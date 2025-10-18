<?php

namespace App\Http\Controllers;


use App\Models\items;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\OrderItem;
use App\Models\ActivityLog;
use App\Events\OrderCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:kasir,owner']);
    }

    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(30);
        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $items = items::where('availability', 'available')->where('stock', '>', 0)->get();
        return view('orders.create', compact('items'));
    }

    public function store(Request $r)
    {
        $r->validate([
            'customer_name' => 'nullable|string',
            'items' => 'required|array|min:1',
            'items.*.item_id' => 'required|exists:items,id',
            'items.*.qty' => 'required|integer|min:1',
            'payment_method' => 'required|in:cash,qr,bank_transfer,other'
        ]);

        DB::beginTransaction();
        try {
            $order = Order::create([
                'user_id' => auth()->id(),
                'customer_name' => $r->customer_name,
                'total' => 0,
                'payment_status' => 'pending',
                'payment_method' => $r->payment_method
            ]);

            $total = 0;
            foreach ($r->items as $it) {
                $menu = items::lockForUpdate()->find($it['item_id']);
                if (!$menu) throw new \Exception('Item not found');
                if ($menu->stock < $it['qty']) throw new \Exception("Stok {$menu->name} tidak cukup");
                $subtotal = $menu->price * $it['qty'];
                OrderItem::create([
                    'order_id' => $order->id,
                    'item_id' => $menu->id,
                    'quantity' => $it['qty'],
                    'price' => $menu->price,
                    'subtotal' => $subtotal
                ]);
                $menu->decrement('stock', $it['qty']);
                $total += $subtotal;
            }

            $order->update(['total' => $total]);

            ActivityLog::create(['user_id' => auth()->id(), 'activity_type' => 'order_created', 'description' => "Order #{$order->id} dibuat, total {$order->total}"]);

            event(new OrderCreated($order->load('items.item', 'user')));

            DB::commit();
            return redirect()->route('orders.show', $order->id)->with('success', 'Order dibuat');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors($e->getMessage());
        }
    }

    public function show(Order $order)
    {
        $order->load('items.item', 'user', 'payment');
        return view('orders.show', compact('order'));
    }

    public function destroy(Order $order)
    {
        // rollback stock when deleting? depends on business logic. We'll not auto-rollback here.
        $order->delete();
        return back()->with('success', 'Order dihapus');
    }

    public function printReceipt(Order $order)
    {
        $order->load('items.item', 'user');
        $pdf = Pdf::loadView('orders.receipt', compact('order'))->setPaper([0, 0, 226.77, 600], 'portrait');
        return $pdf->stream("receipt-{$order->id}.pdf");
    }
}

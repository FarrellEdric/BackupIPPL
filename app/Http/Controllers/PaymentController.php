<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Order;
use App\Models\ActivityLog;
use App\Events\OrderPaid;

class PaymentController extends Controller
{
    public function __construct(){ $this->middleware(['auth','role:kasir,owner']); }

    public function store(Request $r){
        $r->validate(['order_id'=>'required|exists:orders,id','method'=>'required','amount'=>'nullable|numeric','proof'=>'nullable|file']);
        $order = Order::findOrFail($r->order_id);
        $proofPath = null;
        if ($r->hasFile('proof')) {
            $proofPath = $r->file('proof')->store('payments','public');
        }
        Payment::create(['order_id'=>$order->id,'method'=>$r->method,'proof'=>$proofPath,'amount'=>$r->amount]);
        $order->update(['payment_status'=>'paid','transaction_id'=>uniqid('tx_')]);
        ActivityLog::create(['user_id'=>auth()->id(),'activity_type'=>'payment_made','description'=>"Payment for order #{$order->id}"]);
        event(new OrderPaid($order->load('items.item','user')));
        return redirect()->route('orders.show', $order->id)->with('success','Pembayaran tercatat');
    }
}

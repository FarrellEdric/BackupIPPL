<?php

namespace App\Http\Controllers;

use App\Models\Items;
use App\Models\Category;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;

class ItemsController extends Controller
{
    public function __construct()
    { 
        $this->middleware(['auth', 'role:owner']); 
    }

    public function index()
    { 
        $items = Items::with('category')->paginate(30); 
        return view('items.index', compact('items')); 
    }

    public function create()
    { 
        $categories = Category::all(); 
        return view('items.create', compact('categories')); 
    }

    public function store(Request $r)
    {
        $r->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'availability' => 'nullable|string'
        ]);

        // Cek apakah kolom 'availability' memang ada di tabel
        $data = $r->only(['category_id', 'name', 'description', 'price', 'stock']);
        if (Schema::hasColumn('items', 'availability')) {
            $data['availability'] = $r->input('availability', 'available');
        }

        $item = Items::create($data);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'activity_type' => 'item_created',
            'description' => "Item {$item->name} dibuat"
        ]);

        return redirect()->route('items.index')->with('success', 'Item dibuat');
    }

    public function edit(Items $item)
    { 
        $categories = Category::all(); 
        return view('items.edit', compact('item', 'categories')); 
    }

    public function update(Request $r, Items $item)
    {
        $r->validate([
            'category_id' => 'required|exists:categories,id',
            'name' => 'required|string',
            'price' => 'required|integer',
            'stock' => 'required|integer',
            'availability' => 'nullable|string'
        ]);

        $data = $r->only(['category_id', 'name', 'description', 'price', 'stock']);
        if (Schema::hasColumn('items', 'availability')) {
            $data['availability'] = $r->input('availability', $item->availability ?? 'available');
        }

        $item->update($data);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'activity_type' => 'item_updated',
            'description' => "Item {$item->name} diupdate"
        ]);

        return redirect()->route('items.index')->with('success', 'Item diperbarui');
    }

    public function destroy(Items $item)
    { 
        $item->delete(); 
        return back()->with('success', 'Item dihapus'); 
    }

    public function updateStock(Request $r, Items $item)
    {
        $r->validate(['stock' => 'required|integer']);
        $item->update(['stock' => $r->stock]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'activity_type' => 'stock_updated',
            'description' => "Stock {$item->name} diubah menjadi {$r->stock}"
        ]);

        return back()->with('success', 'Stock diperbarui');
    }
}

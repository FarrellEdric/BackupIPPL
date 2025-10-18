<?php
namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\items;
use App\Models\Category;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function __construct(){ $this->middleware(['auth','role:owner']); }
    public function index(){ $items = items::with('category')->paginate(30); return view('items.index', compact('items')); }
    public function create(){ $categories = Category::all(); return view('items.create', compact('categories')); }
    public function store(Request $r){
        $r->validate(['category_id'=>'required|exists:categories,id','name'=>'required','price'=>'required|integer','stock'=>'required|integer']);
        $item = items::create($r->only(['category_id','name','description','price','stock','availability']));
        ActivityLog::create(['user_id'=>auth()->id(),'activity_type'=>'item_created','description'=>"Item {$item->name} dibuat"]);
        return redirect()->route('items.index')->with('success','Item dibuat');
    }
    public function edit(items $item){ $categories = Category::all(); return view('items.edit', compact('item','categories')); }
    public function update(Request $r, items $item){
        $r->validate(['category_id'=>'required|exists:categories,id','name'=>'required','price'=>'required|integer','stock'=>'required|integer']);
        $item->update($r->only(['category_id','name','description','price','stock','availability']));
        ActivityLog::create(['user_id'=>auth()->id(),'activity_type'=>'item_updated','description'=>"Item {$item->name} diupdate"]);
        return redirect()->route('items.index')->with('success','Item diperbarui');
    }
    public function destroy(items $item){ $item->delete(); return back()->with('success','Item dihapus'); }

    // quick stock update (owner)
    public function updateStock(Request $r, items $item){
        $r->validate(['stock'=>'required|integer']);
        $item->update(['stock'=>$r->stock]);
        ActivityLog::create(['user_id'=>auth()->id(),'activity_type'=>'stock_updated','description'=>"Stock {$item->name} set to {$r->stock}"]);
        return back()->with('success','Stock diperbarui');
    }
}

<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Exports\SalesExports;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    public function __construct(){ $this->middleware(['auth','role:owner']); }

    public function index(){ return view('reports.index'); }

    public function exportPDF(Request $r){
        $q = Order::with('items.item')->when($r->from, fn($q)=>$q->whereDate('created_at','>=',$r->from))
            ->when($r->to, fn($q)=>$q->whereDate('created_at','<=',$r->to))->get();
        $pdf = Pdf::loadView('reports.sales', ['orders'=>$q])->setPaper('a4','portrait');
        return $pdf->download('laporan-penjualan.pdf');
    }

    public function exportExcel(Request $r){
        return Excel::download(new SalesExports($r->all()), 'laporan-penjualan.xlsx');
    }
}

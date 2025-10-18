<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\ActivityLog;

class ReservationController extends Controller
{
    public function __construct(){ $this->middleware(['auth','role:kasir,owner']); }

    public function index(){ $reservations = Reservation::latest()->paginate(20); return view('reservations.index', compact('reservations')); }
    public function create(){ return view('reservations.create'); }

    public function store(Request $r){
        $r->validate(['customer_name'=>'required','seat_number'=>'nullable','people_count'=>'required|integer','reservation_time'=>'required|date']);
        $data = $r->only(['customer_name','seat_number','people_count','reservation_time']);
        $data['user_id'] = auth()->id();
        $res = Reservation::create($data);
        ActivityLog::create(['user_id'=>auth()->id(),'activity_type'=>'reservation_created','description'=>"Reservation #{$res->id}"]);
        return redirect()->route('reservations.index')->with('success','Reservasi dibuat');
    }

    public function updateStatus(Request $r, Reservation $reservation){
        $r->validate(['status'=>'required|in:booked,done,cancelled']);
        $reservation->update(['status'=>$r->status]);
        ActivityLog::create(['user_id'=>auth()->id(),'activity_type'=>'reservation_status','description'=>"Reservation #{$reservation->id} status {$r->status}"]);
        return back()->with('success','Status diperbarui');
    }
}

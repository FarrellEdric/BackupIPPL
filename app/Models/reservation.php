<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class reservation extends Model
{
    protected $fillable = ['customer_name', 'seat_number', 'people_count', 'reservation_time', 'status', 'user_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

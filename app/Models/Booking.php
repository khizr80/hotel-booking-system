<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['room_id', 'customer_id', 'room_booked_date', 'status', 'checkout_date'];
    protected $casts = [
        'room_booked_date' => 'date',
        'checkout_date' => 'date',
    ];
    
    // A booking belongs to one room
    public function room()
    {
        return $this->belongsTo(Room::class);
    }

    // A booking belongs to one customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}

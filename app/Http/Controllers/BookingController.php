<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;
class BookingController extends Controller
{
    public function bookingList()
    {
        $bookings = Booking::with('room', 'customer')
            ->where('status', 'booked') // Only show booked rooms
            ->get();
    
        return view('booking', compact('bookings'));
    }
    
    public function checkout($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status = 'checkedout';
        $booking->checkout_date = now();
        $booking->save();

        return redirect()->route('booking-list')->with('success', 'Booking status updated to checkedout');
    }
    
}


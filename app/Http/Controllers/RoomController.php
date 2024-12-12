<?php
namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        Log::info('Retrieved Rooms Data:', [
            'rooms' => $rooms->toArray() // Convert to array for logging
        ]);
        return response()->json($rooms);
    }

    public function create()
    {
        return view('admin.rooms.create');
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'required|image|max:2048',
        ]);

        $room = new Room;

        $room->name = $request->name;
        $room->price = $request->price;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('rooms', 'public');
            $room->image = $path; // This will save as "rooms/filename.png"
        }

        $room->save();

        return response()->json(['message' => 'Room added successfully!']);
    }


public function book($id)
{
    $room = Room::find($id);
    if (!$room) {
        return response()->json(['success' => false, 'message' => 'Room not found.'], 404);
    }

    $existingBooking = Booking::where('room_id', $room->id)
        ->where('status', 'booked')
        ->first();

    if ($existingBooking) {
        return response()->json(['success' => false, 'message' => 'Room is already booked.'], 409);
    }
    $userId = Auth::id(); // Get the authenticated user ID
    Log::info('Authenticated User ID: ' . $userId); // Log the user ID
    if(!isset($userId))
    {
        Log::info('not set ' . $userId); // Log the user ID
       return  response()->json(['fail' => true, 'message' => 'user not logged in ']);;
    }


    Booking::create([
        'customer_id' => Auth::id(), // Save the customer ID from the authenticated user
        'room_id' => intval($id),
        'room_booked_date' => now(), // Store the current date and time
        'status' => 'booked',        // Set status to 'booked'
        'checkout_date' => null    // Checkout date will be null initially
    ]);

    return response()->json(['success' => true, 'message' => 'Room booked successfully!']);
}

}

<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/rooms-list-api', [RoomController::class, 'index'])->name('rooms-list-api');
Route::get('/customers-list-api', [CustomerController::class, 'index'])->name('customers-list-api');

Route::post('/book-room/{id}', [RoomController::class, 'book'])->name('book.room');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/add-room', function ()  {
        return view("addroom");
    })->name('redirect-add-room');
    Route::get('/booking-list', [BookingController::class, 'bookingList'])->name('booking-list');
    Route::post('/rooms/store', [RoomController::class, 'store'])->name('rooms.store');
    Route::get('/rooms-list', function () {
        $response = Http::get("http://hotel.test/rooms-list-api"); 
        $rooms = $response->json(); // This converts the JSON response to an array
        if ($response->successful()) {
            return view('rooms', compact('rooms')); // Pass the API data to the view
        } else {
            return view('rooms')->with('error', 'Failed to retrieve rooms data');
        }
    })->name('rooms-list');
    Route::get('/customers-list', function () {
        $response = Http::get("http://hotel.test/customers-list-api");
        $customers = $response->json(); // This converts the JSON response to an array
        if ($response->successful()) {
            return view('customer', compact('customers')); // Pass the API data to the view
        } else {
            return view('customer')->with('error', 'Failed to retrieve customers data');
        }
    })->name('customers-list');
    Route::post('/bookings/{id}/checkout', [BookingController::class, 'checkout'])->name('checkout');

});

Route::get('/home', function () {
    $response = Http::get(route('rooms-list-api')); // Use route helper to get the URL
    Log::info('Rooms API Response:', $response->json());

    $rooms = $response->json(); // This converts the JSON response to an array
    if ($response->successful()) {
        return view('home', compact('rooms')); // Pass the API data to the view
    } else {
        return view('home')->with('error', 'Failed to retrieve rooms data');
    }
})->name('home');
// Include authentication routes
require __DIR__.'/auth.php';

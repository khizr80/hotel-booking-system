<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-900 text-white">
    <section class="py-20">
        <div class="max-w-screen-xl mx-auto sm:px-6 lg:px-8">

            <!-- Success Message -->
            @if(session('success'))
                <div class="bg-green-600 text-white p-4 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Error Message -->
            @if(session('error'))
                <div class="bg-red-600 text-white p-4 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <h1 class="mb-12 text-center font-sans text-5xl font-bold text-gray-100">Bookings List<span class="text-blue-500">.</span></h1>

            <div class="overflow-hidden rounded-lg border border-gray-600">
                <table class="min-w-full bg-gray-800 text-left text-gray-300">
                    <thead>
                        <tr>
                            <th class="px-6 py-4">Room Name</th>
                            <th class="px-6 py-4">Booked Date</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($bookings) && $bookings->count() > 0)
                            @foreach($bookings as $booking)
                                <tr class="bg-gray-700">
                                    <td class="px-6 py-4">{{ $booking->room->name }}</td>
                                    <td class="px-6 py-4">{{ $booking->room_booked_date->format('d M Y') }}</td>
                                    <td class="px-6 py-4">{{ ucfirst($booking->status) }}</td>
                                    <td class="px-6 py-4">
                                        <!-- Checkout Button -->
                                        @if($booking->status == 'booked')
                                        <form method="POST" action="{{ route('checkout', $booking->id) }}">
    @csrf
    <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
        Checkout
    </button>
</form>
                                        @else
                                            <span class="text-green-500">Checked out</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="5" class="px-6 py-4 text-center">No bookings available</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>
</html>

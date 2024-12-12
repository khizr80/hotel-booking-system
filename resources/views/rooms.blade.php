<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms List</title>
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

            <h1 class="mb-12 text-center font-sans text-5xl font-bold text-gray-100">Rooms List<span class="text-blue-500">.</span></h1>

            <div class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2 lg:grid-cols-3">
                @if(isset($rooms) && is_array($rooms) && count($rooms) > 0)
                    @foreach($rooms as $room)
                        <article class="rounded-xl bg-gray-800 p-3 shadow-lg hover:shadow-xl transition-shadow duration-300">
                            <a href="#">
                                <div class="relative flex items-end overflow-hidden rounded-xl">
                                    <img src="{{ Storage::url($room['image']) }}" alt="{{ $room['name'] }}" class="w-full h-48 object-cover">
                                </div>

                                <div class="mt-1 p-2">
                                    <h2 class="text-slate-200">{{ $room['name'] }}</h2>
                                    <p class="text-slate-400 mt-1 text-sm">Price: ${{ $room['price'] }}</p>
                                    <div class="mt-4">
                                        <button class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">View Details</button>
                                    </div>
                                </div>
                            </a>
                        </article>
                    @endforeach
                @else
                    <div class="col-span-full border border-gray-600 p-4 text-center">No rooms available</div>
                @endif
            </div>
        </div>
    </section>
</body>
</html>

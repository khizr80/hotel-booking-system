<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="mt-6 flex space-x-4">
                    <!-- Add Room Button -->
                    <a href="{{ route('redirect-add-room') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Add Room
                    </a>

                    <!-- Rooms List Button -->
                    <a href="{{ route('rooms-list') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">
                        Rooms List
                    </a>

                    <!-- Customers List Button -->
                    <a href="{{ route('customers-list') }}" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                        Customers List
                    </a>

                    <!-- Room Booking List Button -->
                    <a href="{{ route('booking-list') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">
                        Room Booking List
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

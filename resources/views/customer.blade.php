<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h1 class="text-xl font-bold mb-4 text-gray-800 dark:text-gray-200">Customer List</h1>

                <!-- Success Message -->
                @if (session('success'))
                    <div class="mb-4 p-4 bg-green-500 text-white rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Error Message -->
                @if (session('error'))
                    <div class="mb-4 p-4 bg-red-500 text-white rounded-md">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Table to Display Customer List -->
                <table class="min-w-full bg-white dark:bg-gray-700 rounded-lg">
                    <thead class="bg-gray-200 dark:bg-gray-600">
                        <tr>
                            <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">ID</th>
                            <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">Name</th>
                            <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">Email</th>
                            <th class="py-2 px-4 text-left text-gray-600 dark:text-gray-300">Phone</th> <!-- Phone Column -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($customers as $customer)
                            <tr class="border-b dark:border-gray-600">
                                <td class="py-2 px-4 text-gray-800 dark:text-gray-200">{{ $customer['id'] }}</td>
                                <td class="py-2 px-4 text-gray-800 dark:text-gray-200">{{ $customer['name'] }}</td>
                                <td class="py-2 px-4 text-gray-800 dark:text-gray-200">{{ $customer['email'] }}</td>
                                <td class="py-2 px-4 text-gray-800 dark:text-gray-200">{{ $customer['phone'] }}</td> <!-- Phone Number Display -->
                                <td class="py-2 px-4">
                                    <!-- Additional actions can be added here -->
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>

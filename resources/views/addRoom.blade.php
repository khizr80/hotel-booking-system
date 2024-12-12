<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <h1 class="text-xl font-bold mb-4 text-gray-800 dark:text-gray-200">Add Room</h1>

                <!-- Success Message -->
                @if(session('success'))
                    <div class="bg-green-500 text-white p-4 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Error Messages -->
                @if($errors->any())
                    <div class="bg-red-500 text-white p-4 rounded mb-4">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form to Add Room -->
                <form action="{{ route('rooms.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Name Field -->
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 dark:text-gray-300">Room Name</label>
                        <input type="text" id="name" name="name" class="w-full p-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 rounded-md" required>
                    </div>
                    
                    <!-- Price Field -->
                    <div class="mb-4">
                        <label for="price" class="block text-gray-700 dark:text-gray-300">Price</label>
                        <input type="number" id="price" name="price" class="w-full p-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 rounded-md" required min="0" >
                    </div>
                    
                    <!-- Image Upload Field -->
                    <div class="mb-4">
                        <label for="image" class="block text-gray-700 dark:text-gray-300">Room Image</label>
                        <input type="file" id="image" name="image" class="w-full p-2 border border-gray-300 dark:bg-gray-700 dark:border-gray-600 rounded-md" accept="image/*" required>
                    </div>
                    
                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Add Room</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

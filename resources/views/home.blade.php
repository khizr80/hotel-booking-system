<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body class="bg-gray-900 text-white">
    <section class="py-20">
        <div class="max-w-screen-xl mx-auto sm:px-6 lg:px-8">

            <!-- Success/Error Message -->
            <div id="message" class="hidden p-4 rounded mb-4"></div>

            <h1 class="mb-12 text-center font-sans text-5xl font-bold text-gray-100">Rooms List<span class="text-blue-500">.</span></h1>

            <!-- Authentication Buttons -->
            <div class="mb-4 text-right">
                @auth
                    <!-- If the user is authenticated, show the Logout Button -->
                    <form id="logoutForm" method="POST">
                        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                            Logout
                        </button>
                    </form>
                @else
                    <!-- If the user is a guest, show the Login Button -->
                    <a href="/login" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                        Login
                    </a>
                @endauth
            </div>

            <!-- Rooms List -->
            <div id="roomsList" class="grid grid-cols-1 gap-6 p-6 md:grid-cols-2 lg:grid-cols-3">
                <div class="col-span-full text-center text-slate-400">Loading rooms...</div>
            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            fetch('/rooms-list-api')
                .then(response => response.json())
                .then(data => {
                    const roomsList = document.getElementById('roomsList');
                    roomsList.innerHTML = ''; // Clear the loading message
                    console.log(data);
                    
                    if (data.length > 0) {
                        data.forEach(room => {
                            const roomCard = `
                                <article class="rounded-xl bg-gray-800 p-3 shadow-lg hover:shadow-xl transition-shadow duration-300">
                                    <div class="relative flex items-end overflow-hidden rounded-xl">
                                        <img src="${room.image}" alt="${room.name}" class="w-full h-48 object-cover">
                                    </div>

                                    <div class="mt-1 p-2">
                                        <h2 class="text-slate-200">${room.name}</h2>
                                        <p class="text-slate-400 mt-1 text-sm">Price: $${room.price}</p>
                                        <div class="mt-4">
                                            <button onclick="bookRoom(${room.id})" class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition">
                                                Book Room
                                            </button>
                                        </div>
                                    </div>
                                </article>`;
                            roomsList.insertAdjacentHTML('beforeend', roomCard);
                        });
                    } else {
                        roomsList.innerHTML = '<div class="col-span-full border border-gray-600 p-4 text-center">No rooms available</div>';
                    }
                })
                .catch(error => {
                    console.error('Error fetching rooms:', error);
                    document.getElementById('roomsList').innerHTML = '<div class="col-span-full border border-gray-600 p-4 text-center">Failed to load rooms</div>';
                });
        });

        // Book Room function
        function bookRoom(roomId) {
            fetch(`/book-room/${roomId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') // Fetch CSRF token from meta tag
                }
            })
            .then(response => response.json())
            .then(data => {
                const messageBox = document.getElementById('message');
                messageBox.textContent = data.message;
                messageBox.classList.remove('hidden', 'bg-red-600', 'bg-green-600');
                
                if (data.success) {
                    messageBox.classList.add('bg-green-600');
                } else {
                    messageBox.classList.add('bg-red-600');
                }
            })
            .catch(error => {
                console.error('Error booking room:', error);
                const messageBox = document.getElementById('message');
                messageBox.textContent = 'An error occurred while trying to book the room.';
                messageBox.classList.remove('hidden');
                messageBox.classList.add('bg-red-600');
            });
        }

        // Logout function
        document.getElementById('logoutForm').addEventListener('submit', function (e) {
            e.preventDefault();
            fetch('/logout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(() => window.location.href = '/login')
            .catch(error => console.error('Error logging out:', error));
        });
    </script>
</body>
</html>

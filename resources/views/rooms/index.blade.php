<x-layout>
    <x-sidebar>
        <div>
            @if (session('success'))
                <x-flashMsg msg="{{ session('success') }}" />
            @elseif (session('deleted'))
                <x-flashMsg msg="{{ session('deleted') }}" bg="bg-red-500" />
            @endif
        </div>

        <div class="mb-4">
            <a href="{{ route('rooms.create') }}"
                class="text-sm bg-slate-600 text-white p-2 rounded-lg flex items-center justify-center sm:justify-start">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6 mr-1">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Add Room
            </a>
        </div>

        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="p-4 sm:p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-2">Rooms</h2>
                <p class="text-sm text-gray-500 mb-4">Browse a list of available rooms in our reservation system.</p>

                <form id="search-form" class="mb-4">
                    <input type="text" name="search" id="search-input" placeholder="Search rooms..."
                        class="p-2 border text-sm rounded w-full focus:ring-pink-600 mb-2"
                        value="{{ request('search') }}" />
                    <button type="submit"
                        class="p-2 bg-blue-500 text-white rounded w-full text-sm hover:bg-blue-700">Search</button>
                </form>
            </div>

            <div id="rooms-container" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
                @foreach ($rooms as $room)
                    <div class="bg-white border rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-300">
                        <div class="p-4">
                            <h3 class="font-bold text-lg mb-2">Room {{ $room->room_number }}</h3>
                            <p class="text-gray-600 mb-1">Type: {{ $room->room_type }}</p>
                            <p class="text-gray-600 mb-1">Price: ₱{{ number_format($room->price, 2) }}</p>
                            <p class="text-gray-600 mb-1">Pax: {{ $room->pax }}</p>
                            <p class="text-gray-600 mb-3">Stay: {{ ucfirst($room->stay_type) }}</p>
                            <div class="flex justify-between items-center">
                                <a href="{{ route('rooms.edit', $room) }}"
                                    class="text-sm font-medium text-blue-600 hover:underline">Edit</a>
                                <button class="text-sm font-medium text-red-600 hover:underline"
                                    onclick="confirmDelete('delete-form-{{ $room->id }}', 'room')">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                    <form id="delete-form-{{ $room->id }}"
                        action="{{ route('rooms.destroy', $room) }}" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>
                @endforeach
            </div>

            <div class="p-4">
                {{ $rooms->links() }}
            </div>
        </div>
    </x-sidebar>

    <script src="{{ asset('js/search.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initializeSearch('search-form', 'rooms-container', '{{ route('rooms.index') }}');
        });
    </script>
</x-layout>

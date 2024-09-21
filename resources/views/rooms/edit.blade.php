<x-layout>
    <x-sidebar>
        <div class="container mx-auto px-4 py-8 w-full sm:w-1/2 border rounded-lg bg-white mt-0 sm:mt-10">
            <a href="{{ route('rooms.index') }}" class="text-blue-500 text-sm underline">&larr; back to room list</a>
            <h1 class="text-3xl font-bold text-slate-700 mt-4">Edit Room</h1>
            <p class="text-sm text-slate-500 mb-6">Edit room details</p>
            <form action="{{ route('rooms.update', $room) }}" method="POST" class="flex flex-col w-full justify-center">
                @csrf
                @method('PUT')
                <div class="mb-4 w-full">
                    <label for="room_number" class="block text-gray-700 font-bold mb-2 text-sm">Room Number</label>
                    <input type="text" name="room_number" id="room_number"
                        class="w-full text-gray-600 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500"
                        value="{{ old('room_number', $room->room_number) }}" placeholder="Room - 1" required>
                </div>

                @error('room_number')
                    <p class="text-sm text-red-600 mb-4">{{ $message }}</p>
                @enderror

                <div class="mb-4">
                    <label for="room_type" class="block text-gray-700 font-bold mb-2 text-sm">Room Type</label>
                    <input type="text" name="room_type" id="room_type"
                        class="w-full text-gray-600 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500"
                        value="{{ old('room_type', $room->room_type) }}" placeholder="Deluxe Room" required>
                </div>

                @error('room_type')
                    <p class="text-sm text-red-600 mb-4">{{ $message }}</p>
                @enderror

                <div class="mb-4">
                    <label for="price" class="block text-gray-700 font-bold mb-2 text-sm">Price</label>
                    <input type="number" name="price" id="price" step="0.01"
                        class="w-full text-gray-600 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500"
                        value="{{ old('price', $room->price) }}" placeholder="0.0" required>
                </div>

                @error('price')
                    <p class="text-sm text-red-600 mb-4">{{ $message }}</p>
                @enderror

                <div class="mb-4">
                    <label for="pax" class="block text-gray-700 font-bold mb-2 text-sm">Pax (Number of
                        People)</label>
                    <input type="number" name="pax" id="pax"
                        class="w-full text-gray-600 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500"
                        value="{{ old('pax', $room->pax) }}" placeholder="5" required>
                </div>

                @error('pax')
                    <p class="text-sm text-red-600 mb-4">{{ $message }}</p>
                @enderror

                <div class="mb-6">
                    <label for="stay_type" class="block text-gray-700 font-bold mb-2 text-sm">Stay Type</label>
                    <select name="stay_type" id="stay_type"
                        class="bg-gray-50 border border-gray-300 text-gray-600 text-sm rounded-lg focus:ring-pink-500 focus:border-pink-500 block w-full p-2.5"
                        required>
                        <option value="">Select Stay Type</option>
                        <option value="day tour"
                            {{ old('stay_type', $room->stay_type) == 'day tour' ? 'selected' : '' }}>Day Tour</option>
                        <option value="overnight"
                            {{ old('stay_type', $room->stay_type) == 'overnight' ? 'selected' : '' }}>Overnight
                        </option>
                    </select>
                </div>

                @error('stay_type')
                    <p class="text-sm text-red-600 mb-4">{{ $message }}</p>
                @enderror

                <div>
                    <button type="submit"
                        class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        Update Room
                    </button>
                </div>
            </form>
        </div>
    </x-sidebar>
</x-layout>

<x-layout>
    <x-navbar />
    <div class="container mx-auto flex flex-col items-center">
        <div style="background-image: url('{{ asset('img/matabungkay-beach-batangas.jpg') }}')"
            class="h-48 w-full bg-cover bg-center absolute -z-50"></div>
        <div
            class="mt-5 bg-gray-100 p-5 sm:w-1/2 sm:mx-4 border flex justify-center flex-col items-center shadow-lg rounded-lg">
            <h1 class="text-2xl font-bold text-gray-700">Search Rooms</h1>

            <form id="search-form" method="POST" class=" w-full">
                @csrf
                <div class="flex justify-center gap-x-5 mt-4">
                    <div class="rounded-lg p-1 cursor-pointer overflow-hidden">
                        <input type="radio" id="stay-type-day-tour" name="stay_type" value="day tour"
                            class="hidden peer" checked>
                        <label for="stay-type-day-tour"
                            class="flex flex-col items-center justify-center text-center h-full w-full text-sm font-medium text-gray-900 peer-checked:bg-blue-100 peer-checked:border-blue-700 border-2 border-gray-400 p-2 rounded-full">
                            Day Tour Stays
                        </label>
                    </div>
                    <div class="rounded-lg p-1 cursor-pointer overflow-hidden">
                        <input type="radio" id="stay-type-overnight" name="stay_type" value="overnight"
                            class="hidden peer">
                        <label for="stay-type-overnight"
                            class="flex flex-col items-center justify-center text-center h-full w-full text-sm font-medium text-gray-900 peer-checked:bg-blue-100 peer-checked:border-blue-700 border-2 border-gray-400 p-2 rounded-full">
                            Overnight Stays
                        </label>
                    </div>
                </div>

                <span id="error-stay_type" class="text-red-500 text-sm mt-1"></span>

                <div id="date-range-picker" class="flex items-center mt-4 justify-center">
                    <input id="datepicker-range-start" name="start" type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Select date start">
                    <span class="mx-4 text-gray-500">to</span>
                    <input id="datepicker-range-end" name="end" type="text"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                        placeholder="Select date end">
                </div>

                <span id="error-start" class="text-red-500 text-sm mt-1"></span>
                <span id="error-end" class="text-red-500 text-sm mt-1"></span>

                <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-md w-full">Check Rooms
                    Availability</button>
            </form>
        </div>

        <div id="rooms-list" class="mt-6 w-full sm:w-1/2">
            <h2 class="text-xl font-bold text-gray-700 ml-2">Available Rooms</h2>
            <ul class="mt-2">
            </ul>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#datepicker-range-start", {
                dateFormat: "Y-m-d"
            });
            flatpickr("#datepicker-range-end", {
                dateFormat: "Y-m-d"
            });

            const form = document.getElementById('search-form');
            const roomsList = document.getElementById('rooms-list').querySelector('ul');
            const errorStayType = document.getElementById('error-stay_type');
            const errorStart = document.getElementById('error-start');
            const errorEnd = document.getElementById('error-end');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                errorStayType.textContent = '';
                errorStart.textContent = '';
                errorEnd.textContent = '';

                const formData = new FormData(form);
                const csrfToken = formData.get('_token');

                fetch('{{ route('searchRoom') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        roomsList.innerHTML = '';

                        if (data.errors) {
                            if (data.errors.stay_type) {
                                errorStayType.textContent = data.errors.stay_type[0];
                            }
                            if (data.errors.start) {
                                errorStart.textContent = data.errors.start[0];
                            }
                            if (data.errors.end) {
                                errorEnd.textContent = data.errors.end[0];
                            }
                            return;
                        }

                        if (data.rooms && data.rooms.length > 0) {
                            data.rooms.forEach(room => {
                                const roomItem = document.createElement('li');
                                roomItem.classList.add('border', 'p-4', 'mb-2', 'w-full',
                                    'sm:w-1/2');
                                roomItem.innerHTML = `
                            <h3 class="font-semibold">${room.room_number} - ${room.room_type}</h3>
                            <p>Price: ₱${room.price}</p>
                            <p>Pax: ${room.pax}</p>
                            <p>Stay Type: ${room.stay_type}</p>
                        `;
                                roomsList.appendChild(roomItem);
                            });
                        } else {
                            roomsList.innerHTML =
                            '<p>No rooms available for the selected criteria.</p>';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        });
    </script>
</x-layout>

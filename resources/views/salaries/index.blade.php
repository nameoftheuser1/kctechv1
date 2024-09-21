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
            <a href="{{ route('staff.create') }}" class="text-sm bg-slate-600 text-white p-2 rounded-lg flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                Add New Staff
            </a>
        </div>

        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">

            <table class="w-full text-sm text-left rtl:text-right text-gray-500">
                <caption class="p-5 text-lg font-semibold text-left rtl:text-right text-gray-900 bg-white">
                    Staff List
                    <p class="mt-1 text-sm font-normal text-gray-500">Click on a staff member's name to view more details about their salary.</p>

                    <form id="search-form">
                        <input type="text" name="search" id="search-input" placeholder="Search staff..." class="p-2 border text-sm rounded w-full focus:ring-pink-600 mb-1 mt-2" value="{{ request('search') }}" />
                        <button type="submit" class="p-2 bg-blue-500 text-white rounded w-full text-sm hover:bg-blue-700">Search</button>
                    </form>
                </caption>

                <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3">Name</th>
                        <th scope="col" class="px-6 py-3">Salary</th>
                        <th scope="col" class="px-6 py-3">Payout Date</th>
                        <th scope="col" class="px-6 py-3"><span class="sr-only">Actions</span></th>
                    </tr>
                </thead>

                <tbody id="staff-table-body">
                    @foreach($staff as $member)
                    <tr class="bg-white border-b hover:bg-gray-100 cursor-pointer" onclick="window.location='{{ route('staff.show', $member->id) }}'">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">{{ $member->name }}</th>
                        <td class="px-6 py-4">₱{{ number_format($member->salary, 2) }}</td>
                        <td class="px-6 py-4">{{ $member->payout_date->format('F j, Y') }}</td>
                        <td class="px-6 py-4 text-right">
                            <a href="{{ route('staff.edit', $member->id) }}" class="font-medium text-blue-600 hover:underline" onclick="event.stopPropagation();">Edit</a>

                            <button class="text-red-600 hover:underline ml-2" onclick="event.stopPropagation(); confirmDelete('delete-form-{{ $member }}', 'staff')">Delete</button>

                            <form id="delete-form-{{ $member }}" action="{{ route('staff.destroy', $member->id) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="p-4">
                {{ $staff->links() }}
            </div>
        </div>

    </x-sidebar>

    <script src="{{ asset('js/search.js') }}"></script>
    <script src="{{ asset('js/delete.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            initializeSearch('search-form', 'staff-table-body', '{{ route('staff.index') }}');
        });
    </script>

</x-layout>

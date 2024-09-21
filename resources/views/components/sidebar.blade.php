<!-- responsive-sidebar.blade.php -->
@props(['isOpen' => true])

<div x-data="{ isOpen: {{ $isOpen ? 'true' : 'false' }} }" class="flex h-screen">

    <aside x-show="isOpen" class="hidden md:flex flex-col w-64 p-4 fixed inset-y-0 left-0 z-30">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Kandahar</h2>
            <button @click="isOpen = false" class="md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <nav>
            <ul>
                @php
                    $menuItems = [
                        [
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />',
                            'label' => 'Dashboard',
                            'route' => 'dashboard',
                        ],
                        [
                            'icon' =>
                                '<path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />',
                            'label' => 'Room Management',
                            'route' => 'rooms.index',
                        ],
                        [
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />',
                            'label' => 'Salary Management',
                            'route' => 'staff.index',
                        ],
                    ];
                @endphp

                @foreach ($menuItems as $item)
                    <li
                        class="mb-4 hover:bg-slate-300 rounded-lg p-1 {{ request()->routeIs($item['route']) ? 'bg-gray-300 text-slate-700' : '' }}">
                        <a href="{{ route($item['route']) }}" class="flex items-center space-x-2 text-slate-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                {!! $item['icon'] !!}
                            </svg>
                            <span>{{ $item['label'] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </aside>

    <main class="flex-1 p-4 md:ml-64 bg-gray-100">
        {{ $slot }}
    </main>

    <nav class="md:hidden fixed bottom-0 left-0 right-0  p-4">
        <ul class="flex justify-around">
            @foreach ($menuItems as $item)
                <li>
                    <a href="{{ route($item['route']) }}"
                        class="flex flex-col items-center rounded-lg p-2 {{ request()->routeIs($item['route']) ? 'bg-gray-300 text-slate-700' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            {!! $item['icon'] !!}
                        </svg>
                        <span class="text-xs mt-1">{{ $item['label'] }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
    </nav>
</div>

@props(['isOpen' => false])

<div x-data="{ isOpen: @json($isOpen) }" class="flex h-screen">
    <div x-show="isOpen"
         class="fixed inset-0 bg-black opacity-50 z-40 md:hidden"
         @click="isOpen = false"></div>

    <aside id="sidebar"
           x-bind:class="isOpen ? 'translate-x-0' : '-translate-x-full'"
           class="fixed inset-y-0 left-0 z-50 sm:z-0 w-64 bg-white shadow-lg transform transition-transform duration-300 ease-in-out md:translate-x-0">
        <div class="flex justify-between items-center p-4 border-b mt-14 md:mt-0">
            <h2 class="text-2xl font-bold">Kandahar</h2>
        </div>
        <nav class="p-4">
            <ul>
                @php
                    $menuItems = [
                        [
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6A2.25 2.25 0 0 1 6 3.75h2.25A2.25 2.25 0 0 1 10.5 6v2.25a2.25 2.25 0 0 1-2.25 2.25H6a2.25 2.25 0 0 1-2.25-2.25V6ZM3.75 15.75A2.25 2.25 0 0 1 6 13.5h2.25a2.25 2.25 0 0 1 2.25 2.25V18a2.25 2.25 0 0 1-2.25 2.25H6A2.25 2.25 0 0 1 3.75 18v-2.25ZM13.5 6a2.25 2.25 0 0 1 2.25-2.25H18A2.25 2.25 0 0 1 20.25 6v2.25A2.25 2.25 0 0 1 18 10.5h-2.25a2.25 2.25 0 0 1-2.25-2.25V6ZM13.5 15.75a2.25 2.25 0 0 1 2.25-2.25H18a2.25 2.25 0 0 1 2.25 2.25V18A2.25 2.25 0 0 1 18 20.25h-2.25A2.25 2.25 0 0 1 13.5 18v-2.25Z" />',
                            'label' => 'Dashboard',
                            'route' => 'dashboard',
                        ],
                        [
                            'icon' => '<path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />',
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
                    <li class="mb-4 hover:bg-slate-300 rounded-lg p-1 {{ request()->routeIs($item['route']) ? 'bg-gray-300 text-slate-700' : '' }}">
                        <a href="{{ route($item['route']) }}" class="flex items-center space-x-2 text-slate-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                {!! $item['icon'] !!}
                            </svg>
                            <span>{{ $item['label'] }}</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>
    </aside>

    <nav class="fixed top-0 left-0 right-0 z-50 flex items-center justify-between p-4 bg-white md:hidden">
        <button @click="isOpen = !isOpen"
                class="w-10 h-10"
                aria-label="Toggle Sidebar">
            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-6 w-6"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
            </svg>
        </button>
        <div class="flex justify-center flex-1">
            <img src="/path/to/logo.png" alt="Logo" class="h-8">
        </div>
        <div class="w-10 h-10"></div>
    </nav>

    <main class="flex-1 p-4 mt-14 md:mt-0 ms-0 md:ms-64 bg-gray-100">
        {{ $slot }}
    </main>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const overlay = document.getElementById('sidebar-overlay');
    overlay?.addEventListener('click', function() {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.add('-translate-x-full');
    });
});
</script>

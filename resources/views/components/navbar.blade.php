<div x-data="{ open: false }" class="relative">
    <div class="w-full bg-white fixed top-0 left-0 right-0 z-50">
        <div class="container mx-auto px-4 sm:px-10">
            <div class="flex justify-between items-center h-[100px]">
                <p class="font-bold font-mono text-[20px] text-gray-800 sm:text-[30px]">Kandahar Resort</p>
                <button @click="open = !open" class="sm:hidden p-2 z-20">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="lucide lucide-menu">
                        <line x1="4" x2="20" y1="12" y2="12" />
                        <line x1="4" x2="20" y1="6" y2="6" />
                        <line x1="4" x2="20" y1="18" y2="18" />
                    </svg>
                </button>
                <div class="hidden sm:flex sm:gap-5 sm:h-[25px]">
                    <a href="{{route('home')}}" class="hover:border-b-[1px] border-black">Home</a>
                    <a href="" class="hover:border-b-[1px] border-black">Room</a>
                    <a href="" class="hover:border-b-[1px] border-black">Services</a>
                    <a href="" class="hover:border-b-[1px] border-black">Reservation</a>
                </div>
            </div>
        </div>
    </div>
    <div x-show="open" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="transform -translate-y-full"
        x-transition:enter-end=" transform translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start=" transform translate-y-0"
        x-transition:leave-end=" transform -translate-y-full" @click.away="open = false"
        class="sm:hidden fixed top-0 left-0 right-0 bg-white border-b border-gray-200 shadow-md z-40"
        style="padding-top: 100px;">
        <div class="container mx-auto px-4 sm:px-10 py-4">
            <a href="" class="block py-2 hover:bg-gray-100">Home</a>
            <a href="" class="block py-2 hover:bg-gray-100">Room</a>
            <a href="" class="block py-2 hover:bg-gray-100">Services</a>
            <a href="" class="block py-2 hover:bg-gray-100">Reservation</a>
        </div>
    </div>
</div>
<div class="mt-[100px]">
    {{ $slot }}
</div>
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('navbar', () => ({
            open: false
        }))
    })
</script>

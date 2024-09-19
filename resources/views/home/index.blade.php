<x-layout>
    <x-navbar />
    <div
        class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 h-[60svh] flex justify-center items-center text-white">
        <div class="w-[750px] text-center" data-aos="fade-up">
            <span class="text-[60px] font-semibold">Relax and unwind at Kandahar Resort</span>
            <div class="mb-10">Experience comfort and luxury with hassle-free reservations. Your getaway awaits!</div>
            <a href="" class="border border-white rounded-full py-3 px-7">Book now</a>
        </div>
    </div>

    <section class="flex container mx-auto px-5 my-14">
        <div class="w-full my-auto" data-aos="fade-right">
            <h1 class="text-[50px] font-semibold text-gray-800">Welcome to Kandahar Resort</h1>
            <p class="text-gray-700">Experience unparalleled comfort and hospitality at Kandahar Resort, where we
                offer a variety of rooms and services tailored to make your stay unforgettable. Reservations are easy
                and
                convenient.</p>
            <div class="flex gap-20">
                <div data-aos="zoom-in">
                    <h1 class="text-blue-900 text-[50px]">
                        150+
                    </h1>
                    <p class="text-sm text-gray-700">Book now</p>
                </div>
                <div data-aos="zoom-in">
                    <h1 class="text-blue-900 text-[50px]">
                        15
                    </h1>
                    <p class="text-sm text-gray-700">Trusted by guest</p>
                </div>
            </div>
        </div>
        <div class="w-full" data-aos="fade-left">
            <img src="{{ asset('img/welcome.png') }}" alt="">
        </div>
    </section>

    <section>
        <!-- More content here -->
    </section>
</x-layout>

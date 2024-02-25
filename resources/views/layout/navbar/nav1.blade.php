<nav class="bg-white border-gray-200 dark:bg-gray-900 sticky w-full z-20 top-0 start-0 drop-shadow-md">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-2">
        <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
            <img class="w-8 h-8" src="{{ asset('assets/icon/android-chrome-512x512.png') }}" alt="logo">
            <span
                class="self-center text-xl font-semibold whitespace-nowrap dark:text-white hidden md:block">Pisturest</span>
        </a>
        <div class="flex md:order-2 gap-2">
            <div class="relative w-full md:w-auto lg:w-[500px] hidden md:block" id="navbar-search">
                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                    <span class="sr-only">Search icon</span>
                </div>
                <input type="search" id="search-nav" name="search-nav"
                    class="block w-full p-2 ps-10 text-sm text-gray-900 border border-blue-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="Search..." />
            </div>
            <button id="search-button" type="button" data-collapse-toggle="navbar-search" aria-controls="navbar-search"
                aria-expanded="false"
                class="md:hidden text-gray-500 rounded-lg text-sm p-2.5 me-1 scale-100 hover:scale-105">
                <label for="search-nav">
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </label>
                <span class="sr-only">Search</span>
            </button>
            @if (!auth()->check())
                <div>
                    <a href="/#login" class="font-normal block p-1 text-black w-8 h-8 scale-100 hover:scale-105">
                        <img class="object-cover" src="{{ asset('assets/icon/login.png') }}" alt="">
                    </a>
                </div>
            @else
                <div>
                    <a href="/#login"
                        class="font-normal hidden block py-2 px-3 text-black focus:ring-4 focus:outline-none focus:ring-red-600">Masuk</a>
                </div>
            @endif
        </div>
    </div>
</nav>

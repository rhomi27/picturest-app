<nav class="bg-white border-gray-200 dark:bg-gray-900 sticky w-full z-20 top-0 start-0 drop-shadow-md">
    <div class="w-screen flex flex-wrap items-center justify-between mx-auto p-3 px-5 md:px-10">
        <div class="flex flex-col items-center">
            <button onclick="goBack()">
                <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24">
                    <path
                        d="M.88,14.09,4.75,18a1,1,0,0,0,1.42,0h0a1,1,0,0,0,0-1.42L2.61,13H23a1,1,0,0,0,1-1h0a1,1,0,0,0-1-1H2.55L6.17,7.38A1,1,0,0,0,6.17,6h0A1,1,0,0,0,4.75,6L.88,9.85A3,3,0,0,0,.88,14.09Z" />
                </svg>
            </button>
        </div>
        <div class="flex flex-col justify-center items-center">
            <h1 class="self-center text-sm font-semibold dark:text-white">{{ $navTitle }}</h1>
        </div>
        <div class="flex flex-col justify-center item-center">
            <div class="text-xs font-semibold text-black hover:text-orange-500"></div>
        </div>
    </div>
</nav>

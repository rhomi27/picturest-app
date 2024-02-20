<nav class="bg-white border-gray-200 dark:bg-gray-900 sticky w-full z-20 top-0 start-0 drop-shadow-md">
    <div class="w-screen flex flex-wrap items-center justify-between mx-auto p-2 px-5">
        <div class="flex flex-col items-center ">
            <a href="/profil-user/{{ $user->id }}">
                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24">
                    <path
                        d="M.88,14.09,4.75,18a1,1,0,0,0,1.42,0h0a1,1,0,0,0,0-1.42L2.61,13H23a1,1,0,0,0,1-1h0a1,1,0,0,0-1-1H2.55L6.17,7.38A1,1,0,0,0,6.17,6h0A1,1,0,0,0,4.75,6L.88,9.85A3,3,0,0,0,.88,14.09Z" />
                </svg>
            </a>
        </div>
        <div class="flex flex-col justify-center items-center">
            <h1 class="self-center text-sm font-semibold dark:text-white">{{ $user->username }}</h1>
        </div>
        <div class="flex flex-col items-center ">

        </div>
    </div>
    <div class="w-screen grid grid-cols-2 mx-auto p-1 px-5">
        <div class="nav-link {{ request()->routeIs('user.followers') ? 'actived' : '' }}">
            <a href="{{ route('user.followers', $user->id) }}" class="block py-2 text-center">Pengikut</a>
        </div>
        <div class="nav-link {{ request()->routeIs('user.following') ? 'actived' : '' }}">
            <a href="{{ route('user.following', $user->id) }}" class="block py-2 text-center">Mengikuti</a>
        </div>
    </div>
</nav>

<div class="max-h-80 hide-scrollbar overflow-y-scroll overflow-x-hidden" id="default-tab-content">
    <div class="hidden p-4 rounded-lg bg-white dark:bg-gray-800" id="settings" role="tabpanel"
        aria-labelledby="settings-tab">
        @foreach ($following as $item)
            <div class="flex justify-between items-center  mb-2">
                <a class="flex gap-2 items-center " href="/profil-user/{{ $item->id }}">
                    <img class="w-8 h-8 rounded-full object-cover" src="{{ asset('pictures/'.$item->pictures) }}"
                        alt="">
                    <div class="flex flex-col items-start">
                        <h1 class="text-sm">{{ $item->username }}</h1>
                        <h1 class="text-xs font-light text-gray-500">{{ $item->nama_lengkap }}</h1>
                    </div>
                </a>
                @if ($item->id == Auth::id())
                    <h1 class="text-xs font-light text-gray-500"></h1>
                @else
                    <button data-user-id="{{ $item->id }}"
                        data-follow="{{ Auth::user()->following()->where('following_id', $item->id)->first() }}"
                        class="flex items-center scale-100 hover:scale-105">
                        <div class="notfollow bg-red-600 text-xs font-semibold p-1 rounded-md text-white hover:bg-red-400 hover:text-black">
                            Follow</div>
                        <div class="followed bg-gray-300 hidden text-xs font-semibold p-1 rounded-md text-gray-800 hover:bg-gray-900 hover:text-white">
                            Following</div> 
                    </button>
                @endif
            </div>
        @endforeach
    </div>
    <div class="hidden p-4 rounded-lg bg-white dark:bg-gray-800" id="contacts" role="tabpanel"
        aria-labelledby="contacts-tab">
        @foreach ($follower as $item)
            <div class="flex justify-between items-center mb-2">
                <a class="flex gap-2 items-center cursor-pointer" href="/profil-user/{{ $item->id }}">
                    <img class="w-8 h-8 rounded-full object-cover" src="{{ asset('pictures/'.$item->pictures) }}"
                        alt="">
                    <div class="flex flex-col items-start">
                        <h1 class="text-sm">{{ $item->username }}</h1>
                        <h1 class="text-xs font-light text-gray-500">{{ $item->nama_lengkap }}</h1>
                    </div>
                </a>
                @if ($item->id == Auth::id())
                    <h1 class="text-xs font-light text-gray-500"></h1>
                @else
                    <button data-user-id="{{ $item->id }}"
                        data-follow="{{ Auth::user()->following()->where('following_id', $item->id)->first() }}"
                        class="flex items-center scale-100 hover:scale-105">
                        <div class="notfollow bg-red-600 text-xs font-semibold p-1 rounded-md text-white hover:bg-red-400 hover:text-black">
                            Follow</div>
                        <div class="followed bg-gray-300 hidden text-xs font-semibold p-1 rounded-md text-gray-800 hover:bg-gray-900 hover:text-white">
                            Following</div>
                    </button>
                @endif
            </div>
        @endforeach
    </div>
</div>

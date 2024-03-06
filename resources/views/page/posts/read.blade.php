@foreach ($post as $item)
    @auth
        <figure class="flex flex-col border bg-white drop-shadow-md overflow-hidden rounded-b-md">
            <a class="overflow-hidden" href="/posts/show={{ $item->uuid }}">
                <img class="filter grayscale-0 hover:grayscale cursor-pointer transition-all duration-100 scale-100 hover:scale-105"
                    src="{{ asset('imagePost/' . $item->file) }}" alt="" />
            </a>
            <div class="flex gap-2 p-2 bottom-0 h-full justify-between w-full">
                <a href="/profil-user/show={{ $item->users->uuid }}" class="flex items-center gap-2">
                    <img class="w-5 h-5 rounded-full object-cover" src="{{ asset('pictures/' . $item->users->pictures) }}"
                        alt="profil">
                    <h1 class="text-xs text-black">{{ $item->users->username }}</h1>
                </a>
            </div>
        </figure>
    @else
        <figure class="flex flex-col border bg-white drop-shadow-md overflow-hidden  rounded-b-md">
            <a class="overflow-hidden" href="/posts-tamu/show={{ $item->uuid }}">
                <img class="filter grayscale-0 hover:grayscale cursor-pointer transition-all duration-100 scale-100 hover:scale-105"
                    src="{{ asset('imagePost/' . $item->file) }}" alt="" />
            </a>
            <div class="flex gap-2 p-2 bottom-0 h-full justify-between w-full">
                <a href="/profil-user/show={{ $item->users->uuid }}" class="flex items-center gap-2">
                    <img class="w-5 h-5 rounded-full object-cover" src="{{ asset('pictures/' . $item->users->pictures) }}"
                        alt="profil">
                    <h1 class="text-xs text-black">{{ $item->users->username }}</h1>
                </a>
            </div>
        </figure>
    @endauth
@endforeach

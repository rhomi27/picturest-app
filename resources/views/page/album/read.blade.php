@foreach ($album as $item)
    <div id="idalbum-{{ $item->id }}" class="flex flex-col rounded-md w-full h-full overflow-hidden drop-shadow-lg bg-white mb-3">
        <div class="flex w-full h-full overflow-hidden">
            <a class="max-w-32 flex bg-black overflow-hidden" href="/detail-album/{{ $item->id }}">
                <img class="h-full w-0-full transition-all duration-300 scale-100 hover:scale-105 object-contain"
                    src="{{ asset('Album/' . $item->wallpaper) }}" alt="" />
            </a>
            <div class="flex flex-col text-black p-5 mx-auto w-full h-full">
                <h1 class="text-center text-base">{{ $item->nama }}</h1>
                <p class="text-xs text-center">{{ $item->deskripsi }}</p>
            </div>
        </div>
        @if (auth()->check() && $item->user_id == auth()->id())
        <div class="flex justify-end gap-3 items-center p-2 px-5 bg-gray-200">
            <button type="button" data-id="{{ $item->id }}" class="flex items-center cursor-pointer open-modal">
                <svg class="w-4 h-4 text-blue-700" xmlns="http://www.w3.org/2000/svg" fill="currentColor" id="Layer_1"
                    data-name="Layer 1" viewBox="0 0 24 24">
                    <path
                        d="m18.813,10c.309,0,.601-.143.79-.387s.255-.562.179-.861c-.311-1.217-.945-2.329-1.833-3.217l-3.485-3.485c-1.322-1.322-3.08-2.05-4.95-2.05h-4.515C2.243,0,0,2.243,0,5v14c0,2.757,2.243,5,5,5h3c.552,0,1-.448,1-1s-.448-1-1-1h-3c-1.654,0-3-1.346-3-3V5c0-1.654,1.346-3,3-3h4.515c.163,0,.325.008.485.023v4.977c0,1.654,1.346,3,3,3h5.813Zm-6.813-3V2.659c.379.218.732.488,1.05.806l3.485,3.485c.314.314.583.668.803,1.05h-4.338c-.551,0-1-.449-1-1Zm11.122,4.879c-1.134-1.134-3.11-1.134-4.243,0l-6.707,6.707c-.755.755-1.172,1.76-1.172,2.829v1.586c0,.552.448,1,1,1h1.586c1.069,0,2.073-.417,2.828-1.172l6.707-6.707c.567-.567.879-1.32.879-2.122s-.312-1.555-.878-2.121Zm-1.415,2.828l-6.708,6.707c-.377.378-.879.586-1.414.586h-.586v-.586c0-.534.208-1.036.586-1.414l6.708-6.707c.377-.378,1.036-.378,1.414,0,.189.188.293.439.293.707s-.104.518-.293.707Z" />
                </svg>
            </button>
            <button class="flex items-center delete" data-id="{{ $item->id }}" data-nama="{{ $item->nama }}">
                <svg class="w-4 h-4 text-red-600" xmlns="http://www.w3.org/2000/svg" id="Outline" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        d="M21,4H17.9A5.009,5.009,0,0,0,13,0H11A5.009,5.009,0,0,0,6.1,4H3A1,1,0,0,0,3,6H4V19a5.006,5.006,0,0,0,5,5h6a5.006,5.006,0,0,0,5-5V6h1a1,1,0,0,0,0-2ZM11,2h2a3.006,3.006,0,0,1,2.829,2H8.171A3.006,3.006,0,0,1,11,2Zm7,17a3,3,0,0,1-3,3H9a3,3,0,0,1-3-3V6H18Z" />
                    <path d="M10,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,10,18Z" />
                    <path d="M14,18a1,1,0,0,0,1-1V11a1,1,0,0,0-2,0v6A1,1,0,0,0,14,18Z" />
                </svg>
            </button>
        </div>
        @endif
    </div>
@endforeach

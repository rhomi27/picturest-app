@extends('layout.master')
@section('content')
<div class="container mx-auto p-5">
    <!-- Profile Card -->
    <div class="max-w-screen-lg p-3 mx-auto bg-white rounded-lg shadow-md overflow-hidden mb-5">
        <!-- Header -->
        <div class="bg-sky-600 rounded-3xl px-4 bg-opacity-55 py-2 flex justify-between items-center">
            <h1 class="text-lg font-semibold text-white">Profil Pengguna</h1>
            <a href="/users" class="text-gray-300 hover:text-white"><svg class="w-6 h-6" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg></a>
        </div>
        <!-- Informasi Profil Pengguna -->
        <div class="p-4 grid grid-cols-1 sm:grid-cols-2">
            <div class="flex items-center justify-center mb-4">
                <img src="{{ asset('pictures/'.$user->pictures) }}" alt="Foto Profil" class="w-40 h-40 object-cover rounded-md">
            </div>
            <div class="mb-2">
                <h2 class="text-xl font-semibold">{{ $user->username }}</h2>
                <p class="text-gray-600 text-sm">{{ $user->email }}</p>
                <p class="text-gray-600 text-sm">{{ $user->nama_lengkap }}</p>
                <p class="text-gray-600 text-sm">{{ $user->tanggal_lahir }}</p>
                <p class="text-gray-600 text-sm">{{ $user->alamat }}</p>
                <p class="text-gray-600 text-sm">{{ $user->jenis_kelamin }}</p>
                <p class="text-gray-600 text-sm">{{ $user->bio }}</p>
            </div>
            <!-- Tab Navigation -->
        </div>
    </div>
    <div class="max-w-screen-lg mx-auto border-b-2 mb-3 p-1 bg-white shadow-lg border-b-blue-600">
        <div class="flex justify-evenly items-center mx-auto gap-x-2 hide-scrollbar overflow-x-scroll">
            <button onclick="showTab('post')"
                class="p-1 px-2 bg-blue-200 rounded-md text-blue-800 text-sm font-semibold">Post</button>
            <button onclick="showTab('komen')"
                class="p-1 px-2 bg-blue-200 rounded-md text-blue-800 text-sm font-semibold">Komentar</button>
            <button onclick="showTab('album')"
                class="p-1 px-2 bg-blue-200 rounded-md text-blue-800 text-sm font-semibold">Album</button>
        </div>
    </div>
    <!-- Tab Content -->
    <div class="max-w-screen-lg mx-auto bg-white rounded-lg shadow-md overflow-hidden">
        <div class="p-2" id="tabContent">
            <!-- Konten Tab "Post" -->
            <div id="postTab" class="mb-4 hidden">
                <h3 class="text-gray-700 text-sm mb-3 font-semibold">Postingan</h3>
                <div class="columns-2 sm:columns-4 gap-1 sm:gap-2 [&>img:not(:first-child)]:mt-2">
                    @foreach ($post as $item)
                    <img src="{{ asset('imagePost/'. $item->file ) }}" alt="">
                    @endforeach
                </div>
            </div>
            <!-- Konten Tab "Komentar" -->
            <div id="komenTab" class="mb-4 hidden">
                <h3 class="text-gray-700 mb-3 text-sm font-semibold">Komentar</h3>
                @foreach ($comen as $item)
                <div class="flex items-start gap-2.5 mb-4">
                    <div
                        class="flex flex-col w-full max-w-[320px] leading-1.5 p-4 border-gray-200 bg-gray-100 rounded-e-xl rounded-es-xl dark:bg-gray-700">
                        <div class="flex items-center space-x-2 rtl:space-x-reverse">
                            <span class="text-sm font-semibold text-gray-900 dark:text-white">{{ $item->users->username }}</span>
                            <span class="text-sm font-normal text-gray-500 dark:text-gray-400">{{ $item->created_at->format('H:i') }}</span></span>
                        </div>
                        <p class="text-sm font-normal py-2.5 text-gray-900 dark:text-white">{{ $item->isi_komen }}</p>
                    </div>
                </div>
                @endforeach

            </div>
            <!-- Konten Tab "Album" -->
            <div id="albumTab" class="mb-4 hidden">
                <h3 class="text-gray-700 font-semibold mb-3">Album</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 w-full h-full gap-2">
                        @foreach ($album as $item)
                        <div
                            class="grid grid-cols-1 w-full h-32 sm:h-36 relative drop-shadow-lg scale-100 hover:scale-95 hover:transition-all duration-300">
                            <a class="grid">
                                <img class="h-full w-full rounded-md object-cover absolute z-0"
                                    src="{{ asset('Album/'.$item->wallpaper) }}" alt="" />
                                <div class="z-10 text-white m-auto bg-black bg-opacity-50 w-full p-2">
                                    <h1 class="text-center">{{ $item->nama }}</h1>
                                    <p class="text-center text-xs font-thin">
                                        {{ $item->deskripsi }}
                                    </p>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
            </div>
        </div>
    </div>
</div>
    
@endsection
@section('script')
    <script>
        function showTab(tabName) {
            // Menyembunyikan semua konten tab
            document.querySelectorAll('#tabContent > div').forEach(tab => {
                tab.style.display = 'none';
            });

            // Menampilkan konten tab yang dipilih
            document.getElementById(tabName + 'Tab').style.display = 'block';
        }
    </script>
@endsection
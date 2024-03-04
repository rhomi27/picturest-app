@extends('layout.master')
@section('content')
    @include('layout.navbar.navProf')
    @include('layout.bottom-nav')

    <!-- Dropdown menu -->
    <section>
        <div class="mx-auto w-screen bg-gray-50 drop-shadow-md">
            <div class="flex flex-col w-full h-full items-center">
                <img class="w-40 h-40 rounded-full object-cover mt-10" src="pictures/{{ $user->pictures }}" alt="" />
                <div class="items-center">

                    <p class="text-sm text-center font-light text-gray-500">
                        {{ $user->nama_lengkap }}
                    </p>
                    <div id="count-follow" class="flex gap-4 mb-5">

                    </div>
                    <p class="text-sm text-center text-black mb-4">
                        {{ $user->bio }}
                    </p>

                </div>
                <a href="/edit-user"
                    class="text-center bg-gray-300 border border-gray-400 p-1 rounded-sm text-sm mb-5 drop-shadow- w-40 hover:bg-slate-800 hover:text-white"
                    type="button">
                    Edit Profil
                </a>
            </div>
        </div>
        <div class="w-full h-full bg-gray-100 mt-4 p-1 drop-shadow-md px-5">
            <h1 id="post" data-count="{{ $post->count() }}" class="text-sm text-black">Postingan saya</h1>
        </div>

        <div class="container mt-3 mx-auto">
            <div class="p-5 mb-28 mx-auto max-w-screen-xl">
                <div id="data-wrap"
                    class="columns-2 gap-2 sm:gap-2 md:gap-3 lg:gap-4 sm:columns-2 md:columns-4 lg:columns-5 [&>figure:not(:first-child)]:mt-2 md:[&>figure:not(:first-child)]:mt-2">

                </div>
                <div class="loader flex justify-center items-center">
                    <img class="w-8 h-8" src="{{ asset('assets/img/loading.gif') }}" alt="hehe">
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/my-profil.js') }}"></script>
@endpush

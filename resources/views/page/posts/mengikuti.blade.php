@extends('layout.master')
@section('content')
    @include('layout.navbar.nav1')
    @include('layout.bottom-nav')
    <nav class="bg-white bg-opacity-50 backdrop-blur-sm sticky w-full z-20 top-14 start-0 drop-shadow-md">
        <div class="flex justify-center gap-x-10 items-center p-1">
            <a class="text-sm font-semibold text-gray-800 p-2" href="/home">Semua</a>
            <a id="post" data-count="{{ $post->count() }}" class="text-sm text-blue-950 font-bold border-b-2 p-2 border-b-blue-950" href="/mengikuti">Mengikuti</a>
        </div>
    </nav>

    <div class="container mt-3 mx-auto">
        <div class="p-5 mb-28 mx-auto max-w-screen-xl">
            <div id="data-mengikuti"
                class="mb-5 columns-2 gap-2 sm:gap-2 md:gap-3 lg:gap-4 sm:columns-2 md:columns-4 lg:columns-5 [&>figure:not(:first-child)]:mt-2 md:[&>figure:not(:first-child)]:mt-2">

            </div>
            <div class="loader flex justify-center items-center">
                <img class="w-8 h-8" src="{{ asset('assets/img/loading.gif') }}" alt="hehe">
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/mengikuti.js') }}"></script>
@endpush

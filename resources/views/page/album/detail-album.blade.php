@extends('layout.master')
@section('content')
    @include('layout.navbar.nav1')
    @include('layout.bottom-nav')
    <section>
        <div class="container mx-auto p-5">
            <input type="hidden" name="id_album" id="id_album" value="{{ $album->id }}">
            <h1 class="text-lg font-semibold mb-4 sm:text-2xl">{{ $album->nama }}</h1>
            <div id="data-wrap"
                class="columns-2 gap-2 sm:gap-2 md:gap-3 lg:gap-4 sm:columns-2 md:columns-4 lg:columns-6 [&>figure:not(:first-child)]:mt-2 md:[&>figure:not(:first-child)]:mt-2">

            </div>
            <div class="loader flex justify-center items-center mt-5">
                <img class="w-8 h-8" src="{{ asset('assets/img/loading.gif') }}" alt="hehe">
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/detail-album.js') }}"></script>
@endpush

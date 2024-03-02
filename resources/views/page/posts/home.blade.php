@extends('layout.master')
@section('content')
    @include('layout.navbar.nav1')
    @include('layout.bottom-nav')

    <div class="container mt-3 mx-auto">
        <div class="p-5 mb-28 mx-auto max-w-screen-xl">
            <div id="data-wrap"
                class="mb-5 columns-2 gap-2 sm:gap-2 md:gap-3 lg:gap-4 sm:columns-2 md:columns-4 lg:columns-5 [&>figure:not(:first-child)]:mt-2 md:[&>figure:not(:first-child)]:mt-2">

            </div>
            <div class="loader flex justify-center items-center">
                <img class="w-8 h-8" src="{{ asset('assets/img/loading.gif') }}" alt="hehe">
            </div>
        </div>
    </div>
@endsection
@push('scripts')
<script src="{{ asset('assets/js/home.js') }}"></script>
@endpush


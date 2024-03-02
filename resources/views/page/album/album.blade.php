@extends('layout.master')
@section('content')
    @include('layout.navbar.nav1')
    @include('layout.bottom-nav')
    @include('page.album.modal')
    @include('page.album.offcanvas')
    <!-- btn offcanvas -->
    <div class="fixed top-20 end-6 group z-10">
        @if (Auth::user()->status === 'banned')
            <button type="button" disabled data-drawer-target="drawer-form" data-drawer-show="drawer-form"
                aria-controls="drawer-form"
                class="flex items-center justify-center text-white bg-blue-700 rounded-full w-14 h-14 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800">
                <svg class="w-5 h-5 transition-transform group-hover:rotate-45" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 1v16M1 9h16" />
                </svg>
                <span class="sr-only">Open form</span>
            </button>
        @else
            <button type="button" data-drawer-target="drawer-form" data-drawer-show="drawer-form"
                aria-controls="drawer-form"
                class="flex items-center justify-center text-white bg-blue-700 rounded-full w-14 h-14 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800">
                <svg class="w-5 h-5 transition-transform group-hover:rotate-45" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 1v16M1 9h16" />
                </svg>
                <span class="sr-only">Open form</span>
            </button>
        @endif
    </div>

    <!-- offcanvas form album -->

    <!-- content -->
    <section>
        <div class="container mx-auto mt-5 p-5 mb-5">
            <h1 class="text-2xl font-semibold mb-4">Album Anda</h1>
            <div id="album" class="columns-1 sm:columns-2 lg:columns-3 gap-2 mb-5">

            </div>
            <div class="loader flex justify-center items-center">
                <img class="w-8 h-8 hidden" src="assets/img/loading.gif" alt="hehe">
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/album.js') }}"></script>
@endpush

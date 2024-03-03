@extends('layout.master')
@section('content')
    @include('admin.layout.nav-side')
    <div class="p-4 sm:ml-64">
        <div id="navbar-search" class="sticky start-0 top-5 sm:top-5 w-full hidden sm:inline-block">
            <input id="search-user" type="text" class="p-1 rounded-md focus:outline-none px-4 text-sm w-full ">
        </div>
        <div class="container mx-auto p-5">

            <div id="content" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">

            </div>
            <div class="loader flex justify-center items-center">
                <img class="w-8 h-8" src="{{ asset('assets/img/loading.gif') }}" alt="hehe">
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/admin/users.js') }}"></script>
@endpush


@extends('layout.master')
@section('content')
    @include('admin.layout.nav-side')
    <div class="p-4 sm:ml-64">
        <div id="navbar-search" class="sticky start-0 top-5 sm:top-5 w-full hidden sm:inline-block">
            <input id="search-report" type="text" class="p-1 rounded-md focus:outline-none px-4 text-sm w-full ">
        </div>
        <div id="content" class="container mx-auto p-5">
            <h1 class="text-lg font-semibold mb-4">Laporan dari Pengguna</h1>

        </div>

    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/admin/report.js') }}"></script>
@endpush


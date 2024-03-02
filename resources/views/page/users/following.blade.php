@extends('layout.master')
@section('content')
    @include('layout.navbar.navfollow')
    <section>
        <div class="container mx-auto p-5 max-w-screen-md">
            <div class="border border-gray-200 shadow-lg p-5">
                @if ($following && !$following->isEmpty())
                @foreach ($following as $item)
                    <div class="flex justify-between items-center mb-2 p-2 rounded-md bg-white hover:bg-gray-100">
                        <a href="/profil-user/{{ $item->id }}" class="flex gap-2 items-center cursor-pointer">
                            <img class="w-8 h-8 rounded-full object-cover" src="{{ asset('pictures/' . $item->pictures) }}"
                                alt="">
                            <div class="flex flex-col items-start">
                                <h1 class="text-sm">{{ $item->username }}</h1>
                                <h1 class="text-xs font-light text-gray-500">{{ $item->nama_lengkap }}</h1>
                            </div>
                        </a>
                        @if ($item->id == Auth::id())
                            <h1 class="text-xs font-light text-gray-500"></h1>
                        @else
                            <button data-user-id="{{ $item->id }}"
                                data-follow="{{ Auth::user()->following()->where('following_id', $item->id)->first() }}"
                                class="follow-btn flex items-center scale-100 hover:scale-105">
                                <div
                                    class="notfollow bg-red-600 text-xs font-semibold p-1 rounded-md text-white hover:bg-red-400 hover:text-black">
                                    Follow</div>
                                <div
                                    class="followed bg-gray-300 hidden text-xs font-semibold p-1 rounded-md text-gray-800 hover:bg-gray-900 hover:text-white">
                                    Following</div>
                            </button>
                        @endif
                    </div>
                @endforeach
                @else
                    <div class="text-gray-500 text-center">User tidak mengikuti siapapun.</div>
                @endif
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/follow.js') }}"></script>
@endpush

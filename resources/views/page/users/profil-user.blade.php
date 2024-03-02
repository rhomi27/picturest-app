@extends('layout.master')
@section('content')
    @include('layout.navbar.navProf')
    <!-- Main modal -->

    <section>
        <div class="mx-auto w-screen bg-gray-50 drop-shadow-md">
            <div class="flex flex-col w-full h-full items-center">
                <img class="w-40 h-40 rounded-full object-cover mt-10" src="{{ asset('pictures/' . $user->pictures) }}"
                    alt="" />
                <div class="items-center">
                    <p class="text-sm text-center font-normal text-gray-500">
                        {{ $user->nama_lengkap }}
                    </p>
                    <div id="count-follow" class="flex gap-4 mb-5">

                    </div>
                    <p class="text-sm text-center text-black mb-4">
                        {{ $user->bio }}
                    </p>
                </div>
                <button id="follow-btn" data-user-id="{{ $user->id }}"
                    data-follow="{{ Auth::user()->following()->where('following_id', $user->id)->first() }}">
                    <div
                        class="followed text-center text-black bg-gray-300 border border-gray-400 p-1 rounded-sm text-sm mb-5 drop-shadow-lg w-40 hover:bg-slate-800 hover:text-white">
                        Unfollow
                    </div>
                    <div
                        class="notfollow text-center hidden text-white bg-red-600 border border-gray-400 p-1 rounded-sm text-sm mb-5 drop-shadow-lg w-40 hover:bg-slate-800 hover:text-white">
                        Follow
                    </div>
                </button>
            </div>
        </div>
        @include('page.users.data-user.data')
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/profil-user.js') }}"></script>
@endpush



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
@section('script')
    <script>
        function readAlbum() {
            $.get("{{ route('read.album.user',$user->id) }}", {}, function(data) {
                $("#album").html(data);
            });
        }

        function read() {
            $.get("/count-read/{{ $user->id }}", {}, function(data) {
                $("#count-follow").html(data);
            });
        }

        $(document).ready(function() {
            readAlbum()
            read()
            const followed = $('#follow-btn').data('follow');
            if (followed) {
                $('.notfollow').hide();
                $('.followed').show();
            } else {
                $('.notfollow').show();
                $('.followed').hide();
            }

            $('#follow-btn').click(function() {
                const userId = $(this).data('user-id');
                const followUrl = `/follow-user/${userId}`;

                var button = $(this);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: followUrl,
                    type: 'post',
                    success: function(data) {
                        console.log(data);
                        if (data.following) {
                            button.find('.notfollow').hide();
                            button.find('.followed').show();
                        } else {
                            button.find('.notfollow').show();
                            button.find('.followed').hide();
                        }
                        read()
                    }.bind(this),
                    error: function(jqXHR, ajaxOptions, thrownError) {
                        console.log('server error');
                    }
                });
            });
        });
    </script>
    <script>
        var EndPoint = "/profil-user/{{ $user->id }}";
        var page = 1;
        LoadMore(page);

        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 0,9)) {
                page++;
                LoadMore(page);
            }
        });

        function LoadMore(page) {
            $.ajax({
                    url: EndPoint + "?page=" + page,
                    datatype: "html",
                    type: "get",
                    beforeSend: function() {
                        $('.loader').show();
                    }
                })
                .done(function(data) {
                    if (!data.trim()) {
                        $('.loader').html("Tidak ada data lainnya");
                        return;
                    }

                    $('.loader').hide();
                    $("#data-wrap").append(data);
                })
                .fail(function(jqXHR, ajaxOptions, thrownError) {
                    console.log('server error');
                })
        }
    </script>
@endsection

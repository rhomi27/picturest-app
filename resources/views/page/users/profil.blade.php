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
            <h1 class="text-sm text-black">Postingan saya</h1>
        </div>

        <div class="container mt-3 mx-auto">
            <div class="p-5 mb-28 mx-auto max-w-screen-xl">
                <div id="data-wrap"
                    class="columns-2 gap-2 sm:gap-2 md:gap-3 lg:gap-4 sm:columns-2 md:columns-4 lg:columns-5 [&>figure:not(:first-child)]:mt-2 md:[&>figure:not(:first-child)]:mt-2">

                </div>
            </div>
            <div class="loader flex justify-center items-center">
                <img class="w-8 h-8" src="{{ asset('assets/img/loading.gif') }}" alt="hehe">
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        function read() {
            $.get("/count-reading", {}, function(data) {
                $("#count-follow").html(data);
            });
        }
        $(document).ready(function() {
            $('#data-wrap').on('click', '.delete', function() {
                const id = $(this).data('id');
                const judul = $(this).data('judul')
                const urlDel = `/delete-post/${id}`
                Swal.fire({
                    title: "Apa kamu yakinn?",
                    text: `hapus data dengan judul ${judul}`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, hapus ini!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: urlDel,
                            type: 'get',
                            success: function(res) {
                                $(`#posts-${id}`).animate({
                                    opacity: 0,
                                }, 500, function() {
                                    $(this).hide();
                                });
                            },
                            error: function(err) {
                                console.log('error')
                            }
                        })
                    }
                });
            })
            read()
            LoadMore(page);
        });


        var EndPoint = "/profil";
        var page = 1;
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 20)) {
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

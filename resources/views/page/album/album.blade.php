@extends('layout.master')
@section('content')
    @include('layout.navbar.nav1')
    @include('layout.bottom-nav')
    @include('page.album.modal')
    @include('page.album.offcanvas')
    <!-- btn offcanvas -->
    <div class="fixed top-20 end-6 group z-10">
        <button type="button" data-drawer-target="drawer-form" data-drawer-show="drawer-form" aria-controls="drawer-form"
            class="flex items-center justify-center text-white bg-blue-700 rounded-full w-14 h-14 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800">
            <svg class="w-5 h-5 transition-transform group-hover:rotate-45" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 1v16M1 9h16" />
            </svg>
            <span class="sr-only">Open form</span>
        </button>
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
@section('script')
    <script>
        $(document).ready(function() {
            $(document).on('keyup', function(e) {
                e.preventDefault();
                let search_string = $("#search-nav").val();
                $.ajax({
                    url: "{{ route('search.album') }}",
                    method: "get",
                    data: {
                        search_string: search_string
                    },
                    beforeSend: function() {
                        $('.loader').show();
                    },
                    success: function(res) {
                        $('#album').html(res);
                        $('.loader').html("tidak ada data lainnya");
                        if (res.status == 400) {
                            $('.loader').html(res.pesan);
                        }
                    }

                })
            });
        })
    </script>
    <script>
        function read() {
            $.get("{{ route('read.album') }}", {}, function(data) {
                $("#album").html(data);
            });
        }

        function showMessageAlbum(type, message) {
            const Toast = Swal.mixin({
                toast: true,
                position: "top",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.onmouseenter = Swal.stopTimer;
                    toast.onmouseleave = Swal.resumeTimer;
                }
            });
            Toast.fire({
                icon: type,
                title: message,
            });
        }

        function removeValidasiClass(form) {
            $(form).each(function() {
                $(form).find(':input').removeClass('border-green-600 border-red-600');
                $(form).find('.text-red-600, .text-green-600').text('');
            });
        }

        function errUpdate(field, message) {
            const errorElement = $("#" + field + "-error");
            if (!message) {
                $("#" + field).addClass("border-green-600").removeClass("border-red-600");
                errorElement.text("");
            } else {
                $("#" + field).addClass("border-red-600").removeClass("border-green-600");
                errorElement.text(message);
            }
        }

        function showErrorAlbum(field, message) {
            const errorElement = $("#" + field + "-errors");
            if (!message) {
                $("#" + field).addClass("border-green-600").removeClass("border-red-600");
                errorElement.text("");
            } else {
                $("#" + field).addClass("border-red-600").removeClass("border-green-600");
                errorElement.text(message);
            }
        }
        $(document).ready(function() {
            $('#close-modal').on('click', function() {
                $('#update-modal').hide();
            });
            read();
            $('#album').on('click', '.delete', function() {
                const id = $(this).data('id');
                const nama = $(this).data('nama')
                const urlDel = `/delete-album/${id}`
                Swal.fire({
                    title: "Apa kamu yakinn?",
                    text: `hapus album dengan nama ${nama}`,
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
                                $(`#idalbum-${id}`).animate({
                                    opacity: 0,
                                    marginBottom: "-100px"
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
            });

            $('#album').on('click', '.open-modal', function() {
                $('#update-modal').show();
                var id = $(this).data('id');
                $.ajax({
                    url: '/edit-album/' + id,
                    type: 'get',
                    success: function(res) {
                        console.log('Data Item:', res);
                        $('#id').val(res.id);
                        $('#nama').val(res.nama);
                        $('#deskripsi').val(res.deskripsi);
                        $('#preview').attr('src', res.wallpaper)
                    }
                })
                $('#wallpaperupdate').change(function() {
                    var file = $(this)[0].files[0];
                    var imageURL = URL.createObjectURL(file);
                    $('#preview').attr('src', imageURL);
                });
            });


            $('#updateForm').submit(function(e) {
                e.preventDefault();
                var formData = new FormData(this);
                var id = $('#id').val();
                const urlUpdate = `/update-album/${id}`
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: false,
                    processData: false,
                });
                $.ajax({
                    url: urlUpdate,
                    type: 'post',
                    data: formData,
                    success: function(res) {
                        if (res.status == 400) {
                            errUpdate('nama', res.errors.nama)
                            errUpdate('deskripsi', res.errors.deskripsi)
                            errUpdate('wallpaper', res.errors.wallpaper)
                        } else if (res.status == 404) {
                            showMessageAlbum('errorr', res.message)
                        } else if (res.status == 200) {
                            $('#update-modal').hide(),
                                read()
                            removeValidasiClass('#updateForm')
                            showMessageAlbum('success', res.message)
                        }
                    }
                })
            });

            // create album
            $('#albumForm').submit(function(e) {
                e.preventDefault();
                var dataForm = new FormData(this);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: false,
                    processData: false,
                });

                $.ajax({
                    url: "{{ route('post.album') }}",
                    type: "post",
                    data: dataForm,
                    success: function(res) {
                        console.log(res)
                        if (res.status == 400) {
                            showErrorAlbum('nama', res.errors.nama);
                            showErrorAlbum('deskripsi', res.errors.deskripsi);
                            showErrorAlbum('wallpaper', res.errors.wallpaper);
                            setTimeout(function() {
                                $("#nama-errors, #deskripsi-errors, #wallpaper-errors")
                                    .empty();
                            }, 3000);
                        } else if (res.status == 200) {
                            showMessageAlbum('success', res.messages)
                            $("#albumForm")[0].reset();
                            removeValidasiClass("#albumForm");
                            $("#close-drawer").click();
                            read();
                        }
                    },

                })
            })

        });
    </script>
@endsection

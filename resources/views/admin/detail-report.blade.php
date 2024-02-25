@extends('layout.master')
@section('content')
    <div class="container mx-auto p-5">
        <div class="max-w-screen-lg mx-auto bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Header -->
            <div class="bg-blue-700 px-4 py-2 flex justify-between items-center">
                <h1 class="text-base font-semibold text-white">Detail Laporan</h1>
                <a href="/report" class="text-gray-300 hover:text-white"><svg class="w-6 h-6 scale-100 hover:scale-105 "
                        fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg></a>
            </div>
            <!-- Informasi Laporan -->
            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 items-center mb-4 gap-4">
                    <img src="{{ asset('imagePost/' . $data->posts->file) }}" alt="Gambar"
                        class="w-96 shadow-md h-96 object-contain mr-4">
                    <div class="grid flex-col">
                        <div class="flex gap-2 mb-4">
                            <img class="h-8 w-8 rounded-full object-cover" src="{{ asset('pictures/' . $user->pictures) }}"
                                alt="">
                            <p class="text-gray-600">{{ $user->username }}</p>
                        </div>
                        <h2 class="text-lg font-semibold">{{ $data->posts->judul }}</h2>
                        <div class="mb-4">
                            <h3 class="text-gray-700 font-semibold">Deskripsi:</h3>
                            <p class="text-gray-600">{{ $data->posts->deskripsi }}</p>
                        </div>
                        <div class="mb-4">
                            <h3 class="text-gray-700 font-semibold">Tag:</h3>
                            <div class="flex flex-wrap">
                                <span class="px-2 py-1 text-blue-800 rounded-full mr-2 mb-2">{{ $data->posts->tag }}</span>
                            </div>
                        </div>
                        <div class="mb-4">
                            <h3 class="text-gray-700 font-semibold">Alsan pelapor:</h3>
                            <div class="flex flex-wrap">
                                <span class="px-2 py-1 text-blue-800 rounded-full mr-2 mb-2">{{ $data->alasan }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex justify-end">
                    <button id="delete-button" data-post-id="{{ $data->posts->id }}" data-nama="{{ $data->posts->judul }}"
                        data-bloked="{{ $data->posts->status == 'blokir' }}">
                        <div id="bloked"
                            class="px-4 py-2 hidden bg-blue-500 text-white rounded shadow-md scale-100 hover:scale-105 hover:bg-blue-400">
                            Aktifkan Postingan</div>
                        <div id="aktif"
                            class="px-4 py-2 bg-red-500 text-white rounded shadow-md scale-100 hover:scale-105 hover:bg-red-400">
                            Blokir Postingan</div>
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        function showMessage(message) {
            Swal.fire({
                title: "Berhasil",
                text: message,
                icon: "success"
            });
        }

        $(document).ready(function() {
            const bloked = $('#delete-button').data('bloked')
            if (bloked) {
                $('#bloked').show();
                $('#aktif').hide();
            } else {
                $('#bloked').hide();
                $('#aktif').show();
            }


            $('#delete-button').click(function() {
                var id = $(this).data('post-id');
                var judul = $(this).data('nama');
                const urlDelete = `/blokir/${id}`
                Swal.fire({
                    title: "Anda yakin?",
                    text: `akan melakukan tindakan pada data dengan judul ${judul}!`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "batal",
                    confirmButtonText: "ya! lakukan"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: urlDelete,
                            type: 'post',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(res) {
                                if (res.status == 400) {
                                    showMessage(res.message);
                                    $('#bloked').show();
                                    $('#aktif').hide();
                                } else if (res.status == 200) {
                                    showMessage(res.message);
                                    $('#bloked').hide();
                                    $('#aktif').show();
                                }
                            }
                        })
                    }
                });
            })
        })
    </script>
@endsection

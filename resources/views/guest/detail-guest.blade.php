@extends('layout.master')
@section('content')
    @include('layout.navbar.nav2')
    <!-- Main modal -->
    @include('page.posts.detail.modal-report')
    <section id="foto">
        <div class="container mx-auto p-5">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-1 md:grid-cols-2 mt-10">
                <div class="w-full max-h-screen">
                    <img class="w-full h-full rounded-sm drop-shadow-md object-contain"
                        src="{{ asset('imagePost/' . $data->file) }}" alt="gambar" />
                </div>
                <div>
                    <div class="w-full max-h-full border border-gray-300 bg-white shadow-md p-4">
                        <div class="flex justify-between items-center">
                            <a class="flex items-center" href="/profil-user/{{ $user->id }}">
                                <img class="w-10 h-10 rounded-full object-cover mr-4"
                                    src="{{ asset('pictures/' . $user->pictures) }}" alt="Neil image" />
                                <div class="flex flex-col">
                                    <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                        {{ $user->username }}
                                    </p>
                                    <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                        {{ $user->email }}
                                    </p>
                                </div>
                            </a>
                            @if (auth()->check() && $post->user_id !== auth()->id())
                                <button class="bg-red-600 p-1 rounded-lg text-white px-2 drop-shadow-lg">follow</button>
                            @endif
                        </div>

                        <div class="mt-4">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white">
                                {{ $data->judul }}
                            </h2>
                            <p class="text-gray-500 dark:text-gray-400">
                                {{ $data->deskripsi }}
                            </p>
                            <p class="text-black dark:text-gray-300 mt-5">
                                Tag: <span class="text-blue-600">{{ $data->tag }}</span>
                            </p>
                        </div>
                        <div class="flex justify-between mt-10">
                            <div class="flex items-center">

                            </div>
                            <div class="flex items-center gap-x-5">
                                <button disabled id="like-button" data-post-id="{{ $data->id }}"
                                    class="flex items-center gap-1">
                                    <svg id="like"
                                        class="h-5 w-5 text-gray-500 dark:text-gray-300 hover:text-blue-700 cursor-pointer scale-100 hover:scale-95"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path
                                            d="M458.4 64.3C400.6 15.7 311.3 23 256 79.3 200.7 23 111.4 15.6 53.6 64.3-21.6 127.6-10.6 230.8 43 285.5l175.4 178.7c10 10.2 23.4 15.9 37.6 15.9 14.3 0 27.6-5.6 37.6-15.8L469 285.6c53.5-54.7 64.7-157.9-10.6-221.3zm-23.6 187.5L259.4 430.5c-2.4 2.4-4.4 2.4-6.8 0L77.2 251.8c-36.5-37.2-43.9-107.6 7.3-150.7 38.9-32.7 98.9-27.8 136.5 10.5l35 35.7 35-35.7c37.8-38.5 97.8-43.2 136.5-10.6 51.1 43.1 43.5 113.9 7.3 150.8z" />
                                    </svg>
                                    <svg id="liked"
                                        class="h-5 w-5 hidden text-gray-500 dark:text-gray-300 hover:text-blue-700 cursor-pointer scale-100 hover:scale-95"
                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path
                                            d="M462.3 62.6C407.5 15.9 326 24.3 275.7 76.2L256 96.5l-19.7-20.3C186.1 24.3 104.5 15.9 49.7 62.6c-62.8 53.6-66.1 149.8-9.9 207.9l193.5 199.8c12.5 12.9 32.8 12.9 45.3 0l193.5-199.8c56.3-58.1 53-154.3-9.8-207.9z" />
                                    </svg>
                                    <span id="likeCount"
                                        class="text-gray-500 dark:text-gray-300">{{ $like->count() }}</span>
                                </button>
                                <div class="flex items-center gap-1">
                                    <svg class="h-4 w-5" width="30" height="30" viewBox="0 0 30 30" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                        <rect width="30" height="30" fill="url(#pattern0)" />
                                        <defs>
                                            <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1"
                                                height="1">
                                                <use xlink:href="#image0_187_87" transform="scale(0.0078125)" />
                                            </pattern>
                                            <image id="image0_187_87" width="128" height="128"
                                                xlink:href="data:image/png;base64,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" />
                                        </defs>
                                    </svg>
                                    <span class="text-gray-500 dark:text-gray-300">{{ $comen->count() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @include('page.posts.detail.terkait')
                </div>
            </div>
        </div>
    </section>
    @include('page.posts.detail.comment.comment')
@endsection
@section('script')
    <script>
        function read() {
            $.get("/comen-read-tamu/{{ $data->id }}", {}, function(data) {
                $("#comen").html(data);
            });
        }

        $(document).ready(function() {
            read()
        })
        // $("#formCommen").submit(function(e) {
        //     e.preventDefault();
        //     const postId = document.getElementById("post_id").value;
        //     const comenUrl = `/comen-post/${postId}`
        //     var formData = new FormData(this);
        //     $.ajaxSetup({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         contentType: false,
        //         processData: false,
        //     });

        //     $.ajax({
        //         url: comenUrl,
        //         type: "post",
        //         data: formData,
        //         success: function(res) {
        //             if (res.status == 400) {
        //                 showError('isi_komen', res.errors.isi_komen);
        //                 setTimeout(function() {
        //                     $("#isi_komen-error")
        //                         .empty();
        //                 }, 2000);
        //             } else if (res.status == 200) {
        //                 $("#formCommen")[0].reset();
        //                 removeValidasiClass('#formCommen')
        //                 read()
        //             }
        //         },
        //         error: function(err) {
        //         }
        //     });
        // });
    </script>
@endsection

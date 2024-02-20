@extends('layout.master')
@section('content')
    <nav class="bg-white border-gray-200 dark:bg-gray-900 sticky w-full z-50 top-0 start-0 drop-shadow-md">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-3">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center text-base font-semibold whitespace-nowrap dark:text-white">Edit Postingan</span>
            </a>
            <button onclick="goBack()"
                class="flex items-center gap-2 text-black text-xs font-semibold hover:text-gray-400 rounded-lg focus:ring-2">
                Keluar
                <span><svg class="w-5 h-5 me-2 flex-shrink-0" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="m16,2.5c0-1.381,1.119-2.5,2.5-2.5s2.5,1.119,2.5,2.5-1.119,2.5-2.5,2.5-2.5-1.119-2.5-2.5Zm-5.959,1.031l1.535,1.201c.652.509,1.595.395,2.105-.257.511-.652.396-1.595-.257-2.105l-1.535-1.201c-1.996-1.562-4.784-1.562-6.779,0l-3,2.347C.769,4.566,0,6.145,0,7.848v4.652c0,2.481,2.019,4.5,4.5,4.5h3c.829,0,1.5-.671,1.5-1.5s-.671-1.5-1.5-1.5h-3c-.827,0-1.5-.673-1.5-1.5v-4.652c0-.774.35-1.492.959-1.969l3-2.347c.907-.71,2.175-.71,3.082,0Zm13.249,8.053l-2.519-1.561-.493-1.623c-.443-1.419-1.715-2.4-3.105-2.4-.424.007-.877.096-1.293.278-.048.022-3.156,1.849-3.156,1.849-1.063.626-1.724,1.782-1.724,3.016v2.357c0,.829.671,1.5,1.5,1.5s1.5-.671,1.5-1.5v-2.357c0-.176.094-.341.246-.431l.754-.444v3.19c0,1.141.558,2.213,1.493,2.868l3.294,2.305c.133.094.213.247.213.41v3.458c0,.829.671,1.5,1.5,1.5s1.5-.671,1.5-1.5v-3.458c0-1.141-.558-2.213-1.493-2.868l-1.507-1.055v-2.045l1.71,1.06c.705.437,1.628.219,2.065-.485s.219-1.629-.485-2.065Zm-7.238,6.539c-.765-.313-1.643.052-1.957.818l-1.226,2.989c-.314.767.052,1.643.818,1.957.187.077.379.113.569.113.59,0,1.15-.351,1.388-.931l1.226-2.989c.314-.767-.052-1.643-.818-1.957ZM6,8c-.552,0-1,.448-1,1v1c0,.552.448,1,1,1h1c.552,0,1-.448,1-1v-1c0-.552-.448-1-1-1h-1Z" />
                    </svg></span></button>
        </div>
    </nav>
    <section>
        <div class="container mx-auto mt-5 p-5">
            <div class="mx-auto border border-gray bg-white drop-shadow-lg p-5 rounded-md w-full md:w-full xl:w-3/4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="grid">
                        <img class="w-full h-80 object-cover shadow-lg rounded-md"
                            src="{{ asset('imagePost/' . $post->file) }}" alt="">
                    </div>
                    <div class="grid p-5 mt-5">
                        <form id="updateForm">
                            <input type="hidden" id="id" name="id" value="{{ $post->id }}">
                            <div class="relative z-0 mb-5">
                                <input type="text" id="judul" name="judul" value="{{ $post->judul }}"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " />
                                <p id="judul-error" class="mt-2 text-xs font-thin text-red-600 dark:text-red-400"></p>
                                <label for="judul"
                                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Judul</label>
                            </div>
                            <div class="relative z-0 mb-5">
                                <input type="text" id="deskripsi" name="deskripsi" value="{{ $post->deskripsi }}"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " />
                                <p id="deskripsi-error" class="mt-2 text-xs font-thin text-red-600 dark:text-red-400"></p>
                                <label for="deskripsi"
                                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Deskripsi</label>
                            </div>
                            <div class="relative z-0 mb-5">
                                <input type="text" id="tag" name="tag" value="{{ $post->tag }}"
                                    class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                    placeholder=" " />
                                <p id="tag-error" class="mt-2 text-xs font-thin text-red-600 dark:text-red-400"></p>
                                <label for="tag"
                                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Tag</label>
                            </div>
                            <div class="relative z-0 mb-5">
                                <label for="album_id" class="sr-only">Pilih album</label>
                                <select id="album_id" name="album_id"
                                    class="block py-2.5 px-2 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 ">
                                    @if ($post->albums)
                                        <option value="{{ $post->albums->id }}" selected>{{ $post->albums->nama }}</option>
                                    @else
                                        <option selected>Pilih album</option>
                                    @endif
                                    @foreach ($album as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit"
                                class="bg-blue-400 w-full rounded-lg text-white p-1 drop-shadow-lg hover:bg-blue-200 hover:text-black">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        function showMessage(type, message) {
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

        function showError(field, message) {
            const errorElement = $("#" + field + "-error");
            if (!message) {
                $("#" + field).addClass("border-green-600").removeClass("border-red-600");
                errorElement.text("");
            } else {
                $("#" + field).addClass("border-red-600").removeClass("border-green-600");
                errorElement.text(message);
            }
        }
        $(document).ready(function() {

            $('#updateForm').submit(function(e) {
                e.preventDefault();
                var dataForm = new FormData(this);
                const id = document.getElementById('id').value;
                const updateUrl = `/update/${id}`
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    contentType: false,
                    processData: false,
                });

                $.ajax({
                    url: updateUrl,
                    type: "post",
                    data: dataForm,
                    success: function(res) {
                        console.log(res)
                        if (res.status == 400) {
                            showError('judul', res.errors.judul);
                            showError('deskripsi', res.errors.deskripsi);
                            showError('tag', res.errors.tag)
                            setTimeout(function() {
                                $("#judul-error, #deskripsi-error, #tag-error")
                                    .empty();
                            }, 3000);
                        } else if(res.status == 200){
                            showMessage('success', res.message);
                        }

                    },
                    error: function(err) {
                        console.log(err)
                    }

                })
            })

        });
    </script>
@endsection

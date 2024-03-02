@extends('layout.master')
@section('content')
    @include('layout.navbar.nav2')
    @include('layout.modal.modal1')
    <div class="container mx-auto mt-10 p-5">
        <div
            class="mx-auto w-full md:w-full xl:w-3/4 h-full border border-gray-200 bg-white rounded-md drop-shadow-md sm:px-5">
            <form id="createForm" enctype="multipart/form-data" method="post"
                class="grid grid-cols-1 md:grid-cols-2 gap-4 gap-x-5 mb-5 p-3 px-5">
                <div class="flex items-center justify-center w-full h-full mt-1 relative">
                    <label for="file"
                        class="flex flex-col items-center p-3 justify-center w-full h-64 border-2 rounded-md cursor-pointer bg-white bg-opacity-50 dark:bg-gray-700 hover:bg-opacity-70 hover:bg-white dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 z-10">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-black dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                            <p class="mb-2 text-center text-sm text-black dark:text-gray-400">
                                <span class="font-semibold">Klik untuk unggah</span>
                            </p>
                            <p id="file-error" class="mt-2 text-lg font-thin text-red-600 dark:text-red-400"></p>
                        </div>
                        <input type="file" id="file" name="file" class="hidden" />
                    </label>
                    <img id="previewImage" class="w-full hidden h-64 object-contain z-0 absolute rounded-md" src=""
                        alt="">
                </div>
                <div class="w-full h-full">
                    <div class="mt-4 mb-5">
                        <div class="relative z-0">
                            <input type="text" id="judul" name="judul"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " />
                            <label for="judul"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Judul</label>
                        </div>
                        <p id="judul-error" class="mt-2 text-xs font-thin text-red-600 dark:text-red-400"></p>
                    </div>
                    <div class="mb-5">
                        <div class="relative z-0">
                            <input type="text" id="deskripsi-id" name="deskripsi"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " />
                            <label for="deskripsi"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Deskripsi</label>
                        </div>
                        <p id="deskripsi-id-error" class="mt-2 text-xs font-thin text-red-600 dark:text-red-400"></p>
                    </div>
                    <div class="mb-5">
                        <div class="relative z-0">
                            <input type="text" id="tag" name="tag"
                                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " />
                            <label for="tag"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Tag</label>
                        </div>
                        <p id="tag-error" class="mt-2 text-xs font-thin text-red-600 dark:text-red-400"></p>
                    </div>
                    <div class="mb-5 album">
                        <div class="relative z-0 flex">
                            <label for="album" class="sr-only">Pilih Album</label>
                            <select id="album" name="album_id"
                                class="block py-2.5 px-2 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 ">
                                <option value="" selected>Pilih Album</option>
                                @foreach ($album as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            <button type="button" data-modal-target="addAlbum" data-modal-toggle="addAlbum"
                                class="text-xs w-40 bg-gray-500 text-white rounded-md drop-shadow-md hover:bg-gray-200 hover:text-black">add
                                album</button>
                        </div>
                        <p id="album_id-error" class="mt-2 text-xs font-thin text-red-600 dark:text-red-400"></p>
                    </div>
                    <button type="submit"
                        class="bg-blue-500 w-full p-1 rounded-md drop-shadow-md text-white hover:bg-blue-900 mb-5 mt-5">
                        Unggah
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/create.js') }}"></script>
@endpush

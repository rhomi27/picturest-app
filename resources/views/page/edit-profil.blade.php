@extends('layout.master')
@section('content')
    <nav class="bg-white border-gray-200 dark:bg-gray-900 sticky w-full z-20 top-0 start-0 drop-shadow-md">
        <div class="w-screen flex flex-wrap items-center justify-between mx-auto p-3 px-5 md:px-10">
            <div class="flex flex-col items-center">
                <a href="/profil">
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24">
                        <path
                            d="M.88,14.09,4.75,18a1,1,0,0,0,1.42,0h0a1,1,0,0,0,0-1.42L2.61,13H23a1,1,0,0,0,1-1h0a1,1,0,0,0-1-1H2.55L6.17,7.38A1,1,0,0,0,6.17,6h0A1,1,0,0,0,4.75,6L.88,9.85A3,3,0,0,0,.88,14.09Z" />
                    </svg>
                </a>
            </div>
            <div class="flex flex-col justify-center items-center">
                <h1 class="self-center text-sm font-semibold dark:text-white">Edit Profil</h1>
            </div>
            <div class="flex flex-col justify-center item-center">
                <div class="text-xs font-semibold text-black hover:text-orange-500"></div>
            </div>
        </div>
    </nav>
    <section>
        <div class="container mx-auto mt-5 p-5 w-full md:w-4/5">
            <form id="formEdit" enctype="multipart/form-data">
                <div class="flex flex-col justify-center items-center mb-5">
                    <label class="cursor-pointer relative" for="pictures">
                        <svg fill="currentColor"
                            class="w-10 h-10 text-white absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"
                            xmlns="http://www.w3.org/2000/svg" id="Outline" viewBox="0 0 24 24" width="512"
                            height="512">
                            <path
                                d="M19,4h-.508L16.308,1.168A3.023,3.023,0,0,0,13.932,0H10.068A3.023,3.023,0,0,0,7.692,1.168L5.508,4H5A5.006,5.006,0,0,0,0,9V19a5.006,5.006,0,0,0,5,5H19a5.006,5.006,0,0,0,5-5V9A5.006,5.006,0,0,0,19,4ZM9.276,2.39A1.006,1.006,0,0,1,10.068,2h3.864a1.008,1.008,0,0,1,.792.39L15.966,4H8.034ZM22,19a3,3,0,0,1-3,3H5a3,3,0,0,1-3-3V9A3,3,0,0,1,5,6H19a3,3,0,0,1,3,3Z" />
                            <path d="M12,8a6,6,0,1,0,6,6A6.006,6.006,0,0,0,12,8Zm0,10a4,4,0,1,1,4-4A4,4,0,0,1,12,18Z" />
                        </svg>
                        <div
                            class="w-32 h-32 rounded-full bg-black bg-opacity-40 absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">
                        </div>
                        <img id="previewImage" class="w-32 h-32 rounded-full object-cover"
                            src="{{ asset('pictures/' . $user->pictures) }}" alt="">
                        <input class="hidden" type="file" name="pictures" id="pictures">
                    </label>
                    <p id="pictures-error" class="mt-2 text-xs text-red-600 dark:text-red-400"></p>
                    <h1 class="text-sm font-medium text-black mt-2">ubah foto</h1>
                </div>
                <div class="flex text-sm px-5 mt-5">
                    Tentang Anda
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 px-5 mt-5">
                    <div class="grid">
                        <div class="relative z-0 mb-4">
                            <input type="text" id="username" name="username" value="{{ $user->username }}"
                                class="block w-full px-0 py-2 text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-700 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " />
                            <label for="username"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">username</label>
                            <p id="username-error" class="mt-2 text-xs text-red-600 dark:text-red-400"></p>
                        </div>
                        <div class="relative z-0 mb-4">
                            <input type="text" id="nama_lengkap" name="nama_lengkap" value="{{ $user->nama_lengkap }}"
                                class="block w-full px-0 py-2 text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-700 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " />
                            <label for="nama_lengkap"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">nama
                                lengkap</label>
                        </div>
                        <div class="relative z-0 mb-4">
                            <input type="text" id="alamat" name="alamat" value="{{ $user->alamat }}"
                                class="block w-full px-0 py-2 text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-700 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " />
                            <label for="alamat"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">alamat</label>
                        </div>
                    </div>
                    <div class="grid">
                        <div class="relative z-0 mb-4">
                            <label for="jenis_kelamin" class="sr-only">Underline select</label>
                            <select id="jenis_kelamin" name="jenis_kelamin"
                                class="block py-2 px-2 w-full text-sm text-gray-500 bg-transparent border-0 border-b-2 border-gray-700 appearance-none dark:text-gray-400 dark:border-gray-700 focus:outline-none focus:ring-0 focus:border-gray-200 ">
                                <option selected>{{ $user->jenis_kelamin }}</option>
                                <option value="pria">Pria</option>
                                <option value="wanita">Wanita</option>
                            </select>
                        </div>
                        <div class="relative mb-4">
                            <input type="text" id="bio" name="bio" value="{{ $user->bio }}"
                                class="block w-full px-0 py-2 text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-700 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " />
                            <label for="bio"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">bio</label>
                        </div>
                        <div class="relative mb-4">
                            <input type="date" id="tanggal_lahir" name="tanggal_lahir" {{ $user->tanggal_lahir }}
                                class="block w-full px-0 py-2 text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-700 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                placeholder=" " />
                            <label for="tanggal_lahir"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">tanggal
                                lahir</label>
                        </div>
                    </div>
                    <button type="submit"
                        class="mt-5 p-1 bg-blue-600 rounded-md text-sm text-white drop-shadow-lg hover:bg-blue-400 hover:text-black">Simpan</button>
                </div>
            </form>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/edit-profil.js') }}"></script>
@endpush

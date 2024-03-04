@extends('layout.master')
@section('content')
    @include('layout.index')

    <section id="login" class="h-screen pt-10 sm:pt-24">
        <div class="container mx-auto mt-5 px-5 sm:px-10 mb-5">
            <div class="grid grid-cols-1 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-2 w-full gap-2 mt-10">
                <div data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine"
                    class="flex gap-2 justify-center mt-5">
                    <div class="flex flex-col gap-2">
                        <img class="w-52 h-40 rounded-md object-cover" src="assets/img/anim2.jpg" alt="">
                        <img class="w-52 h-40 rounded-md object-cover" src="assets/img/anim3.jpg" alt="">
                    </div>
                    <div class="flex flex-col">
                        <img class="w-52 h-80 rounded-md object-cover" src="assets/img/anim1.jpg" alt="">
                    </div>
                </div>
                <div data-aos="fade-up" data-aos-offset="300" data-aos-easing="ease-in-sine"
                    class="block bg-slate-50 max-h-screen max-w-md w-full p-4 border border-blue-300 rounded-md shadow-md">
                    <!-- Login Tab Content -->
                    <div class="px-3 sm:px-5" id="loginTabContent">
                        <h1
                            class="text-black font-serif font-medium text-center mt-4 text-lg sm:text-lg md:text-xl lg:text-2xl">
                            Selamat datang kembali
                        </h1>
                        <p class="text-black font-serif text-center mb-16 text-xs">Saya harap anda masih ingat
                            passwordnya</p>
                        <!-- Input fields -->
                        <form id="loginForm">
                            <div class=" mb-5 group">
                                <div class="relative z-0 w-full">
                                    <input type="text" name="email" id="id-email"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2  appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " />
                                    <label for="email"
                                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
                                </div>
                                <p id="email-error" class="mt-2 text-xs text-red-600 dark:text-red-400"></p>
                            </div>
                            <div class="mb-5 group">
                                <div class="relative z-0 w-full">
                                    <input type="password" name="password" id="id-password"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2  appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " />
                                    <div id="showpw">
                                        <svg class="w-3 h-3 absolute right-3 top-5 scale-100 hover:scale-110 cursor-pointer hidden"
                                            xmlns="http://www.w3.org/2000/svg" id="hide" viewBox="0 0 24 24">
                                            <path
                                                d="M23.271,9.419C21.72,6.893,18.192,2.655,12,2.655S2.28,6.893.729,9.419a4.908,4.908,0,0,0,0,5.162C2.28,17.107,5.808,21.345,12,21.345s9.72-4.238,11.271-6.764A4.908,4.908,0,0,0,23.271,9.419Zm-1.705,4.115C20.234,15.7,17.219,19.345,12,19.345S3.766,15.7,2.434,13.534a2.918,2.918,0,0,1,0-3.068C3.766,8.3,6.781,4.655,12,4.655s8.234,3.641,9.566,5.811A2.918,2.918,0,0,1,21.566,13.534Z" />
                                            <path
                                                d="M12,7a5,5,0,1,0,5,5A5.006,5.006,0,0,0,12,7Zm0,8a3,3,0,1,1,3-3A3,3,0,0,1,12,15Z" />
                                        </svg>
                                        <svg class="w-3 h-3 absolute right-3 top-5 scale-100 hover:scale-110 cursor-pointer"
                                            xmlns="http://www.w3.org/2000/svg" id="show" viewBox="0 0 24 24">
                                            <path
                                                d="M23.271,9.419A15.866,15.866,0,0,0,19.9,5.51l2.8-2.8a1,1,0,0,0-1.414-1.414L18.241,4.345A12.054,12.054,0,0,0,12,2.655C5.809,2.655,2.281,6.893.729,9.419a4.908,4.908,0,0,0,0,5.162A15.866,15.866,0,0,0,4.1,18.49l-2.8,2.8a1,1,0,1,0,1.414,1.414l3.052-3.052A12.054,12.054,0,0,0,12,21.345c6.191,0,9.719-4.238,11.271-6.764A4.908,4.908,0,0,0,23.271,9.419ZM2.433,13.534a2.918,2.918,0,0,1,0-3.068C3.767,8.3,6.782,4.655,12,4.655A10.1,10.1,0,0,1,16.766,5.82L14.753,7.833a4.992,4.992,0,0,0-6.92,6.92l-2.31,2.31A13.723,13.723,0,0,1,2.433,13.534ZM15,12a3,3,0,0,1-3,3,2.951,2.951,0,0,1-1.285-.3L14.7,10.715A2.951,2.951,0,0,1,15,12ZM9,12a3,3,0,0,1,3-3,2.951,2.951,0,0,1,1.285.3L9.3,13.285A2.951,2.951,0,0,1,9,12Zm12.567,1.534C20.233,15.7,17.218,19.345,12,19.345A10.1,10.1,0,0,1,7.234,18.18l2.013-2.013a4.992,4.992,0,0,0,6.92-6.92l2.31-2.31a13.723,13.723,0,0,1,3.09,3.529A2.918,2.918,0,0,1,21.567,13.534Z" />
                                        </svg>
                                    </div>
                                    <label for="password"
                                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                                </div>
                                <p id="password-error" class="mt-2 text-xs text-red-600 dark:text-red-400"></p>
                            </div>
                            <!-- Login button -->
                            <button type="submit"
                                class="w-full bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300 mt-10 mb-5">Login</button>
                        </form>
                        <p class="mt-4 mb-5 text-sm text-gray-600">Belum bergabung? <button type="button" id="signupTab"
                                class="text-blue-500 bg-transparent" onclick="showTab('signup')">Daftar</button></p>
                    </div>
                    <!-- Sign Up Tab Content -->
                    <div id="signupTabContent" class="hidden px-3 sm:px-5">
                        <h1
                            class="text-black font-serif font-medium text-center mt-4 text-lg sm:text-lg md:text-xl lg:text-2xl">
                            Selamat datang di
                            Picturest
                        </h1>
                        <p class="text-black font-serif text-center mb-5 text-xs">Bergabung dan simpan kenangan anda
                        </p>
                        <!-- Sign Up form fields go here -->
                        <form id="daftarForm">
                            <div class="mb-4 group">
                                <div class="relative z-0 w-full ">
                                    <input type="text" name="username" id="username"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-blue-950 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " />
                                    <label for="username"
                                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Username</label>
                                </div>
                                <p id="username-errors" class="mt-2 text-xs text-red-600 dark:text-red-400"></p>
                            </div>
                            <div class="mb-4 group">
                                <div class="relative z-0 w-full ">
                                    <input type="text" name="email" id="email"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-blue-950 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " />
                                    <label for="email"
                                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
                                </div>
                                <p id="email-errors" class="mt-2 text-xs text-red-600 dark:text-red-400"></p>
                            </div>
                            <div class="mb-4 group">
                                <div class="relative z-0 w-full">
                                    <input type="password" name="password" id="password"
                                        class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-blue-950 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                                        placeholder=" " />
                                    <label for="password"
                                        class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Password</label>
                                </div>

                                <p id="password-errors" class="mt-2 text-xs text-red-600 dark:text-red-400"></p>
                            </div>
                            <!-- Sign Up button -->
                            <button type="submit"
                                class="w-full mt-5 bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:ring focus:border-blue-300 mb-5">Sign
                                Up</button>
                        </form>

                        <p class="mt-4 mb-5 text-sm text-gray-600">Sudah menjadi anggota? <button type="button"
                                id="loginTab" class="text-blue-500 bg-transparent"
                                onclick="showTab('login')">Masuk</button></p>
                    </div>
                </div>
            </div>
            <div class="w-full mt-5 rounded-md border border-gray bg-white shadow-md h-full p-5">
                <a class="text-blue-600 text-sm" href="/help-tamu">Picturest</a>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/index.js') }}"></script>
@endpush

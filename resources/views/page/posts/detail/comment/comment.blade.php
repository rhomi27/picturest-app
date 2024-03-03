<section id="comment">
    <div class="container mx-auto p-5 w-full md:w-3/4">
        <div class="mt-3 drop-shadow-sm border border-gray-400 rounded-md p-5">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                Komentar
            </h3>
            <!-- Daftar Komentar -->
            @auth
                @if (Auth::check() && Auth::user()->status === 'banned')
                    <form id="formCommen">
                        <div class="flex mt-4">
                            <div class="relative w-full drop-shadow-md">
                                <button type="submit" disabled
                                    class="absolute top-0 right-0 px-5 h-full text-sm font-medium text-white bg-none border-l-0 rounded-e-lg border border-blue-300 focus:ring-4 focus:outline-none focus:ring-blue-500 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="w-4 h-4 m-auto text-black" stroke="currentColor" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path
                                            d="m3.539.26l-.038-.02C2.565-.194,1.481-.025.738.671.041,1.323-.182,2.273.187,3.217l4.933,8.785L.247,20.853c-.337.879-.111,1.829.587,2.479.465.434,1.062.661,1.68.661.374,0,.755-.083,1.121-.254l20.368-11.74L3.539.26ZM1.09,2.792c-.192-.498-.068-1.018.331-1.391.229-.214.594-.4,1.018-.4.197,0,.407.041.622.138l18.063,10.361H5.985L1.09,2.792Zm2.084,20.061c-.562.262-1.212.163-1.658-.252-.4-.373-.525-.893-.364-1.328l4.837-8.772h15.144L3.174,22.853Z" />
                                    </svg>
                                </button>
                                <input type="hidden" name="post_id" id="post_id" value="{{ $data->id }}">
                                <div id="isi_komen-error"
                                    class="absolute z-10 inline-block bg-opacity-20 right-20 -top-10 px-3 py-2  text-sm font-normal text-red-600 rounded-lg  tooltip dark:bg-gray-700">
                                </div>
                                <input disabled type="text" id="isi_komen" name="isi_komen"
                                    class="block p-2.5 w-full z-20 text-sm text-gray-900 bg-gray-50 rounded-e-lg rounded-s-gray-100 rounded-s-2 border border-blue-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:border-blue-500"
                                    placeholder="Kirimkan Komentar" />
                            </div>
                        </div>
                    </form>
                @else
                    <form id="formCommen">
                        <div class="flex mt-4">
                            <div class="flex w-full relative">
                                <input type="hidden" name="post_id" id="post_id" value="{{ $data->id }}">
                                <div id="isi_komen-error"
                                    class="inline-block absolute bg-opacity-20 right-20 -top-10 px-3 py-2  text-sm font-normal text-red-600 rounded-lg  tooltip dark:bg-gray-700">

                                </div>
                                <input type="text" id="isi_komen" name="isi_komen"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 border border-blue-300 focus:ring-blue-500 focus:border-blue-500 "
                                    placeholder="Kirimkan Komentar" />
                                <button type="submit"
                                    class=" top-0 right-0 px-5 h-full text-sm font-medium text-white bg-gray-50 border-l-0 rounded-e-lg border border-blue-300 focus:ring-4 focus:outline-none focus:ring-blue-500">
                                    <svg class="w-4 h-4 m-auto text-black" stroke="currentColor" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <path
                                            d="m3.539.26l-.038-.02C2.565-.194,1.481-.025.738.671.041,1.323-.182,2.273.187,3.217l4.933,8.785L.247,20.853c-.337.879-.111,1.829.587,2.479.465.434,1.062.661,1.68.661.374,0,.755-.083,1.121-.254l20.368-11.74L3.539.26ZM1.09,2.792c-.192-.498-.068-1.018.331-1.391.229-.214.594-.4,1.018-.4.197,0,.407.041.622.138l18.063,10.361H5.985L1.09,2.792Zm2.084,20.061c-.562.262-1.212.163-1.658-.252-.4-.373-.525-.893-.364-1.328l4.837-8.772h15.144L3.174,22.853Z" />
                                    </svg>
                                </button>

                            </div>
                        </div>
                    </form>
                @endif
            @else
                <div class="border w-full h-full bg-white shadow-md text-center p-3">
                    <a class=" text-blue-600 hover:underline p-2" href="/#login">Silahkan Login untuk menambahkan
                        komentar</a>
                </div>
            @endauth

            <div id="comen" class="mt-5">
                <div class="loading flex justify-center items-center">
                    <img class="w-8 h-8" src="{{ asset('assets/img/loading.gif') }}" alt="hehe">
                </div>
            </div>
        </div>
    </div>
</section>

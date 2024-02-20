<div id="drawer-form"
        class="fixed top-0 left-0 z-50 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-80 dark:bg-gray-800"
        tabindex="-1" aria-labelledby="drawer-form-label">
        <h5 id="drawer-label"
            class="inline-flex items-center mb-6 text-base font-semibold text-gray-500 dark:text-gray-400">
            <svg class="w-3.5 h-3.5 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 24 24">
                <path
                    d="m24 3a3 3 0 0 0 -3-3h-10a3 3 0 0 0 -3 3v2h-1a3 3 0 0 0 -3 3v2h-1a3 3 0 0 0 -3 3v11h16v-5h4v-5h4zm-21 9h10a1 1 0 0 1 1 1v.586l-4 4-1.947-1.948-6.053 5.188v-7.826a1 1 0 0 1 1-1zm11 10h-10.3l4.244-3.638 2.056 2.052 4-4zm4-5h-2v-4a3 3 0 0 0 -3-3h-7v-2a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1zm4-5h-2v-4a3 3 0 0 0 -3-3h-7v-2a1 1 0 0 1 1-1h10a1 1 0 0 1 1 1zm-18 3a1 1 0 1 1 1 1 1 1 0 0 1 -1-1z" />
            </svg>
            Tambah Album
        </h5>
        <button id="close-drawer" type="button" data-drawer-hide="drawer-form" aria-controls="drawer-form"
            class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
            </svg>
            <span class="sr-only">Close menu</span>
        </button>
        <form id="albumForm" enctype="multipart/form-data" class="mb-6">
            <div class="mb-4">
                <label for="nama" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                    Album</label>
                <input type="text" id="nama" name="nama"
                    class="bg-gray-50 border placeholder-slate-300 border-blue-200 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="isi judul album" />
                <p id="nama-errors" class="mt-2 text-xs font-thin text-red-600 dark:text-red-400"></p>
            </div>
            <div class="mb-4">
                <label for="deskripsi"
                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                <textarea id="deskripsi" name="deskripsi" rows="4"
                    class="block p-2 placeholder-slate-300 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="isi deskripsi album"></textarea>
                <p id="deskripsi-errors" class="mt-2 text-xs font-thin text-red-600 dark:text-red-400"></p>
            </div>

            <div class="flex flex-col items-center justify-center w-full mb-6">
                <label for="wallpaper"
                    class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                        <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                        </svg>
                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">Klik untuk unggah wallpaper album</p>
                    </div>
                    <input id="wallpaper" name="wallpaper" type="file" class="hidden" />
                </label>
                <p id="wallpaper-errors" class="mt-2 text-xs font-thin text-red-600 dark:text-red-400"></p>
            </div>

            <button type="submit"
                class="text-white mt-3 justify-center flex items-center bg-blue-700 hover:bg-blue-800 w-full focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                <svg class="w-3.5 h-3.5 me-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 24 24">
                    <path
                        d="m2,20h10v2H0V3C0,1.346,1.346,0,3,0h16c1.654,0,3,1.346,3,3v9h-2V3c0-.552-.449-1-1-1H3c-.551,0-1,.448-1,1v10.132l4.28-4.28c1.099-1.098,2.886-1.1,3.985,0l5.734,5.735v1.414h-1.414l-5.734-5.734c-.319-.318-.838-.318-1.157,0l-5.694,5.694v4.04ZM15,3.5c1.654,0,3,1.346,3,3s-1.346,3-3,3-3-1.346-3-3,1.346-3,3-3Zm0,2c-.551,0-1,.448-1,1s.449,1,1,1,1-.448,1-1-.449-1-1-1Zm9,12.5h-4v-4h-2v4h-4v2h4v4h2v-4h4v-2Z" />
                </svg>
                Tambah
            </button>
        </form>
    </div>
<div id="update-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                    Update Album
                </h3>
                <button type="button" id="close-modal"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <form id="updateForm" enctype="multipart/form-data" class="mb-6 p-5">
                <div class="mb-4">
                    <label for="nama"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Judul</label>
                    <input type="text" id="nama" name="nama"
                        class="bg-gray-50 border placeholder-slate-300 border-blue-200 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="ubah judul album" />
                    <p id="nama-error" class="mt-2 text-lg font-thin text-red-600 dark:text-red-400"></p>
                </div>
                <div class="mb-4">
                    <label for="deskripsi"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                    <textarea id="deskripsi" rows="3" name="deskripsi"
                        class="block p-2 placeholder-slate-300 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="ubah deskripsi album"></textarea>
                    <p id="deskripsi-error" class="mt-2 text-lg font-thin text-red-600 dark:text-red-400"></p>
                </div>
                <div class="flex items-center justify-center w-full h-full mt-1 relative mb-4">
                    <label for="wallpaperupdate"
                        class="flex flex-col items-center p-3 justify-center w-full h-40 border-2 border-sky-300 border-dashed rounded-md cursor-pointer bg-white bg-opacity-50 dark:bg-gray-700 hover:bg-opacity-70 hover:bg-white dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 z-10">
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-8 h-8 mb-4 text-black dark:text-gray-400" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                            </svg>
                            <p class="mb-2 text-center text-sm text-black dark:text-gray-400">
                                <span class="font-semibold">Klik untuk unggah</span>
                            </p>
                        </div>
                        <input type="file" name="wallpaper" id="wallpaperupdate" class="hidden">
                    </label>
                    <img id="preview" src="#" class="w-full h-40 object-cover z-0 absolute rounded-md" alt="">
                </div>
                <p id="updateWallpaper-error" class="mt-2 text-lg font-thin text-red-600 dark:text-red-400"></p>
                <input type="hidden" name="id" id="id">
                <button type="submit"
                    class="text-white mt-3 justify-center flex items-center bg-blue-700 hover:bg-blue-800 w-full focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                    Update
                </button>
            </form>
        </div>
    </div>
</div>

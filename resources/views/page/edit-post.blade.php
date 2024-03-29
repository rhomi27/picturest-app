@extends('layout.master')
@section('content')
@include('layout.navbar.nav2')
    <section>
        <div class="container mx-auto mt-5 p-5">
            <div data-aos="fade-down" class="mx-auto border border-gray bg-white drop-shadow-lg p-5 rounded-md w-full md:w-full xl:w-3/4">
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
                                        <option value="" selected>Pilih album</option>
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
@push('scripts')
    <script src="{{ asset('assets/js/edit-post.js') }}"></script>
@endpush

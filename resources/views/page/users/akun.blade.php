@extends('layout.master')
@section('content')
    <div data-aos="fade-down" class="container mx-auto max-w-screen-md p-5">
        <button type="button" onclick="goBack()"
            class="text-sm mb-5 bg-blue-600 text-white shadow-md rounded-full p-1 px-3 scale-100 hover:scale-95 transition-all duration-300">kembali</button>
        <div class="m-auto border border-gray-300 w-full h-full bg-white shadow-lg p-5">
            <h1 class="text-center">Pengaturan Akun</h1>
            <form id="update-acount">
                <div class="mt-5 p-2 w-full px-3 sm:px-10">
                    <div class=" relative z-0 mb-4">
                        <input type="text" id="email" name="email" value="{{ $user->email }}"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " />
                        <p id="email-error" class="mt-2 text-xs font-thin text-red-600 dark:text-red-400"></p>
                        <label for="email"
                            class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Email</label>
                    </div>
                    <div class="relative z-0 mb-4">
                        <input type="password" id="old_password" name="old_password"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " />
                        <p id="old_password-error" class="mt-2 text-xs font-thin text-red-600 dark:text-red-400"></p>
                        <label for="old_password"
                            class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Password
                            Lama</label>
                    </div>
                    <div class="relative z-0 mb-4">
                        <input type="password" id="new_password" name="new_password"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " />
                        <p id="new_password-error" class="mt-2 text-xs font-thin text-red-600 dark:text-red-400"></p>
                        <label for="new_password"
                            class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Password
                            Baru</label>
                    </div>
                    <div class="relative z-0 mb-4">
                        <input type="password" id="confirm_password" name="confirm_password"
                            class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
                            placeholder=" " />
                        <p id="confirm_password-error" class="mt-2 text-xs font-thin text-red-600 dark:text-red-400"></p>
                        <label for="confirm_password"
                            class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto">Konfirmasi
                            Password</label>
                    </div>
                    <button class="text-sm  text-white bg-blue-500 p-1 px-5 rounded-md hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
        <h1 class="text-center mt-10 bg-blue-500 text-white rounded-lg p-1 ">History Login</h1>
        <div class="overflow-x-auto overflow-y-auto h-64 mt-5 mb-5 hide-scrollbar">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="sticky start-0 top-0">
                    <tr>
                        <th scope="col"
                            class="px-6 py-3 bg-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            <input class="rounded-full w-3 h-3" type="checkbox" id="selectAll">
                        </th>
                        <th scope="col"
                            class="px-6 py-3 bg-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            No</th>
                        <th scope="col"
                            class="px-6 py-3 bg-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Terakhir Login</th>
                        <th scope="col"
                            class="px-6 py-3 bg-gray-100 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Ip Address</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($aktivitas_log as $item)
                        <tr id="data-{{ $item->id }}">
                            <td class="px-6 py-4 text-xs whitespace-nowrap"><input type="checkbox"
                                    class="checkboxId rounded-full w-3 h-3" value="{{ $item->id }}"></td>
                            <td class="px-6 py-4 text-xs whitespace-nowrap">{{ $loop->iteration }}</td>
                            <td class="px-6 py-4 text-xs whitespace-nowrap">
                                {{ \Carbon\Carbon::parse($item->login_time)->format('Y-F-l H:i') }}
                            </td>
                            <td class="px-6 py-4 text-xs whitespace-nowrap">{{ $item->ip_address }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="w-full border border-gray bg-white shadow-md h-full p-5">
            <button id="deleteSelected" type="button"
                class="bg-red-600 text-white p-1 px-3 text-sm shadow-md rounded-lg scale-100 hover:scale-95 transition-all duration-300">Hapus
                terpilih</button>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('assets/js/akun-setting.js') }}"></script>
@endpush

@extends('layout.master')
@section('content')
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md relative mt-5">
        <a href="/profil" class="absolute right-1 top-1 text-blue-900 text-xs rounded-md mb-4 hover:text-blue-600 ">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 scale-100 hover:scale-110" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg></a>

        <!-- Section Tentang Aplikasi -->
        <section id="tentang" class="mb-8">
            <h1 class="text-2xl flex gap-2 items-center font-bold mb-4">Tentang Aplikasi Picturest <img class="h-5 w-5"
                    src="{{ asset('assets/icon/android-chrome-512x512.png') }}" alt=""></h1>
            <p class="mb-4">Picturest adalah aplikasi yang memudahkan pengguna untuk mengatur dan berbagi foto mereka
                dengan mudah. Dengan Picturest, Anda dapat mengelompokkan foto-foto Anda, menambahkan deskripsi, dan berbagi
                dengan teman-teman Anda.</p>
            <p class="mb-4">Dengan antarmuka yang ramah pengguna dan fitur yang intuitif, Picturest adalah pilihan
                sempurna bagi mereka yang ingin menjaga koleksi foto mereka tetap teratur dan mudah diakses.</p>
        </section>

        <!-- Section Bantuan & Kontak -->
        <section id="bantuan">
            <h2 class="text-2xl font-bold mb-4">Bantuan & Hubungi Kami</h2>
            <p class="mb-4">Jika Anda memerlukan bantuan lebih lanjut atau memiliki pertanyaan, jangan ragu untuk
                menghubungi tim dukungan kami.</p>
            <form action="/inbox-auth" method="post">
                @csrf
                <label for="nama" class="block mb-2">Nama:</label>
                <input type="text" id="nama" name="name"
                    class="w-full border border-gray-300 rounded-md px-4 py-2 mb-4" required>

                <label for="email" class="block mb-2">Email:</label>
                <input type="email" id="email" name="email"
                    class="w-full border border-gray-300 rounded-md px-4 py-2 mb-4" required>

                <label for="pesan" class="block mb-2">Pesan:</label>
                <textarea id="pesan" name="pesan" class="w-full border border-gray-300 rounded-md px-4 py-2 mb-4" rows="4"
                    required></textarea>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Kirim
                    Pesan</button>
            </form>
        </section>

        <!-- Footer -->
        <hr class="my-8">
        <footer class="text-sm text-gray-500">Terma & Syarat Penggunaan</footer>
    </div>
@endsection

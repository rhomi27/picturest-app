<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/icon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/icon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/icon/favicon-32x32.png') }}">
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" /> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css"
        integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .hide-scrollbar::-webkit-scrollbar {
            width: 0px;
            /* Lebar scrollbar */
        }
    </style>
</head>

<body class="overflow-x-hidden {{ $bg }}">

    @yield('content')

    <script src="{{ asset('assets/js/flowbite.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script> --}}

    @yield('script')
    @stack('scripts')
    <script>
        @if (session()->has('success'))
            Swal.fire({
                title: "",
                text: "{{ session('success') }}",
                icon: "success"
            });
        @endif
        @if (session()->has('info'))
            Swal.fire({
                title: "",
                text: "{{ session('info') }}",
                icon: "info"
            });
        @endif
        @if (session()->has('error'))
            Swal.fire({
                title: "",
                text: "{{ session('error') }}",
                icon: "error"
            });
        @endif
    </script>
    <script>
        $(document).ready(function() {
            $('a[href^="#"]').on('click', function(event) {
                // Pastikan hash telah diset
                if (this.hash !== "") {
                    // Menghentikan default behavior
                    event.preventDefault();

                    // Simpan hash
                    var hash = this.hash;

                    // Menggunakan metode animate() jQuery untuk menambahkan animasi scroll
                    // Menggunakan offset() untuk menyesuaikan posisi
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 800, function() {
                        // Tambahkan hash ke URL setelah scroll
                        window.location.hash = hash;
                    });
                }
            });
        });

        function goBack() {
            window.history.back();
        }
    </script>
</body>

</html>

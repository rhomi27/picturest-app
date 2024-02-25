@extends('layout.master')
@section('content')
    <nav class="bg-white border-gray-200 dark:bg-gray-900 sticky w-full z-50 top-0 start-0 drop-shadow-md">
        <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-3">
            <a href="#" class="flex items-center space-x-3 rtl:space-x-reverse">
                <span class="self-center text-base font-semibold whitespace-nowrap dark:text-white">Notifikasi</span>
            </a>
        </div>
    </nav>
    <!-- bottom navigasi -->
    @include('layout.bottom-nav')
    <!-- content -->
    <section>
        <div class="container mx-auto p-5 max-w-screen-md">
            <div class="grid grid-cols-1 gap-3">
                @if ($notifikasi && !$notifikasi->isEmpty())
                    <div id="deleteall-notif"
                        class="bg-white cursor-pointer shadow-md p-2 text-sm rounded-sm font-serif text-red-500 scale-100 hover:scale-105 transition-all duration-300">
                        <span class="flex justify-center items-center gap-3">
                            hapus semua notifikasi
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-3 h-3" viewBox="0 0 24 24">
                                <path
                                    d="m15.707,11.707l-2.293,2.293,2.293,2.293c.391.391.391,1.023,0,1.414-.195.195-.451.293-.707.293s-.512-.098-.707-.293l-2.293-2.293-2.293,2.293c-.195.195-.451.293-.707.293s-.512-.098-.707-.293c-.391-.391-.391-1.023,0-1.414l2.293-2.293-2.293-2.293c-.391-.391-.391-1.023,0-1.414s1.023-.391,1.414,0l2.293,2.293,2.293-2.293c.391-.391,1.023-.391,1.414,0s.391,1.023,0,1.414Zm7.293-6.707c0,.553-.448,1-1,1h-.885l-1.276,13.472c-.245,2.581-2.385,4.528-4.978,4.528h-5.727c-2.589,0-4.729-1.943-4.977-4.521l-1.296-13.479h-.86c-.552,0-1-.447-1-1s.448-1,1-1h4.101c.465-2.279,2.485-4,4.899-4h2c2.414,0,4.435,1.721,4.899,4h4.101c.552,0,1,.447,1,1Zm-14.828-1h7.656c-.413-1.164-1.524-2-2.828-2h-2c-1.304,0-2.415.836-2.828,2Zm10.934,2H4.87l1.278,13.287c.148,1.547,1.432,2.713,2.986,2.713h5.727c1.556,0,2.84-1.168,2.987-2.718l1.258-13.282Z" />
                            </svg>
                        </span>
                    </div>
                    @php
                        $dibaca = $notifikasi->contains('status', 'new');
                    @endphp
                    <div id="readall-notif" data-dibaca="{{ $dibaca }}"
                        class="bg-white cursor-pointer shadow-md p-2 text-sm rounded-sm font-serif text-blue-500 scale-100 hover:scale-105 transition-all duration-300">
                        <span class="flex justify-center items-center">
                            tandai semua telah dibaca
                        </span>
                    </div>

                    @foreach ($notifikasi as $item)
                        <div id="notif-{{ $item->id }}"
                            class="notifikasi relative border border-gray-200 h-full w-full mb-5 rounded-sm drop-shadow-md @if ($item->status == 'new') bg-white @else bg-gray-50 @endif">
                            <label data-notif-id="{{ $item->id }}"
                                class="notif flex px-4 py-2 h-full hover:bg-gray-50 dark:hover:bg-gray-700">
                                <div class="flex-shrink-0">
                                    <img class="rounded-full w-11 h-11 object-cover"
                                        src="{{ asset('pictures/' . $item->sender->pictures) }}" alt="Jese image">
                                </div>
                                <div class="w-full ps-3">
                                    <div class="text-gray-500 text-sm mb-1.5 dark:text-gray-400"><span
                                            class="font-semibold text-gray-900 dark:text-white">{{ $item->sender->username }}</span>
                                        {{ $item->msg }}
                                        @if ($item->post_id !== null)
                                            <a href="/detail/{{ $item->post_id }}">Lihat</a>
                                        @endif
                                    </div>
                                    <div class="text-xs text-blue-600 dark:text-blue-500">
                                        {{ $item->created_at->diffForHumans() }}</div>
                                </div>
                            </label>
                            @if ($item->status == 'new')
                                <div id="new-notif-{{ $item->id }}"
                                    class="new-notif absolute text-xs bg-red-600 w-5 h-5 flex items-center justify-center rounded-full text-white border-2 border-white -end-1 -top-1">
                                    <svg class="w-2 h-2 text-white dark:text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-500"
                                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        viewBox="0 0 24 24">
                                        <path
                                            d="M22.555,13.662l-1.9-6.836A9.321,9.321,0,0,0,2.576,7.3L1.105,13.915A5,5,0,0,0,5.986,20H7.1a5,5,0,0,0,9.8,0h.838a5,5,0,0,0,4.818-6.338ZM12,22a3,3,0,0,1-2.816-2h5.632A3,3,0,0,1,12,22Zm8.126-5.185A2.977,2.977,0,0,1,17.737,18H5.986a3,3,0,0,1-2.928-3.651l1.47-6.616a7.321,7.321,0,0,1,14.2-.372l1.9,6.836A2.977,2.977,0,0,1,20.126,16.815Z" />
                                    </svg>
                                </div>
                            @endif
                            <div data-notif-id="{{ $item->id }}"
                                class="delete absolute bottom-2 right-2 text-red-600 cursor-pointer scale-100 hover:scale-110">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-3 h-3"
                                    viewBox="0 0 24 24">
                                    <path
                                        d="m15.707,11.707l-2.293,2.293,2.293,2.293c.391.391.391,1.023,0,1.414-.195.195-.451.293-.707.293s-.512-.098-.707-.293l-2.293-2.293-2.293,2.293c-.195.195-.451.293-.707.293s-.512-.098-.707-.293c-.391-.391-.391-1.023,0-1.414l2.293-2.293-2.293-2.293c-.391-.391-.391-1.023,0-1.414s1.023-.391,1.414,0l2.293,2.293,2.293-2.293c.391-.391,1.023-.391,1.414,0s.391,1.023,0,1.414Zm7.293-6.707c0,.553-.448,1-1,1h-.885l-1.276,13.472c-.245,2.581-2.385,4.528-4.978,4.528h-5.727c-2.589,0-4.729-1.943-4.977-4.521l-1.296-13.479h-.86c-.552,0-1-.447-1-1s.448-1,1-1h4.101c.465-2.279,2.485-4,4.899-4h2c2.414,0,4.435,1.721,4.899,4h4.101c.552,0,1,.447,1,1Zm-14.828-1h7.656c-.413-1.164-1.524-2-2.828-2h-2c-1.304,0-2.415.836-2.828,2Zm10.934,2H4.87l1.278,13.287c.148,1.547,1.432,2.713,2.986,2.713h5.727c1.556,0,2.84-1.168,2.987-2.718l1.258-13.282Z" />
                                </svg>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div id="none-notif" class="text-gray-500 text-center">Tidak ada notifikasi.</div>
                @endif
                <div id="none-notif" class="hidden text-gray-500 text-center">Tidak ada notifikasi.</div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        function showToast(message) {
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "newestOnTop": true,
                "progressBar": true,
                "positionClass": "toast-top-left",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            }

            toastr.info(message)
        }

        $(document).ready(function() {
            $('.delete').click(function() {
                var id = $(this).data('notif-id');
                const urldel = `/delete/${id}`

                $.ajax({
                    method: 'get',
                    url: urldel,
                    success: function(res) {
                        console.log(res);
                        $(`#notif-${id}`).animate({
                            opacity: 0,
                            marginLeft: "-100px"
                        }, 500, function() {
                            $(this).hide();
                        });
                        $('#count-notif').load(location.href + ' #count-notif');
                    },
                    error: function(xhr, status, error) {
                        console.error('Terjadi kesalahan:', error);
                    }
                });
            })
            // hapus semua notif
            $('#deleteall-notif').click(function() {
                $.ajax({
                    method: 'get',
                    url: "{{ route('deleteall.notif') }}",
                    success: function(res) {
                        console.log(res)
                        showToast(res.message)
                        $('#deleteall-notif').hide();
                        $('#readall-notif').hide();
                        $('.notifikasi').animate({
                            opacity: 0,
                            marginLeft: "-100px"
                        }, 500, function() {
                            $(this).hide();
                        });
                        $('#none-notif').show();
                        $('#count-notif').load(location.href + ' #count-notif');
                    },
                    error: function(err) {
                        console.log('error');
                    }
                })
            })
            // button baca semua notif
            const dibaca = $('#readall-notif').data('dibaca');

            if (dibaca) {
                $('#readall-notif').show();
            } else {
                $('#readall-notif').hide();
            }

            $('#readall-notif').click(function() {
                $.ajax({
                    method: 'post',
                    url: "{{ route('readall.notif') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(res) {
                        console.log(res)
                        showToast(res.message)
                        $('.new-notif').hide();
                        $('.notif').removeClass('bg-white').addClass('bg-gray-50');
                        $('#readall-notif').hide();
                        $('#count-notif').load(location.href + ' #count-notif');
                    },
                    error: function(err) {
                        console.log('error');
                    }
                })
            });
        });


        // baca notif per id
        $(document).on('click', '.notif', function() {
            var notifId = $(this).data('notif-id');

            $.ajax({
                method: 'POST',
                url: "{{ route('read.notif') }}",
                data: {
                    id: notifId,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    console.log(res);
                    $(`#new-notif-${notifId}`).hide();
                    $(this).removeClass('bg-white').addClass('bg-gray-50');
                    $('#count-notif').load(location.href + ' #count-notif');
                }.bind(this),
                error: function(xhr, status, error) {
                    console.error('Terjadi kesalahan:', error);
                }
            });
        });
    </script>
@endsection

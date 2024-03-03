@extends('layout.master')
@section('content')
    @include('admin.layout.nav-side')
    <div class="p-4 sm:ml-64">
        <div id="navbar-search" class="sticky start-0 top-5 sm:top-5 w-full hidden sm:inline-block">
            <input id="search-report" type="text" class="p-1 rounded-md focus:outline-none px-4 text-sm w-full ">
        </div>
        <div id="content" class="container mx-auto p-5">
            <h1 class="text-lg font-semibold mb-4">Laporan dari Pengguna</h1>

        </div>

    </div>
@endsection
@section('script')
    <script>
        function handleSearch() {
            let search_string = $("#search-report").val();
            $.ajax({
                url: "/search-report",
                method: "get",
                data: {
                    search: search_string
                },
                beforeSend: function() {
                    $('.loader').show();
                },
                success: function(res) {
                    $('#content').html(res);
                    $('.loader').html("tidak ada data lainnya");
                    if (res.status == 400) {
                        $('.loader').html(res.message);
                    }
                }

            })
        }

        $(document).ready(function() {
            $('#search-report').on('keyup', function(e) {
                e.preventDefault();
                handleSearch();

            })

            var EndPoint = "/report";
            var page = 1;
            LoadMore(page);

            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 5)) {
                    page++;
                    LoadMore(page);
                }
            });

            function LoadMore(page) {
                $.ajax({
                        url: EndPoint + "?page=" + page,
                        type: "get",
                        datatype: "html",
                        beforeSend: function() {
                            $('.loader').show();
                        }
                    })
                    .done(function(data) {
                        if (data.length == 0) {
                            $('.loader').html("tidak ada data lainnya");
                            return;
                        }
                        $('.loader').hide();
                        $("#content").append(data);
                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError) {
                        console.log('server error');
                    })
            }
            $('#content').on('click', '.delete-btn', function() {
                const id = $(this).data('report-id')
                const delUrl = `/delete-report/${id}`
                Swal.fire({
                    title: "kamu yakin?",
                    text: `akan menghapus id ${id}`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: delUrl,
                            type: 'get',
                            success: function(res) {
                                $(`#report-${id}`).hide('slow');
                            }
                        })
                        // Swal.fire({
                        //   title: "Deleted!",
                        //   text: "Your file has been deleted.",
                        //   icon: "success"
                        // });
                    }
                });
            })
        })
    </script>
@endsection


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

        function showMessage(message) {
            Swal.fire({
                title: "Berhasil",
                text: message,
                icon: "success"
            });
        }

        $(document).ready(function() {
            const bloked = $('#delete-button').data('bloked')
            if (bloked) {
                $('#bloked').show();
                $('#aktif').hide();
            } else {
                $('#bloked').hide();
                $('#aktif').show();
            }


            $('#delete-button').click(function() {
                var id = $(this).data('post-id');
                var judul = $(this).data('nama');
                const urlDelete = `/blokir/${id}`
                Swal.fire({
                    title: "Anda yakin?",
                    text: `akan melakukan tindakan pada data dengan judul ${judul}!`,
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    cancelButtonText: "batal",
                    confirmButtonText: "ya! lakukan"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: urlDelete,
                            type: 'post',
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(res) {
                                if (res.status == 400) {
                                    showMessage(res.message);
                                    $('#bloked').show();
                                    $('#aktif').hide();
                                } else if (res.status == 200) {
                                    showMessage(res.message);
                                    $('#bloked').hide();
                                    $('#aktif').show();
                                }
                            }
                        })
                    }
                });
            })
        })
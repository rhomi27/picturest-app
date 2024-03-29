function handleSearch() {
    let search_string = $("#search-user").val();
    $.ajax({
        url: "/search-user",
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

    $('#search-user').on('keyup', function(e) {
        e.preventDefault();
        handleSearch();

    })


    var EndPoint = "/users";
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
});

function showMessage(type, message) {
    Swal.fire({
        title: "Berhasil",
        text: message,
        icon: type
    });
}
$(document).ready(function() {
    $('#content').on('click', '.banned', function() {
        var userId = $(this).data('user-id');
        var status = $(this).data('status');
        var nama = $(this).data('nama');
        var button = $(this);
        Swal.fire({
            title: "kamu yakin?",
            text: `akan melakukan tindakan pada user ${nama}`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, Lakukan!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '/banned-user/' + userId,
                    type: 'post',
                    data: {
                        status: status
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        console.log(response)
                        if (response.status == 400) {
                            button.text('Aktifkan user');
                            $(`#user-${userId}`).text('banned');
                            showMessage('success', response.message)
                        } else if (response.status == 200) {
                            button.text('Banned user');
                            $(`#user-${userId}`).text('aktif');
                            showMessage('success', response.message)
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                    }
                });
            }
        });

    });
});
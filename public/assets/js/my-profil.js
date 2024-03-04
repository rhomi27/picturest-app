function read() {
    $.get("/count-reading", {}, function (data) {
        $("#count-follow").html(data);
    });
}
$(document).ready(function () {
    $('#data-wrap').on('click', '.delete', function () {
        const id = $(this).data('id');
        const judul = $(this).data('judul')
        const urlDel = `/delete-post/${id}`
        Swal.fire({
            title: "Apa kamu yakinn?",
            text: `hapus data dengan judul ${judul}`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, hapus ini!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: urlDel,
                    type: 'get',
                    success: function (res) {
                        $(`#posts-${id}`).animate({
                            opacity: 0,
                        }, 500, function () {
                            $(this).hide('slow');
                        });
                    },
                    error: function (err) {
                        console.log('error')
                    }
                })
            }
        });
    })
    read()
    LoadMore(page);
});


var EndPoint = "/profil";
var page = 1;
$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 0, 9)) {
        page++;
        LoadMore(page);
    }
});

var countPost = $('#post').data('count');
console.log('data: ' + countPost)
function LoadMore(page) {
    $.ajax({
        url: EndPoint + "?page=" + page,
        datatype: "html",
        type: "get",
        beforeSend: function () {
            $('.loader').show();
        }
    })
        .done(function (data) {
            if (countPost == 0) {
                $('.loader').html('Tidak ada postingan')
            } else {
                if (!data.trim()) {
                    $('.loader').html("Tidak ada postingan lainnya");
                    return;
                }

                $('.loader').hide();
                $("#data-wrap").append(data);
            }
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            console.log('server error');
        })
}
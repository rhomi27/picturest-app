var EndPoint = "/mengikuti";
var page = 1;
LoadMore(page);

$(window).scroll(function () {
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
        beforeSend: function () {
            $('.loader').show();
        }
    })
        .done(function (data) {
            if (data.length == 0) {
                $('.loader').html("tidak ada data lainnya");
                return;
            }
            $('.loader').hide();
            $("#data-mengikuti").append(data);
        })
        .fail(function (jqXHR, ajaxOptions, thrownError) {
            console.log('server error');
        })
}



function handleSearch() {
    let search_string = $("#search-nav").val();
    $.ajax({
        url: "/search-image-mengikuti",
        method: "get",
        data: {
            search_string: search_string
        },
        beforeSend: function () {
            $('.loader').show();
        },
        success: function (res) {
            $('#data-mengikuti').html(res);
            $('.loader').html("tidak ada data lainnya");
            if (res.status == 400) {
                $('.loader').html(res.pesan);
            }
        }

    })
}

$(document).ready(function () {
    $(document).on('keyup', function (e) {
        e.preventDefault();
        handleSearch()
    });
})
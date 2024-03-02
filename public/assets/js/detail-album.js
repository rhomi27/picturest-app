var EndPoint = "/read-detail-album";
var page = 1;
LoadMore(page); 

$(window).scroll(function() {
    if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 20)) {
        page++;
        LoadMore(page);
    }
});

function LoadMore(page) {
    const idAlbum = $('#id_album').val();
    $.ajax({
            url: EndPoint + "?page=" + page,
            type: "get",
            data: {
                id: idAlbum
            },
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
            $("#data-wrap").append(data);
        })
        .fail(function(jqXHR, ajaxOptions, thrownError) {
            console.log('server error');
        })
}

function handleSearch() {
    let search_string = $("#search-nav").val();
    const idAlbum = $('#id_album').val();
    $.ajax({
        url: `/search-image-album/${idAlbum}`,
        method: "get",
        data: {
            search_string: search_string
        },
        beforeSend: function() {
            $('.loader').show();
        },
        success: function(res) {
            $('#data-wrap').html(res);
            $('.loader').html("tidak ada data lainnya");
            if (res.status == 400) {
                $('.loader').html(res.pesan);
            }
        }

    })
}

$(document).on('keyup', function(e) {
        e.preventDefault();
        handleSearch()
    });
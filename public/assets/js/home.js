var EndPoint = "/home";
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
            $("#data-wrap").append(data);
        })
        .fail(function(jqXHR, ajaxOptions, thrownError) {
            console.log('server error');
        })
}

function setInputValue() {
    const urlParams = new URLSearchParams(window.location.search);
    const tagValue = urlParams.get('tagValue');
    if (tagValue) {
        document.getElementById('search-nav').value = tagValue;
        $('#search-button').click();
    }
}

function handleSearch() {
    let search_string = $("#search-nav").val();
    $.ajax({
        url: "/search-image",
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

$(document).ready(function() {
    setInputValue()
    handleSearch()
    $(document).on('keyup', function(e) {
        e.preventDefault();
        handleSearch()
    });
})
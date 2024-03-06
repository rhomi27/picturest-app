const userId = $('#follow-btn').data('user-id');
const userUuid = $('#uuid').val();
var EndPoint = `/profil-user/show=${userUuid}`;
var page = 1;
LoadMore(page);

$(window).scroll(function() {
    if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 0,9)) {
        page++;
        LoadMore(page);
    }
});

function LoadMore(page) {
    $.ajax({
            url: EndPoint + "?page=" + page,
            datatype: "html",
            type: "get",
            beforeSend: function() {
                $('.loader').show();
            }
        })
        .done(function(data) {
            if (!data.trim()) {
                $('.loader').html("Tidak ada data lainnya");
                return;
            }

            $('.loader').hide();
            $("#data-wrap").append(data);
        })
        .fail(function(jqXHR, ajaxOptions, thrownError) {
            console.log('server error');
        })
}

function readAlbum() {
    $.get(`/read-album-user/${userId}`, {}, function(data) {
        $("#album").html(data);
    });
}

function read() {
    $.get(`/count-read/${userId}`, {}, function(data) {
        $("#count-follow").html(data);
    });
}

$(document).ready(function() {
    readAlbum()
    read()
    const followed = $('#follow-btn').data('follow');
    if (followed) {
        $('.notfollow').hide('fast');
        $('.followed').show('fast');
    } else {
        $('.notfollow').show('fast');
        $('.followed').hide('fast');
    }

    $('#follow-btn').click(function() {
        const userId = $(this).data('user-id');
        const followUrl = `/follow-user/${userId}`;

        var button = $(this);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: followUrl,
            type: 'post',
            success: function(data) {
                if (data.following) {
                    button.find('.notfollow').hide('fast');
                    button.find('.followed').show('slow');
                } else {
                    button.find('.notfollow').show('slow');
                    button.find('.followed').hide('fast');
                }
                read()
            }.bind(this),
            error: function(jqXHR, ajaxOptions, thrownError) {
                console.log('server error');
            }
        });
    });
});
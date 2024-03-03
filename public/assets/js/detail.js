// follow ajax js

$(document).ready(function () {
    const followed = $('#follow-btn').data('follow');

    if (followed) {
        $('#notfollow').hide('fast');
        $('#followed').show('fast');
    } else {
        $('#notfollow').show('fast');
        $('#followed').hide('fast');
    }

    $('#follow-btn').click(function () {
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
            success: function (data) {
                if (data.following) {
                    button.find('#notfollow').hide('fast');
                    button.find('#followed').show('slow');
                } else {
                    button.find('#notfollow').show('slow');
                    button.find('#followed').hide('fast');
                }
            }.bind(this),
            error: function (jqXHR, ajaxOptions, thrownError) {
                console.log('server error');
            }
        });
    });
});

// like ajax js 

$(document).ready(function () {
    const isLiked = $('#like-button').data('liked');

    if (isLiked === true) {
        $('#like').hide('fast');
        $('#liked').show('fast');
    } else {
        $('#like').show('fast');
        $('#liked').hide('fast');
    }

    $('#like-button').click(function () {
        const postId = $(this).data('post-id');
        const likeUrl = `/like-post/${postId}`

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: likeUrl,
            type: 'post',
            success: function (data) {
                if (data.liked) {
                    $(this).find('#like').hide('fast');
                    $(this).find('#liked').show('slow');
                } else {
                    $(this).find('#like').show('slow');
                    $(this).find('#liked').hide('fast');
                }
                $('#likeCount').load(location.href + ' #likeCount')
            }.bind(this),
            error: function (jqXHR, ajaxOptions, thrownError) {
                console.log('server error');
            }
        })
    })
});

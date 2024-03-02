
$(document).ready(function() {
    $('.follow-btn').each(function() {
        var followed = $(this).data('follow');
        var notfollowBtn = $(this).find('.notfollow');
        var followedBtn = $(this).find('.followed');

        if (followed) {
            notfollowBtn.hide();
            followedBtn.show();
        } else {
            notfollowBtn.show();
            followedBtn.hide();
        }
    });

    $('.follow-btn').click(function() {
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
                console.log(data);
                if (data.following) {
                    button.find('.notfollow').hide();
                    button.find('.followed').show();
                } else {
                    button.find('.notfollow').show();
                    button.find('.followed').hide();
                }
            }.bind(this),
            error: function(jqXHR, ajaxOptions, thrownError) {
                console.log('server error');
            }
        });
    });
});
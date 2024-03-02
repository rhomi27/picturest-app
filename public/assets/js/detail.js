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
    read()
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

    // comments ajax js

    $("#formCommen").submit(function (e) {
        e.preventDefault();
        const postId = document.getElementById("post_id").value;
        const comenUrl = `/comen-post/${postId}`
        var formData = new FormData(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: false,
            processData: false,
        });
        $.ajax({
            url: comenUrl,
            type: "post",
            data: formData,
            success: function (res) {
                if (res.status == 400) {
                    showError('isi_komen', res.errors.isi_komen);
                    setTimeout(function () {
                        $("#isi_komen-error")
                            .empty();
                    }, 2000);
                } else if (res.status == 200) {
                    $("#formCommen")[0].reset();
                    removeValidasiClass('#formCommen')
                    read()
                    $('#comenCount').load(location.href + ' #comenCount')
                }
            },
            error: function (err) {
                console.log('server error');
            }
        });
    });

    // repports post ajax js

    $('#reportForm').submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        const postId = document.getElementById("post_id").value;
        const reportUrl = `/report-post/${postId}`;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: false,
            processData: false,
        });
        $.ajax({
            url: reportUrl,
            type: 'post',
            data: formData,
            success: function (res) {
                if (res.status == 400) {
                    showError('alasan', res.errors.alasan)
                } else if (res.status == 200) {
                    $('#close-modal').click();
                    $('#reportForm')[0].reset();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top",
                        showConfirmButton: false,
                        timer: 3000,
                        timerProgressBar: true,
                        didOpen: (toast) => {
                            toast.onmouseenter = Swal.stopTimer;
                            toast.onmouseleave = Swal.resumeTimer;
                        }
                    });
                    Toast.fire({
                        icon: 'success',
                        title: res.message,
                    });
                }
            }
        })
    })
});

function removeValidasiClass(form) {
    $(form).each(function () {
        $(form).find(':input').removeClass('border-green-600 border-red-600');

        $(form).find('.text-red-600, .text-green-600').text('');
    });
}

function read() {
    const postId = document.getElementById("post_id").value;
    $.get(`/comen-read/${postId}`, {}, function (data) {
        $("#comen").html(data);
    });
}

function showError(field, message) {
    const errorElement = $("#" + field + "-error");
    if (!message) {
        $("#" + field).addClass("border-green-600").removeClass("border-red-600");
        errorElement.text("");
    } else {
        $("#" + field).addClass("border-red-600").removeClass("border-green-600");
        errorElement.text(message);
    }
}
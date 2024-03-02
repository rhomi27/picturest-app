
// baca notif per id
$(document).on('click', '.notif', function () {
    var notifId = $(this).data('notif-id');

    $.ajax({
        method: 'POST',
        url: "read-notif",
        data: {
            id: notifId,
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function (res) {
            $(`#new-notif-${notifId}`).hide('slow');
            $(this).removeClass('bg-white').addClass('bg-gray-50');
            $('#count-notif').load(location.href + ' #count-notif');
        }.bind(this),
        error: function (xhr, status, error) {
            console.error('Terjadi kesalahan:', error);
        }
    });
});

$(document).ready(function () {
    $('.delete').click(function () {
        var id = $(this).data('notif-id');
        const urldel = `/delete/${id}`

        $.ajax({
            method: 'get',
            url: urldel,
            success: function (res) {
                $(`#notif-${id}`).animate({
                    opacity: 0,
                    marginLeft: "-100px"
                }, 500, function () {
                    $(this).hide('slow');
                });
                $('#count-notif').load(location.href + ' #count-notif');
            },
            error: function (xhr, status, error) {
                console.error('Terjadi kesalahan:', error);
            }
        });
    })
    // hapus semua notif
    $('#deleteall-notif').click(function () {
        $.ajax({
            method: 'get',
            url: "/delete-all-notif",
            success: function (res) {
                $('#deleteall-notif').hide('slow');
                $('#readall-notif').hide('slow');
                $('.notifikasi').animate({
                    opacity: 0,
                    marginLeft: "-100px"
                }, 500, function () {
                    $(this).hide('slow');
                });
                $('#none-notif').show();
                $('#count-notif').load(location.href + ' #count-notif');
            },
            error: function (err) {
                console.log('error');
            }
        })
    })
    // button baca semua notif
    const dibaca = $('#readall-notif').data('dibaca');

    if (dibaca) {
        $('#readall-notif').show();
    } else {
        $('#readall-notif').hide();
    }

    $('#readall-notif').click(function () {
        $.ajax({
            method: 'post',
            url: "/read-all-notif",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (res) {

                $('.new-notif').hide();
                $('.notif').removeClass('bg-white').addClass('bg-gray-50');
                $('#readall-notif').hide('slow');
                $('#count-notif').load(location.href + ' #count-notif');
            },
            error: function (err) {
                console.log('error');
            }
        })
    });
});
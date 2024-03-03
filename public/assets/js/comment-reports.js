$(document).ready(function(){
    loadMore(page);
});

var page = 1;


$(window).scroll(function () {
    if ($(window).scrollTop() + $(window).height() >= ($(document).height() -1)) {
        page++;
        loadMore(page);
    }
});

function loadMore(page) {
    const postId = document.getElementById("post_id").value;
    $.ajax({
        url: "/comen-read/" + postId + "?page=" + page,
        type: 'get',
        dataType: 'html',
        beforeSend: function () {
            $('.loading')
        },
        success: function (data) {
            if (data.length == 0) {
                $('.loading').html("tidak ada komen lainnya");
                return;
            }
            $('.loading').hide();
            $("#comen").append(data);
        }
    })
}

function read() {
    const postId = document.getElementById("post_id").value;
    $.get(`/comen-read/${postId}`, {}, function (data) {
        $("#comen").html(data);
    });
}


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


function removeValidasiClass(form) {
    $(form).each(function () {
        $(form).find(':input').removeClass('border-green-600 border-red-600');

        $(form).find('.text-red-600, .text-green-600').text('');
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



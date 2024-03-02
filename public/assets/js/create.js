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
function showErrorFile(message) {
    if(message){
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
            icon: 'error',
            title: message,
        });
    }
}
function showMessage(link, message) {
    Swal.fire({
        title: message,
        text: 'Lihat detail??',
        icon: "success",
        showCancelButton: true,
        confirmButtonText: 'OK',
        cancelButtonText: 'Batal',
        allowOutsideClick: false,
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = link;
        }
    });
}

function removeValidasiClass(form) {
    $(form).each(function() {
        $(form).find(':input').removeClass('border-green-600 border-red-600');

        $(form).find('.text-red-600, .text-green-600').text('');
    });
}

$(document).ready(function() {

    $("#file").change(function() {
        if (this.files && this.files[0]) {
            let reader = new FileReader();

            reader.onload = (e) => {
                $("#previewImage").attr('src', e.target.result);
                $("#previewImage").show();
            }
            reader.readAsDataURL(this.files[0]);
        } else {
            // Kembalikan gambar ke default di sini
            $("#previewImage").hide();
        }
    });

    $("#createForm").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: false,
            processData: false,
        })
        $.ajax({
            url: "/post-image",
            type: "post",
            data: formData,
            // dataType: 'json',
            success: function(res) {
                if (res.status == 400) {
                    showErrorFile(res.errors.file);
                    showError('judul', res.errors.judul);
                    showError('deskripsi-id', res.errors.deskripsi);
                    showError('tag', res.errors.tag);
                    setTimeout(function() {
                        $("#file-error, #judul-error, #deskripsi-id-error, #tag-error")
                            .empty();
                    }, 3000);
                } else if (res.status == 200) {
                    var link = '/detail/' + res.postId;
                    showMessage(link, res.messages)
                    $("#createForm")[0].reset();
                    removeValidasiClass("#createForm");
                }
            },
            error: function(err) {
                console.error(err);
            }
        });
    });
});

function showMessageAlbum(type, message) {
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
        icon: type,
        title: message,
    });
}

function removeValidasiClass(form) {
    $(form).each(function() {
        $(form).find(':input').removeClass('border-green-600 border-red-600');

        $(form).find('.text-red-600, .text-green-600').text('');
    });
}

function showErrorAlbum(field, message) {
    const errorElement = $("#" + field + "-errors");
    if (!message) {
        $("#" + field).addClass("border-green-600").removeClass("border-red-600");
        errorElement.text("");
    } else {
        $("#" + field).addClass("border-red-600").removeClass("border-green-600");
        errorElement.text(message);
    }
}
$(document).ready(function() {

    $("#wallpaper").change(function() {
        if (this.files && this.files[0]) {
            let reader = new FileReader();
            reader.onload = (e) => {
                $("#previewWallpaper").attr('src', e.target.result);
                $("#previewWallpaper").show();
            }
            reader.readAsDataURL(this.files[0]);
        } else {
            // Kembalikan gambar ke default di sini
            $("#previewWallpaper").hide();
        }
    });

    $('#albumForm').submit(function(e) {
        e.preventDefault();
        var dataForm = new FormData(this);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: false,
            processData: false,
        });

        $.ajax({
            url: "/post-album",
            type: "post",
            data: dataForm,
            success: function(res) {
                if (res.status == 400) {
                    showErrorAlbum('nama', res.errors.nama);
                    showErrorAlbum('deskripsi', res.errors.deskripsi);
                    showErrorAlbum('wallpaper', res.errors.wallpaper);
                    setTimeout(function() {
                        $("#nama-errors, #deskripsi-errors, #wallpaper-errors")
                            .empty();
                    }, 3000);
                } else if (res.status == 200) {
                    showMessageAlbum('success', res.messages)
                    $("#albumForm")[0].reset();
                    removeValidasiClass("#albumForm");
                    $("#close-modal").click();
                    $('.album').load(location.href + ' .album')
                }
            },

        })
    })

});
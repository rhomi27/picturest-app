// search album
$(document).ready(function () {
    read();
    $('#search-nav').on('keyup', function (e) {
        e.preventDefault();
        let search_string = $("#search-nav").val();
        $.ajax({
            url: "/search-album",
            method: "get",
            data: {
                search_string: search_string
            },
            beforeSend: function () {
                $('.loader').show();
            },
            success: function (res) {
                $('#album').html(res);
                $('.loader').html("tidak ada data lainnya");
                if (res.status == 400) {
                    $('.loader').html(res.pesan);
                }
            }

        })
    });
})

function read() {
    $.get("/read-album", {}, function (data) {
        $("#album").html(data);
    });
}

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
    $(form).each(function () {
        $(form).find(':input').removeClass('border-green-600 border-red-600');
        $(form).find('.text-red-600, .text-green-600').text('');
    });
}

function errUpdate(field, message) {
    const errorElement = $("#" + field + "-error");
    if (!message) {
        $("#" + field).addClass("border-green-600").removeClass("border-red-600");
        errorElement.text("");
    } else {
        $("#" + field).addClass("border-red-600").removeClass("border-green-600");
        errorElement.text(message);
    }
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
$(document).ready(function () {
    $('#close-modal').on('click', function () {
        $('#update-modal').hide('slow');
    });

    // delete album
    $('#album').on('click', '.delete', function () {
        const id = $(this).data('id');
        const nama = $(this).data('nama')
        const urlDel = `/delete-album/${id}`
        Swal.fire({
            title: "Apa kamu yakinn?",
            text: `hapus album dengan nama ${nama}`,
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Ya, hapus ini!"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: urlDel,
                    type: 'get',
                    success: function (res) {
                        $(`#idalbum-${id}`).animate({
                            opacity: 0,
                            marginBottom: "-100px"
                        }, 500, function () {
                            $(this).hide('slow');
                        });
                    },
                    error: function (err) {
                        console.log('error')
                    }
                })
            }
        });
    });

    // show update album
    $('#album').on('click', '.open-modal', function () {
        var id = $(this).data('id');
        $.ajax({
            url: '/edit-album/' + id,
            type: 'get',
            success: function (res) {
                $('#update-modal').show('slow');
                $('#id').val(res.id);
                $('#nama').val(res.nama);
                $('#deskripsi').val(res.deskripsi);
                $('#preview').attr('src', res.wallpaper)
            }
        })
        $('#wallpaperupdate').change(function () {
            var file = $(this)[0].files[0];
            var imageURL = URL.createObjectURL(file);
            $('#preview').attr('src', imageURL);

        });
    });

    // update album
    $('#updateForm').submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        var id = $('#id').val();
        const urlUpdate = `/update-album/${id}`
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: false,
            processData: false,
        });
        $.ajax({
            url: urlUpdate,
            type: 'post',
            data: formData,
            success: function (res) {
                if (res.status == 400) {
                    errUpdate('nama', res.errors.nama)
                    errUpdate('deskripsi', res.errors.deskripsi)
                    errUpdate('wallpaper', res.errors.wallpaper)
                } else if (res.status == 404) {
                    showMessageAlbum('errorr', res.message)
                } else if (res.status == 200) {
                    $('#update-modal').hide('slow'),
                        read()
                    removeValidasiClass('#updateForm')
                    showMessageAlbum('success', res.message)
                }
            }
        })
    });

    // create album
    $('#wallpaper-id').change(function () {
        var file = $(this)[0].files[0];
        var imageURL = URL.createObjectURL(file);
        $('#previewWallpaper').attr('src', imageURL);
        $('#previewWallpaper').show()
    });

    $('#albumForm').submit(function (e) {
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
            success: function (res) {
                
                if (res.status == 400) {
                    showErrorAlbum('nama', res.errors.nama);
                    showErrorAlbum('deskripsi', res.errors.deskripsi);
                    showErrorAlbum('wallpaper-id', res.errors.wallpaper);
                    setTimeout(function () {
                        $("#nama-errors, #deskripsi-errors, #wallpaper-id-errors")
                            .empty();
                    }, 3000);
                } else if (res.status == 200) {
                    showMessageAlbum('success', res.messages)
                    $("#albumForm")[0].reset();
                    removeValidasiClass("#albumForm");
                    $("#close-drawer").click();
                    read();
                }
            },

        })
    })

});
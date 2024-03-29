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

function showMessage(type,message) {
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

$(document).ready(function() {

    $("#pictures").change(function() {
        if (this.files && this.files[0]) {
            let reader = new FileReader();

            reader.onload = (e) => {
                $("#previewImage").attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        } else {
            // Kembalikan gambar ke default di sini
            $("#previewImage").attr('src', 'pictures/{{ $user->pictures }}');
        }
    });

    $("#formEdit").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        var baseUrl = "profil-edit";
        $.ajax({
            url: baseUrl,
            method: "POST",
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: false,
            processData: false,
            success: function(res) {
                if (res.status === 400) {
                    showError('pictures', res.errors.pictures)
                    showError('username', res.errors.username)
                    showError('nama_lengkap', res.errors.nama_lengkap)
                    showError('bio', res.errors.bio)
                    setTimeout(function() {
                        $("#pictures-error, #username-error, #nama_lengkap-error, #bio-error")
                            .empty();
                    }, 3000);
                } else if (res.status === 200) {
                    removeValidasiClass('#formEdit')
                    showMessage('success',res.message)
                }
            },
            error: function(err) {
                console.error(err);
            }
        });
    });

});

$('#delete-pp').click(function() {
    Swal.fire({
        title: "Apa kamu yakinn?",
        text: "akan menghapus foto profilmu",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "batal"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "/hapus-profil",
                type: 'get',
                success: function(res) {
                    $('#previewImage').attr('src','pictures/user.jpg')
                },
                error: function(err) {
                    console.log('error')
                }
            })
        }
    });
})
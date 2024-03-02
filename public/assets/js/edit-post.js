function showMessage(type, message) {
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
$(document).ready(function() {

    $('#updateForm').submit(function(e) {
        e.preventDefault();
        var dataForm = new FormData(this);
        const id = document.getElementById('id').value;
        const updateUrl = `/update/${id}`
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: false,
            processData: false,
        });

        $.ajax({
            url: updateUrl,
            type: "post",
            data: dataForm,
            success: function(res) {
                if (res.status == 400) {
                    showError('judul', res.errors.judul);
                    showError('deskripsi', res.errors.deskripsi);
                    showError('tag', res.errors.tag)
                    setTimeout(function() {
                        $("#judul-error, #deskripsi-error, #tag-error")
                            .empty();
                    }, 3000);
                } else if(res.status == 200){
                    showMessage('success', res.message);
                }

            },
            error: function(err) {
                console.log(err)
            }

        })
    })

});
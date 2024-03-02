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

function resetForm(fieldName) {
    var form = $('#update-acount')[0];
    var savedValue = form[fieldName].value;
    form.reset();
    form[fieldName].value = savedValue;
}

$('#selectAll').change(function() {
    var checkboxes = $('.checkboxId');
    checkboxes.each(function() {
        $(this).prop('checked', $('#selectAll').prop('checked'));
    });
});

$('#deleteSelected').click(function() {
    var selectIds = [];
    var checkboxes = $('.checkboxId:checked');
    checkboxes.each(function() {
        selectIds.push($(this).val());
    })
    if (selectIds.length > 0) {
        $.ajax({
            url: "/delete-history",
            type: 'post',
            data: {
                ids: selectIds
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(res) {
                $(`#data-${selectIds.join(', #data-')}`).animate({
                    opacity: 0,
                    left: 0,
                }, 500, function() {
                    $(this).hide('slow');
                });
            },
            error: function(err) {
                console.log(err);
            }
        })
    } else {
        showMessage('info', 'pilih setidaknya satu data')
    }
})

$(document).ready(function() {
    $('#update-acount').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            contentType: false,
            processData: false,
        });

        $.ajax({
            url: "/update-acount",
            type: 'post',
            data: formData,
            success: function(res) {
                if (res.status == 400) {
                    showError('old_password', res.errors.old_password);
                    showError('new_password', res.errors.new_password);
                    showError('confirm_password', res.errors.confirm_password);
                    showError('email', res.errors.email);
                    setTimeout(function() {
                        $("#email-error, #old_password-error, #new_password-error, #confirm_password-error")
                            .empty();
                    }, 3000);
                } else if (res.status == 422) {
                    showError('old_password', res.errors.old_password);
                    showMessage('error', res.message);
                    setTimeout(function() {
                        $('#old_password-error')
                    }, 3000);
                } else if (res.status == 200) {
                    showMessage('success', res.message)
                    resetForm('email');
                }
            }
        })
    })
});
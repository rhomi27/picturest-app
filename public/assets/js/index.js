$(document).ready(function () {

    $("#showpw").click(function () {
        var passwordInput = $("#id-password");
        var toggleButton = $("#show");
        if (passwordInput.attr("type") === "password") {
            passwordInput.attr("type", "text");
            toggleButton.hide(); // Sembunyikan tombol "show password"
            $("#hide").show(); // Tampilkan tombol "hide password"
        } else {
            passwordInput.attr("type", "password");
            toggleButton.show(); // Tampilkan tombol "show password"
            $("#hide").hide(); // Sembunyikan tombol "hide password"
        }
    });
});

function showError(field, message) {
    const errorElement = $("#" + field + "-errors");
    if (!message) {
        $("#" + field).addClass("border-green-600").removeClass("border-red-600");
        errorElement.text("");
    } else {
        $("#" + field).addClass("border-red-600").removeClass("border-green-600");
        errorElement.text(message);
        // $(errorElement).append(message);
    }
}

function removeValidasiClass(form) {
    $(form).each(function () {
        $(form).find(':input').removeClass('border-green-600 border-red-600');

        $(form).find('.text-red-600, .text-green-600').text('');
    });
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


$(document).ready(function () {
    $("#daftarForm").submit(function (e) {
        e.preventDefault();
        $.ajax({
            url: "/daftar",
            type: "post",
            data: $(this).serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function (res) {
                if (res.status === 400 && res.hasOwnProperty('errors')) {
                    showError('username', res.errors.username);
                    showError('email', res.errors.email);
                    showError('password', res.errors.password);
                    setTimeout(function () {
                        $("#username-errors, #email-errors, #password-errors")
                            .empty();
                    }, 3000);
                } else if (res.status == 200) {
                    showMessage('success', res.messages);
                    $("#daftarForm")[0].reset();
                    removeValidasiClass("#daftarForm");
                    $('#loginTab').click();
                }
            },
            error: function (err) {
                console.error(err);
            }
        });
    });

});

function showErrorLogin(field, message) {
    const errorElement = $("#" + field + "-error");
    if (!message) {
        $("#id-" + field).addClass("border-green-600").removeClass("border-red-600");
        errorElement.text("");
    } else {
        $("#id-" + field).addClass("border-red-600").removeClass("border-green-600");
        errorElement.text(message);
        // $(errorElement).append(message);
    }
}
$(document).ready(function () {
    $("#loginForm").submit(function (e) {
        e.preventDefault();
        var timeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
        // Tambahkan zona waktu ke data yang akan dikirimkan ke server
        var formData = $(this).serializeArray();
        formData.push({
            name: "timeZone",
            value: timeZone
        });

        $.ajax({
            url: "/login",
            type: 'post',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function (res) {
                console.log(res)
                if (res.status === 400 && res.hasOwnProperty('errors')) {
                    showErrorLogin('email', res.errors.email);
                    showErrorLogin('password', res.errors.password);
                    setTimeout(function () {
                        $("#email-error, #password-error")
                            .empty();
                    }, 3000);
                } else if (res.status == 500) {
                    showMessage('info', res.info);
                    $("#loginForm")[0].reset();
                } else if (res.status == 400 && res.hasOwnProperty('msg')) {
                    showMessage('error', res.msg);
                } else if (res.status == 200 && res.hasOwnProperty('redirect')) {
                    $("#loginForm")[0].reset();
                    removeValidasiClass("#loginForm");
                    showMessage('success', res.messages)
                    window.location.href = res.redirect;
                }
            },
        })
    });
})
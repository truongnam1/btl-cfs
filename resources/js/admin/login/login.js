$(document).ready(function() {
    // $('#input-submit').click(clickSubmit)

    $('#input-username').keypress(function(ev) {
        var keycode = (ev.keyCode ? ev.keyCode : ev.which);
        if (keycode == '13') {
            toggleSignIn();
        }
    });;
    $('#input-password').keypress(function(ev) {
        var keycode = (ev.keyCode ? ev.keyCode : ev.which);
        if (keycode == '13') {
            toggleSignIn();
        }
    });


});

function clickSubmit() {
    var username = $('#input-username').val();
    var password = $('#input-password').val();
    console.log(`username`, username);
    console.log(`password`, password);

    var data = {
            'username': username,
            'password': password
        }
        // postLogin(data);
}

function validateFormInput(data) {
    if (!validateEmail(data.email)) {
        toastr.error('Email không hợp lệ');
        return false;
    }
    if (data.password.length == 0) {
        toastr.error('Mật khẩu không được để trống');

        return false;
    }
    return true;
}

function validateEmail(email) {
    const re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}



function postLogin(data) {
    var input = `<input type="text" name="token" value="${data.token}" style="
    display: none;">`;
    $('#form-token-login').append(input);

    $('#form-token-login').submit();
    console.log(`token`, data);
}
$(document).ready(function() {
    firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
            console.log('overview');
            // toastr.success('đăng nhập thành công bên overview');
            intProfile();
            $('#update-profile [name=btn-submit-password]').on('click', updatePassword);
        } else {
            // User is signed out.

        }
    });

    $('#update-profile [name=btn-submit-fullname]').on('click', changeName);

})


function intProfile() {
    const user = firebase.auth().currentUser;
    $('.profile-img img[name=image-user]').attr('src', user.photoURL);
    $('#fullname-user-header').text(user.displayName);

    $('#home [name=fullname]').text(user.displayName);
    $('#home [name=email]').text(user.email);

    $('#update-profile [name=fullname]').attr('value', user.displayName)
    getRoleName();
}

function updatePassword() {
    // const user = firebase.auth().currentUser;
    var current_password = $('#update-profile [name=current_password]').val();
    var new_password = $('#update-profile [name=new_password]').val();

    var repeat_new_password = $('#update-profile [name=repeat_new_password]').val();
    var dataPassword = {
        'current_password': current_password,
        'new_password': new_password,
        'repeat_new_password': repeat_new_password,
    };

    if (validatePassword(dataPassword)) {
        reauthenticate(current_password).then(function() {
            const user = firebase.auth().currentUser;

            user.updatePassword(new_password).then(() => {
                // Update successful.
                console.log('update mật khẩu thành công');
                toastr.success('Đổi mật mật khẩu thành công')
            }).catch((error) => {
                toastr.error('Lỗi không xác định đổi mật khẩu');

            });

        }).catch(function(error) {
            console.log('error', error);
            var errorCode = error.code;
            if (errorCode == 'auth/wrong-password') {
                toastr.error('Mật khẩu hiện không chính xác');
            } else {
                toastr.error('Lỗi không xác định auth');

            }
        })

    }
}

function reauthenticate(current_password) {
    const user = firebase.auth().currentUser;
    var credential = firebase.auth.EmailAuthProvider.credential(user.email, current_password);
    return user.reauthenticateWithCredential(credential);
}

function validatePassword(data) {
    if (!data.current_password) {
        toastr.error('Mật khẩu hiện tại không được để trống');
        return false;
    }
    if (data.current_password.length < 6) {
        toastr.error('Mật khẩu hiện tại phải dài hơn 6 ký tự');
        return false;

    } else if (!data.current_password) {
        toastr.error('Mật khẩu mới không được để trống');
        return false;

    } else if (data.new_password.length < 6) {
        toastr.error('Mật khẩu mới phải dài hơn 6 ký tự');
        return false;

    } else if (!data.repeat_new_password) {
        toastr.error('Nhập lại mật khẩu không được để trống');
        return false;

    } else if (data.new_password != data.repeat_new_password) {
        toastr.error('mật khẩu mới và nhập lại mật khẩu không trùng khớp');
        return false;
    }

    return true;
}

function validateName(name) {
    if (!name) {
        toastr.error('Tên không được để trống');
        return false;
    } else if (name.length > 50) {
        toastr.error('Tên không được dài hơn 50 ký tự');
        return false;
    } else {

    }

    return true;
}

function getRoleName() {
    console.log('get role profile');
    $.ajax({
        url: route('api-profile-role'),
        method: "GET",
        success: function(result) {
            if (result.status) {
                html = '';
                for (const role of result.data) {
                    html += `<span class="badge badge-secondary mr-1">${role.desc}</span>`;
                }
                $('#home [name=roles]').html(html);
            }

        }
    });
}

function changeName() {
    var fullname = $('#update-profile [name=fullname]').val();
    if (validateName(fullname)) {
        const user = firebase.auth().currentUser;

        user.updateProfile({
            displayName: fullname,
        }).then(() => {
            toastr.success('Cập nhật tên thành công');
            intProfile();
            inIGeneral();
        }).catch((error) => {
            toastr.error('Lỗicaapj nhật tên');
            console.log(error);
        });
    }
}
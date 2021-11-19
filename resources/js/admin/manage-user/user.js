// submit form tạo tài khoản
var dataRowCurrent = null;
var dataRoles = null;
$(document).ready(function() {

    firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
            // $('#dataTable tbody').on('click', 'td span', function() {
            //     var rowCurr = $(this).parent();
            //     var idModal = $(this).attr('data-target').replace('#', '');
            //     var rowIdx = table.cell(rowCurr).index().row;
            //     console.log(this);
            //     var dataRow = table.row(rowIdx).data()
            //     console.log(dataRow);
            // });
            getDataRoles();


        }

    });

    $('#dataTable tbody').on('click', 'tr', function() {
        dataRowCurrent = table.row(this).data();
        console.log(dataRowCurrent);
    });

    // xac nhan xoa user
    $('#modal-delete-user [name=btn-submit]').on('click', function() {
        console.log('xoa user');
        deleteUser(dataRowCurrent.id);
    });

    $('#dataTable tbody').on('click', 'tr .action-menu .action-item', function() {
        console.log(this);
        var className = $(this).attr('class');
        console.log(className);

        if (className.search('action-lock-user') >= 0) {
            if (dataRowCurrent.statusAcc) {
                disableUser(dataRowCurrent.id);
            } else {
                activeUser(dataRowCurrent.id);
            }
        } else if (className.search('action-delete-user') >= 0) {

        } else if (className.search('action-update-password-user') >= 0) {

        }
    });

    $('#dataTable tbody').on('click', 'tr .action-main', function() {
        console.log(this);
        var className = $(this).attr('class');
        // console.log(className);

        if (className.search('icon-edit-user') >= 0) {
            openEditModal();
        }
    });

    $('#modal-edit-info [name=btn-submit]').on('click', function() {
        var fullname = $('#modal-edit-info [name=fullname]').val();
        var statusAcc = $('#modal-edit-info [name=active-acc]').is(":checked");
        var roles = $('#modal-edit-info [name=roles]').val();
        var data = {
            'fullname': fullname,
            'statusAcc': statusAcc,
            'roles': roles
        };

        console.log(data);
        updateProfileUser(data);
    });

    $('#modal-change-password [name=btn-submit]').on('click', function() {
        console.log('send email');
        sendEmailResetPassword();
    })

});

$('#btn-create-user').click(function(e) {

    var fullname = $('#modal-create-user input[name=fullname]').val();
    var email = $('#modal-create-user input[name=email]').val();
    var phoneNumber = $('#modal-create-user input[name=phone-number]').val();
    var role = $('#modal-create-user select[name=role]').val();
    var activeAccount = $('#modal-create-user input[name=active-acc]').is(':checked');

    var dataCreateAcc = {
        fullname: fullname,
        email: email,
        phoneNumber: phoneNumber,
        role: role,
        activeAccount: activeAccount
    }
    $.ajax({
        url: route('api-register-user'),
        type: 'POST',
        dataType: 'json',
        data: dataCreateAcc,

        beforeSend: function(xhr) {
            toastr.info('Đã gửi yêu cầu tạo tài khoản');
        },
        success: function(result) {
            console.log(result);
            console.log(result.status);

            if (result.status) {
                toastr.success('Đăng kí tài khoản thành công')
                table.draw();
            } else {
                toastr.error(result.error)
            }
        },

        error: function(jqXhr, textStatus, errorMessage) { // error callback 
            toastr.success('Lỗi server')
        }
    });




    console.log(dataCreateAcc);
})

function openEditModal() {
    var htmlRoleSelect = '';

    $('#modal-edit-info [name=image-user]').prop('src', dataRowCurrent.user.photoUrl);
    $('#modal-edit-info [name=fullname]').val(dataRowCurrent.user.name);
    $('#modal-edit-info [name=active-acc]').prop('checked', dataRowCurrent.statusAcc);

    for (const role of dataRoles) {
        htmlRoleSelect += `<option value="${role.id}">${role.desc}</option>`;
    }
    $('#modal-edit-info [name=roles]').html(htmlRoleSelect);

    for (const role of dataRowCurrent.roles) {
        if (Object.keys($(`#modal-edit-info option[value=${role.id}]`)).length > 0) {
            $(`#modal-edit-info option[value=${role.id}]`).prop('selected', true);
        }
    }

}


function deleteUser(idUser) {
    $.ajax({
        url: route('api-delete-user', { idUser: idUser }),
        type: 'GET',

        success: function(result) {
            console.log(result);

            if (result.status) {
                toastr.success('Xoá người dùng thành công');
                table.draw();

            } else {
                toastr.error(result.error)
            }
        },

        error: function(jqXhr, textStatus, errorMessage) { // error callback 
            toastr.error('Lỗi server')
        }
    });
}

function changePasswordUser(idUser) {

}

function activeUser(idUser) {
    $.ajax({
        url: route('api-active-user', { idUser: idUser }),
        type: 'GET',

        success: function(result) {
            console.log(result);
            console.log(result.status);

            if (result.status) {
                toastr.success('Kích hoạt thành công');
                var row = $(`#${idUser}`);
                table.row(row).data(result.data);

            } else {
                toastr.error(result.error)
            }
        },

        error: function(jqXhr, textStatus, errorMessage) { // error callback 
            toastr.error('Lỗi server')
        }
    });
}

function disableUser(idUser) {

    $.ajax({
        url: route('api-disable-user', { idUser: idUser }),
        type: 'GET',

        success: function(result) {
            console.log(result);
            console.log(result.status);

            if (result.status) {
                toastr.success('Khoá tài khoản thành công');
                var row = $(`#${idUser}`);
                table.row(row).data(result.data);

            } else {
                toastr.error(result.error)
            }
        },

        error: function(jqXhr, textStatus, errorMessage) { // error callback 
            toastr.error('Lỗi server')
        }
    });
}
// 
function getDataRoles() {
    $.ajax({
        // url: `${urlApi}/admin/manage-user/register`,
        url: route('api-get-roles'),
        type: 'GET',

        success: function(result) {
            console.log(result);
            console.log(result.status);

            if (result.status) {
                toastr.success('Lấy role thành công')
                setRole2ModalCreateUser(result.data);
                dataRoles = result.data;
            } else {
                toastr.error(result.error)
            }
        },

        error: function(jqXhr, textStatus, errorMessage) { // error callback 
            toastr.success('Lỗi server')
        }
    });
}

function getUserTable(idUser) {
    $.ajax({
        url: route('api-get-user-table', { idUser: idUser }),
        type: 'GET',

        success: function(result) {
            console.log(result);
            // console.log(result.status);

            if (result.status) {
                // toastr.success('Lấy data user thành công');
                var row = $(`#${idUser}`)
                table.row(row).data(result.data);

            } else {
                toastr.error(result.error)
            }
        },

        error: function(jqXhr, textStatus, errorMessage) { // error callback 
            toastr.error('Lỗi server')
        }
    });
}

function updateProfileUser(data) {
    toastr.info('Đang cập nhật dữ liệu');
    $.ajax({
        url: route('api-update-profile-user', { idUser: dataRowCurrent.id }),
        type: 'POST',
        data: data,
        success: function(result) {
            console.log(result);
            // console.log(result.status);

            if (result.status) {
                // toastr.success('Lấy data user thành công');
                console.log(result);
                toastr.success('Cập nhật thành công');

                var row = $(`#${dataRowCurrent.id}`)
                table.row(row).data(result.data);

            } else {
                toastr.error(result.error)
            }
        },

        error: function(jqXhr, textStatus, errorMessage) { // error callback 
            toastr.error('Lỗi server')
        }
    });
}

function sendEmailResetPassword() {
    toastr.info('Đang gửi email reset mật khẩu');
    $.ajax({
        url: route('api-admin-reset-password', { idUser: dataRowCurrent.id }),
        type: 'GET',
        success: function(result) {
            console.log(result);
            // console.log(result.status);

            if (result.status) {
                toastr.success('Đã gửi email reset mật khẩu');
                console.log(result);

            } else {
                toastr.error(result.error)
            }
        },

        error: function(jqXhr, textStatus, errorMessage) { // error callback 
            toastr.error('Lỗi server')
        }
    });
}

function setRole2ModalCreateUser(dataRole) {
    var selectRoleEle = $('#modal-create-user select[name=role]');
    var html = '';
    for (const role of dataRole) {
        html += `<option value="${role.id}">${role.desc}</option>`;
    }

    selectRoleEle.html(html);

}
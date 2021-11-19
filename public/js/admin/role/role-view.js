$(document).ready(function() {
    var roleName = $('#form-1').attr('role-name');
    firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
            getdataRole(roleName);
        }
    });

    $('#btn-save-permissions').click(function(params) {
        var form = $('#form-1')[0].elements;
        // var roleName = $('#form-1').attr('role-name');

        var roleDesc = $('#role-desc input').val();

        var data = {};

        data['role-desc'] = roleDesc;
        var arrCheckbox = [];

        for (const input of form) {
            var temp = {
                'id': $(input).attr('permission-id'),
                'checked': input.checked
            }
            arrCheckbox.push(temp);
        }
        data['permissions'] = arrCheckbox;
        console.log(data);
        updatePermission2Role(data, roleName)
    })



});

function updatePermission2Role(data, roleName) {
    $.ajax({
        url: `${urlApi}/admin/role/${roleName}`,
        method: "POST",
        data: data,
        success: function(result) {
            console.log(result);
            updateCheckBox(result.data.permissions);
            toastr.success('Cập nhật quyền thành công')
        }
    });

    toastr.info('Đang cập nhật quyền')
}

function getdataRole(roleName) {
    $.ajax({
        url: route('api-get-role', { nameRole: roleName }),
        method: "GET",
        success: function(result) {
            console.log(result);
            updateCheckBox(result.data.permissions);
            console.log('lay data role thanh cong');
            toastr.success('khởi tạo quyền thành công')

        }
    });
}

function updateCheckBox(dataPermission) {
    console.log('cap nhat lai check box');
    var form = $('#form-1')[0].elements;
    for (const input of form) {
        $(input).prop('checked', false);
    }

    for (const item of dataPermission) {
        var input = $(`.table input[permission-id=${item.id}]`);
        $(input).prop('checked', true);
    }
}
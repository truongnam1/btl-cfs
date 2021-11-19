$(document).ready(function() {

    $("#modal-edit-permission [name='btn-submit-permission']").on('click', getDataEditPermission);

    firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
            intAppPermission();
        }
    });

});

function intAppPermission() {
    $('#dataTable tbody').on('click', 'td span', function() {
        var rowCurr = $(this).parent();
        var idModal = $(this).attr('data-target').replace('#', '');

        var rowIdx = table.cell(rowCurr).index().row;
        console.log(this);
        var dataRow = table.row(rowIdx).data()
        console.log(dataRow);

        setDataModalOpen(idModal, dataRow);
    });
}

function getDataEditPermission() {
    var descPermission = $("#modal-edit-permission [name=desc-permission]").val();
    var permissionId = $('#modal-edit-permission .form-data').attr('permission-id');

    var data = {
        'desc-permission': descPermission,
    };
    postEditPermission(data, permissionId);
}


function setDataModalOpen(idModal, dataRow) {
    switch (idModal) {
        case 'modal-edit-permission':
            openModalEdit(dataRow);
            break;
        default:
            break;
    }
}

function openModalEdit(dataRow) {
    $('#modal-edit-permission [name=desc-permission]').val(dataRow.desc);
    $('#modal-edit-permission .form-data').attr('permission-id', dataRow.idPermission);
    console.log('open modal edit');
}

function postEditPermission(data, permissionId) {
    toastr.info('Đang cập nhật dữ liệu');

    $.ajax({
        url: route('api-update-permission', { idPermission: permissionId }),
        method: "GET",
        data: data,
        success: function(result) {

            console.log('edit permission thanh cong');
            console.log(result);
            if (result.status) {
                toastr.success('Cập nhật thành công');


                var row = $(`tr#${permissionId}`);
                console.log(row);
                table.row(row).data(result.data);
            } else {
                toastr.error(result.error);
            }
            // table.draw();
        }
    });

    console.log('post permission');
}
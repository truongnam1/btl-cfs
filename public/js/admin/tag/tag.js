$(document).ready(function() {

    firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
            iniAppTag();
        }
    });


});

function iniAppTag() {
    // val table ở bên datatable
    $("#modal-create-tag [name='btn-submit-tag']").on('click', getDataCreateTag);
    $("#modal-edit-tag [name='btn-submit-tag']").on('click', getDataEditTag);
    $("#modal-delete-tag [name='btn-submit-tag']").on('click', getDataDeleteTag);

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

function getDataCreateTag() {
    var nameTag = $("#modal-create-tag [name=name-tag]").val();
    var descTag = $("#modal-create-tag [name=desc-tag]").val();
    console.log(nameTag);
    console.log(descTag);
    var data = {
        'name-tag': nameTag,
        'desc-tag': descTag
    };
    postCreateTag(data);
}

function getDataEditTag() {
    var nameTag = $("#modal-edit-tag [name=name-tag]").val();
    var descTag = $("#modal-edit-tag [name=desc-tag]").val();
    var tagId = $('#modal-edit-tag .form-data').attr('tag-id');

    var data = {
        'name-tag': nameTag,
        'desc-tag': descTag,
    };
    postEditTag(data, tagId);
}

function getDataDeleteTag() {
    var tagId = $('#modal-delete-tag .content-warning').attr('tag-id');
    if (tagId != '') {
        postDeleteTag(tagId);
    }
}

function setDataModalOpen(idModal, dataRow) {
    switch (idModal) {
        case 'modal-view-tag':
            openModalView(dataRow);
            break;
        case 'modal-edit-tag':
            openModalEdit(dataRow);
            break;
        case 'modal-delete-tag':
            openModalDelete(dataRow);
            break;

        default:
            break;
    }
}

function openModalView(dataRow) {
    $('#modal-view-tag p[data-text=name-tag]').text(dataRow.tag_name);
    $('#modal-view-tag p[data-text=desc-tag]').text(dataRow.desc);
    console.log('open modal view');
}

function openModalEdit(dataRow) {
    $('#modal-edit-tag [name=name-tag]').val(dataRow.tag_name);
    $('#modal-edit-tag [name=desc-tag]').val(dataRow.desc);
    $('#modal-edit-tag .form-data').attr('tag-id', dataRow.tagId);
    console.log('open modal edit');
}

function openModalDelete(dataRow) {
    $('#modal-delete-tag p.content-warning').attr('tag-id', dataRow.tagId);
    console.log('open modal delete');
}

function postCreateTag(data) {
    $.ajax({
        url: route('api-admin-store-tag'),
        method: "POST",
        data: data,

        success: function(result) {
            console.log('tao tag thanh cong');
            console.log(result);
            table.draw();
        }
    });
}

function postEditTag(data, tagId) {
    $.ajax({
        url: route('api-admin-update-tag', { idTag: tagId }),
        method: "POST",
        data: data,
        success: function(result) {
            console.log('edit tag thanh cong');
            console.log(result);
            table.draw();
        }
    });
}

function postDeleteTag(idTag) {
    $.ajax({
        url: route('api-admin-delete-tag', { tagId: idTag }),
        method: "DELETE",

        success: function(result) {
            console.log('xoa tag thanh cong');
            console.log(result);
            table.draw();
        }
    });
}
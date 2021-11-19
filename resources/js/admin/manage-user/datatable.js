// submit form tạo tài khoản
// var urlApi = `http://web-app-cfs.test/api`;
var table = '';

$(document).ready(function() {
    firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
            table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                rowId: 'id',
                ajax: {
                    url: route('api-get-users-table'),
                    dataType: 'json',
                    type: 'GET',
                },
                "columns": [
                    { "data": 'id', },
                    {
                        "data": 'user',

                        render: function(data, type, row, meta) {
                            // console.log(data);
                            return `
                       
                        <div class ="d-flex align-items-center">
                                    <!--begin:: Avatar -->
                                    <div class="mr-1" style="width : 50px">
                                        <a href="#">
                                            <div class="symbol-label">
                                                <img src="${data.photoUrl}"
                                                    alt="Emma Smith" class="w-100">
                                            </div>
                                        </a>
                                    </div>
                                    <!--end::Avatar-->
        
                                    <!--begin::User details-->
                                    <div class="d-flex flex-column">
                                        <a href="${data.urlProfile}" class="text-gray-800 text-hover-primary mb-1">${data.name}</a>
                        
                                    </div>
                                    <!--begin::User details-->
                        </div>
                          
                        `;
                        }
                    },
                    {
                        "data": 'roles',

                        render: function(roles) {
                            var html = '';
                            for (const role of roles) {
                                html += `<span class="badge badge-pill badge-secondary mr-1">${role.desc}</span>`;
                            }
                            return html;
                        }
                    },
                    { "data": 'registerAt', },
                    {
                        "data": 'statusAcc',
                        render: function(active) {
                            if (active) {
                                return `<span class="badge badge-success">Đã kích hoạt</span>`;
                            } else {
                                return `<span class="badge badge-warning">Chưa kích hoạt</span>`;
                            }
                        }

                    },
                    {
                        "data": 'action',

                        render: function(data, type, row, meta) {
                            var textStatusAcc = '';
                            if (row.statusAcc) {
                                textStatusAcc = 'Khoá tài khoản';
                            } else {
                                textStatusAcc = 'Kích hoạt tài khoản';
                            }
                            return `
                            <div class="d-flex">
                                    <a href="${data.urlProfile}">
                                        <span data-toggle="modal" data-target="#modal-view-user" class="action-main mr-1">
                                            <i class="fas fa-eye" style="color: #858796;"></i>
                                        </span>
                                    </a>
                                    <span data-toggle="modal" data-target="#modal-edit-info" class="action-main icon-edit-user mr-1">
                                        <i class="fas fa-edit"></i>
                                    </span>

                                    <div class="dropdown no-arrow mb-4">
                                       
                                      <i class="fas fa-ellipsis-v fa-sm fa-fw mr-1" style="cursor: pointer;" data-toggle="dropdown" aria-haspopup="true"></i>
                                        <div class="dropdown-menu action-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" href="${data.urlProfile}">Chi tiết tài khoản</a>
                                            <span class="dropdown-item action-item action-lock-user" href="#">${textStatusAcc}</span>
                                           <!-- <span class="dropdown-item action-item action-delete-user" href="#" data-toggle="modal" data-target="#modal-delete-user">Xoá tài khoản</span> -->
                                            <span class="dropdown-item action-item action-update-password-user" href="#" data-toggle="modal" data-target="#modal-change-password">Đổi mật khẩu</span>
                                        </div>
                                    </div>
                                </div>
                            `;
                        },
                        orderable: false
                    },
                ]


            });
        }

    });



    // hết table

    // $('#dataTable tbody').on('click', 'tr', function() {
    //     console.log(table.row(this).data());
    // });
});
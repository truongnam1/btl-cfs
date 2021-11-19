// submit form tạo tài khoản
var urlApi = `http://web-app-cfs.test/api`;
var table = '';
$(document).ready(function() {

    firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
            table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                // rowId: 'idPermission',

                ajax: {
                    url: route('api-get-tag-table'),
                    dataType: 'json',
                    type: 'GET',
                },
                "columns": [{
                        "data": 'tag_name',
                    },
                    {
                        "data": 'desc',
                        render: function(dataDesc, type, row, meta) {
                            if (dataDesc.length > 50) {
                                return dataDesc.substring(0, 49) + '...';
                            }
                            return dataDesc;
                        },

                        orderable: false
                    },
                    {
                        "data": 'userCreate',
                        render: function(dataUser, type, row, meta) {
                            var html = '';
                            if (dataUser) {
                                html = `
                                <a href="${dataUser.urlProfile}">${dataUser.name}</a>
                               `;
                            }
                            return html;
                        }
                    },
                    {
                        "data": 'quantity_use',
                    },
                    {
                        "data": 'created_at',
                        render: function(dataTime, type, row, meta) {
                            var html = '';
                            if (dataTime) {
                                html = convertTime(dataTime);
                            }
                            return html;
                        }
                    },
                    {
                        "data": 'action',

                        render: function(data, type, row, meta) {
                            return `
                            <span data-toggle="modal" data-target="#modal-view-tag">
                            <i class="fas fa-eye"></i>
                            </span>
                            <span data-toggle="modal" data-target="#modal-edit-tag">
                            <i class="fas fa-edit"></i>
                            </span>
                            <span data-toggle="modal" data-target="#modal-delete-tag">
                                <i class="fas fa-trash"></i>
                            </span>
                            `;
                        },
                        orderable: false
                    },
                ]


            });
        }
    });

    function convertTime(time) {
        var date = new Date(time);

        var month = date.getMonth() + 1;
        var day = date.getDate();
        var hour = date.getHours();
        var min = date.getMinutes();
        var sec = date.getSeconds();


        month = (month < 10 ? "0" : "") + month;
        day = (day < 10 ? "0" : "") + day;
        hour = (hour < 10 ? "0" : "") + hour;
        min = (min < 10 ? "0" : "") + min;
        sec = (sec < 10 ? "0" : "") + sec;

        var str = day + '-' + month + "-" + date.getFullYear() + " " + hour + ":" + min + ":" + sec;

        /*alert(str);*/

        return str;
    }


    // hết table

});
// submit form tạo tài khoản
var table = '';

$(document).ready(function() {
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
    firebase.auth().onAuthStateChanged(function(user) {
        if (user) {
            table = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                rowId: 'idPermission',

                ajax: {
                    url: route('api-get-permissions-table'),
                    dataType: 'json',
                    type: 'GET',
                },
                "columns": [{
                        "data": 'desc',
                    },
                    {
                        "data": 'perAssignRole',
                        render: function(data, type, row, meta) {
                            var html = '';
                            if (data) {
                                for (const index in data) {
                                    html += `<span class="badge badge-pill badge-secondary mr-1">${data[index]['desc']}</span>`;
                                }
                            }
                            return html;
                        },
                        orderable: false

                    },
                    {
                        "data": 'createdAt',
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
                            <span data-toggle="modal" data-target="#modal-edit-permission">
                                <i class="fas fa-edit"></i>
                            </span>
                            `;
                        },
                        orderable: false
                    },
                ]


            });

        }
    });

    // hết table


});
$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var data = {};
    callBackDataTable(data);
});

function callBackDataTable(data = null) {

    $("#service_table").DataTable({
        bStateSave: true,
        bDestroy: true,
        bProcessing: true,
        serverSide: true,
        deferRender: true,
        order: [
            [1, 'desc']
        ],
        ajax: {
            url: base_url + '/admin/service/list',
            type: 'get',
            data: data,
            headers: {
                'X-CSRF-Token': $('meta[name = "csrf-token"]').attr('content')
            }
        },
        fnDrawCallback: function(oSettings, json) {

        },
        columns: [{
                orderable: false,
                data: "null",
                width: '100',
                autoWidth: false,
                render: function(data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {
                orderable: false,
                data: "null",
                width: '300',
                autoWidth: false,
                render: function(data, type, full) {
                    return '<div class="d-flex"><a title="View" href="' + base_url + '/admin/service/view/' + full.id + '"><i class="las la-eye" style="font-size:14px"></i></i></a></div>';
                }
            },
            {
                orderable: false,
                data: "null",
                width: '300',
                autoWidth: false,
                render: function(data, type, full) {
                    return full.complaint_number;
                }
            },
            {
                orderable: false,
                data: "null",
                width: '300',
                autoWidth: false,
                render: function(data, type, full) {
                    return full.first_name + ' ' + full.last_name;
                }
            },
           
            {
                orderable: false,
                data: "null",
                width: '300',
                autoWidth: false,
                render: function(data, type, full) {
                    return full.mobile;
                }
            },
            {
                orderable: false,
                data: "null",
                width: '300',
                autoWidth: false,
                render: function(data, type, full) {
                    return full.product.name;
                }
            },
            {
                orderable: false,
                data: "null",
                width: '300',
                autoWidth: false,
                render: function(data, type, full) {
                    return full.model_number;
                }
            },
            {
                orderable: false,
                data: "null",
                width: '300',
                autoWidth: false,
                render: function(data, type, full) {
                    return full.service_type;
                }
            },
            {
                orderable: false,
                data: "null",
                width: '300',
                autoWidth: false,
                render: function(data, type, full) {
                    return full.complaint_id;
                }
            },
            {
                orderable: false,
                data: "null",
                width: '300',
                autoWidth: false,
                render: function(data, type, full) {
                    return full.reference_number;
                }
            },
            {
                orderable: false,
                data: "null",
                width: '300',
                autoWidth: false,
                render: function(data, type, full) {
                    if (full.request_status.length == 0)
                        return 'New';
                    else
                        return full.request_status[0].status;
                }
            },
            {
                orderable: false,
                data: "null",
                width: '300',
                autoWidth: false,
                render: function(data, type, full) {
                    return full.change_date;
                }
            }
        ],

        createdRow: function(row, data, dataIndex) {
            setTimeout(function() {

                $('#service_table tbody').addClass("m-datatable__body");
                $('#service_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
                $('#service_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
                $('#service_table td').addClass("m-datatable__cell");
                $('#service_table input').addClass("form-control m-input");
                $('#service_table tr').css('table-layout', 'fixed');
            });
        }
    });
    var table = $('#service_table').DataTable();
    table.search('').draw();

}

$("#searchSeriveRequest").click(function() {
    if (document.getElementById('from_date').value == '') {
        alert('Please select From date');
    } else if (document.getElementById('to_date').value == '') {
        alert('Please select To date');
    } else {

        var from_date = document.getElementById('from_date').value;
        var to_date = document.getElementById('to_date').value;
        data = { 'from_date': from_date, 'to_date': to_date };
        callBackDataTable(data);
    }
});
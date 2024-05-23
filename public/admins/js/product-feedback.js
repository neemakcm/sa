$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var data={};
    callBackDataTable(data);
});

function callBackDataTable(data = null) {
   
    $("#product_feedback_table").DataTable({
        bStateSave: true,
        bDestroy: true,
        bProcessing: true,
        serverSide: true,
        deferRender: true,
        order: [
            [1, 'desc']
        ],
        ajax: {
            url: base_url + '/admin/products/feedbackList',
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
                    return full.product.category.name;
                }
            },
            {
                orderable: false,
                data: "null",
                width: '300',
                autoWidth: false,
                render: function(data, type, full) {
                    return full.serial_number;
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
            },
            {
                orderable: false,
                data: "null",
                width: '300',
                autoWidth: false,
                render: function(data, type, full) {
                    return '<div class="d-flex"><a title="View" href="' + base_url + '/admin/products/feedback/' + full.id + '"><i class="las la-eye" style="font-size:14px"></i></i></a></div>';
                }
            }
        ],

        createdRow: function(row, data, dataIndex) {
            setTimeout(function() {

                $('#product_feedback_table tbody').addClass("m-datatable__body");
                $('#product_feedback_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
                $('#product_feedback_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
                $('#product_feedback_table td').addClass("m-datatable__cell");
                $('#product_feedback_table input').addClass("form-control m-input");

                $('#product_feedback_table tr').css('table-layout', 'fixed');
            });
        }
    });
    var table = $('#product_feedback_table').DataTable();
    table.search('').draw();

}

$("#searchFeedback").click(function() {
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

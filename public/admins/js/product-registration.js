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

    $("#product_registered_table").DataTable({
        bStateSave: true,
        bDestroy: true,
        bProcessing: true,
        serverSide: true,
        deferRender: true,
        order: [
            [1, 'desc']
        ],
        ajax: {
            url: base_url + '/admin/products/registeredListPost',
            type: 'POST',
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

                if(full.products){
                    return full.products.name;
                }
                else{
                    return '---';

                }
                
            }
        },
        {
            orderable: false,
            data: "null",
            width: '300',
            autoWidth: false,
            render: function(data, type, full) {
                if(full.products){
                    return full.products.sku;
                }
                else{
                    return '---';

                }
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
                return '<div class="d-flex"><a title="View" href="' + base_url + '/admin/products/registered/' + full.id + '"><i class="las la-eye" style="font-size:14px"></i></i></a></div>';
            }
        }
    ],
    createdRow: function(row, data, dataIndex) {
        setTimeout(function() {

            $('#product_registered_table tbody').addClass("m-datatable__body");
            $('#product_registered_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
            $('#product_registered_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
            $('#product_registered_table td').addClass("m-datatable__cell");
            $('#product_registered_table_filter input').addClass("form-control m-input");

            $('#product_registered_table tr').css('table-layout', 'fixed');
        });
    }
    });
    var table = $('#product_registered_table').DataTable();
    table.search('').draw();
}

$("#searchRegisteredProduct").click(function() {
if (document.getElementById('from_date').value == '') {
        alert('Please select From date');
    } else if (document.getElementById('to_date').value == '') {
        alert('Please select To date');
    } else {
        var from_date = document.getElementById('from_date').value;
        var to_date = document.getElementById('to_date').value;
        var data = { 'from_date': from_date, 'to_date': to_date };
        callBackDataTable(data);
    }
});
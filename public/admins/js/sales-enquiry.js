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

    $("#sales_enquiry").DataTable({
        bStateSave: true,
        bDestroy: true,
        bProcessing: true,
        serverSide: true,
        deferRender: true,
        order: [
            [1, 'desc']
        ],
        ajax: {
            url: base_url + '/admin/sales-enquiry/listPost',
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
                                return full.enquiry_type;
                            }
                        },
                        {
                            orderable: false,
                            data: "null",
                            width: '300',
                            autoWidth: false,
                            render: function(data, type, full) {
                                return full.first_name;
                            }
                        }, {
                            orderable: false,
                            data: "null",
                            width: '300',
                            autoWidth: false,
                            render: function(data, type, full) {
                                return full.last_name;
                            }
                        },
                        {
                            orderable: false,
                            data: "null",
                            width: '300',
                            autoWidth: false,
                            render: function(data, type, full) {
                                return full.email;
                            }
                        }, {
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
                                // return full.created_at;
                                return moment(full.created_at).format('DD-MM-YYYY');
                            }
                        },
        
                    ],
                    "columnDefs": [{
                        width: '300',
                        "targets": 7,
                        "visible": true,
                        "render": function(data, type, full) {
                            return '<div class="d-flex"><a title="view" href="' + base_url + '/admin/sales-enquiry/view/' + full.id + '"><i class="las la-eye"></i></i></a></div>';
                        }
                    }],
                    createdRow: function(row, data, dataIndex) {
                        setTimeout(function() {
        
                            $('#sales_enquiry tbody').addClass("m-datatable__body");
                            $('#sales_enquiry tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
                            $('#sales_enquiry tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
                            $('#sales_enquiry td').addClass("m-datatable__cell");
                            $('#sales_enquiry input').addClass("form-control m-input");
        
                            $('#sales_enquiry tr').css('table-layout', 'fixed');
                        });
                    }
    });
    var table = $('#sales_enquiry').DataTable();
    table.search('').draw();
}

$("#searchSalesEnquiry").click(function() {
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
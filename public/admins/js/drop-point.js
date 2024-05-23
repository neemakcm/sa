$(function() {
    if ($('#drop_point_table').length > 0) {
        $('#drop_point_table').DataTable({
            language: { search: '', searchPlaceholder: "Search..." },
            processing: true,
            serverSide: true,
            pageLength: 50,
            "dom": "lifrtp",
            initComplete: function() {
                var input = $('.dataTables_filter input').unbind(),
                    self = this.api(),
                    $searchButton = $('<button class="ml-1 btn btn-secondary">')
                    .text('search')
                    .click(function() {
                        self.search(input.val()).draw();
                    }),
                    $clearButton = $('<button class="ml-1 btn btn-secondary">')
                    .text('clear')
                    .click(function() {
                        input.val('');
                        $searchButton.click();
                    })
                $('.dataTables_filter').append($searchButton, $clearButton);
                $('.dataTables_filter').bind('keyup', function(e) {
                    if (e.keyCode == 13) {
                        self.search(input.val()).draw();
                    }
                });
            },
            ajax: base_url + '/admin/drop-point/list',
            columns: [{
                    orderable: false,
                    data: "null",
                    width: '300',
                    autoWidth: false,
                    render: function(data, type, full) {
                        return full.title;
                    }
                },
                {
                    orderable: false,
                    data: "null",
                    width: '300',
                    autoWidth: false,
                    render: function(data, type, full) {
                        return full.description;
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
                        return full.open_hour;
                    }
                }
            ],
            "columnDefs": [{
                width: '300',
                "targets": 5,
                "visible": true,
                "render": function(data, type, full) {
                    return '<div class="d-flex"><a title="Edit" href="' + base_url + '/admin/drop-point/edit/' + full.id + '"><i class="nav-icon i-Pen-2"></i></i></a>&nbsp;&nbsp;&nbsp<a title="Delete" href="' + base_url + '/admin/stores/delete/' + full.id + '"><i class="las la-trash" style="font-size:14px"></i></i></a></div>';
                }
            }],
            createdRow: function(row, data, dataIndex) {
                setTimeout(function() {

                    $('#drop_point_table tbody').addClass("m-datatable__body");
                    $('#drop_point_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
                    $('#drop_point_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
                    $('#drop_point_table td').addClass("m-datatable__cell");
                    $('#drop_point_table input').addClass("form-control m-input");

                    $('#drop_point_table tr').css('table-layout', 'fixed');
                });
            }
        });
    }
});

function ValidateDrop(event) {
    var regex = new RegExp("^[0-9-!@#$%*+, ?]");
    var key = String.fromCharCode(event.charCode ? event.which : event.charCode);
    if (!regex.test(key)) {
        event.preventDefault();
        return false;
    }
}
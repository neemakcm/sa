$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if ($('#extension_table').length > 0) {
        $('#extension_table').DataTable({
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
            ajax: base_url + '/admin/warranty-extension/list',
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
                        if (full.products) {
                            return full.products.name;
                        } else {
                            return "";
                        }
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
                    return '<div class="d-flex"><a title="view" href="' + base_url + '/admin/warranty-extension/view/' + full.id + '"><i class="las la-eye"></i></i></a></div>';
                }
            }],
            createdRow: function(row, data, dataIndex) {
                setTimeout(function() {

                    $('#extension_table tbody').addClass("m-datatable__body");
                    $('#extension_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
                    $('#extension_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
                    $('#extension_table td').addClass("m-datatable__cell");
                    $('#extension_table input').addClass("form-control m-input");

                    $('#extension_table tr').css('table-layout', 'fixed');
                });
            }
        });
    }

});
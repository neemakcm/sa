$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if ($('#escalate_service').length > 0) {
        $('#escalate_service').DataTable({
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
            ajax: base_url + '/admin/escalate-to-service/list',
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
                            return full.products.sku;
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
                    return '<div class="d-flex"><a title="view" href="' + base_url + '/admin/escalate-to-service/view/' + full.id + '"><i class="las la-eye"></i></i></a></div>';
                }
            }],
            createdRow: function(row, data, dataIndex) {
                setTimeout(function() {

                    $('#escalate_service tbody').addClass("m-datatable__body");
                    $('#escalate_service tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
                    $('#escalate_service tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
                    $('#escalate_service td').addClass("m-datatable__cell");
                    $('#escalate_service input').addClass("form-control m-input");

                    $('#escalate_service tr').css('table-layout', 'fixed');
                });
            }
        });
    }

});
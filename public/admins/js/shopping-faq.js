$(function() {

    if ($('#shopping_faq_table').length > 0) {
        $('#shopping_faq_table').DataTable({
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
            ajax: base_url + '/admin/shopping-faq/list',
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
                        return full.question;
                    }
                },
                {
                    orderable: false,
                    data: "null",
                    width: '300',
                    autoWidth: false,
                    render: function(data, type, full) {
                        return full.answer;
                    }
                }
            ],
            "columnDefs": [{
                width: '300',
                "targets": 3,
                "visible": true,
                "render": function(data, type, full) {
                    return '<div class="d-flex"><a title="Edit" href="' + base_url + '/admin/shopping-faq/edit/' + full.id + '"><i class="nav-icon i-Pen-2"></i></i></a>&nbsp;&nbsp;&nbsp<a title="Delete" href="' + base_url + '/admin/shopping-faq/delete/' + full.id + '"><i class="las la-trash" style="font-size:14px"></i></i></a></div>';
                }
            }],
            createdRow: function(row, data, dataIndex) {
                setTimeout(function() {

                    $('#shopping_faq_table tbody').addClass("m-datatable__body");
                    $('#shopping_faq_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
                    $('#shopping_faq_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
                    $('#shopping_faq_table td').addClass("m-datatable__cell");
                    $('#shopping_faq_table input').addClass("form-control m-input");
                    $('#shopping_faq_table tr').css('table-layout', 'fixed');
                });
            }
        });
    }

});
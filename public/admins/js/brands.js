$(function() {


    if ($('#brands_table').length > 0) {
        $('#brands_table').DataTable({
            language: { search: '', searchPlaceholder: "Search..." },
            processing: true,
            serverSide: true,
            pageLength: 50,
            "dom": "lifrtp",
            initComplete: function() {
                var input = $('.dataTables_filter input').unbind(),
                    self = this.api(),
                    $searchButton = $('<button class="ml-1 btn btn-primary">')
                    .text('search')
                    .click(function() {
                        self.search(input.val()).draw();
                    }),
                    $clearButton = $('<button class="ml-1 btn btn-primary">')
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
            ajax: base_url + '/admin/brands/list',
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
                        if (full.image == '' || full.image == null)
                            return '';
                        else
                            return '<img src="' + storage_url + '/' + full.image + '" width="50">';
                    }
                }
            ],
            "columnDefs": [{
                width: '300',
                "targets": 2,
                "visible": true,
                "render": function(data, type, full) {
                    return '<div class="d-flex"><a title="Edit" href="' + base_url + '/admin/brands/edit/' + full.id + '"><i class="nav-icon i-Pen-2"></i></i></a>&nbsp;&nbsp;&nbsp<a title="Delete" href="' + base_url + '/admin/brands/delete/' + full.id + '"><i class="las la-trash" style="font-size:14px"></i></i></a></div>';

                }
            }],
            createdRow: function(row, data, dataIndex) {
                setTimeout(function() {

                    $('#brands_table tbody').addClass("m-datatable__body");
                    $('#brands_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
                    $('#brands_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
                    $('#brands_table td').addClass("m-datatable__cell");
                    $('#brands_table input').addClass("form-control m-input");

                    $('#brands_table tr').css('table-layout', 'fixed');
                });
            }
        });
    }
});
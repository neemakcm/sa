$(function() {
    if ($('#news_table').length > 0) {
        $('#news_table').DataTable({
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
            ajax: base_url + '/admin/news-and-events/list',
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
                        return '<img class="m-1" src="' + storage_url + '/' + full.media + '" width="40">';
                    }
                },
                {
                    orderable: false,
                    data: "null",
                    width: '300',
                    autoWidth: false,
                    render: function(data, type, full) {
                        if (full.description != null && full.description.length > 100)
                            return '<p title="' + full.description + '">' + full.description.substring(0, 100) + '...</p>';
                        else
                            return full.description;
                    }
                },
                {
                    orderable: false,
                    data: "null",
                    width: '300',
                    autoWidth: false,
                    render: function(data, type, full) {
                        return '<div class="d-flex"><a title="Edit" href="' + base_url + '/admin/news-and-events/edit/' + full.id + '"><i class="nav-icon i-Pen-2"></i></i></a>&nbsp;&nbsp;&nbsp<a title="Delete" href="' + base_url + '/admin/news-and-events/delete/' + full.id + '"><i class="las la-trash" style="font-size:14px"></i></i></a></div>';
                    }
                }
            ],
            createdRow: function(row, data, dataIndex) {
                setTimeout(function() {

                    $('#news_table tbody').addClass("m-datatable__body");
                    $('#news_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
                    $('#news_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
                    $('#news_table td').addClass("m-datatable__cell");
                    $('#news_table input').addClass("form-control m-input");

                    $('#news_table tr').css('table-layout', 'fixed');
                });
            }
        });
    }


});
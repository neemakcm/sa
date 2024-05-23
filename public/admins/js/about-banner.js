$(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if ($('#about_banners_table').length > 0) {
        $('#about_banners_table').DataTable({
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
            ajax: base_url + '/admin/about/banners/list',
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
                        return full.name;
                    }
                }, {
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
                        return '<img src="' + storage_url + '/' + full.image + '" width="50">';
                    }
                }, {
                    orderable: false,
                    data: "null",
                    width: '300',
                    autoWidth: false,
                    render: function(data, type, full) {
                        if (full.status == 1) {
                            return "Active";
                        } else {
                            return "inactive";
                        }
                    }
                },

            ],
            "columnDefs": [{
                width: '300',
                "targets": 5,
                "visible": true,
                "render": function(data, type, full) {
                    return '<div class="d-flex"><a title="Edit" href="' + base_url + '/admin/about/banners/edit/' + full.id + '"><i class="i-Pen-2 nav-icon"></i></i></a>&nbsp&nbsp&nbsp<a title="Delete" href="' + base_url + '/admin/about/banners/delete/' + full.id + '"><svg aria-hidden="true" width="10" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg></a></div>';
                }
            }],
            createdRow: function(row, data, dataIndex) {
                setTimeout(function() {

                    $('#about_banners_table tbody').addClass("m-datatable__body");
                    $('#about_banners_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
                    $('#about_banners_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
                    $('#about_banners_table td').addClass("m-datatable__cell");
                    $('#about_banners_table input').addClass("form-control m-input");

                    $('#about_banners_table tr').css('table-layout', 'fixed');
                });
            }
        });
    }

});
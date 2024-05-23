$(function() {
    if ($('#products_vendor_table').length > 0) {
        $('#products_vendor_table').DataTable({
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
            "ajax": {
                url: base_url + '/admin/products/vendorList?product_id=' + $('#product_id').val(),
                type: "GET"
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
                        if (full.vendor) {
                            return full.vendor.name;
                            // return '<img src="' + storage_url + '/' + full.vendor.image + '" width="50">';
                        } else { return ""; }
                    }
                },
                {
                    orderable: false,
                    data: "null",
                    width: '100',
                    render: function(data, type, full) {
                        return full.online_link;

                    }
                },



            ],
            "columnDefs": [{
                width: '300',
                "targets": 3,
                "visible": true,
                "render": function(data, type, full) {
                    return '<div class="d-flex"><a title="Delete" href="' + base_url + '/admin/products/vendor/delete/' + full.id + '"><i class="las la-trash" style="font-size:14px"></i></i></a></div>';
                }
            }],
            createdRow: function(row, data, dataIndex) {
                setTimeout(function() {

                    $('#products_vendor_table tbody').addClass("m-datatable__body");
                    $('#products_vendor_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
                    $('#products_vendor_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
                    $('#products_vendor_table td').addClass("m-datatable__cell");
                    $('#products_vendor_table input').addClass("form-control m-input");
                    $('#products_vendor_table tr').css('table-layout', 'fixed');
                });
            }
        });
    }
});
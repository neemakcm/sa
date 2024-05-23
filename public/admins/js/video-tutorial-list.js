$(function() {
    if ($('#tutorial_table').length > 0) {
        $('#tutorial_table').DataTable({
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
            ajax: base_url + '/admin/video-tutorials/list',
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
                        if (full.category) {
                            return full.category.name;
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
                        return full.title;
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
                        return '<img src="' + storage_url + '/' + full.thumbnail + '" width="50">';
                    }
                },
                {
                    orderable: false,
                    data: "null",
                    width: '300',
                    autoWidth: false,
                    render: function(data, type, full) {
                        if (full.type == 0)
                            return 'Video';
                        else
                            return 'YouTube';
                    }
                },
                {
                    orderable: false,
                    data: "null",
                    width: '300',
                    autoWidth: false,
                    render: function(data, type, full) {
                        return '<a href="' + storage_url + '/' + full.video + '" target="_blank"><img class="m-1" src="' + storage_url + '/' + full.thumbnail + '" width="60" height="60"></a>';
                    }
                }
            ],
            "columnDefs": [{
                width: '300',
                "targets": 7,
                "visible": true,
                "render": function(data, type, full) {
                    return '<div class="d-flex"><a title="Edit" href="' + base_url + '/admin/video-tutorials/edit/' + full.id + '"><i class="nav-icon i-Pen-2"></i></i></a>&nbsp;&nbsp;&nbsp<a title="Delete" href="' + base_url + '/admin/video-tutorials/delete/' + full.id + '"><i class="las la-trash" style="font-size:14px"></i></i></a></div>';
                }
            }],
            createdRow: function(row, data, dataIndex) {
                setTimeout(function() {

                    $('#tutorial_table tbody').addClass("m-datatable__body");
                    $('#tutorial_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
                    $('#tutorial_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
                    $('#tutorial_table td').addClass("m-datatable__cell");
                    $('#tutorial_table input').addClass("form-control m-input");

                    $('#tutorial_table tr').css('table-layout', 'fixed');
                });
            }
        });
    }

    $('#video_tutorial_add_form').submit(function(e) {
        e.preventDefault();

        var form = $('#video_tutorial_add_form');
        var formData = new FormData(form[0]);

        $.ajax({
            type: "POST",
            url: base_url + '/admin/video-tutorials/store',
            contentType: false,
            processData: false,
            data: formData,
            success: function(result) {

                location.href = base_url + '/admin/video-tutorials';
            },

            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                //Upload progress
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total) * 100 + '%';
                        $("#progressBar").animate({
                            width: percentComplete
                        }, {
                            duration: 5000,
                            easing: "linear",
                            step: function(x) {
                                $("#percent").text(percentComplete)

                            }
                        });

                    }
                }, false);
                return xhr;
            }
        });
    });

    $('#tutorial_edit_form').submit(function(e) {
        e.preventDefault();

        var form = $('#tutorial_edit_form');
        var formData = new FormData(form[0]);

        $.ajax({
            type: "POST",
            url: base_url + '/admin/video-tutorials/update',
            contentType: false,
            processData: false,
            data: formData,
            success: function(result) {

                location.href = base_url + '/admin/video-tutorials';
            },

            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                //Upload progress
                xhr.upload.addEventListener("progress", function(evt) {
                    if (evt.lengthComputable) {
                        var percentComplete = (evt.loaded / evt.total) * 100 + '%';
                        $("#progressBar").animate({
                            width: percentComplete
                        }, {
                            duration: 5000,
                            easing: "linear",
                            step: function(x) {
                                $("#percent").text(percentComplete)

                            }
                        });

                    }
                }, false);
                return xhr;
            }

        });

    });
});
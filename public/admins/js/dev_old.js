$(function() 
{

	if($('#roles_table').length > 0)
	{
		$('#roles_table').DataTable({
			language: { search: '', searchPlaceholder: "Search..." },
	        processing: true,
	        serverSide: true,
	        pageLength: 50,
	        "dom": "lifrtp",
	        initComplete : function() {
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
				       if(e.keyCode == 13) {
					        self.search(input.val()).draw();
					    }
					});
			    },
	        ajax: base_url+'/admin/roles/list',
	        columns: [
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.title;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		if(full.description != null && full.description.length > 100)
	              			return '<p title="'+full.description+'">'+full.description.substring(0, 100) + '...</p>';
	              		else
	              			return full.description;
	              	}
	            }
	        ],
	        "columnDefs": [
	            {
	            	 width: '300',
	                "targets": 2,
	                "visible": true,
	                 "render": function (data, type, full) { 
	 				return '<a href="'+base_url+'/admin/roles/edit/'+full.id+'" title="Edit"><i class="nav-icon i-Pen-2"></i></i></a>';
	                
	                }
	            }
	         ],
	        createdRow: function(row, data, dataIndex) 
	        {
	            setTimeout(function()
	            {

	            	$('#roles_table tbody').addClass("m-datatable__body");
	            	$('#roles_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
	            	$('#roles_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
	            	$('#roles_table td').addClass("m-datatable__cell");
	            	$('#roles_table_filter input').addClass("form-control m-input");

	            	$('#roles_table tr').css('table-layout','fixed');
	            });
	        }
	    });
	}

	if($('#admin_users_table').length > 0)
	{
		$('#admin_users_table').DataTable({
			language: { search: '', searchPlaceholder: "Search..." },
	        processing: true,
	        serverSide: true,
	        pageLength: 50,
	        "dom": "lifrtp",
	        initComplete : function() {
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
				       if(e.keyCode == 13) {
					        self.search(input.val()).draw();
					    }
					});
			    },
	        'ajax': {
		       'url':base_url+'/admin/admin-users/list',
		    },
	        
	        columns: [
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.name;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.roles.title;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.email;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.change_date;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		if(full.status == 1)
	              			return 'Active';
	              		else
	              			return 'Inactive';
	              	}
	            }
	        ],
	        "columnDefs": [
	            {
	            	 width: '300',
	                "targets": 5,
	                "visible": true,
	                 "render": function (data, type, full) { 
	 				return '<div class="d-flex"><a title="Edit" href="'+base_url+'/admin/admin-users/edit/'+full.id+'"><i class="i-Pen-2 nav-icon"></i></i></a>&nbsp&nbsp&nbsp<a title="Delete" href="'+base_url+'/admin/admin-users/delete/'+full.id+'"><svg aria-hidden="true" width="10" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg></a></div>';
	                
	                }
	            }
	         ],
	        createdRow: function(row, data, dataIndex) 
	        {
	            setTimeout(function()
	            {

	            	$('#admin_users_table tbody').addClass("m-datatable__body");
	            	$('#admin_users_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
	            	$('#admin_users_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
	            	$('#admin_users_table td').addClass("m-datatable__cell");
	            	$('#admin_users_table_filter input').addClass("form-control m-input");

	            	$('#admin_users_table tr').css('table-layout','fixed');
	            });
	        }
	    });
	}

	if($('#banners_table').length > 0)
	{
		loadBanners();

		function loadBanners(filter = '')
		{
			$('#banners_table').DataTable({
				language: { search: '', searchPlaceholder: "Search..." },
		        processing: true,
		        serverSide: true,
		        pageLength: 50,
		        "dom": "lifrtp",
		        initComplete : function() {
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
				       if(e.keyCode == 13) {
					        self.search(input.val()).draw();
					    }
					});
			    },
		        ajax: base_url+'/admin/banners/list',
		        columns: [
		            { 
		            	orderable: false,
		            	data: "null",
		            	width: '300',
		            	autoWidth: false,
		              	render : function(data,type,full) {
		              		return '<img class="black_bckgrnd" src="'+storage_url+'/'+full.image+'" width="60" height="60">';
		              	}
		            },
		            { 
		            	orderable: false,
		            	data: "null",
		            	width: '300',
		            	autoWidth: false,
		              	render : function(data,type,full) {
		              		return full.title;
		              	}
		            },
		            { 
		            	orderable: false,
		            	data: "null",
		            	width: '300',
		            	autoWidth: false,
		              	render : function(data,type,full) {
		              		var description = (full.description == '' || full.description == null)?full.description:full.description.replace(/<(.|\n)*?>/g, '');
		              		if(description != null && description.length > 100)
		              			return '<p title="'+description+'">'+description.substring(0, 100) + '...</p>';
		              		else
		              			return description;
		              	}
		            },
		            { 
		            	orderable: false,
		            	data: "null",
		            	width: '300',
		            	autoWidth: false,
		              	render : function(data,type,full) {
		              		return full.position
		              	}
		            },
		            { 
		            	orderable: false,
		            	data: "null",
		            	width: '300',
		            	autoWidth: false,
		              	render : function(data,type,full) {
		              		if(full.status == 0)
		              			return 'Inactive';
		              		else
		              			return 'Active';
		              	}
		            }
		        ],
		        "columnDefs": [
		            {
		            	 width: '300',
		                "targets": 5,
		                "visible": true,
		                 "render": function (data, type, full) { 
		                 	var td = '<div class="d-flex"><a title="Edit" href="'+base_url+'/admin/banners/edit/'+full.id+'"><i class="i-Pen-2 nav-icon"></i></i></a>&nbsp&nbsp&nbsp<a title="Delete" href="'+base_url+'/admin/banners/delete/'+full.id+'"><svg aria-hidden="true" width="10" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg></a></div>';

	 						return td;
		                }
		            }
		         ],
		        createdRow: function(row, data, dataIndex) 
		        {
		            setTimeout(function()
		            {

		            	$('#banners_table tbody').addClass("m-datatable__body");
		            	$('#banners_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
		            	$('#banners_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
		            	$('#banners_table td').addClass("m-datatable__cell");
		            	$('#banners_table_filter input').addClass("form-control m-input");

		            	$('#banners_table tr').css('table-layout','fixed');
		            });
		        }
		    });
		}


	    $('.filter_otion').on('click', function(e)
	    {
		    e.preventDefault();
		    var filter = $(this).attr('data-type');
		    $('#banners_table').DataTable().destroy();
		    loadBanners(filter);
		    
		});
	}

	if($('.tinymce').length > 0)
	{
	    var demoBaseConfig = {
		  	selector: "textarea.tinymce",
		  	//width: 450,
		  	height: 500,
		  	resize: false,
		  	menubar: false,
	        statusbar: true,
	        relative_urls : false,
			remove_script_host : false,
			convert_urls : true,
		  	plugins: 'image code',
		  	toolbar:
		    	"insertfile a11ycheck undo redo | bold italic | forecolor backcolor | template codesample | alignleft aligncenter alignright alignjustify | bullist numlist | link image | code | removeformat",
		  	spellchecker_dialog: true,
		  	images_upload_url: base_url+'/imageUpload',
		    images_upload_handler: function (blobInfo, success, failure) {
		        var xhr, formData;
		        xhr = new XMLHttpRequest();
		        xhr.withCredentials = false;
		        xhr.open('POST', base_url+'/imageUpload');
		        xhr.onload = function() {
		            var json;
		            if (xhr.status != 200) {
		                failure('HTTP Error: ' + xhr.status);
		                return;
		            }
		            success(xhr.responseText);
		        };
		        formData = new FormData();
		        formData.append('file', blobInfo.blob(), blobInfo.filename());
		        formData.append('_token',$('input[name="_token"]').val());
		        xhr.send(formData);
		    }
		};

		tinymce.init(demoBaseConfig);
	}


	if($('#attributes_table').length > 0)
	{
		$('#attributes_table').DataTable({
			language: { search: '', searchPlaceholder: "Search..." },
	        processing: true,
	        serverSide: true,
	        pageLength: 50,
	        "dom": "lifrtp",
	        initComplete : function() {
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
				       if(e.keyCode == 13) {
					        self.search(input.val()).draw();
					    }
					});
			    },
	        ajax: base_url+'/admin/attributes/list',
	        columns: [
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.name;
	              	}
	            }
	        ],
	        "columnDefs": [
	            {
	            	 width: '300',
	                "targets": 1,
	                "visible": true,
	                "render": function (data, type, full) { 
	 					var td = '<div class="d-flex"><a title="Edit" href="'+base_url+'/admin/attributes/edit/'+full.id+'"><i class="nav-icon i-Pen-2"></i></i></a>';

	 					if(full.products.length == 0)
	 						td += '&nbsp&nbsp&nbsp<a title="Delete" href="'+base_url+'/admin/attributes/delete/'+full.id+'"><svg aria-hidden="true" width="10" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg></a>';

	 					td += '</div>';

	 					return td;
	                
	                }
	            }
	         ],
	        createdRow: function(row, data, dataIndex) 
	        {
	            setTimeout(function()
	            {

	            	$('#attributes_table tbody').addClass("m-datatable__body");
	            	$('#attributes_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
	            	$('#attributes_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
	            	$('#attributes_table td').addClass("m-datatable__cell");
	            	$('#attributes_table_filter input').addClass("form-control m-input");

	            	$('#attributes_table tr').css('table-layout','fixed');
	            });
	        }
	    });
	}


	if($('#categories_table').length > 0)
	{
		$('#categories_table').DataTable({
			language: { search: '', searchPlaceholder: "Search..." },
	        processing: true,
	        serverSide: true,
	        pageLength: 50,
	        "dom": "lifrtp",
	        initComplete : function() {
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
				       if(e.keyCode == 13) {
					        self.search(input.val()).draw();
					    }
					});
			    },
	        ajax: base_url+'/admin/categories/list',
	        columns: [
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.name;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		if(full.parent_id == 0)
	              			return '---';
	              		else
	              			return full.parent.name;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		if(full.icon == '')
	              			return '---';
	              		else
	              			return '<img src="'+storage_url+'/'+full.icon+'" width="60" height="60">';
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		if(full.is_last_child == 0)
	              			return '---';
	              		else
	              			return '<a href="'+base_url+'/admin/categories/attributes/'+full.id+'"><i class="las la-braille"></i></a>';
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		if(full.status == 0)
	              			return 'Inactive';
	              		else
	              			return 'Active';
	              	}
	            }
	        ],
	        "columnDefs": [
	            {
	            	 width: '300',
	                "targets": 5,
	                "visible": true,
	                "render": function (data, type, full) { 
	 					var td = '<div class="d-flex"><a title="Edit" href="'+base_url+'/admin/categories/edit/'+full.id+'"><i class="nav-icon i-Pen-2"></i></i></a>';

	 					if(full.products.length == 0 && full.children.length == 0)
	 						td += '&nbsp&nbsp&nbsp<a title="Delete" href="'+base_url+'/admin/categories/delete/'+full.id+'"><svg aria-hidden="true" width="10" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg></a>';

	 					td += '</div>';

	 					return td;
	                
	                }
	            }
	         ],
	        createdRow: function(row, data, dataIndex) 
	        {
	            setTimeout(function()
	            {

	            	$('#categories_table tbody').addClass("m-datatable__body");
	            	$('#categories_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
	            	$('#categories_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
	            	$('#categories_table td').addClass("m-datatable__cell");
	            	$('#categories_table_filter input').addClass("form-control m-input");

	            	$('#categories_table tr').css('table-layout','fixed');
	            });
	        }
	    });
	}

	$('.is_child').change(function()
	{
		var value = $(this).val();

		if(value == 0)
		{
			$('#image_label').html('Image');
			$('#image_upload').removeAttr('required');
		}
		else
		{
			$('#image_label').html('Image*');
			$('#image_upload').attr('required','required');
		}
	});


	if($('#category_attributes_table').length > 0)
	{
		$('#category_attributes_table').DataTable({
			language: { search: '', searchPlaceholder: "Search..." },
	        processing: true,
	        serverSide: true,
	        pageLength: 50,
	        "dom": "lifrtp",
	        initComplete : function() {
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
				       if(e.keyCode == 13) {
					        self.search(input.val()).draw();
					    }
					});
			    },
	        ajax: base_url+'/admin/categories/attributesList?category='+$('#category').val(),
	        columns: [
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.attribute.name;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		if(full.is_varient == 0)
	              			return 'Not varient';
	              		else
	              			return 'Varient';
	              	}
	            }
	        ],
	        "columnDefs": [
	            {
	            	 width: '300',
	                "targets": 2,
	                "visible": true,
	                "render": function (data, type, full) { 
	 					if(full.category.products.length == 0)
	 						return '<a title="Delete" href="'+base_url+'/admin/categories/attributes/delete/'+full.id+'"><svg aria-hidden="true" width="10" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg></a>';
	 					else
	 						return '---';
	                
	                }
	            }
	         ],
	        createdRow: function(row, data, dataIndex) 
	        {
	            setTimeout(function()
	            {

	            	$('#category_attributes_table tbody').addClass("m-datatable__body");
	            	$('#category_attributes_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
	            	$('#category_attributes_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
	            	$('#category_attributes_table td').addClass("m-datatable__cell");
	            	$('#category_attributes_table_filter input').addClass("form-control m-input");

	            	$('#category_attributes_table tr').css('table-layout','fixed');
	            });
	        }
	    });
	}

	if($('#latest_table').length > 0)
	{
		$('#latest_table').DataTable({
			language: { search: '', searchPlaceholder: "Search..." },
	        processing: true,
	        serverSide: true,
	        pageLength: 50,
	        "dom": "lifrtp",
	        initComplete : function() {
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
			       if(e.keyCode == 13) {
				        self.search(input.val()).draw();
				    }
				});
		    },
	        "ajax" : {
		     	url:base_url+'/admin/latestVideos/list',
		     	type:"GET"
		    },
	        
	        columns: [
	        	{ 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.title;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		if(full.description != null && full.description.length > 100)
	              			return '<p title="'+full.description+'">'+full.description.substring(0, 100) + '...</p>';
	              		else
	              			return full.description;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return '<img class="m-1" src="'+storage_url+'/'+full.thumbnail+'" width="60" height="60">';
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return '<a href="'+storage_url+'/'+full.video+'" target="_blank"><img class="m-1" src="'+storage_url+'/'+full.thumbnail+'" width="60" height="60"></a>';
	              	}
	            }
	        ],
	        "columnDefs": [
	            {
	            	 width: '300',
	                "targets": 4,
	                "visible": true,
	                 "render": function (data, type, full) { 
	 				return '<div class="d-flex"><a title="Edit" href="'+base_url+'/admin/latestVideos/edit/'+full.id+'"><i class="i-Pen-2 nav-icon"></i></i></a>&nbsp&nbsp&nbsp<a title="Delete" href="'+base_url+'/admin/latestVideos/delete/'+full.id+'"><svg aria-hidden="true" width="10" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg></a></div>';
	                
	                }
	            }
	         ],
	        createdRow: function(row, data, dataIndex) 
	        {
	            setTimeout(function()
	            {

	            	$('#latest_table tbody').addClass("m-datatable__body");
	            	$('#latest_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
	            	$('#latest_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
	            	$('#latest_table td').addClass("m-datatable__cell");
	            	$('#latest_table_filter input').addClass("form-control m-input");

	            	$('#latest_table tr').css('table-layout','fixed');
	            });
	        }
	    });
	}

	$('.select2').select2(); 

	$('#latest_add_form').submit(function(e)
	{
		e.preventDefault();

		var form = $('#latest_add_form');
    	var formData = new FormData(form[0]);
    
    	$.ajax({
    		type:"POST",
	       	url: base_url+'/admin/latestVideos/store',
	       	contentType: false,
	       	processData: false,
	       	data:formData,
	       	success:function(result){
       
       			location.href = base_url+'/admin/latestVideos';
       		},

      		xhr: function(){
		       	var xhr = new window.XMLHttpRequest();
		       	//Upload progress
		       	xhr.upload.addEventListener("progress", function(evt){
			       	if (evt.lengthComputable) 
			       	{
			         	var percentComplete = (evt.loaded / evt.total)*100+'%';
			         	$("#progressBar").animate({
	    	                width: percentComplete
	    	            }, {
	    	                duration: 5000,
	    	                easing: "linear",
	    	                step: function (x) {
	    	                $("#percent").text(percentComplete)
	                        
	    	                }
	    	            });
			         
			        }
		       	}, false);
		       return xhr;
		    }
    
    	});

	});

	$('#latest_edit_form').submit(function(e)
	{
		e.preventDefault();

		var form = $('#latest_edit_form');
    	var formData = new FormData(form[0]);
    
    	$.ajax({
    		type:"POST",
	       	url: base_url+'/admin/latestVideos/update',
	       	contentType: false,
	       	processData: false,
	       	data:formData,
	       	success:function(result){
       
       			location.href = base_url+'/admin/latestVideos';
       		},

      		xhr: function(){
		       	var xhr = new window.XMLHttpRequest();
		       	//Upload progress
		       	xhr.upload.addEventListener("progress", function(evt){
			       	if (evt.lengthComputable) 
			       	{
			         	var percentComplete = (evt.loaded / evt.total)*100+'%';
			         	$("#progressBar").animate({
	    	                width: percentComplete
	    	            }, {
	    	                duration: 5000,
	    	                easing: "linear",
	    	                step: function (x) {
	    	                $("#percent").text(percentComplete)
	                        
	    	                }
	    	            });
			         
			        }
		       	}, false);
		       return xhr;
		    }
    
    	});

	});

	if($('#products_table').length > 0)
	{
		$('#products_table').DataTable({
			language: { search: '', searchPlaceholder: "Search..." },
	        processing: true,
	        serverSide: true,
	        pageLength: 50,
	        "dom": "lifrtp",
	        initComplete : function() {
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
			       if(e.keyCode == 13) {
				        self.search(input.val()).draw();
				    }
				});
		    },
	        "ajax" : {
		     	url:base_url+'/admin/products/list',
		     	type:"GET"
		    },
	        
	        columns: [
	        	{ 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.name;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.sku;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.category.name;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		if(full.type == 0)
	              			return 'Single';
	              		else if(full.type == 1)
	              			return 'Configurable';
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return '<img src="'+storage_url+'/'+full.thumbnail+'" width="60">';
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		if(full.is_active == 1)
	              			return 'Active';
	              		else
	              			return 'Inactive';
	              	}
	            }
	        ],
	        "columnDefs": [
	            {
	            	 width: '300',
	                "targets": 6,
	                "visible": true,
	                "render": function (data, type, full) { 
	 					var td = '<div class="d-flex"><a title="Edit" href="'+base_url+'/admin/products/edit/'+full.id+'"><i class="i-Pen-2 nav-icon"></i></i></a>&nbsp&nbsp&nbsp<a title="Delete" href="'+base_url+'/admin/products/delete/'+full.id+'"><i class="las la-trash" style="font-size:14px"></i></i></a>';

	 					if(full.type == 1)
	 						td += '&nbsp&nbsp&nbsp<a title="Varients" href="'+base_url+'/admin/products/varient/'+full.id+'"><i class="las la-eye" style="font-size:15px"></i></i></a>';
	 					else
	 						td += '&nbsp&nbsp&nbsp<a title="Reviews" href="'+base_url+'/admin/products/reviews/'+full.id+'"><i class="las la-comment" style="font-size:15px"></i></i></a>&nbsp&nbsp&nbsp<a title="Faq" href="'+base_url+'/admin/products/faq/'+full.id+'"><i class="las la-question" style="font-size:15px"></i></i></a>&nbsp&nbsp&nbsp<a target="_blank" title="Front detail page" href="'+base_url+'/products/detail/'+full.slug+'"><i class="las la-play" style="font-size:15px"></i></i></a>';

	 					td += '</div>';

	 					return td;
	                
	                }
	            }
	         ],
	        createdRow: function(row, data, dataIndex) 
	        {
	            setTimeout(function()
	            {

	            	$('#products_table tbody').addClass("m-datatable__body");
	            	$('#products_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
	            	$('#products_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
	            	$('#products_table td').addClass("m-datatable__cell");
	            	$('#products_table_filter input').addClass("form-control m-input");

	            	$('#products_table tr').css('table-layout','fixed');
	            });
	        }
	    });
	}

	$('.product_type').click(function()
	{
		var type = $(this).val();

		if(type == 1)
		{
			$('.not_configurable').addClass('hide');

			$('.not_configurable').children('input').removeAttr('required');
			$('.not_configurable').children('textarea').removeAttr('required');
			$('.not_configurable').children('.form-check').children('label').find('input').removeAttr('required');
			$('#image_upload').removeAttr('required');

			$('.attributes_div').html('');
			$('.attributes_wrapper').addClass('hide');

			$('#multiple_upload').removeAttr('required');
		}
		else
		{
			$('.not_configurable').removeClass('hide');

			$('.not_configurable').children('input').attr('required','required');
			$('.not_configurable').children('textarea').attr('required','required');
			$('.not_configurable').children('.form-check').children('label').find('input').attr('required','required');
			$('#image_upload').attr('required','required');

			$('.attributes_wrapper').removeClass('hide');

			$('#multiple_upload').attr('required','required');

			addAttributes();

		}
	});

	function addAttributes()
	{
		var category_id = $('#category_id').find(':selected').val();

		$.ajax({
		    type: "GET",
		    url: base_url+'/admin/products/getCategoryAttributes/'+category_id,
		    processData: false,
			contentType: false,
		    success: function(result) 
		    {
		    	result = $.parseJSON(result);

		    	var td = '';
		    	
		    	$.each(result,function(index,value)
		    	{
		    		td += '<div class="col-md-6 form-group mb-3 not_configurable"><label>'+value.attribute.name+'*</label><input class="form-control" type="text" placeholder="Enter '+value.attribute.name+'" name="attribute['+value.attribute.id+']" required=""></div>';
		    	});

		    	$('.attributes_div').html(td);

		    	if(td == '')
		    		$('.attributes_wrapper').addClass('hide');
		    }
		});
	}


	$('#category_id').change(function()
	{
		$('.attributes_wrapper').removeClass('hide');
		addAttributes();
	});


	if($('#product_varient_table').length > 0)
	{
		$('#product_varient_table').DataTable({
			language: { search: '', searchPlaceholder: "Search..." },
	        processing: true,
	        serverSide: true,
	        pageLength: 50,
	        "dom": "lifrtp",
	        initComplete : function() {
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
			       if(e.keyCode == 13) {
				        self.search(input.val()).draw();
				    }
				});
		    },
	        "ajax" : {
		     	url:base_url+'/admin/products/varientList?product_id='+$('#product_id').val(),
		     	type:"GET"
		    },
	        
	        columns: [
	        	{ 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.name;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.sku;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.offer_price;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return '<img src="'+storage_url+'/'+full.thumbnail+'" width="60">';
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		if(full.is_active == 1)
	              			return 'Active';
	              		else
	              			return 'Inactive';
	              	}
	            }
	        ],
	        "columnDefs": [
	            {
	            	 width: '300',
	                "targets": 5,
	                "visible": true,
	                "render": function (data, type, full) { 
	 					var td = '<div class="d-flex"><a title="Edit" href="'+base_url+'/admin/products/varient/edit/'+full.id+'"><i class="i-Pen-2 nav-icon"></i></i></a>&nbsp&nbsp&nbsp<a title="Delete" href="'+base_url+'/admin/products/varient/delete/'+full.id+'"><i class="las la-trash" style="font-size:14px"></i></i></a>&nbsp&nbsp&nbsp<a title="Reviews" href="'+base_url+'/admin/products/reviews/'+full.id+'"><i class="las la-comment" style="font-size:15px"></i></i></a>&nbsp&nbsp&nbsp<a title="Faq" href="'+base_url+'/admin/products/faq/'+full.id+'"><i class="las la-question" style="font-size:15px"></i></i></a>&nbsp&nbsp&nbsp<a target="_blank" title="Front detail page" href="'+base_url+'/products/detail/'+full.slug+'"><i class="las la-play" style="font-size:15px"></i></i></a></div>';

	 					return td;
	                
	                }
	            }
	         ],
	        createdRow: function(row, data, dataIndex) 
	        {
	            setTimeout(function()
	            {

	            	$('#product_varient_table tbody').addClass("m-datatable__body");
	            	$('#product_varient_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
	            	$('#product_varient_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
	            	$('#product_varient_table td').addClass("m-datatable__cell");
	            	$('#product_varient_table_filter input').addClass("form-control m-input");

	            	$('#product_varient_table tr').css('table-layout','fixed');
	            });
	        }
	    });
	}

	if($('#support_table').length > 0)
	{
		$('#support_table').DataTable({
			language: { search: '', searchPlaceholder: "Search..." },
	        processing: true,
	        serverSide: true,
	        pageLength: 50,
	        "dom": "lifrtp",
	        initComplete : function() {
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
				       if(e.keyCode == 13) {
					        self.search(input.val()).draw();
					    }
					});
			    },
	        ajax: base_url+'/admin/support-options/list',
	        columns: [
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.name;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return '<img class="m-1" src="'+storage_url+'/'+full.icon+'" width="40">';
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		if(full.description != null && full.description.length > 100)
	              			return '<p title="'+full.description+'">'+full.description.substring(0, 100) + '...</p>';
	              		else
	              			return full.description;
	              	}
	            }
	        ],
	        "columnDefs": [
	            {
	            	 width: '300',
	                "targets": 3,
	                "visible": true,
	                "render": function (data, type, full) { 
	 				 	var td = '<div class="d-flex"><a title="Edit" href="'+base_url+'/admin/support-options/edit/'+full.id+'"><i class="nav-icon i-Pen-2"></i></i></a>';

	 				 	if(full.products.length == 0)
	 				 		td += '&nbsp;&nbsp;&nbsp<a title="Delete" href="'+base_url+'/admin/support-options/delete/'+full.id+'"><i class="las la-trash" style="font-size:14px"></i></i></a>';

	 				 	td += '</div>';

	 				 	return td;
	                
	                }
	            }
	         ],
	        createdRow: function(row, data, dataIndex) 
	        {
	            setTimeout(function()
	            {

	            	$('#support_table tbody').addClass("m-datatable__body");
	            	$('#support_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
	            	$('#support_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
	            	$('#support_table td').addClass("m-datatable__cell");
	            	$('#support_table_filter input').addClass("form-control m-input");

	            	$('#support_table tr').css('table-layout','fixed');
	            });
	        }
	    });
	}


	if($('#product_support_table').length > 0)
	{
		$('#product_support_table').DataTable({
			language: { search: '', searchPlaceholder: "Search..." },
	        processing: true,
	        serverSide: true,
	        pageLength: 50,
	        "dom": "lifrtp",
	        initComplete : function() {
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
				       if(e.keyCode == 13) {
					        self.search(input.val()).draw();
					    }
					});
			    },
	        ajax: base_url+'/admin/products/supportList?product_id='+$('#product_id').val(),
	        columns: [
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.support.name;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		if(full.type == 1)
	              			return '<img class="m-1" src="'+storage_url+'/'+full.value+'" width="40">';
	              		else if(full.type == 0)
	              			return full.value;
	              		else
	              			return '<a href="'+storage_url+'/'+full.value+'" target="_blank">File</a>';
	              	}
	            }
	        ],
	        "columnDefs": [
	            {
	            	 width: '300',
	                "targets": 2,
	                "visible": true,
	                "render": function (data, type, full) { 
	 				 	var td = '<div class="d-flex"><a title="Edit" href="'+base_url+'/admin/products/support/edit/'+full.id+'"><i class="nav-icon i-Pen-2"></i></i></a>&nbsp;&nbsp;&nbsp<a title="Delete" href="'+base_url+'/admin/products/support/delete/'+full.id+'"><i class="las la-trash" style="font-size:14px"></i></i></a></div>';

	 				 	return td;
	                
	                }
	            }
	         ],
	        createdRow: function(row, data, dataIndex) 
	        {
	            setTimeout(function()
	            {

	            	$('#product_support_table tbody').addClass("m-datatable__body");
	            	$('#product_support_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
	            	$('#product_support_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
	            	$('#product_support_table td').addClass("m-datatable__cell");
	            	$('#product_support_table_filter input').addClass("form-control m-input");

	            	$('#product_support_table tr').css('table-layout','fixed');
	            });
	        }
	    });
	}


	$('#support_type').change(function()
	{
		var value = $(this).val();

		if(value == 0)
		{
			$('#support_value').attr('type','text');
			$('#support_value').removeAttr('accept');
		}
		else if(value == 1)
		{
			$('#support_value').attr('type','file');
			$('#support_value').attr('accept','.jpeg,.jpg,.png,.gif');
		}
		else
		{
			$('#support_value').attr('type','file');
			$('#support_value').removeAttr('accept');
		}
	});


	if($('#product_reviews_table').length > 0)
	{
		$('#product_reviews_table').DataTable({
			language: { search: '', searchPlaceholder: "Search..." },
	        processing: true,
	        serverSide: true,
	        pageLength: 50,
	        "dom": "lifrtp",
	        initComplete : function() {
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
				       if(e.keyCode == 13) {
					        self.search(input.val()).draw();
					    }
					});
			    },
	        ajax: base_url+'/admin/products/reviewsList?product_id='+$('#product_id').val(),
	        columns: [
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.name;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		if(full.image == '' || full.image == null)
	              			return '---';
	              		else
	              			return '<img class="m-1" src="'+storage_url+'/'+full.image+'" width="40">';
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.title;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.rating;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		if(full.review != null && full.review.length > 100)
	              			return '<p title="'+full.review+'">'+full.review.substring(0, 100) + '...</p>';
	              		else
	              			return full.review;
	              	}
	            }
	        ],
	        "columnDefs": [
	            {
	            	 width: '300',
	                "targets": 5,
	                "visible": true,
	                "render": function (data, type, full) { 
	 				 	var td = '<div class="d-flex"><a title="Edit" href="'+base_url+'/admin/products/reviews/edit/'+full.id+'"><i class="nav-icon i-Pen-2"></i></i></a>&nbsp;&nbsp;&nbsp<a title="Delete" href="'+base_url+'/admin/products/reviews/delete/'+full.id+'"><i class="las la-trash" style="font-size:14px"></i></i></a></div>';

	 				 	return td;
	                
	                }
	            }
	         ],
	        createdRow: function(row, data, dataIndex) 
	        {
	            setTimeout(function()
	            {

	            	$('#product_reviews_table tbody').addClass("m-datatable__body");
	            	$('#product_reviews_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
	            	$('#product_reviews_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
	            	$('#product_reviews_table td').addClass("m-datatable__cell");
	            	$('#product_reviews_table_filter input').addClass("form-control m-input");

	            	$('#product_reviews_table tr').css('table-layout','fixed');
	            });
	        }
	    });
	}


	if($('#product_faq_table').length > 0)
	{
		$('#product_faq_table').DataTable({
			language: { search: '', searchPlaceholder: "Search..." },
	        processing: true,
	        serverSide: true,
	        pageLength: 50,
	        "dom": "lifrtp",
	        initComplete : function() {
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
				       if(e.keyCode == 13) {
					        self.search(input.val()).draw();
					    }
					});
			    },
	        ajax: base_url+'/admin/products/faqList?product_id='+$('#product_id').val(),
	        columns: [
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.question;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		if(full.answer != null && full.answer.length > 100)
	              			return '<p title="'+full.answer+'">'+full.answer.substring(0, 100) + '...</p>';
	              		else
	              			return full.answer;
	              	}
	            }
	        ],
	        "columnDefs": [
	            {
	            	 width: '300',
	                "targets": 2,
	                "visible": true,
	                "render": function (data, type, full) { 
	 				 	var td = '<div class="d-flex"><a title="Edit" href="'+base_url+'/admin/products/faq/edit/'+full.id+'"><i class="nav-icon i-Pen-2"></i></i></a>&nbsp;&nbsp;&nbsp<a title="Delete" href="'+base_url+'/admin/products/faq/delete/'+full.id+'"><i class="las la-trash" style="font-size:14px"></i></i></a></div>';

	 				 	return td;
	                
	                }
	            }
	         ],
	        createdRow: function(row, data, dataIndex) 
	        {
	            setTimeout(function()
	            {

	            	$('#product_faq_table tbody').addClass("m-datatable__body");
	            	$('#product_faq_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
	            	$('#product_faq_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
	            	$('#product_faq_table td').addClass("m-datatable__cell");
	            	$('#product_faq_table_filter input').addClass("form-control m-input");

	            	$('#product_faq_table tr').css('table-layout','fixed');
	            });
	        }
	    });
	}


	if($('#homepage_list_table').length > 0)
	{
		$('#homepage_list_table').DataTable({
			language: { search: '', searchPlaceholder: "Search..." },
	        processing: true,
	        serverSide: true,
	        pageLength: 50,
	        "dom": "lifrtp",
	        initComplete : function() {
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
				       if(e.keyCode == 13) {
					        self.search(input.val()).draw();
					    }
					});
			    },
	        ajax: base_url+'/admin/homePage/detailList?type='+$('#type').val(),
	        columns: [
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		if(full.type == 1)
	              			return full.categories.name;
	              		else
	              			return full.products.name;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		if(full.type == 1)
	              			return '<img class="black_bckgrnd" src="'+storage_url+'/'+full.image+'" width="60" height="60">';
	              		else
	              			return '---';
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.position;
	              	}
	            }
	        ],
	        "columnDefs": [
	            {
	            	 width: '300',
	                "targets": 3,
	                "visible": true,
	                 "render": function (data, type, full) { 
	                 	if($('#type').val() == 1)
	 						return '<a href="'+base_url+'/admin/homePage/edit/'+full.id+'" title="Edit"><i class="nav-icon i-Pen-2"></i></i></a>';
	 					else
	 						return '<a href="'+base_url+'/admin/homePage/delete/'+full.id+'" title="Delete"><i class="las la-trash" style="font-size:14px"></i></i></a>';
	                
	                }
	            }
	         ],
	        createdRow: function(row, data, dataIndex) 
	        {
	            setTimeout(function()
	            {

	            	$('#homepage_list_table tbody').addClass("m-datatable__body");
	            	$('#homepage_list_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
	            	$('#homepage_list_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
	            	$('#homepage_list_table td').addClass("m-datatable__cell");
	            	$('#homepage_list_table_filter input').addClass("form-control m-input");

	            	$('#homepage_list_table tr').css('table-layout','fixed');
	            });
	        }
	    });
	}

	if($('#offer_table').length > 0)
	{
		$('#offer_table').DataTable({
			language: { search: '', searchPlaceholder: "Search..." },
	        processing: true,
	        serverSide: true,
	        pageLength: 50,
	        "dom": "lifrtp",
	        initComplete : function() {
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
			       if(e.keyCode == 13) {
				        self.search(input.val()).draw();
				    }
				});
		    },
	        ajax: base_url+'/admin/offers/list',
	        columns: [
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.products.name;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.from_date;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.to_date;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.title;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.sub_title;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		if(full.type == 0)
	              			return 'Without Form';
	              		else
	              			return 'With Form';
	              	}
	            }
	        ],
	        "columnDefs": [
	            {
	            	 width: '300',
	                "targets": 6,
	                "visible": true,
	                 "render": function (data, type, full) { 
	                 	return '<div class="d-flex"><a title="Edit" href="'+base_url+'/admin/offers/edit/'+full.id+'"><i class="nav-icon i-Pen-2"></i></i></a>&nbsp;&nbsp;&nbsp<a title="Delete" href="'+base_url+'/admin/offers/delete/'+full.id+'"><i class="las la-trash" style="font-size:14px"></i></i></a></div>';
	                }
	            }
	         ],
	        createdRow: function(row, data, dataIndex) 
	        {
	            setTimeout(function()
	            {

	            	$('#offer_table tbody').addClass("m-datatable__body");
	            	$('#offer_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
	            	$('#offer_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
	            	$('#offer_table td').addClass("m-datatable__cell");
	            	$('#offer_table_filter input').addClass("form-control m-input");

	            	$('#offer_table tr').css('table-layout','fixed');
	            });
	        }
	    });
	}

	if($('#offer_interest_table').length > 0)
	{
		$('#offer_interest_table').DataTable({
			language: { search: '', searchPlaceholder: "Search..." },
	        processing: true,
	        serverSide: true,
	        pageLength: 50,
	        "dom": "lifrtp",
	        initComplete : function() {
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
			       if(e.keyCode == 13) {
				        self.search(input.val()).draw();
				    }
				});
		    },
	        ajax: base_url+'/admin/offers/interestList',
	        columns: [
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return '<a href="'+base_url+'/admin/offers/edit/'+full.offer_id+'">'+full.offer.products.name+'</a>';
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.first_name+' '+full.last_name;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.email;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.phone;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.state;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.city;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.change_date;
	              	}
	            }
	        ],
	        createdRow: function(row, data, dataIndex) 
	        {
	            setTimeout(function()
	            {

	            	$('#offer_interest_table tbody').addClass("m-datatable__body");
	            	$('#offer_interest_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
	            	$('#offer_interest_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
	            	$('#offer_interest_table td').addClass("m-datatable__cell");
	            	$('#offer_interest_table_filter input').addClass("form-control m-input");

	            	$('#offer_interest_table tr').css('table-layout','fixed');
	            });
	        }
	    });
	}

	$('#from_date').change(function()
	{
		var value = $(this).val();

		$('#to_date').attr('min',value);
	});

	$('#image_upload').change(function(e)
	{
		var input = this;

		if (input.files && input.files[0]) {
	        var reader = new FileReader();

	        reader.onload = function (e) {

	            $('#imagePreview').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	});

	$('#multiple_upload').change(function(e)
	{
		var input = this.files;
		var images = '';
		$('.image_preview_wrapper').html();

		$.each(input,function(index,value)
		{
			var reader = new FileReader();

	        reader.onload = function (e) 
	        {
	        	images = '<div class="cl-img-wrap"><img src="'+e.target.result+'" width="50"></div>';

	        	$('.image_preview_wrapper').append(images);
	        }
	        reader.readAsDataURL(value);
		});
	});

	$('#max_price').keyup(function()
	{
		var value = $(this).val();

		$('#offer_price').attr('max',(value-1));
	});

	$('body').on('focus', '#offer_price', function (e) 
	{
		$(this).on('wheel.disableScroll', function (e) {
		    e.preventDefault();
		})
	});

	$('body').on('blur', '#offer_price', function (e) 
	{
	  	$(this).off('wheel.disableScroll')
	});


	if($('#stores_table').length > 0)
	{
		$('#stores_table').DataTable({
			language: { search: '', searchPlaceholder: "Search..." },
	        processing: true,
	        serverSide: true,
	        pageLength: 50,
	        "dom": "lifrtp",
	        initComplete : function() {
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
			       if(e.keyCode == 13) {
				        self.search(input.val()).draw();
				    }
				});
		    },
	        ajax: base_url+'/admin/stores/list',
	        columns: [
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.title;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.description;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.email;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.mobile;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.open_hour;
	              	}
	            }
	        ],
	        "columnDefs": [
	            {
	            	 width: '300',
	                "targets": 5,
	                "visible": true,
	                 "render": function (data, type, full) { 
	                 	return '<div class="d-flex"><a title="Edit" href="'+base_url+'/admin/stores/edit/'+full.id+'"><i class="nav-icon i-Pen-2"></i></i></a>&nbsp;&nbsp;&nbsp<a title="Delete" href="'+base_url+'/admin/stores/delete/'+full.id+'"><i class="las la-trash" style="font-size:14px"></i></i></a></div>';
	                }
	            }
	         ],
	        createdRow: function(row, data, dataIndex) 
	        {
	            setTimeout(function()
	            {

	            	$('#stores_table tbody').addClass("m-datatable__body");
	            	$('#stores_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
	            	$('#stores_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
	            	$('#stores_table td').addClass("m-datatable__cell");
	            	$('#stores_table_filter input').addClass("form-control m-input");

	            	$('#stores_table tr').css('table-layout','fixed');
	            });
	        }
	    });
	}


	if($('#service_table').length > 0)
	{
		$('#service_table').DataTable({
			language: { search: '', searchPlaceholder: "Search..." },
	        processing: true,
	        serverSide: true,
	        pageLength: 50,
	        "dom": "lifrtp",
	        initComplete : function() {
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
			       if(e.keyCode == 13) {
				        self.search(input.val()).draw();
				    }
				});
		    },
	        ajax: base_url+'/admin/service/list',
	        columns: [
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.first_name+' '+full.last_name;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.mobile;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.product.name;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.model_number;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.service_type;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.complaint_id;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.reference_number;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		if(full.request_status.length == 0)
	              			return 'New';
	              		else
	              			return full.request_status[0].status;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return '<div class="d-flex"><a title="View" href="'+base_url+'/admin/service/view/'+full.id+'"><i class="las la-eye" style="font-size:14px"></i></i></a></div>';
	              	}
	            }
	        ],
	        createdRow: function(row, data, dataIndex) 
	        {
	            setTimeout(function()
	            {

	            	$('#service_table tbody').addClass("m-datatable__body");
	            	$('#service_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
	            	$('#service_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
	            	$('#service_table td').addClass("m-datatable__cell");
	            	$('#service_table_filter input').addClass("form-control m-input");

	            	$('#service_table tr').css('table-layout','fixed');
	            });
	        }
	    });
	}


	if($('#center_table').length > 0)
	{
		$('#center_table').DataTable({
			language: { search: '', searchPlaceholder: "Search..." },
	        processing: true,
	        serverSide: true,
	        pageLength: 50,
	        "dom": "lifrtp",
	        initComplete : function() {
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
			       if(e.keyCode == 13) {
				        self.search(input.val()).draw();
				    }
				});
		    },
	        ajax: base_url+'/admin/serviceCenters/list',
	        columns: [
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.title;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.description;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.email;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.mobile;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.open_hour;
	              	}
	            }
	        ],
	        "columnDefs": [
	            {
	            	 width: '300',
	                "targets": 5,
	                "visible": true,
	                 "render": function (data, type, full) { 
	                 	return '<div class="d-flex"><a title="Edit" href="'+base_url+'/admin/serviceCenters/edit/'+full.id+'"><i class="nav-icon i-Pen-2"></i></i></a>&nbsp;&nbsp;&nbsp<a title="Delete" href="'+base_url+'/admin/serviceCenters/delete/'+full.id+'"><i class="las la-trash" style="font-size:14px"></i></i></a></div>';
	                }
	            }
	         ],
	        createdRow: function(row, data, dataIndex) 
	        {
	            setTimeout(function()
	            {

	            	$('#center_table tbody').addClass("m-datatable__body");
	            	$('#center_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
	            	$('#center_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
	            	$('#center_table td').addClass("m-datatable__cell");
	            	$('#center_table_filter input').addClass("form-control m-input");

	            	$('#center_table tr').css('table-layout','fixed');
	            });
	        }
	    });
	}


	if($('#product_registered_table').length > 0)
	{
		$('#product_registered_table').DataTable({
			language: { search: '', searchPlaceholder: "Search..." },
	        processing: true,
	        serverSide: true,
	        pageLength: 50,
	        "dom": "lifrtp",
	        initComplete : function() {
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
			       if(e.keyCode == 13) {
				        self.search(input.val()).draw();
				    }
				});
		    },
	        ajax: base_url+'/admin/products/registeredList',
	        columns: [
	            {
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.first_name+' '+full.last_name;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.mobile;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.product.name;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.model_number;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.serial_number;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return '<div class="d-flex"><a title="View" href="'+base_url+'/admin/products/registered/'+full.id+'"><i class="las la-eye" style="font-size:14px"></i></i></a></div>';
	              	}
	            }
	        ],
	        createdRow: function(row, data, dataIndex) 
	        {
	            setTimeout(function()
	            {

	            	$('#product_registered_table tbody').addClass("m-datatable__body");
	            	$('#product_registered_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
	            	$('#product_registered_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
	            	$('#product_registered_table td').addClass("m-datatable__cell");
	            	$('#product_registered_table_filter input').addClass("form-control m-input");

	            	$('#product_registered_table tr').css('table-layout','fixed');
	            });
	        }
	    });
	}


	if($('#manual_table').length > 0)
	{
		$('#manual_table').DataTable({
			language: { search: '', searchPlaceholder: "Search..." },
	        processing: true,
	        serverSide: true,
	        pageLength: 50,
	        "dom": "lifrtp",
	        initComplete : function() {
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
			       if(e.keyCode == 13) {
				        self.search(input.val()).draw();
				    }
				});
		    },
	        ajax: base_url+'/admin/user-manuals/list',
	        columns: [
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.product.name;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.title;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return '<img src="'+storage_url+'/'+full.thumbnail+'" width="50">';
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return '<a target="_blank" href="'+storage_url+'/'+full.manual+'"><img src="'+base_url+'/public/admins/images/pdf.png" width="30"></a>';
	              	}
	            }
	        ],
	        "columnDefs": [
	            {
	            	 width: '300',
	                "targets": 4,
	                "visible": true,
	                 "render": function (data, type, full) { 
	                 	return '<div class="d-flex"><a title="Edit" href="'+base_url+'/admin/user-manuals/edit/'+full.id+'"><i class="nav-icon i-Pen-2"></i></i></a>&nbsp;&nbsp;&nbsp<a title="Delete" href="'+base_url+'/admin/user-manuals/delete/'+full.id+'"><i class="las la-trash" style="font-size:14px"></i></i></a></div>';
	                }
	            }
	         ],
	        createdRow: function(row, data, dataIndex) 
	        {
	            setTimeout(function()
	            {

	            	$('#manual_table tbody').addClass("m-datatable__body");
	            	$('#manual_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
	            	$('#manual_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
	            	$('#manual_table td').addClass("m-datatable__cell");
	            	$('#manual_table_filter input').addClass("form-control m-input");

	            	$('#manual_table tr').css('table-layout','fixed');
	            });
	        }
	    });
	}


	if($('#faq_table').length > 0)
	{
		$('#faq_table').DataTable({
			language: { search: '', searchPlaceholder: "Search..." },
	        processing: true,
	        serverSide: true,
	        pageLength: 50,
	        "dom": "lifrtp",
	        initComplete : function() {
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
			       if(e.keyCode == 13) {
				        self.search(input.val()).draw();
				    }
				});
		    },
	        ajax: base_url+'/admin/faq/list',
	        columns: [
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.category.name;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.question;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.answer;
	              	}
	            }
	        ],
	        "columnDefs": [
	            {
	            	 width: '300',
	                "targets": 3,
	                "visible": true,
	                 "render": function (data, type, full) { 
	                 	return '<div class="d-flex"><a title="Edit" href="'+base_url+'/admin/faq/edit/'+full.id+'"><i class="nav-icon i-Pen-2"></i></i></a>&nbsp;&nbsp;&nbsp<a title="Delete" href="'+base_url+'/admin/faq/delete/'+full.id+'"><i class="las la-trash" style="font-size:14px"></i></i></a></div>';
	                }
	            }
	         ],
	        createdRow: function(row, data, dataIndex) 
	        {
	            setTimeout(function()
	            {

	            	$('#faq_table tbody').addClass("m-datatable__body");
	            	$('#faq_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
	            	$('#faq_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
	            	$('#faq_table td').addClass("m-datatable__cell");
	            	$('#faq_table_filter input').addClass("form-control m-input");

	            	$('#faq_table tr').css('table-layout','fixed');
	            });
	        }
	    });
	}

	if($('#pages_table').length > 0)
	{
		$('#pages_table').DataTable({
			language: { search: '', searchPlaceholder: "Search..." },
	        processing: true,
	        serverSide: true,
	        pageLength: 50,
	        "dom": "lifrtp",
	        initComplete : function() {
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
				       if(e.keyCode == 13) {
					        self.search(input.val()).draw();
					    }
					});
			    },
	        ajax: base_url+'/admin/pages/list',
	        columns: [
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.title;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		if(full.image == '' || full.image == null)
	              			return '';
	              		else
	              			return '<img src="'+storage_url+'/'+full.image+'" width="50">';
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		item = full.description;
	              		item = item.replace(/<(.|\n)*?>/g, '');

	              		if(item != null && item.length > 100)
	              			return item.substring(0, 100);
	              		else
	              			return item;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		if(full.status == 0)
	              			var tr = 'Inactive';
	              		else
	              			var tr = 'Active';

	              		return tr;
	              	}
	            }
	        ],
	        "columnDefs": [
	            {
	            	 width: '300',
	                "targets": 4,
	                "visible": true,
	                 "render": function (data, type, full) { 
	                 	return '<a href="'+base_url+'/admin/pages/edit/'+full.id+'"><i class="nav-icon i-Pen-2"></i></i></a>';
	                
	                }
	            }
	         ],
	        createdRow: function(row, data, dataIndex) 
	        {
	            setTimeout(function()
	            {

	            	$('#pages_table tbody').addClass("m-datatable__body");
	            	$('#pages_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
	            	$('#pages_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
	            	$('#pages_table td').addClass("m-datatable__cell");
	            	$('#pages_table_filter input').addClass("form-control m-input");

	            	$('#pages_table tr').css('table-layout','fixed');
	            });
	        }
	    });
	}

	if($('#milestone_table').length > 0)
	{
		$('#milestone_table').DataTable({
			language: { search: '', searchPlaceholder: "Search..." },
	        processing: true,
	        serverSide: true,
	        pageLength: 50,
	        "dom": "lifrtp",
	        initComplete : function() {
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
				       if(e.keyCode == 13) {
					        self.search(input.val()).draw();
					    }
					});
			    },
	        ajax: base_url+'/admin/milestones/list',
	        columns: [
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.year;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.milestone;
	              	}
	            }
	        ],
	        "columnDefs": [
	            {
	            	 width: '300',
	                "targets": 2,
	                "visible": true,
	                 "render": function (data, type, full) { 
	                 	return '<div class="d-flex"><a title="Edit" href="'+base_url+'/admin/milestones/edit/'+full.id+'"><i class="nav-icon i-Pen-2"></i></i></a>&nbsp;&nbsp;&nbsp<a title="Delete" href="'+base_url+'/admin/milestones/delete/'+full.id+'"><i class="las la-trash" style="font-size:14px"></i></i></a></div>';
	                
	                }
	            }
	         ],
	        createdRow: function(row, data, dataIndex) 
	        {
	            setTimeout(function()
	            {

	            	$('#milestone_table tbody').addClass("m-datatable__body");
	            	$('#milestone_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
	            	$('#milestone_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
	            	$('#milestone_table td').addClass("m-datatable__cell");
	            	$('#milestone_table_filter input').addClass("form-control m-input");

	            	$('#milestone_table tr').css('table-layout','fixed');
	            });
	        }
	    });
	}

	if($('#awards_table').length > 0)
	{
		$('#awards_table').DataTable({
			language: { search: '', searchPlaceholder: "Search..." },
	        processing: true,
	        serverSide: true,
	        pageLength: 50,
	        "dom": "lifrtp",
	        initComplete : function() {
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
				       if(e.keyCode == 13) {
					        self.search(input.val()).draw();
					    }
					});
			    },
	        ajax: base_url+'/admin/awards/list',
	        columns: [
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.title;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		if(full.image == '' || full.image == null)
	              			return '';
	              		else
	              			return '<img src="'+storage_url+'/'+full.image+'" width="50">';
	              	}
	            }
	        ],
	        "columnDefs": [
	            {
	            	 width: '300',
	                "targets": 2,
	                "visible": true,
	                 "render": function (data, type, full) { 
	                 	return '<div class="d-flex"><a title="Edit" href="'+base_url+'/admin/awards/edit/'+full.id+'"><i class="nav-icon i-Pen-2"></i></i></a>&nbsp;&nbsp;&nbsp<a title="Delete" href="'+base_url+'/admin/awards/delete/'+full.id+'"><i class="las la-trash" style="font-size:14px"></i></i></a></div>';
	                
	                }
	            }
	         ],
	        createdRow: function(row, data, dataIndex) 
	        {
	            setTimeout(function()
	            {

	            	$('#awards_table tbody').addClass("m-datatable__body");
	            	$('#awards_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
	            	$('#awards_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
	            	$('#awards_table td').addClass("m-datatable__cell");
	            	$('#awards_table_filter input').addClass("form-control m-input");

	            	$('#awards_table tr').css('table-layout','fixed');
	            });
	        }
	    });
	}

	if($('#management_table').length > 0)
	{
		$('#management_table').DataTable({
			language: { search: '', searchPlaceholder: "Search..." },
	        processing: true,
	        serverSide: true,
	        pageLength: 50,
	        "dom": "lifrtp",
	        initComplete : function() {
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
				       if(e.keyCode == 13) {
					        self.search(input.val()).draw();
					    }
					});
			    },
	        ajax: base_url+'/admin/managements/list',
	        columns: [
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.title;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.position;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		if(full.image == '' || full.image == null)
	              			return '';
	              		else
	              			return '<img src="'+storage_url+'/'+full.image+'" width="50">';
	              	}
	            }
	        ],
	        "columnDefs": [
	            {
	            	 width: '300',
	                "targets": 3,
	                "visible": true,
	                 "render": function (data, type, full) { 
	                 	return '<div class="d-flex"><a title="Edit" href="'+base_url+'/admin/managements/edit/'+full.id+'"><i class="nav-icon i-Pen-2"></i></i></a>&nbsp;&nbsp;&nbsp<a title="Delete" href="'+base_url+'/admin/managements/delete/'+full.id+'"><i class="las la-trash" style="font-size:14px"></i></i></a></div>';
	                
	                }
	            }
	         ],
	        createdRow: function(row, data, dataIndex) 
	        {
	            setTimeout(function()
	            {

	            	$('#management_table tbody').addClass("m-datatable__body");
	            	$('#management_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
	            	$('#management_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
	            	$('#management_table td').addClass("m-datatable__cell");
	            	$('#management_table_filter input').addClass("form-control m-input");

	            	$('#management_table tr').css('table-layout','fixed');
	            });
	        }
	    });
	}


	if($('#service_feedback_table').length > 0)
	{
		$('#service_feedback_table').DataTable({
			language: { search: '', searchPlaceholder: "Search..." },
	        processing: true,
	        serverSide: true,
	        pageLength: 50,
	        "dom": "lifrtp",
	        initComplete : function() {
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
			       if(e.keyCode == 13) {
				        self.search(input.val()).draw();
				    }
				});
		    },
	        ajax: base_url+'/admin/service/feedbackList',
	        columns: [
	            {
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.first_name+' '+full.last_name;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.mobile;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.case_number;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		if(full.is_fixed == 1)
	              			return 'Yes';
	              		else
	              			return 'No';
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		if(full.rating == 1)
	              			return 'Very Bad';
	              		else if(full.rating == 2)
	              			return 'Bad';
	              		else if(full.rating == 3)
	              			return 'Average';
	              		else if(full.rating == 4)
	              			return 'Good';
	              		else
	              			return 'Very Good';
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return '<div class="d-flex"><a title="View" href="'+base_url+'/admin/service/feedback/'+full.id+'"><i class="las la-eye" style="font-size:14px"></i></i></a></div>';
	              	}
	            }
	        ],
	        createdRow: function(row, data, dataIndex) 
	        {
	            setTimeout(function()
	            {

	            	$('#service_feedback_table tbody').addClass("m-datatable__body");
	            	$('#service_feedback_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
	            	$('#service_feedback_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
	            	$('#service_feedback_table td').addClass("m-datatable__cell");
	            	$('#service_feedback_table_filter input').addClass("form-control m-input");

	            	$('#service_feedback_table tr').css('table-layout','fixed');
	            });
	        }
	    });
	}

	if($('#product_feedback_table').length > 0)
	{
		$('#product_feedback_table').DataTable({
			language: { search: '', searchPlaceholder: "Search..." },
	        processing: true,
	        serverSide: true,
	        pageLength: 50,
	        "dom": "lifrtp",
	        initComplete : function() {
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
			       if(e.keyCode == 13) {
				        self.search(input.val()).draw();
				    }
				});
		    },
	        ajax: base_url+'/admin/products/feedbackList',
	        columns: [
	            {
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.first_name+' '+full.last_name;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.mobile;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.product.name;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.category.name;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return full.serial_number;
	              	}
	            },
	            { 
	            	orderable: false,
	            	data: "null",
	            	width: '300',
	            	autoWidth: false,
	              	render : function(data,type,full) {
	              		return '<div class="d-flex"><a title="View" href="'+base_url+'/admin/products/feedback/'+full.id+'"><i class="las la-eye" style="font-size:14px"></i></i></a></div>';
	              	}
	            }
	        ],
	        createdRow: function(row, data, dataIndex) 
	        {
	            setTimeout(function()
	            {

	            	$('#product_feedback_table tbody').addClass("m-datatable__body");
	            	$('#product_feedback_table tbody tr:odd').addClass("m-datatable__row m-datatable__row--odd");
	            	$('#product_feedback_table tbody tr:even').addClass("m-datatable__row m-datatable__row--even");
	            	$('#product_feedback_table td').addClass("m-datatable__cell");
	            	$('#product_feedback_table_filter input').addClass("form-control m-input");

	            	$('#product_feedback_table tr').css('table-layout','fixed');
	            });
	        }
	    });
	}

});
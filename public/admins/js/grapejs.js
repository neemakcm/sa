var editor = grapesjs.init({
    height: '600px',
    showOffsets: 1,
    noticeOnUnload: 0,
    storageManager: { autoload: 0 },
    container: '#gjs',
    fromElement: true,
    showDevices: false,
    plugins: ['grapesjs-blocks-bootstrap4'],
    pluginsOpts: {
        'grapesjs-blocks-bootstrap4': {
            blocks: {},
            blockCategories: {},
            labels: {},
            gridDevicesPanel: true,
            formPredefinedActions: [
                {name: 'Contact', value: '/contact'},
                {name: 'landing', value: '/landing'},
            ]
        }
    },
    canvas: {
        styles: [
            'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css',
            base_url+'/public/admins/css/template-style.css'
        ],
        scripts: [
            'https://code.jquery.com/jquery-3.5.1.slim.min.js',
            'https://unpkg.com/@popperjs/core@2',
            'https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js'
        ],
    },
    assetManager: {
        storageType     : '',
        storeOnChange  : true,
        storeAfterUpload  : true,
        upload: storage_url+'/product_overview',
        assets      : [ ],
        uploadFile: function(e) {
            var files = e.dataTransfer ? e.dataTransfer.files : e.target.files;
            var formData = new FormData();
            formData.append('_token', $('input[name="_token"]').val());
            for(var i in files){
                    formData.append('file-'+i, files[i]) //containing all the selected images from local
            }
            $.ajax({
                url: base_url + '/imageUploadOverview',
                type: 'POST',
                data: formData,
                contentType:false,
                crossDomain: true,
                dataType: 'json',
                mimeType: "multipart/form-data",
                processData:false,
                success: function(result){
                    var myJSON = [];
                    $.each( result['data'], function( key, value ) {
                            myJSON[key] = value;    
                    });
                    var images = myJSON;    
                    editor.AssetManager.add(images);
                }
            });
        },
    }
});
window.editor = editor;


var pnm = editor.Panels;
pnm.addButton('options', [{
        id: 'clean-all',
        className: 'fa fa-trash icon-blank',
        command: function (editor, sender) {
            if (sender) sender.set('active', false);
            if (confirm('Are you sure to clean the canvas?')) {
                editor.DomComponents.clear();
                setTimeout(function () {
                    localStorage.setItem('gjs-assets', '');
                    localStorage.setItem('gjs-components', '');
                    localStorage.setItem('gjs-html', '');
                    localStorage.setItem('gjs-css', '');
                    localStorage.setItem('gjs-styles', '');
                }, 0);
            }
        },
        attributes: {
            title: 'Empty canvas'
        }
    }
]);


var blockManager = editor.BlockManager;

blockManager.add('content', {
  label:    '<img src="'+base_url+'/public/admins/plugin/grapejs/src/icons/impex/content.png" style="padding:10px"><div>Content</div>',
  category: 'Section',
  content: '<section class="main-heading">'
                + '<div class="container">'
                + '<div class="row">'
                + '<div class="col-md-12 mx-auto">'
                + '<h1>The Real 4K TV for all your entertainment needs</h1>'
                + '<p class="text font-regular ">LG UHD TV was made to entertain by taking everything you watch to a new level. Whether its cinema, sports, or games, it delivers real 4K images with vivid color and fine detail. Enjoy more realistic images in four times the resolution of Full HD.</p>'
                + '</div>'
                + '</div>'
                + '</div>'
                + '</section>',
});

blockManager.add('2 image block', {
  label:    '<img src="'+base_url+'/public/admins/plugin/grapejs/src/icons/impex/2image.png" style="padding:10px"><div>2 image block</div>',
  category: 'Section',
  content: '<section class="left-side-image">'
                + '<div class="position-relative">'
                + '<div class="fixed-image-layer d-none d-lg-block">'
                + '<img src="http://via.placeholder.com/740x412/BF00FF/ffffff/" class="img-fluid left_image_big fit-image" alt="image">'
                + '</div>'
                + '<div class="container">'
                + '<div class="row">'
                + '<div class="col-lg-6 d-lg-none mb-4">'
                + '<img src="http://via.placeholder.com/740x412/BF00FF/ffffff/" class="img-fluid left_image_small fit-image" alt="image">'
                + '</div>'
                + '<div class="col-lg-6 ml-auto">'
                + '<div class="about-program__content">'
                + '<h6 class="about-program__sub-title">'
                + 'FILMMAKER MODE™'
                + '</h6>'
                + '<h6 class="about-program__title">'
                + 'Watch content as the creator intended'
                + '</h6>'
                + '<p class="about-program__desc">'
                + 'The processor automatically turns off motion smoothing for the full motion picture effect. Watch films and other content with the creative intent and cinematic experience preserved.'
                + '</p>'
                + '</div>'
                + '</div>'
                + '</div>'
                + '</div>'
                + '</div>'
                + '</section>'
                + '<section class="right-side-image">'
                + '<div class="position-relative">'
                + '<div class="fixed-image-layer d-none d-lg-block right-fixed">'
                + '<img src="http://via.placeholder.com/740x412/BF00FF/ffffff/" class="img-fluid right_image_big fit-image" alt="image">'
                + '</div>'
                + '<div class="container">'
                + '<div class="row">'
                + '<div class="col-lg-6">'
                + '<div class="about-program__content">'
                + '<h6 class="about-program__sub-title">'
                + 'FILMMAKER MODE™'
                + '</h6>'
                + '<h6 class="about-program__title">'
                + 'Watch content as the creator intended'
                + '</h6>'
                + '<p class="about-program__desc">'
                + 'The processor automatically turns off motion smoothing for the full motion picture effect. Watch films and other content with the creative intent and cinematic experience preserved.'
                + '</p>'
                + '</div>'
                + '</div>'
                + '<div class="col-lg-6 d-lg-none mb-4">'
                + '<img src="http://via.placeholder.com/740x412/BF00FF/ffffff/" class="img-fluid right_image_small fit-image" alt="image">'
                + '</div>'
                + '</div>'
                + '</div>'
                + '</div>'
                + '</section>',
});

blockManager.add('Image overlay content on top', {
  label:    '<img src="'+base_url+'/public/admins/plugin/grapejs/src/icons/impex/imagetop.png" style="padding:10px"><div>Image overlay content on top</div>',
  category: 'Section',
  content: '<section class="banner-captions">'
                + '<img src="https://via.placeholder.com/1500x845/BF00FF/ffffff/" alt=""  class="fit-image web">'
                + '<img src="https://via.placeholder.com/360x540/BF00FF/ffffff/" alt=""  class="fit-image mobile">'
                + '<div class="caption middle-upper">'
                + '<h1 class="title">Blur-free Visuals Reality Flow</h1>'
                + '<h2 class="Sub-tile">Enjoy A Fluid Display Even With Low-Frame Rate Content</h2>'
                + '<p class="title__desc">'
                + 'The processor automatically turns off motion smoothing for the full motion picture effect. Watch films and other content with the creative intent and cinematic experience preserved.'
                + '</p>'
                + '</div>'
                + '</section>',
});

blockManager.add('Image overlay content on middle', {
  label:    '<img src="'+base_url+'/public/admins/plugin/grapejs/src/icons/impex/imagemiddle.png" style="padding:10px"><div>Image overlay content on middle</div>',
  category: 'Section',
  content: '<section class="banner-captions">'
                + '<img src="https://via.placeholder.com/1500x845/BF00FF/ffffff/" alt=""  class="fit-image web">'
                + '<img src="https://via.placeholder.com/360x540/BF00FF/ffffff/" alt=""  class="fit-image mobile">'
                + '<div class="caption middle-center">'
                + '<h1 class="title">Blur-free Visuals Reality Flow</h1>'
                + '<h2 class="Sub-tile">Enjoy A Fluid Display Even With Low-Frame Rate Content</h2>'
                + '<p class="title__desc">'
                + 'The processor automatically turns off motion smoothing for the full motion picture effect. Watch films and other content with the creative intent and cinematic experience preserved.'
                + '</p>'
                + '</div>'
                + '</section>',
});

blockManager.add('Image overlay content on bottom', {
  label:    '<img src="'+base_url+'/public/admins/plugin/grapejs/src/icons/impex/imagebottom.png" style="padding:10px"><div>Image overlay content on bottom</div>',
  category: 'Section',
  content: '<section class="banner-captions">'
                + '<img src="https://via.placeholder.com/1500x845/BF00FF/ffffff/" alt=""  class="fit-image web">'
                + '<img src="https://via.placeholder.com/360x540/BF00FF/ffffff/" alt=""  class="fit-image mobile">'
                + '<div class="caption middle-bottom">'
                + '<h1 class="title">Blur-free Visuals Reality Flow</h1>'
                + '<h2 class="Sub-tile">Enjoy A Fluid Display Even With Low-Frame Rate Content</h2>'
                + '<p class="title__desc">'
                + 'The processor automatically turns off motion smoothing for the full motion picture effect. Watch films and other content with the creative intent and cinematic experience preserved.'
                + '</p>'
                + '</div>'
                + '</section>',
});

blockManager.add('Image overlay content on left', {
  label:    '<img src="'+base_url+'/public/admins/plugin/grapejs/src/icons/impex/imageleft.png" style="padding:10px"><div>Image overlay content on left</div>',
  category: 'Section',
  content: '<section class="banner-captions">'
                + '<img src="https://via.placeholder.com/1500x845/BF00FF/ffffff/" alt=""  class="fit-image web">'
                + '<img src="https://via.placeholder.com/360x540/BF00FF/ffffff/" alt=""  class="fit-image mobile">'
                + '<div class="caption left">'
                + '<h1 class="title">Blur-free Visuals Reality Flow</h1>'
                + '<h2 class="Sub-tile">Enjoy A Fluid Display Even With Low-Frame Rate Content</h2>'
                + '<p class="title__desc">'
                + 'The processor automatically turns off motion smoothing for the full motion picture effect. Watch films and other content with the creative intent and cinematic experience preserved.'
                + '</p>'
                + '</div>'
                + '</section>',
});

blockManager.add('Image overlay content on right', {
  label:    '<img src="'+base_url+'/public/admins/plugin/grapejs/src/icons/impex/imageright.png" style="padding:10px"><div>Image overlay content on right</div>',
  category: 'Section',
  content: '<section class="banner-captions">'
                + '<img src="https://via.placeholder.com/1500x845/BF00FF/ffffff/" alt=""  class="fit-image web">'
                + '<img src="https://via.placeholder.com/360x540/BF00FF/ffffff/" alt=""  class="fit-image mobile">'
                + '<div class="caption right">'
                + '<h1 class="title">Blur-free Visuals Reality Flow</h1>'
                + '<h2 class="Sub-tile">Enjoy A Fluid Display Even With Low-Frame Rate Content</h2>'
                + '<p class="title__desc">'
                + 'The processor automatically turns off motion smoothing for the full motion picture effect. Watch films and other content with the creative intent and cinematic experience preserved.'
                + '</p>'
                + '</div>'
                + '</section>',
});

blockManager.add('4 column content', {
  label:    '<img src="'+base_url+'/public/admins/plugin/grapejs/src/icons/impex/4content.png" style="padding:10px"><div>4 column content</div>',
  category: 'Section',
  content: '<section class="multiple-block">'
                + '<div class="container">'
                + '<div class="row">'
                + '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 bottom-sep">'
                + '<div class="Grid-blocks">'
                + '<div class="grid-images">'
                + '<img src="http://via.placeholder.com/250x250/BF00FF/ffffff/" alt="" class="fit-image">'
                + '</div>'
                + '<h6 class="grid_block-title">True Cinema Experience</h6>'
                + '</div>'
                + '</div>'
                + '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 bottom-sep">'
                + '<div class="Grid-blocks">'
                + '<div class="grid-images">'
                + '<img src="http://via.placeholder.com/250x250/BF00FF/ffffff/" alt="" class="fit-image">'
                + '</div>'
                + '<h6 class="grid_block-title">True Cinema Experience</h6>'
                + '</div>'
                + '</div>'
                + '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 bottom-sep">'
                + '<div class="Grid-blocks">'
                + '<div class="grid-images">'
                + '<img src="http://via.placeholder.com/250x250/BF00FF/ffffff/" alt="" class="fit-image">'
                + '</div>'
                + '<h6 class="grid_block-title">True Cinema Experience</h6>'
                + '</div>'
                + '</div>'
                + '<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 bottom-sep">'
                + '<div class="Grid-blocks">'
                + '<div class="grid-images">'
                + '<img src="http://via.placeholder.com/250x250/BF00FF/ffffff/" alt="" class="fit-image">'
                + '</div>'
                + '<h6 class="grid_block-title">True Cinema Experience</h6>'
                + '</div>'
                + '</div>'
                + '</div>'
                + '</div>'
                + '</section>',
});


$('span[title="Open Style Manager"]').hide();
$('span[title="Settings"]').click();


$(function() {

    $('body').on('click','span[title="Open Blocks"]',function()
    {
        if($(".gjs-block-category:visible").length > 1)
        {
            $(".gjs-block-category:eq(6)").insertBefore(".gjs-block-category:eq(0)");
            $(".gjs-block-category:eq(2)").hide();
            $(".gjs-block-category:eq(3)").hide();
            $(".gjs-block-category:eq(4)").hide();
            $(".gjs-block-category:eq(5)").hide();
            $(".gjs-block-category:eq(6)").hide();
        }
    });
    

    if($('#gjs').length > 0)
    {
        $.ajax({
            type: "GET",
            url: base_url + '/admin/products/getProductBasics/'+$('#id').val(),
            success: function(result) {
                result = $.parseJSON(result);
                editor.setComponents(result.overview);
                editor.setStyle(result.overview_style);
            }

        });
    }

    $('#updateOverview').submit(function(e)
    {
        e.preventDefault();

        var content = editor.getHtml();
        var css = editor.getCss();

        if(content != '')
        {
            var form = $('#updateOverview');
            var formData = new FormData(form[0]);
            formData.append('content',content);
            formData.append('css',css);

            $.ajax({
                type: "POST",
                url: base_url + '/admin/products/updateOverview',
                contentType: false,
                processData: false,
                data: formData,
                success: function(result) {
                    //console.log(result);
                    location.href = base_url + '/admin/products';
                }

            });
        }

    });
});
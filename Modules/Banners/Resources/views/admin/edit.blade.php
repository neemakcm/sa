@extends('admin::layouts.master')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.1/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>
@endsection
@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold">Edit Banner</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin')}}">
                                <span class="las la-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{URL('admin/banners')}}">
                                Banners
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                           Edit Banner
                        </li>

                    </ol>
                </nav>

                <div class="separator-breadcrumb border-top"></div>
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <form id="banner_edit_form" class="banner_edit_form">
                                	@csrf

                                    <input type="hidden" name="id" value="{{$banner->id}}">
                                    <input type="hidden" id="type" value="edit">
                                    <div class="row">
                                        <div class="col-md-4 form-group mb-3">
                                            <label >Title</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter title" name="title" value="{{$banner->title}}">

                                            </div>
                                            <div class="col-md-2 form-group mb-3">
                                                <label >Title Color</label>
                                                <input class="form-control colorpicker"  type="text"
                                                    placeholder="Enter color code" name="title_color_code" value="{{$banner->title_color_code}}">
                                            </div>
                                            <div class="col-md-2 form-group mb-3">
                                                <label >Title font size</label>
                                                <input class="form-control "  type="number" placeholder="Enter Font Size" name="title_font_size" value="{{$banner->title_font_size}}">
                                            </div>
                                         <div class="col-md-2 form-group mb-3">
                                            <label >Prioritise</label>
                                            <input class="form-control "  type="number" name="prioritise" value="{{$banner->prioritise}}" id="prioritise">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Status</label>
                                            <select class="form-control" name="status">
                                                <option <?php echo $banner->status == 1?'selected':''; ?> value="1">Active</option>
                                                <option <?php echo $banner->status == 0?'selected':''; ?> value="0">Inactive</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Type</label>
                                            <select class="form-control" name="type" id="banner_type">
                                                <option value="1" <?php echo $banner->type == 1?'selected':''; ?>>Image</option>
                                                <option value="2" <?php echo $banner->type == 2?'selected':''; ?>>Video</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 form-group mb-3 image_holder <?php echo $banner->type == 1?'':'hide'; ?>">
                                            <label >Desktop Image*</label><small> (1367px × 480px)</small>

                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" id="image_upload" type="file" name="image" accept=".jpeg,.jpg,.png,.gif">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    <label id="file-name"></label>
                                                </div>
                                            </div>

                                            <img src="{{storage_url()}}/{{$banner->image}}" width="100">

                                            <img id="imagePreview" width="70">

                                        </div>

                                        <div class="col-md-6 form-group mb-3 image_holder <?php echo $banner->type == 1?'':'hide'; ?>">
                                            <label >Mobile Image*</label><small> (360px * 540px)</small>

                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" id="mobile_image_upload" type="file" name="image_mobile" accept=".jpeg,.jpg,.png,.webp">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    <label id="file-name"></label>
                                                </div>
                                            </div>

                                            <img src="{{storage_url()}}/{{$banner->image_mobile}}" width="100">

                                            <img id="mobile_imagePreview" width="70">

                                        </div>

                                        <div class="col-md-6 form-group mb-3 video_holder <?php echo $banner->type == 2?'':'hide'; ?>">
                                            <label >Video*</label>
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" type="file" name="video" accept=".mp4">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    <label id="file-name"></label>
                                                </div>
                                            </div>

                                                <video width="100" height="100" controls>
                                                  <source src="{{storage_url()}}/{{$banner->video}}" type="video/mp4">
                                                </video>

                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Desktop Title Position</label>
                                            <select class="form-control" name="position">
                                                <option <?php echo $banner->position == 'left'?'selected':''; ?> value="left">Left</option>
                                                <option <?php echo $banner->position == 'right'?'selected':''; ?> value="right">Right</option>
                                                <option <?php echo $banner->position == 'middle'?'selected':''; ?> value="middle">Middle</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Mobile Title Position</label>
                                            <select class="form-control" name="position_mobile">
                                                <option <?php echo $banner->position_mobile == 'top'?'selected':''; ?> value="top">Top</option>
                                                <option <?php echo $banner->position_mobile == 'bottom'?'selected':''; ?> value="bottom">Bottom</option>
                                                <option <?php echo $banner->position_mobile == 'middle'?'selected':''; ?> value="middle">Middle</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4 form-group mb-3">
                                            <label >Short Description</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter Short Description" name="short_description" value="{{$banner->short_description}}">
                                        </div>
                                        <div class="col-md-2 form-group mb-3">
                                            <label >Short Description Color</label>
                                            <input class="form-control colorpicker"  type="text"
                                                placeholder="Enter color code" name="short_color_code" value="{{$banner->short_color_code}}">
                                        </div>
                                        <div class="col-md-2 form-group mb-3">
                                            <label > font size</label>
                                            <input class="form-control "  type="number" placeholder="Enter Font Size" name="short_font_size" value="{{$banner->short_font_size}}">
                                        </div>
                                        <div class="col-md-4 form-group mb-3">
                                            <label >Description</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter description" name="description" value="{{$banner->description}}">
                                        </div>
                                        <div class="col-md-2 form-group mb-3">
                                            <label >Description Color</label>
                                            <input class="form-control colorpicker"  type="text"
                                                placeholder="Enter color code" name="description_color_code" value="{{$banner->description_color_code}}">
                                        </div>
                                        <div class="col-md-2 form-group mb-3">
                                            <label >Description Font Size</label>
                                            <input class="form-control "  type="number"
                                                name="description_font_size" value="{{$banner->description_font_size}}">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Buy Now</label>
                                            <input class="form-control"  type="url"
                                                placeholder="Enter link" name="buy_now" value="{{$banner->buy_now}}">
                                        </div>
                                        <div class="col-md-2 form-group mb-3">
                                            <label >Buy Now Title</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter link" name="buy_now_title" value="{{$banner->buy_now_title}}">
                                        </div>
                                        <div class="col-md-2 form-group mb-3">
                                            <label >Buy Now Bg Color</label>
                                            <input class="form-control colorpicker"  type="text"
                                                placeholder="Enter color code" name="buy_now_bg_color_code" value="{{$banner->buy_now_bg_color_code}}">
                                        </div>
                                        <div class="col-md-2 form-group mb-3">
                                            <label >Color</label>
                                            <input class="form-control colorpicker"  type="text"
                                                placeholder="Enter color code" name="buy_now_color_code" value="{{$banner->buy_now_color_code}}">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Learn More</label>
                                            <input class="form-control"  type="url"
                                                placeholder="Enter link" name="learn_more" value="{{$banner->learn_more}}" >
                                        </div>
                                        <div class="col-md-2 form-group mb-3">
                                            <label >Learn More Title</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter link" name="learn_more_title" value="{{$banner->learn_more_title}}">
                                        </div>
                                        <div class="col-md-2 form-group mb-3">
                                            <label >Learn More Bg Color</label>
                                            <input class="form-control colorpicker"  type="text"
                                                placeholder="Enter color code" name="learn_more_bg_color" value="{{$banner->learn_more_bg_color}}">
                                        </div>
                                        <div class="col-md-2 form-group mb-3">
                                            <label >Color</label>
                                            <input class="form-control colorpicker"  type="text"
                                                placeholder="Enter color code" name="learn_more_color_code" value="{{$banner->learn_more_color_code}}">
                                        </div>

                                        <div class="col-md-12 d-flex">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a class="btn btn-light ml-3" href="{{URL('admin/banners')}}">Back</a>
                                        </div>
                                    </div>
                                </form>

                                <div class='upload-progress col-md-12' id="progressDivId">
                                    <div class='progress-status-bar' id='progressBar'></div>
                                </div>
                                <div style="height: 10px;"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end of col-->
                </div>
            </div>
            <div class="flex-grow-1"></div>

            <!-- fotter end -->
        </div>
    </div>


@stop
@section('script')
   <script>
        $('.colorpicker').colorpicker();
    </script>
   @endsection

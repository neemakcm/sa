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
                <h4 class="mr-2 font-weight-bold">Add Category</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin')}}">
                                <span class="las la-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{URL('admin/categories')}}">
                                Categories
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                           Add Category
                        </li>

                    </ol>
                </nav>

                <div class="separator-breadcrumb border-top"></div>

                <div class="container"> 
                    <div class="row"> 
                        @if(session()->has('duplicate_message'))
                           <div class="col-12 alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                {{ session()->get('duplicate_message') }}
                            </div>
                        @endif
                        
                        @if(session()->has('duplicate_position'))
                           <div class="col-12 alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                {{ session()->get('duplicate_position') }}
                            </div>
                        @endif
                    </div>
                </div>


                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <form method="POST" action="{{URL('admin/categories/store')}}" enctype='multipart/form-data'>
                                	@csrf
                                    <div class="row">
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Name*</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter name" name="name" required value="{{old('name')}}">
                                        </div>
                                        
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Sub Title*</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter sub title" name="sub_title" required value="{{old('sub_title')}}">
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Parent*</label>
                                            <select name="parent_id" class="form-control">
                                                <option <?php echo old('parent_id') == 0?'selected':''; ?> value="0">Parent</option>
                                                @foreach($parents as $parent)
                                                    <option <?php echo old('parent_id') == $parent->id?'selected':''; ?> value="{{$parent->id}}">{{$parent->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Position*</label>
                                            <input class="form-control"  type="number"
                                                placeholder="Enter position" name="sort_oder" min="1" required value="{{old('sort_oder')}}">
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label id="image_label">Image</label><small> (520x360 px)</small>

                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" id="image_upload" type="file" name="icon" accept=".jpeg,.jpg,.png,.gif">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    <label id="file-name"></label>
                                                </div>
                                            </div>
                                            <img id="imagePreview" width="70">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label id="image_label">Mobile Image (360px * 540px)</label>
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" id="mobile_image" type="file" name="mobile_image" accept=".jpeg,.jpg,.png,.gif">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    <label id="file-name"></label>
                                                </div>
                                            </div>
                                            <img id="mobile_image_preview" width="70">
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Is it child category?*</label>
                                            <br>
                                            <div class="form-check form-check-inline mt-2">
                                                <label class="form-check-label">
                                                <input type="radio" class="is_child" id="main-2" name="is_last_child" value="0" required> No</label>
                                            </div>
                                            <div class="form-check form-check-inline mt-2">
                                                <label class="form-check-label">
                                                <input type="radio" class="is_child" id="main-1" name="is_last_child" value="1" required> Yes</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Status</label>
                                            <select class="form-control" name="status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 form-group mb-3 not_configurable">
                                            <label >Meta Title</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter your meta title" name="meta_title" value="{{old('meta_title')}}">
                                        </div>

                                        <div class="col-md-6 form-group mb-3 not_configurable">
                                            <label >Meta Keywords</label><small>( Seperate by commas)</small>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter your meta keywords" name="meta_tags" value="{{old('meta_tags')}}">
                                        </div>

                                        <div class="col-md-6 form-group mb-3 not_configurable">
                                            <label >Meta Description</label>
                                            <textarea class="form-control" name="meta_description">{{old('meta_description')}}</textarea>
                                        </div>

                                        <br>

                                        <div class="col-md-12 form-group mb-3">
                                            <h4>Banner Details</h4>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Desktop Image*</label><small> (2500px * 480px)</small>

                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" id="image_upload" type="file" name="desktop_banner" accept=".jpeg,.jpg,.png,.webp" required>
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    <label id="file-name"></label>
                                                </div>
                                            </div>

                                            <img id="imagePreview" width="70">

                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Mobile Image*</label><small> (360px * 540px)</small>

                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" id="mobile_image_upload" type="file" name="mobile_banner" accept=".jpeg,.jpg,.png,.webp" required>
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    <label id="file-name"></label>
                                                </div>
                                            </div>

                                            <img id="mobile_imagePreview" width="70">

                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Main Title</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter main title" name="banner_main_title"  value="{{old('banner_main_title')}}">
                                        </div>
                                        <div class="col-md-3 form-group mb-3">
                                            <label >Title Color</label>
                                            <input class="form-control colorpicker"  type="text"
                                                placeholder="Enter color code" autocomplete="off" name="title_color_code" value="">
                                        </div>
                                        <div class="col-md-3 form-group mb-3">
                                            <label >Title font size</label>
                                            <input class="form-control"  type="text" placeholder="Enter Font Size" name="title_font_size" value="">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Sub Title</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter sub title" name="banner_sub_title"  value="{{old('banner_sub_title')}}">
                                        </div>

                                        <div class="col-md-3 form-group mb-3">
                                            <label >Sub Title Color</label>
                                            <input class="form-control colorpicker"  type="text"
                                                placeholder="Enter color code" autocomplete="off" name="sub_title_color_code" value="">
                                        </div>
                                        <div class="col-md-3 form-group mb-3">
                                            <label >Sub Title font size</label>
                                            <input class="form-control"  type="number" placeholder="Enter Font Size" name="sub_title_font_size" value="">
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Small Description</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter sub title" name="banner_small_description"  value="{{old('banner_small_description')}}">
                                        </div>
                                        <div class="col-md-3 form-group mb-3">
                                            <label >Description Color</label>
                                            <input class="form-control colorpicker"  type="text"
                                                placeholder="Enter color code" autocomplete="off" name="description_color_code" value="">
                                        </div>
                                        <div class="col-md-3 form-group mb-3">
                                            <label> Font Size</label>
                                            <input class="form-control"  type="number"
                                                placeholder="Enter color code" name="description_font_size" value="">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Learn More</label>
                                            <input class="form-control"  type="url"
                                                placeholder="Enter link" name="banner_link">
                                        </div>
                                        <div class="col-md-3 form-group mb-3">
                                            <label >Learn More Bg Color</label>
                                            <input class="form-control colorpicker"  type="text"
                                                placeholder="Enter color code" autocomplete="off" name="learn_more_bg_color" value="">
                                        </div>
                                        <div class="col-md-3 form-group mb-3">
                                            <label >Color</label>
                                            <input class="form-control colorpicker"  type="text"
                                                placeholder="Enter color code" autocomplete="off" name="learn_more_color_code" value="">
                                        </div>



                                        <div class="col-md-12 d-flex">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a class="btn btn-light ml-3" href="{{URL('admin/categories')}}">Back</a>
                                        </div>
                                    </div>
                                </form>
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
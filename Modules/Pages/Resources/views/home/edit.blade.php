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
                <h4 class="mr-2 font-weight-bold">Edit Design</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin')}}">
                                <span class="las la-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin/homePage')}}">
                                Home Page Design
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            @if($design->type == 1)
                                <a href="{{URL('/admin/homePage/list/1')}}">
                                    Blocks
                                </a>
                            @endif

                            @if($design->type == 2)
                                <a href="{{URL('/admin/homePage/list/2')}}">
                                    New Arrivals
                                </a>
                            @endif

                            @if($design->type == 3)
                                <a href="{{URL('/admin/homePage/list/3')}}">
                                    Most Popular
                                </a>
                            @endif

                            @if($design->type == 4)
                                <a href="{{URL('/admin/homePage/list/4')}}">
                                    New Launches
                                </a>
                            @endif
                        </li>
                        <li class="breadcrumb-item">
                           Edit Design
                        </li>

                    </ol>
                </nav>

                <div class="separator-breadcrumb border-top"></div>
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <form method="POST" action="{{URL('admin/homePage/update')}}" enctype='multipart/form-data'>
                                	@csrf
                                    <input type="hidden" name="id" value="{{$design->id}}">
                                    <div class="row">
                                        <div class="@if($design->type == 1) col-md-2 @else col-md-6 @endif  form-group mb-3">
                                            @if($design->type == 1 || $design->type == 5)
                                                <label >Category*</label>
                                                <select class="form-control" name="product_id" required>
                                                    @foreach($categories as $category)
                                                        <option <?php echo $design->product_id == $category->id?'selected':''; ?> value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <label >Product*</label>
                                                <select class="form-control" name="product_id" required>
                                                    @foreach($products as $product)
                                                        <option <?php echo $design->product_id == $product->id?'selected':''; ?> value="{{$product->id}}">{{$product->name}}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                            @if(session()->has('message_duplicate_category'))
                                            <span class="has-danger">
                                                <strong class="form-control-feedback">{{ session()->get('message_duplicate_category') }}</strong>
                                            </span>
                                        @endif

                                        </div>
                                        @if($design->type == 1)
                                        <div class="col-md-2 form-group mb-3">
                                            <label >Category Color</label>
                                            <input class="form-control colorpicker"  type="text"
                                                placeholder="Enter color code" autocomplete="off" name="category_color_code" value="{{$design->category_color_code}}">
                                        </div>
                                        <div class="col-md-2 form-group mb-3">
                                            <label > Font Size(px)</label>
                                            <input class="form-control "  type="number"
                                                placeholder="Enter color code"  name="category_font_size" value="{{$design->category_font_size}}">
                                        </div>
                                        @endif
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Position*</label>
                                            @if($design->type == 1)
                                                <input class="form-control" type="number" name="position" required min="1" max="5" value="{{$design->position}}" readonly>
                                            @else
                                                <input class="form-control" type="number" name="position" required min="1" max="10" value="{{$design->position}}">
                                            @endif

                                            @if(session()->has('message_duplicate'))
                                                <span class="has-danger">
                                                    <strong class="form-control-feedback">{{ session()->get('message_duplicate') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Learn more link</label>
                                            <input class="form-control"  type="url"
                                                placeholder="Enter your link" value="{{$design->learn_more}}" name="learn_more">
                                        </div>
                                        @if($design->type == 1)
                                        <div class="col-md-2 form-group mb-3">
                                            <label >Learn More Title</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter link" name="learn_more_title" value="{{$design->learn_more_title}}">
                                        </div>
                                        <div class="col-md-2 form-group mb-3">
                                            <label >Learn More Bg Color</label>
                                            <input class="form-control colorpicker"  type="text"
                                                placeholder="Enter color code" autocomplete="off" name="learn_more_bg_color" value="{{$design->learn_more_bg_color}}">
                                        </div>
                                        <div class="col-md-2 form-group mb-3">
                                            <label >Color</label>
                                            <input class="form-control colorpicker"  type="text"
                                                placeholder="Enter color code" autocomplete="off" name="learn_more_color_code" value="{{$design->learn_more_color_code}}">
                                        </div>

                                        @endif
                                        @if($design->type == 1 || $design->type == 2 || $design->type == 3 || $design->type == 6)
                                            <div class="col-md-6 form-group mb-3">
                                                @if($design->type == 1)
                                                    <label >Image</label>
                                                @else
                                                    <label >Image</label><small> (400x493 px)</small>
                                                @endif

                                                <div class="input-group mb-3">
                                                    <div class="custom-file">
                                                        <input class="custom-file-input" id="image_upload" type="file" name="image" accept=".jpeg,.jpg,.png,.gif">
                                                        <label class="custom-file-label" for="inputGroupFile02"
                                                            aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                        <label id="file-name"></label>
                                                    </div>
                                                </div>

                                                <img id="imagePreview" width="70">

                                                <img src="{{storage_url()}}/{{$design->image}}" width="100">
                                            </div>
                                            @if($design->type == 1)
                                            <div class="col-md-6 form-group mb-3">
                                                    <label >Mobile Image</label>
                                                <div class="input-group mb-3">
                                                    <div class="custom-file">
                                                        <input class="custom-file-input" id="mobile_image_upload" type="file" name="image_mobile" accept=".jpeg,.jpg,.png,.gif">
                                                        <label class="custom-file-label" for="inputGroupFile02"
                                                            aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                        <label id="file-name"></label>
                                                    </div>
                                                </div>
                                                <img id="mobile_imagePreview" width="70">
                                                <img src="{{storage_url()}}/{{$design->mobile_image}}" width="100">
                                            </div>
                                            @endif
                                        @endif

                                        @if($design->type == 1 || $design->type == 2 || $design->type == 3 || $design->type == 6)
                                            <div class="col-md-6 form-group mb-3">
                                                <label >Description*</label>
                                                <textarea class="form-control" name="description" required>{{$design->description}}</textarea>
                                            </div>
                                        @endif
                                        @if($design->type == 1 || $design->type == 5)
                                        <div class="col-md-3 form-group mb-3">
                                            <label >Description Font Size(px)</label>
                                            <input class="form-control "  type="number"
                                                placeholder="Enter color code"  name="description_font_size" value="{{$design->description_font_size}}">
                                        </div>
                                        <div class="col-md-3 form-group mb-3">
                                            <label >Description Color</label>
                                            <input class="form-control colorpicker"  type="text"
                                                placeholder="Enter color code" name="description_color_code" value="{{$design->description_color_code}}">
                                        </div>

                                        <div class="col-md-3 form-group mb-3">
                                            <label >Buy Now Bg Color</label>
                                            <input class="form-control colorpicker"  type="text"
                                                placeholder="Enter color code" name="buy_now_bg_color_code" value="{{$design->buy_now_bg_color_code}}">
                                        </div>
                                        <div class="col-md-3 form-group mb-3">
                                            <label >Color</label>
                                            <input class="form-control colorpicker"  type="text"
                                                placeholder="Enter color code" name="buy_now_color_code" value="{{$design->buy_now_color_code}}">
                                        </div>
                                        @endif
                                        @if($design->type == 1)

                                        <div class="col-md-2 form-group mb-3">
                                            <label >Buy Now Title</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter link" name="buy_now_title" value="{{$design->buy_now_title}}">
                                        </div>
                                        @endif
                                        <div class="col-md-12 d-flex">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a class="btn btn-light ml-3" href="{{URL('admin/homePage/list')}}/{{$design->type}}">Back</a>
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

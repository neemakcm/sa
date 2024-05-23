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
                <h4 class="mr-2 font-weight-bold">Add Design</h4>

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
                            @if($id == 1)
                                <a href="{{URL('/admin/homePage/list/1')}}">
                                    Blocks
                                </a>
                            @endif

                            @if($id == 2)
                                <a href="{{URL('/admin/homePage/list/2')}}">
                                    New Arrivals
                                </a>
                            @endif

                            @if($id == 3)
                                <a href="{{URL('/admin/homePage/list/3')}}">
                                    Most Popular
                                </a>
                            @endif

                            @if($id == 4)
                                <a href="{{URL('/admin/homePage/list/4')}}">
                                    New Launches
                                </a>
                            @endif

                            @if($id == 5)
                                <a href="{{URL('/admin/homePage/list/5')}}">
                                    Other Products
                                </a>
                            @endif

                            @if($id == 6)
                                <a href="{{URL('/admin/homePage/list/6')}}">
                                    Offers
                                </a>
                            @endif
                        </li>
                        <li class="breadcrumb-item">
                           Add Design
                        </li>

                    </ol>
                </nav>

                <div class="separator-breadcrumb border-top"></div>
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <form method="POST" action="{{URL('admin/homePage/store')}}" enctype='multipart/form-data'>
                                	@csrf
                                    <input type="hidden" name="type" value="{{$id}}">
                                    <div class="row">
                                        <div class="@if($id == 1) col-md-2 @else col-md-6 @endif  form-group mb-3">
                                            @if($id == 1 || $id == 5)
                                                <label >Category*</label>
                                                <select class="form-control" id="product_id" name="product_id" required>
                                                <option value="" selected="selected" disabled>Select</option>
                                                    @foreach($categories as $category)
                                                        @if($id == 1 || ($id == 5 && $category->parent_id == 0 && $category->children->count()>0))
                                                            <option <?php echo old('product_id') == $category->id?'selected':''; ?> value="{{$category->id}}">{{$category->name}}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            @else
                                                <label >Product*</label>
                                                <select class="form-control" name="product_id" required>
                                                    @foreach($products as $product)
                                                        <option <?php echo old('product_id') == $product->id?'selected':''; ?> value="{{$product->id}}">{{$product->name}}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                        @if($id == 1 )
                                        <div class="col-md-2 form-group mb-3">
                                            <label >Category Color</label>
                                            <input class="form-control colorpicker"  type="text"
                                                placeholder="Enter color code" autocomplete="off" name="category_color_code" value="">
                                        </div>
                                        <div class="col-md-2 form-group mb-3">
                                            <label > Font Size(px)</label>
                                            <input class="form-control "  type="number"
                                                placeholder="Enter color code"  name="category_font_size" value="">
                                        </div>
                                        @endif
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Position*</label>
                                            @if($id == 1)
                                                <input class="form-control" type="number" name="position" required min="1" max="5" value="{{old('position')}}">
                                            @else
                                                <input class="form-control" type="number" name="position" required min="1" max="10" value="{{old('position')}}">
                                            @endif

                                            @if(session()->has('message_duplicate'))
                                                <span class="has-danger">
                                                    <strong class="form-control-feedback">{{ session()->get('message_duplicate') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        @if($id == 5)
                                        
                                        <div class="col-md-12 add_sub_category_div" id="onlinestore">
                                            <div class="row sub_category_clone " >
                                                <div class="col-md-2 form-group mb-3">
                                                    <label >Sub Category*</label>
                                                    <select class="form-control sub_category_change"  name="sub_category[]" id="sub_category" required>
                                                        <option value=""></option>
                                                    </select>
                                                </div>
                                                <div class="col-md-2 form-group mb-3">
                                                    <label >Category Color</label>
                                                    <input class="form-control colorpicker"  type="text"
                                                        placeholder="Enter color code" autocomplete="off" name="category_color_code[]" value="">
                                                </div>
                                                <div class="col-md-2 form-group mb-3">
                                                    <label > Font Size(px)</label>
                                                    <input class="form-control"  type="number"
                                                        placeholder="Enter color code"  name="category_font_size[]" value="">
                                                </div>
                                                <div class="col-md-2 form-group mb-3 ">
                                                    <label >Learn more link</label>
                                                    <input class="form-control"  type="url" placeholder="Enter your link" name="learn_more_link[]">
                                                </div>
                                                <div class="col-md-2 form-group mb-3">
                                                    <label >Learn More Bg Color</label>
                                                    <input class="form-control colorpicker"  type="text"
                                                        placeholder="Enter color code" autocomplete="off" name="learn_more_bg_color[]" value="">
                                                </div>
                                                <div class="col-md-2 form-group mb-3">
                                                    <label >Color</label>
                                                    <input class="form-control colorpicker"  type="text"
                                                        placeholder="Enter color code" autocomplete="off" name="learn_more_color_code[]" value="">
                                                </div>
                                                <div class="col-md-2 form-group mb-3">
                                                    <label >Buy Now Bg Color</label>
                                                    <input class="form-control colorpicker"  type="text"
                                                        placeholder="Enter color code" name="buy_now_bg_color_code[]" value="">
                                                </div>
                                                <div class="col-md-2 form-group mb-3">
                                                    <label >Color</label>
                                                    <input class="form-control colorpicker"  type="text"
                                                        placeholder="Enter color code" name="buy_now_color_code[]" value="">
                                                </div>
                                                <div class="col-md-1 pull-right mt-4 ">
                                                    <button class="add_more_sub_category btn btn-sm btn-info font-18"><i class="las la-plus"></i></button>
                                                    <button class="remove_more_sub_category btn btn-danger hide"><svg aria-hidden="true" width="10" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg></button>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        @if($id != 5)

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Learn more link</label>
                                            <input class="form-control"  type="url"
                                                placeholder="Enter your link" name="learn_more">
                                        </div>
                                        @if($id == 1)
                                        <div class="col-md-2 form-group mb-3">
                                            <label >Learn More Title</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter link" name="learn_more_title" value="">
                                        </div>
                                        <div class="col-md-2 form-group mb-3">
                                            <label >Learn More Bg Color</label>
                                            <input class="form-control colorpicker"  type="text"
                                                placeholder="Enter color code" autocomplete="off" name="learn_more_bg_color" value="">
                                        </div>

                                        <div class="col-md- form-group mb-3">
                                            <label >Color</label>
                                            <input class="form-control colorpicker"  type="text"
                                                placeholder="Enter color code" autocomplete="off" name="learn_more_color_code" value="">
                                        </div>
                                        <div class="col-md-2 form-group mb-3">
                                            <label >Buy Now Title</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter link" name="buy_now_title" value="">
                                        </div>
                                        <div class="col-md-2 form-group mb-3">
                                            <label >Buy Now Bg Color</label>
                                            <input class="form-control colorpicker"  type="text"
                                                placeholder="Enter color code" name="buy_now_bg_color_code" value="">
                                        </div>
                                        <div class="col-md-2 form-group mb-3">
                                            <label >Color</label>
                                            <input class="form-control colorpicker"  type="text"
                                                placeholder="Enter color code" name="buy_now_color_code" value="">
                                        </div>
                                        @endif
                                        @endif
                                       
                                        @if($id == 1 || $id == 2 || $id == 3 || $id == 6)
                                            <div class="col-md-6 form-group mb-3">
                                                @if($id == 1)
                                                    <label >Image*</label>
                                                @else
                                                    <label >Image*</label><small> (400x493 px)</small>
                                                @endif

                                                <div class="input-group mb-3">
                                                    <div class="custom-file">
                                                        <input class="custom-file-input" id="image_upload" type="file" name="image" accept=".jpeg,.jpg,.png,.gif" required>
                                                        <label class="custom-file-label" for="inputGroupFile02"
                                                            aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                        <label id="file-name"></label>
                                                    </div>
                                                </div>

                                                <img id="imagePreview" width="70">
                                            </div>
                                        @endif

                                        @if($id == 1 || $id == 2 || $id == 3 || $id == 6)
                                            <div class="col-md-6 form-group mb-3">
                                                <label >Description*</label>
                                                <textarea class="form-control" name="description" required>{{old('description')}}</textarea>
                                            </div>
                                        @endif

                                        <div class="col-md-12 d-flex">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a class="btn btn-light ml-3" href="{{URL('admin/homePage/list')}}/{{$id}}">Back</a>
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

    <script src="{{asset('public/admins/js/home-page.js')}}"></script>
    <script>
        $('.colorpicker').colorpicker();
    </script>
    @endsection
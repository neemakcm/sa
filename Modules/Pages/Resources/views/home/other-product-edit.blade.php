
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
                            <a href="{{URL('/admin/homePage/list/5')}}">
                                    Other Products
                                </a>
                        </li>
                        <li class="breadcrumb-item">
                            Add Design
                        </li>
                    </ol>
                </nav>
                @if(session()->has('message_duplicate_category'))
                    <span class="has-danger">
                        <strong class="form-control-feedback">{{ session()->get('message_duplicate_category') }}</strong>
                    </span>
                @endif
                <div class="separator-breadcrumb border-top"></div>
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <form method="POST" action="{{URL('admin/homePage/other-product/update',$id)}}" enctype='multipart/form-data'>
                                	@csrf
                                    <input type="hidden" name="type" value="{{$id}}">
                                    <div class="row">
                                        <div class="@if($id == 1) col-md-2 @else col-md-6 @endif  form-group mb-3">
                                                <label >Category*</label>
                                                <select class="form-control" id="product_id" name="product_id" required>
                                                <option value="" selected="selected" disabled>Select</option>
                                                    @foreach($categories as $category)
                                                            <option <?php echo $design->product_id == $category->id?'selected':''; ?> value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>

                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Position*</label>
                                                <input class="form-control" type="number" name="position" required min="1" max="10" value="{{$design->position}}">
                                            @if(session()->has('message_duplicate'))
                                                <span class="has-danger">
                                                    <strong class="form-control-feedback">{{ session()->get('message_duplicate') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        @php
                                              $array_cat =array();
                                        @endphp
                                        @foreach($subcategories as $subs)
@php

                                           $array_cat[]=$subs->sub_category_id;
                                       @endphp
                                            <div class="col-md-12 " >
                                                <div class="row  " >
                                                    <div class="col-md-2 form-group mb-3">
                                                        <label >Sub Category*</label>
                                                        <select class="form-control "  name="sub_categorys[]" id="sub_category" required>
                                                            <option value="{{$subs->categories->id}}" readonly selected>{{$subs->categories->name}}</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2 form-group mb-3">
                                                        <label >Category Color</label>
                                                        <input class="form-control colorpicker"  type="text"
                                                            placeholder="Enter color code" autocomplete="off" name="category_color_codes[]" value="{{$subs->category_color_code}}">
                                                    </div>
                                                    <div class="col-md-2 form-group mb-3">
                                                        <label > Font Size(px)</label>
                                                        <input class="form-control"  type="number"
                                                            placeholder="Enter color code"  name="category_font_sizes[]" value="{{$subs->category_font_size}}">
                                                    </div>
                                                    <div class="col-md-2 form-group mb-3 ">
                                                        <label >Learn more link</label>
                                                        <input class="form-control"  type="url" placeholder="Enter your link" name="learn_more_links[]" value="{{$subs->online_link}}">
                                                    </div>
                                                    <div class="col-md-2 form-group mb-3">
                                                        <label >Learn More Bg Color</label>
                                                        <input class="form-control colorpicker"  type="text"
                                                            placeholder="Enter color code" autocomplete="off" name="learn_more_bg_colors[]" value="{{$subs->learn_more_bg_color}}">
                                                    </div>
                                                    <div class="col-md-2 form-group mb-3">
                                                        <label >Color</label>
                                                        <input class="form-control colorpicker"  type="text"
                                                            placeholder="Enter color code" autocomplete="off" name="learn_more_color_codes[]" value="{{$subs->learn_more_color_code}}">
                                                    </div>
                                                    <div class="col-md-2 form-group mb-3">
                                                        <label >Buy Now Bg Color</label>
                                                        <input class="form-control colorpicker"  type="text"
                                                            placeholder="Enter color code" name="buy_now_bg_color_codes[]" value="{{$subs->buy_now_bg_color_code}}">
                                                    </div>
                                                    <div class="col-md-2 form-group mb-3">
                                                        <label >Color</label>
                                                        <input class="form-control colorpicker"  type="text"
                                                            placeholder="Enter color code" name="buy_now_color_codes[]" value="{{$subs->buy_now_color_code}}">
                                                    </div>
                                                    {{-- <input type="text" id="design_sub_cat" value="{{$subs->id}}"> --}}
                                                    <div class="col-md-1 pull-right mt-4 ">
                                                        {{-- <button class="add_more_sub_category btn btn-sm btn-info font-18"><i class="las la-plus"></i></button> --}}
                                                        <button type="button" class=" btn btn-danger" id="deleteButton" onClick="deleteConfirm({{$subs->id}})" ><svg aria-hidden="true" width="10" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg></button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-md-12 add_sub_category_div" id="onlinestore">
                                            <div class="row sub_category_clone " >
                                                <div class="col-md-2 form-group mb-3">
                                                    <label >Sub Category*</label>
                                                    <select class="form-control sub_category_change"  name="sub_category[]" id="sub_category" required>
                                                        <option value="">Select</option>
                                                        @foreach($subcategory as $sub_cats)
                                                            @if(!in_array($sub_cats->id, $array_cat))
                                                                @if($sub_cats->children->count() > 0)
                                                                    @foreach($sub_cats->children as $value1)
                                                                        @if(!in_array($value1->id, $array_cat))
                                                                            <option value="{{$value1->id}}">{{$value1->name}}</option>
                                                                        @endif
                                                                    @endforeach
                                                                @else
                                                                    <option value="{{$sub_cats->id}}">{{$sub_cats->name}}</option>
                                                                @endif
                                                            @endif
                                                        @endforeach
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
                                                    <button class="remove_more_sub_category btn btn-danger "><svg aria-hidden="true" width="10" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg></button>
                                                </div>
                                            </div>
                                        </div>
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
        function deleteConfirm(value){
            var data = {
                    id: value,
                };
                $.ajax({
                    type: "post",
                    data: data,
                    url: base_url + '/admin/homePage/other-product/sub-category/delete',
                    async: true,
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        window.location.reload();

                    }
                });
        }
    </script>
    @endsection

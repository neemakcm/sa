@extends('admin::layouts.master')

@section('content')
<style>
    .addon-btn-group .btn-addons {
    border-radius: 10px;
    border-bottom-left-radius: 10px!important;
    border-top-left-radius: 0px!important;
    padding: 0.3rem 1.4rem;
    border: none
}
    </style>
<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold">Add Product</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin')}}">
                                <span class="las la-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{URL('admin/products')}}">
                                Products
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                           Add Product
                        </li>

                    </ol>
                </nav>


                <div class="separator-breadcrumb border-top"></div>
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <form method="POST" action="{{URL('admin/products/store')}}" enctype='multipart/form-data'>
                                	@csrf
                                    <div class="row">
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Name*</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter name" name="name" required value="{{old('name')}}">
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Model Number*</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter sku" name="sku" required value="{{old('sku')}}">

                                            @if(session()->has('message_duplicate'))
                                                <span class="has-danger">
                                                    <strong class="form-control-feedback">{{ session()->get('message_duplicate') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Product Code*</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter Product Code" name="product_code"  value="{{old('product_code')}}">
                                            @if(session()->has('message_duplicate_code'))
                                                <span class="has-danger">
                                                    <strong class="form-control-feedback">{{ session()->get('message_duplicate_code') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Category*</label>
                                            <select name="category_id" id="category_id" class="form-control" required>
                                                <option value="">Select</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}" >{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Type*</label>
                                            <br>
                                            <div class="form-check form-check-inline mt-2">
                                                <label class="form-check-label">
                                                <input type="radio" class="product_type" id="type-2" name="type" value="0" checked> Single</label>
                                            </div>
                                            <div class="form-check form-check-inline mt-2">
                                                <label class="form-check-label">
                                                <input type="radio" class="product_type" id="type-1" name="type" value="1" <?php echo old('product_type') == 1?'checked':''; ?>> Configurable</label>
                                            </div>
                                        </div>


                                        <div class="col-md-6 form-group mb-3 not_configurable">
                                            <label >Price*</label>
                                            <input class="form-control allow_decimal"  type="text"
                                                placeholder="Enter price" name="price" required value="{{old('price')}}"  id="max_price">
                                        </div>

                                        <div class="col-md-6 form-group mb-3 not_configurable">
                                            <label >Offer Price</label>
                                            <input class="form-control allow_decimal"  type="text"
                                                placeholder="Enter offer price" name="offer_price" value="{{old('offer_price')}}"  onBlur="priceCalculation()" id="offer_price">
                                        </div>
                                    </div>
                                    <div class="field_wrapper add_vendor_div" id="onlinestore">
                                        <div class="row vendor_clone " >
                                            <div class="col-md-5 form-group mb-3 ">
                                                <label >Online Store name</label>
                                                <select name="vendor_id[]"  class="form-control vendor_change">
                                                    <option value="">Select</option>
                                                    @foreach($vendors as $vendor)
                                                        <option value="{{$vendor->id}}" <?php echo old('vendor_id.*') == $vendor->id?'selected':''; ?>>{{$vendor->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-6 form-group mb-3 ">
                                                <label >Online Store Link</label>
                                                <input class="form-control"  type="text"
                                                    placeholder="Enter link" name="link[]" value="{{old('link.*')}}">
                                            </div>
                                            <div class="col-md-1 pull-right mt-4 ">
                                            <button class="add_more_vendor btn btn-sm btn-info font-18"><i class="las la-plus"></i></button>
                                            <button class="remove_more_vendor btn btn-danger hide"><svg aria-hidden="true" width="10" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg></button>
                                        </div>
                                        </div>

                                    </div>


                                    <!-- <div id="onlinestoreClone"></div> -->

                                    <div class="row">

                                        <div class="col-md-3 form-group mb-3">
                                            <label >Stock*</label>
                                            <br>
                                            <div class="form-check form-check-inline mt-2">
                                                <label class="form-check-label">
                                                <input type="radio" class="stock" id="stock-2" name="stock" value="0" checked> No</label>
                                            </div>
                                            <div class="form-check form-check-inline mt-2">
                                                <label class="form-check-label">
                                                <input type="radio" class="stock" id="stock-1" name="stock" value="1" <?php echo old('stock') == 1?'checked':''; ?>> Yes</label>
                                            </div>
                                        </div>

                                        <div class="col-md-3 form-group mb-3 not_configurable">
                                            <label >Flagship*</label>
                                            <br>
                                            <div class="form-check form-check-inline mt-2">
                                                <label class="form-check-label">
                                                <input type="radio" class="is_flagship" id="is_flagship-2" name="is_flagship" value="0" checked> No</label>
                                            </div>
                                            <div class="form-check form-check-inline mt-2">
                                                <label class="form-check-label">
                                                <input type="radio" class="is_flagship" id="is_flagship-1" name="is_flagship" value="1" <?php echo old('is_flagship') == 1?'checked':''; ?>> Yes</label>
                                            </div>
                                            <br>
                                            @if(session()->has('message_flagship'))
                                                <span class="has-danger">
                                                    <strong class="form-control-feedback">{{ session()->get('message_flagship') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="col-md-3 form-group mb-3">
                                            <label >New Arrival*</label>
                                            <br>
                                            <div class="form-check form-check-inline mt-2">
                                                <label class="form-check-label">
                                                <input type="radio" class="is_new" id="is_new-2" name="is_new" value="0" checked> No</label>
                                            </div>
                                            <div class="form-check form-check-inline mt-2">
                                                <label class="form-check-label">
                                                <input type="radio" class="is_new" id="is_new-1" name="is_new" value="1" <?php echo old('is_new') == 1?'checked':''; ?>> Yes</label>
                                            </div>
                                        </div>

                                        <div class="col-md-3 form-group mb-3">
                                            <label >Active*</label>
                                            <br>
                                            <div class="form-check form-check-inline mt-2">
                                                <label class="form-check-label">
                                                <input type="radio" class="is_active" id="is_active-2" name="is_active" value="0" <?php echo old('is_active') == 0?'checked':''; ?>> No</label>
                                            </div>
                                            <div class="form-check form-check-inline mt-2">
                                                <label class="form-check-label">
                                                <input type="radio" class="is_active" id="is_active-1" name="is_active" value="1" checked> Yes</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label id="image_label">Thumbnail*</label><small> (740x420 px)</small>

                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" id="image_upload" type="file" name="thumbnail" required accept=".jpeg,.jpg,.png,.gif">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    <label id="file-name"></label>
                                                </div>
                                            </div>
                                            <img id="imagePreview" width="70">
                                        </div>
                                        <div class="col-md-6 form-group mb-3 not_configurable">
                                            <label>Video Url*</label>
                                            <input class="form-control"  type="url"
                                                placeholder="Enter url" name="url"  value="{{old('url')}}">
                                        </div>
                                        <div class="col-md-6 form-group mb-3 not_configurable">
                                            <label >Video Position*</label>
                                            <select name="video_position" id="video_position" class="form-control"  required>
                                                <option value="0" >First</option>
                                                <option value="1">Last</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6 form-group mb-3 not_configurable">
                                            <label id="image_label">Images*</label><small> (740x500 px)</small>

                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" id="multiple_upload" type="file" name="images[]" required multiple accept=".jpeg,.jpg,.png,.gif">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    <label id="file-name"></label>
                                                </div>
                                            </div>

                                            <div class="image_preview_wrapper d-flex">

                                            </div>

                                        </div>
                                        <div class="col-md-12 form-group mb-3 flagship_type hide">
                                            <label >Flagship Description*</label>
                                            <textarea name="flagship_description" class="form-control ">{{old('flagship_description')}}</textarea>

                                        </div>
                                        <div class="col-md-12 form-group mb-3">
                                            <label >Short Description*</label><small> (For listing page)</small>
                                            <textarea name="short_description" class="form-control tinymce {{ $errors->has('short_description') ? ' is-invalid' : '' }}">{{old('short_description')}}</textarea>
                                            @if($errors->has('short_description'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('short_description') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="col-md-12 form-group mb-3">
                                            <label >Description*</label>
                                            <textarea name="description" class="form-control tinymce {{ $errors->has('description') ? ' is-invalid' : '' }}">{{old('description')}}</textarea>
                                            @if($errors->has('description'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <!-- <div class="col-md-12 form-group mb-3 not_configurable">
                                            <label >Overview*</label>
                                            <textarea name="overview" class="form-control tinymce {{ $errors->has('overview') ? ' is-invalid' : '' }}">{{old('overview')}}</textarea>
                                            @if($errors->has('overview'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('overview') }}</strong>
                                                </span>
                                            @endif
                                        </div> -->

                                        <div class="col-md-12 form-group mb-3 not_configurable">
                                            <label >Specifications*</label>
                                            <textarea name="specification" class="form-control tinymce {{ $errors->has('specification') ? ' is-invalid' : '' }}">{{old('specification')}}</textarea>
                                            @if($errors->has('specification'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('specification') }}</strong>
                                                </span>
                                            @endif
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

                                        <div class="attributes_wrapper col-12 hide">
                                            <h4>Attributes</h4>

                                            <div class="attributes_div row">

                                            </div>
                                        </div>

                                        <div class="col-md-12 d-flex">
                                            <button type="submit" id="submit" class="btn btn-primary">Submit</button>
                                            <a class="btn btn-light ml-3" href="{{URL('admin/products')}}">Back</a>
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
    <script src="{{asset('public/admins/js/product-detail.js')}}"></script>
@endsection

@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold">Edit Product</h4>

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
                           Edit Product
                        </li>

                    </ol>
                </nav>

                <div class="separator-breadcrumb border-top"></div>

                <div class="container">
                    <div class="row">
                        @if(session()->has('message'))
                           <div class="col-12 alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert">&times;</button>
                                {{ session()->get('message') }}
                            </div>
                        @endif
                    </div>
                </div>


                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <form method="POST" action="{{URL('admin/products/update')}}" enctype='multipart/form-data'>
                                    @csrf
                                    <input type="hidden" name="id" value="{{$product->id}}">
                                    <div class="row">
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Name*</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter name" name="name" required value="{{$product->name}}">
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Model Number*</label>
                                            <input class="form-control {{ $errors->has('sku') ? ' is-invalid' : '' }}"  type="text"
                                                placeholder="Enter sku" name="sku" required value="{{$product->sku}}" >
                                                @if($errors->has('sku'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('sku') }}</strong>
                                                </span>
                                            @endif
                                        </div>
 <div class="col-md-6 form-group mb-3">
                                            <label >Product Code*</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter Product Code" name="product_code"  value="{{$product->product_code}}">
                                            @if(session()->has('message_duplicate_code'))
                                                <span class="has-danger">
                                                    <strong class="form-control-feedback">{{ session()->get('message_duplicate_code') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Category*</label>
                                            <select name="category_id" id="category_id" class="form-control" disabled required>
                                                <option value="{{$product->category_id}}">{{$product->category->name}}</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Type*</label>
                                            <br>
                                            <div class="form-check form-check-inline mt-2">
                                                <label class="form-check-label">
                                                <input type="radio" class="product_type" id="type-2" name="type" value="0" <?php echo $product->type == 0?'checked':''; ?> disabled> Single</label>
                                            </div>
                                            <div class="form-check form-check-inline mt-2">
                                                <label class="form-check-label">
                                                <input type="radio" class="product_type" id="type-1" name="type" value="1" <?php echo $product->type == 1?'checked':''; ?> disabled> Configurable</label>
                                            </div>
                                        </div>


                                        @if($product->type == 0)
                                            <div class="col-md-6 form-group mb-3 not_configurable">
                                                <label >Price*</label>
                                                <input class="form-control allow_decimal"  type="text"
                                                    placeholder="Enter price" name="price" required value="{{$product->price}}"  id="max_price">
                                            </div>

                                            <div class="col-md-6 form-group mb-3 not_configurable">
                                                <label >Offer Price</label>
                                                <input class="form-control"  type="number"
                                                    placeholder="Enter offer price" name="offer_price" value="{{$product->offer_price == $product->price?'':$product->offer_price}}" id="offer_price"  onBlur="priceCalculation()" max="{{$product->price-1}}">
                                            </div>
                                             @endif
                                            <?php $counter = 0; ?>
                                            <div class="add_card_div col-md-12">

                                                @if($product->online->count() > 0)
                                                    @foreach($product->online as $voucher_key => $online)
                                                        <div class="row vendor_clone " >
                                                            <div class="col-md-5 form-group mb-3 ">
                                                                <label >Online Store name</label>
                                                                <select name="vendor_id[]"  class="form-control vendor_change">
                                                                    <option value="">Select</option>
                                                                    @foreach($vendors as $vendor)
                                                                        <option value="{{$vendor->id}}" <?php echo $online->vendor_id == $vendor->id?'selected':''; ?>>{{$vendor->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-6 form-group mb-3 ">
                                                                <label >Online Store Link</label>
                                                                <input class="form-control"  type="text"
                                                                    placeholder="Enter link" name="link[]" value="{{$online->online_link}}">
                                                            </div>
                                                            <div class="col-md-1 pull-right mt-4">
                                                                <button type="button" class="add_more_vendor btn btn-sm btn-info font-18 <?php echo $counter ==0?'':'hide'; ?>"><i class="las la-plus"></i></button>
                                                                    <!-- <button type="button"  class="btn btn-danger delete_vendor_edit <?php //echo count($vendors) > 1?'':'hide'; ?>"><svg aria-hidden="true" width="10" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg></a> -->
                                                                    <a href="{{URL('admin/products/deleteProductVendor')}}/{{$online->vendor_id}}/{{$product->id}}" class="btn btn-danger delete_vendor_id_edit"><svg aria-hidden="true" width="10" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg></a>

                                                            </div>
                                                        </div>
                                                    <?php $counter++; ?>
                                                    @endforeach
                                                @else
                                                    <div class="field_wrapper add_vendor_div">
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
                                                            <button class="delete_vendor_edit btn btn-danger hide"><svg aria-hidden="true" width="10" focusable="false" data-prefix="fal" data-icon="trash-alt" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" class="svg-inline--fa fa-trash-alt fa-w-14"><path fill="currentColor" d="M296 432h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zm-160 0h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8zM440 64H336l-33.6-44.8A48 48 0 0 0 264 0h-80a48 48 0 0 0-38.4 19.2L112 64H8a8 8 0 0 0-8 8v16a8 8 0 0 0 8 8h24v368a48 48 0 0 0 48 48h288a48 48 0 0 0 48-48V96h24a8 8 0 0 0 8-8V72a8 8 0 0 0-8-8zM171.2 38.4A16.1 16.1 0 0 1 184 32h80a16.1 16.1 0 0 1 12.8 6.4L296 64H152zM384 464a16 16 0 0 1-16 16H80a16 16 0 0 1-16-16V96h320zm-168-32h16a8 8 0 0 0 8-8V152a8 8 0 0 0-8-8h-16a8 8 0 0 0-8 8v272a8 8 0 0 0 8 8z" class=""></path></svg></button>
                                                        </div>
                                                        </div>

                                                    </div>

                                                @endif
                                            </div>

                                        <div class="col-md-3 form-group mb-3">
                                            <label >Stock*</label>
                                            <br>
                                            <div class="form-check form-check-inline mt-2">
                                                <label class="form-check-label">
                                                <input type="radio" class="stock" id="stock-2" name="stock" value="0" <?php echo $product->stock == 0?'checked':''; ?>> No</label>
                                            </div>
                                            <div class="form-check form-check-inline mt-2">
                                                <label class="form-check-label">
                                                <input type="radio" class="stock" id="stock-1" name="stock" value="1" <?php echo $product->stock == 1?'checked':''; ?>> Yes</label>
                                            </div>
                                        </div>

                                        @if($product->type == 0)
                                            <div class="col-md-3 form-group mb-3 not_configurable">
                                                <label >Flagship*</label>
                                                <br>
                                                <div class="form-check form-check-inline mt-2">
                                                    <label class="form-check-label">
                                                    <input type="radio" class="is_flagship" id="is_flagship-2" name="is_flagship" value="0" <?php echo $product->is_flagship == 0?'checked':''; ?>> No</label>
                                                </div>
                                                <div class="form-check form-check-inline mt-2">
                                                    <label class="form-check-label">
                                                    <input type="radio" class="is_flagship" id="is_flagship-1" name="is_flagship" value="1" <?php echo $product->is_flagship == 1?'checked':''; ?>> Yes</label>
                                                </div>
                                                <br>
                                                @if(session()->has('message_flagship'))
                                                    <span class="has-danger">
                                                        <strong class="form-control-feedback">{{ session()->get('message_flagship') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        @endif

                                        <div class="col-md-3 form-group mb-3">
                                            <label >New Arrival*</label>
                                            <br>
                                            <div class="form-check form-check-inline mt-2">
                                                <label class="form-check-label">
                                                <input type="radio" class="is_new" id="is_new-2" name="is_new" value="0" <?php echo $product->is_new == 0?'checked':''; ?>> No</label>
                                            </div>
                                            <div class="form-check form-check-inline mt-2">
                                                <label class="form-check-label">
                                                <input type="radio" class="is_new" id="is_new-1" name="is_new" value="1" <?php echo $product->is_new == 1?'checked':''; ?>> Yes</label>
                                            </div>
                                        </div>

                                        <div class="col-md-3 form-group mb-3">
                                            <label >Active*</label>
                                            <br>
                                            <div class="form-check form-check-inline mt-2">
                                                <label class="form-check-label">
                                                <input type="radio" class="is_active" id="is_active-2" name="is_active" value="0" <?php echo $product->is_active == 0?'checked':''; ?>> No</label>
                                            </div>
                                            <div class="form-check form-check-inline mt-2">
                                                <label class="form-check-label">
                                                <input type="radio" class="is_active" id="is_active-1" name="is_active" value="1" <?php echo $product->is_active == 1?'checked':''; ?>> Yes</label>
                                            </div>
                                        </div>

                                        <div class="col-md-6 form-group mb-3 ">
                                            <label id="image_label">Thumbnail</label><small> (740x420 px)</small>

                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" id="image_upload" type="file" name="thumbnail" accept=".jpeg,.jpg,.png,.gif">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    <label id="file-name"></label>
                                                </div>
                                            </div>
                                            <img id="imagePreview" width="70">
                                            <img src="{{storage_url()}}/{{$product->thumbnail}}" width="100">
                                        </div>

                                        @if($product->type == 0)
                                        <div class="col-md-6 form-group mb-3 not_configurable">
                                            <label>Video Url*</label>
                                            <input class="form-control"  type="url"
                                                placeholder="Enter url" name="url"  value="{{$product->url}}">
                                        </div>
                                        <div class="col-md-6 form-group mb-3 not_configurable">
                                            <label >Video Position*</label>
                                            <select name="video_position" id="video_position" class="form-control"  required>
                                                <option value="0" @if($product->video_position==0) selected="selected" @endif>First</option>
                                                <option value="1"  @if($product->video_position==1) selected="selected" @endif>Last</option>
                                            </select>
                                        </div>
                                            <div class="col-md-6 form-group mb-3 not_configurable">
                                                <label id="image_label">Images</label><small> (740x500 px)</small>

                                                <div class="input-group mb-3">
                                                    <div class="custom-file">
                                                        <input class="custom-file-input" id="multiple_upload" type="file" name="images[]" multiple accept=".jpeg,.jpg,.png,.gif">
                                                        <label class="custom-file-label" for="inputGroupFile02"
                                                            aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                        <label id="file-name"></label>
                                                    </div>
                                                </div>

                                                <div class="image_preview_wrapper d-flex">

                                            </div>

                                                <div class="d-flex">
                                                    @foreach($product->images as $images)
                                                        <div class="cl-img-wrap">
                                                            <a target="_blank" href="{{storage_url()}}/{{$images->image}}"><img src="{{storage_url()}}/{{$images->image}}" width="60"></a>

                                                            <div class="cl-overlay">
                                                            <a href="{{URL('admin/products/deleteImage')}}/{{$images->id}}"><img class="cl-close-bt" src="{{asset('public/admins/images/close.svg')}}"></a></div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif

                                        <div class="col-md-12 form-group mb-3 flagship_type @if($product->is_flagship !=1) hide @endif">
                                            <label >Flagship Description*</label>
                                            <textarea name="flagship_description" class="form-control ">{{$product->flagship_description}}</textarea>

                                        </div>
                                        <div class="col-md-12 form-group mb-3">
                                            <label >Short Description*</label><small> (For listing page)</small>
                                            <textarea name="short_description" class="form-control tinymce {{ $errors->has('short_description') ? ' is-invalid' : '' }}">{{$product->short_description}}</textarea>
                                            @if($errors->has('short_description'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('short_description') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="col-md-12 form-group mb-3">
                                            <label >Description*</label>
                                            <textarea name="description" class="form-control tinymce {{ $errors->has('description') ? ' is-invalid' : '' }}">{{$product->description}}</textarea>
                                            @if($errors->has('description'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('description') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        @if($product->type == 0)
                                            <!-- <div class="col-md-12 form-group mb-3 not_configurable">
                                                <label >Overview*</label>
                                                <textarea name="overview" class="form-control tinymce {{ $errors->has('overview') ? ' is-invalid' : '' }}">{{$product->overview}}</textarea>
                                                @if($errors->has('overview'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('overview') }}</strong>
                                                </span>
                                                @endif
                                            </div> -->

                                            <div class="col-md-12 form-group mb-3 not_configurable">
                                                <label >Specifications*</label>
                                                <textarea name="specification" class="form-control tinymce {{ $errors->has('specification') ? ' is-invalid' : '' }}">{{$product->specification}}</textarea>
                                                @if($errors->has('specification'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('specification') }}</strong>
                                                </span>
                                                @endif
                                            </div>

                                            <div class="col-md-6 form-group mb-3 not_configurable">
                                                <label >Meta Title</label>
                                                <input class="form-control"  type="text"
                                                    placeholder="Enter your meta title" name="meta_title" value="{{$product->meta_title}}">
                                            </div>

                                            <div class="col-md-6 form-group mb-3 not_configurable">
                                                <label >Meta Keywords</label><small>( Seperate by commas)</small>
                                                <input class="form-control"  type="text"
                                                    placeholder="Enter your meta keywords" name="meta_tags" value="{{$product->meta_tags}}">
                                            </div>

                                            <div class="col-md-6 form-group mb-3 not_configurable">
                                                <label >Meta Description</label>
                                                <textarea class="form-control" name="meta_description">{{$product->meta_description}}</textarea>
                                            </div>
                                        @endif

                                        @if($product->type == 0)
                                            @if($product->attributes->count() > 0 && $product->attributes->count() > $attributes->count())
                                                <div class="attributes_wrapper col-12 <?php echo $product->attributes->count() > 0?'':'hide'; ?>">
                                                    <h4>Attributes</h4>

                                                    <div class="attributes_div row">
                                                        @foreach($product->attributes as $attribute)
                                                            <div class="col-md-6 form-group mb-3">
                                                                <label >{{$attribute->attribute->name}}*</label>
                                                                <input class="form-control"  type="text"
                                                                    placeholder="Enter {{$attribute->attribute->name}}" name="attribute[{{$attribute->attribute_id}}]" value="{{$attribute->value}}">
                                                            </div>
                                                        @endforeach

                                                    </div>

                                                </div>
                                            @elseif($product->attributes->count())

                                                <div class="attributes_wrapper col-12 <?php echo $product->attributes->count() > 0?'':'hide'; ?>">
                                                    <h4>Attributes</h4>

                                                    <div class="attributes_div row">
                                                        @foreach($product->attributes as $attribute)
                                                            <div class="col-md-6 form-group mb-3">
                                                                <label >{{$attribute->attribute->name}}*</label>
                                                                <input class="form-control"  type="text"
                                                                    placeholder="Enter {{$attribute->attribute->name}}" name="attribute[{{$attribute->attribute_id}}]" value="{{$attribute->value}}">
                                                            </div>
                                                        @endforeach
                                                        @foreach($attributes as $attribute)
                                                            <div class="col-md-6 form-group mb-3">
                                                                <label >{{$attribute->attribute->name}}*</label>
                                                                <input class="form-control"  type="text"
                                                                    placeholder="Enter {{$attribute->attribute->name}}" name="attribute[{{$attribute->attribute_id}}]"  value="">
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                </div>
                                            @else
                                                <div class="attributes_wrapper col-12 <?php echo $attributes->count() > 0?'':'hide'; ?>">
                                                    <h4>Attributes</h4>
                                                    <div class="attributes_div row">
                                                        @foreach($attributes as $attribute)
                                                            <div class="col-md-6 form-group mb-3">
                                                                <label >{{$attribute->attribute->name}}*</label>
                                                                <input class="form-control"  type="text"
                                                                    placeholder="Enter {{$attribute->attribute->name}}" name="attribute[{{$attribute->attribute_id}}]"  value="">
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                </div>
                                            @endif
                                        @endif

                                        <div class="col-md-12 d-flex">
                                            <button type="submit" class="btn btn-primary">Submit</button>
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
    <script src="{{asset('public/admins/js/product-detail-edit.js')}}"></script>
@endsection

@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold">Edit Varient</h4>

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
                            <a href="{{URL('admin/products/varient')}}/{{$product->parent_id}}">
                                Varients
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                           Edit Varient
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
                                <form method="POST" action="{{URL('admin/products/varient/update')}}" enctype='multipart/form-data'>
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

                                        <div class="col-md-6 form-group mb-3 not_configurable">
                                            <label >Price*</label>
                                            <input class="form-control allow_decimal"  type="text"
                                                placeholder="Enter price" name="price" required value="{{$product->price}}"  id="max_price">
                                        </div>

                                        <div class="col-md-6 form-group mb-3 not_configurable">
                                            <label >Offer Price</label>
                                            <input class="form-control allow_decimal"  type="text"
                                                placeholder="Enter offer price" name="offer_price" value="{{$product->offer_price == $product->price?'':$product->offer_price}}" id="offer_price"  onBlur="priceCalculation()" max="{{$product->price-1}}">
                                        </div>



                                        <div class="col-md-6 form-group mb-3">
                                            <label id="image_label">Thumbnail</label><small> (740x420 px)</small>

                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" id="image_upload" type="file" name="thumbnail" accept=".jpeg,.jpg,.png,.gif">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                        <img id="imagePreview" width="70">
                                                        <label id="file-name"></label>
                                                </div>
                                            </div>
                                            <img src="{{storage_url()}}/{{$product->thumbnail}}" width="100">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label>Video Url*</label>
                                            <input class="form-control"  type="url"
                                                placeholder="Enter url" name="url"  value="{{$product->url}}">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Video Position*</label>
                                            <select name="video_position" id="video_position" class="form-control"  required>
                                                <option value="0" @if($product->video_position==0) selected="selected" @endif>First</option>
                                                <option value="1"  @if($product->video_position==1) selected="selected" @endif>Last</option>
                                            </select>
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
                                                        <a href="{{URL('admin/products/varient/deleteImage')}}/{{$images->id}}"><img class="cl-close-bt" src="{{asset('public/admins/images/close.svg')}}"></a></div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-12 form-group mb-3 flagship_type @if($product->is_flagship !=1) hide @endif">
                                            <label >Flagship Description*</label>
                                            <textarea name="flagship_description" class="form-control ">{{$product->flagship_description}}</textarea>

                                        </div>
                                        <div class="col-md-12 form-group mb-3">
                                            <label >Description*</label>
                                            <textarea name="description" class="form-control tinymce{{ $errors->has('description') ? ' is-invalid' : '' }}">{{$product->description}}</textarea>
                                            @if($errors->has('description'))
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                        <!-- <div class="col-md-12 form-group mb-3 not_configurable">
                                            <label >Overview*</label>
                                            <textarea name="overview" class="form-control tinymce">{{$product->overview}}</textarea>
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

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Meta Title</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter your meta title" name="meta_title" value="{{$product->meta_title}}">
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Meta Keywords</label><small>( Seperate by commas)</small>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter your meta keywords" name="meta_tags" value="{{$product->meta_tags}}">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Meta Description</label>
                                            <textarea class="form-control" name="meta_description">{{$product->meta_description}}</textarea>
                                        </div>
                                        <div class="attributes_wrapper col-12 <?php echo $product->attributes->count() > 0?'':'hide'; ?>">
                                            <h4>Attributes</h4>
                                            <div class="attributes_div row">
                                                @foreach($product->attributes as $attribute)
                                                    <div class="col-md-6 form-group mb-3">
                                                        <label >{{$attribute->attribute->name}}*</label>
                                                        <input class="form-control {{ $errors->has('attribute.*') ? ' is-invalid' : '' }}"  type="text"
                                                            placeholder="Enter {{$attribute->attribute->name}}" name="attribute[{{$attribute->attribute_id}}]" required value="{{$attribute->value}}">
                                                    </div>
                                                @endforeach
                                                @if($errors->has('attribute.*'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('attribute.*') }}</strong>
                                                </span>
                                            @endif
                                            </div>
                                        </div>

                                        <div class="col-md-12 d-flex">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a class="btn btn-light ml-3" href="{{URL('admin/products/varient')}}/{{$product->parent_id}}">Back</a>
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
    <script src="{{asset('public/admins/js/product-varient-detail.js')}}"></script>
@endsection

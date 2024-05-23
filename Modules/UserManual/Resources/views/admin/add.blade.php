@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold">Add User Manual</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin')}}">
                                <span class="las la-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{URL('admin/user-manuals')}}">
                                User Manuals
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                           Add User Manual
                        </li>

                    </ol>
                </nav>
                
                <div class="separator-breadcrumb border-top"></div>
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <form method="POST" action="{{URL('admin/user-manuals/store')}}"  enctype='multipart/form-data'>
                                	@csrf
                                    <div class="row">
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Product</label>
                                            <select class="form-control {{ $errors->has('product_id') ? ' is-invalid' : '' }}" name="product_id" required>
                                                <option value="" disabled selected>Select</option>
                                                @foreach($products as $product)
                                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                                @endforeach
                                            </select>
                                            @if($errors->has('product_id'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('product_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>


                                        <div class="col-md-6 form-group mb-3">
                                            <label >Title</label>
                                            <input class="form-control {{ $errors->has('title') ? ' is-invalid' : '' }}"  type="text"
                                                placeholder="Enter title" name="title" required>
                                            @if($errors->has('title'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif
                                            </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Thumbnail</label><small> (120x60 px)</small>
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input class="custom-file-input {{ $errors->has('thumbnail') ? ' is-invalid' : '' }}" id="image_upload" type="file" name="thumbnail" required accept=".jpeg,.jpg,.png,.gif">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    <label id="file-name"></label>
                                                </div>
                                            </div>
                                            @if($errors->has('thumbnail'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('thumbnail') }}</strong>
                                                </span>
                                            @endif
                                            <img id="imagePreview" width="70">
                                        </div>

                                    
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Manual</label>
                                            
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input onchange="Filevalidation()" class="custom-file-input {{ $errors->has('manual') ? ' is-invalid' : '' }}" type="file" name="manual" id="manual" required accept="application/pdf">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    <label id="file-name"></label>
                                                </div>
                                            </div>
                                            <p id="size"></p>
                                            @if($errors->has('manual'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('manual') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        

                                        <div class="col-md-12 d-flex">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a class="btn btn-light ml-3" href="{{URL('admin/user-manuals')}}">Back</a>
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
    <script src="{{asset('public/admins/js/user-manual.js')}}"></script>
@endsection


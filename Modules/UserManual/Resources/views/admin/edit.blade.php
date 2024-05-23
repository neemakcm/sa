@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold">Edit User Manual</h4>

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
                           Edit User Manual
                        </li>

                    </ol>
                </nav>
                
                <div class="separator-breadcrumb border-top"></div>
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <form method="POST" action="{{URL('admin/user-manuals/update')}}"  enctype='multipart/form-data'>
                                    @csrf
                                    <input type="hidden" name="id" value="{{$manual->id}}">
                                    <div class="row">
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Product</label>
                                            <select class="form-control" name="product_id" disabled>
                                                <option disabled selected>{{$manual->product->name}}</option>
                                            </select>
                                        </div>


                                        <div class="col-md-6 form-group mb-3">
                                            <label >Title</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter title" name="title" required value="{{$manual->title}}">
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Thumbnail</label><small> (120x60 px)</small>
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" id="image_upload" type="file" name="thumbnail" accept=".jpeg,.jpg,.png,.gif">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    <label id="file-name"></label>
                                                </div>
                                            </div>
                                            <img id="imagePreview" width="70">
                                            <img src="{{storage_url()}}/{{$manual->thumbnail}}" width="100">
                                        </div>

                                    
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Manual</label>
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" type="file" name="manual" id="manual" onchange="Filevalidation()" accept="application/pdf">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    <label id="file-name"></label>
                                                </div>
                                            </div>
                                            <p id="size"></p>
                                            <a href="{{storage_url()}}/{{$manual->manual}}" target="_blank"><img src="{{asset('public/admins/images/pdf.png')}}" width="40"></a>
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
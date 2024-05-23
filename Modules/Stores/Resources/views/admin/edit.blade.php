@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold">Edit Store</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin')}}">
                                <span class="las la-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{URL('admin/stores')}}">
                                Stores
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                           Edit Store
                        </li>

                    </ol>
                </nav>
                
                <div class="separator-breadcrumb border-top"></div>
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <form method="POST" action="{{URL('admin/stores/update')}}"  enctype='multipart/form-data'>
                                    @csrf
                                    <input type="hidden" name="id" value="{{$store->id}}">
                                    <div class="row">
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Title</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter title" name="title" required value="{{$store->title}}">
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Address</label>
                                            <textarea class="form-control" required name="description" >{{$store->description}}</textarea>
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Location</label>
                                            <input type="text" class="form-control" required name="location" id="location" value="{{$store->location}}">
                                            <input type="hidden" id="lat" name="lat" value="{{$store->latitude}}"/>
                                            <input type="hidden" id="lng" name="lng" value="{{$store->longitude}}" /> 
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Mobile</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter mobile" name="mobile" id="mobile" onkeypress="return ValidateDrop(event);" required value="{{$store->mobile}}">
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Email</label>
                                            <input class="form-control"  type="email"
                                                placeholder="Enter email" name="email" required value="{{$store->email}}">
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Open Hour</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter open hour" name="open_hour" required value="{{$store->open_hour}}">
                                        </div>

                                        <!-- <div class="col-md-6 form-group mb-3">
                                            <label >Location</label><small> (500x500 px)</small>
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" id="image_upload" type="file" name="location" accept=".jpeg,.jpg,.png,.gif">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    <label id="file-name"></label>
                                                </div>
                                            </div>

                                            <img id="imagePreview" width="70">
                                            <img src="{{storage_url()}}/{{$store->location}}" width="100">
                                        </div> -->

                                        <div class="col-md-6 form-group mb-3">
                                            <label >State</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter state" name="state" required value="{{$store->state}}">
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >District</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter district" name="district" required value="{{$store->district}}">
                                        </div>

                                        <div class="col-md-12 d-flex">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a class="btn btn-light ml-3" href="{{URL('admin/stores')}}">Back</a>
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
<script src="{{asset('public/front/script/excalate-to-service.js')}}"></script>

<script src="{{asset('public/admins/js/google-api.js')}}"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{config('impex.keys.googleMap')}}&libraries=places&callback=initMap"></script>

@endsection
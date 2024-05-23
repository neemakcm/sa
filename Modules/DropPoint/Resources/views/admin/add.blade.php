@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold">Add Drop Point</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin')}}">
                                <span class="las la-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{URL('admin/drop-point')}}">
                                Drop Point
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                           Add Drop Point
                        </li>

                    </ol>
                </nav>
                
                <div class="separator-breadcrumb border-top"></div>
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <form method="POST" action="{{URL('admin/drop-point/store')}}"  enctype='multipart/form-data'>
                                	@csrf
                                    <div class="row">
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Title</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter title" name="title" required>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Address</label>
                                            <textarea class="form-control" required name="description" ></textarea>
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Location</label>
                                            <input type="text" class="form-control" required name="location" id="location">
                                            <input type="hidden" id="lat" name="lat" />
                                            <input type="hidden" id="lng" name="lng" /> 
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Mobile</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter mobile" name="mobile"  required onkeypress="return ValidateDrop(event);">
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Email</label>
                                            <input class="form-control"  type="email"
                                                placeholder="Enter email" name="email" required>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Open Hour</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter open hour" name="open_hour" required>
                                        </div>

                                        <!-- <div class="col-md-6 form-group mb-3">
                                            <label >Location</label><small> (500x500 px)</small>
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" id="image_upload" type="file" name="location" required accept=".jpeg,.jpg,.png,.gif">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    <label id="file-name"></label>
                                                </div>
                                            </div>
                                            <img id="imagePreview" width="70">
                                        </div> -->

                                        <div class="col-md-6 form-group mb-3">
                                            <label >State</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter state" name="state" required>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >District</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter district" name="district" required>
                                        </div>

                                        <div class="col-md-12 d-flex">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a class="btn btn-light ml-3" href="{{URL('admin/drop-point')}}">Back</a>
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
    <script src="{{asset('public/admins/js/drop-point.js')}}"></script>
    <script src="{{asset('public/admins/js/google-api.js')}}"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key={{config('impex.keys.googleMap')}}&libraries=places&callback=initMap"></script>

@endsection
@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold">Registered Product Details</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin')}}">
                                <span class="las la-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin/products/registered')}}">
                                Registered Products
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            Registered Product Details
                        </li>
                    </ol>
                </nav>

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
                    
                <div class="separator-breadcrumb border-top"></div>
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">

                                <h5><b>Product Information</b></h5>
                                <div class="row">
                                @if($request->products)
                                    <div class="col-md-6 form-group mb-3">
                                        <label >Model Number</label>
                                        <input class="form-control"  type="text" value=" {{$request->products->sku}} " disabled>
                                    </div>
@endif
                                    <div class="col-md-6 form-group mb-3">
                                        <label >Serial Number</label>
                                        <input class="form-control"  type="text" value="{{$request->serial_number}}" disabled>
                                    </div>
                                </div>

                                <br>

                                <h5><b>Contact Info</b></h5>
                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label >Name</label>
                                        <input class="form-control"  type="text" value="{{$request->first_name}} {{$request->last_name}}" disabled>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label >Mobile</label>
                                        <input class="form-control"  type="text" value="{{$request->mobile}}" disabled>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label >Email</label>
                                        <input class="form-control"  type="text" value="{{$request->email}}" disabled>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label >Address 1</label>
                                        <input class="form-control"  type="text" value="{{$request->address_1}}" disabled>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label >Address 2</label>
                                        <input class="form-control"  type="text" value="{{$request->address_2}}" disabled>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label >District/City/Town</label>
                                        <input class="form-control"  type="text" value="{{$request->district}}" disabled>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label >State</label>
                                        <input class="form-control"  type="text" value="{{$request->state}}" disabled>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label >Pin Code</label>
                                        <input class="form-control"  type="text" value="{{$request->pincode}}" disabled>
                                    </div>
                                </div>

                                <br>


                                <h5><b>Other Info</b></h5>
                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label >Purchase Date</label>
                                        <input class="form-control"  type="text" value="{{$request->purchased_date}}" disabled>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label >Purchased From</label>
                                        <input class="form-control"  type="text" value="{{$request->purchased_from}}" disabled>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label >Attached Document</label>
                                        <br>
                                        <a href="{{storage_url()}}/{{$request->document}}" target="_blank"><img src="{{storage_url()}}/{{$request->document}}" width="100"></a>
                                    </div>
                                </div>
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
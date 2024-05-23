@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold">Service Feedback Details</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin')}}">
                                <span class="las la-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin/service/feedback')}}">
                                Service Feedbacks
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            Service Feedback Details
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
                                        <label >Case Number </label>
                                        <input class="form-control"  type="text" value="{{$request->case_number}}" disabled>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label >Was your issue fixed?</label>
                                        <input class="form-control"  type="text" value="{{$request->is_fixed == 1?'Yes':'No'}}" disabled>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        @php
                                            if($request->rating == 1)
                                                $rate = 'Very Bad';
                                            else if($request->rating == 2)
                                                $rate = 'Bad';
                                            else if($request->rating == 3)
                                                $rate = 'Average';
                                            else if($request->rating == 4)
                                                $rate = 'Good';
                                            else
                                                $rate = 'Very Good';
                                        @endphp
                                        <label >Overall, how satisfied are you with the service provided? </label>
                                        <input class="form-control"  type="text" value="{{$rate}}" disabled>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label >Additional comments </label>
                                        <textarea class="form-control" disabled>{{$request->comments}}</textarea>
                                    </div>

                                    @if($request->attachment != '')
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Attached Document</label>
                                            <br>
                                            <a href="{{storage_url()}}/{{$request->attachment}}" target="_blank"><img src="{{asset('public/admins/images/document.png')}}" width="100"></a>
                                        </div>
                                    @endif
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
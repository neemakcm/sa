@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold">Product Feedback Details</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin')}}">
                                <span class="las la-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin/jobs')}}">
                                Jobs
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin/jobs/requests')}}/{{$job->job_id}}">
                                Job Requests
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            Job Request Details
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

                                <h5><b>Basic Info</b></h5>
                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label >Name</label>
                                        <input class="form-control"  type="text" value="{{$job->first_name}} {{$job->last_name}}" disabled>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label >Mobile</label>
                                        <input class="form-control"  type="text" value="{{$job->mobile}}" disabled>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label >Email</label>
                                        <input class="form-control"  type="text" value="{{$job->email}}" disabled>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label >District/City/Town</label>
                                        <input class="form-control"  type="text" value="{{$job->city}}" disabled>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label >State</label>
                                        <input class="form-control"  type="text" value="{{$job->state}}" disabled>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label >Address</label>
                                        <input class="form-control"  type="text" value="{{$job->address}}" disabled>
                                    </div>
                                </div>

                                <br>

                                <h5><b>Professional Details</b></h5>
                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label >Skill Set</label>
                                        <textarea class="form-control" disabled>{{$job->skill_set}}</textarea>
                                    </div>
                                </div>

                                <br>

                                <h5><b>Educational Details</b></h5>
                                <div class="row">
                                    @foreach($job->requestEducations as $educations)
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Institute / School</label>
                                            <input class="form-control"  type="text" value="{{$educations->institute}}" disabled>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Department</label>
                                            <input class="form-control"  type="text" value="{{$educations->department}}" disabled>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Degree</label>
                                            <input class="form-control"  type="text" value="{{$educations->degree}}" disabled>
                                        </div>

                                        <div class="col-md-3 form-group mb-3">
                                            <label >From</label>
                                            <input class="form-control"  type="text" value="{{$educations->from_month}} - {{$educations->from_year}}" disabled>
                                        </div>

                                        <div class="col-md-3 form-group mb-3">
                                            <label >To</label>
                                            <input class="form-control"  type="text" value="{{$educations->to_month}} - {{$educations->to_year}}" disabled>
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>

                                <br>

                                <h5><b>Experience Details</b></h5>
                                <div class="row">
                                    @foreach($job->requestExperience as $experience)
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Institute / School</label>
                                            <input class="form-control"  type="text" value="{{$experience->institute}}" disabled>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Job Title</label>
                                            <input class="form-control"  type="text" value="{{$experience->job_title}}" disabled>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Experience</label>
                                            <input class="form-control"  type="text" value="{{$experience->experience}}" disabled>
                                        </div>

                                        <div class="col-md-3 form-group mb-3">
                                            <label >From</label>
                                            <input class="form-control"  type="text" value="{{$experience->from_month}} - {{$experience->from_year}}" disabled>
                                        </div>

                                        <div class="col-md-3 form-group mb-3">
                                            <label >To</label>
                                            <input class="form-control"  type="text" value="{{$experience->to_month}} - {{$experience->to_year}}" disabled>
                                        </div>
                                        <hr>
                                    @endforeach
                                </div>

                                <br>

                                <h5><b>Attachment Info</b></h5>
                                <div class="row">
                                    <div class="col-md-6 form-group mb-3">
                                        <label >Resume</label>
                                        <br>
                                        <a href="{{storage_url()}}/{{$job->resume}}" target="_blank"><img src="{{asset('public/admins/images/document.png')}}" width="100"></a>
                                    </div>

                                    <div class="col-md-6 form-group mb-3">
                                        <label >Cover Letter</label>
                                        <br>
                                        <a href="{{storage_url()}}/{{$job->cover_letter}}" target="_blank"><img src="{{asset('public/admins/images/document.png')}}" width="100"></a>
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
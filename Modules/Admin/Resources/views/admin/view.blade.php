@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <div class="breadcrumb d-flex">
                    <h1 class="mr-2">Admin Details</h1>
                    <a class="btn btn-info m-1 ml-auto" href="{{URL('admin/admin-users')}}">Back</a>
                </div>
                <div class="separator-breadcrumb border-top"></div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-body">
                            <div class="row user-view-detail">
                    <div class="col-md-2">
                        <div class="imgWrapper">
                        	@if($user->photo != null)
                            	<img src="{{storage_url()}}/{{$user->photo}}" alt="lulu">
                            @else	
                            	<img src="{{asset('public/admins/images/user.png')}}" alt="lulu">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="details">
                            <h1>{{$user->first_name}} {{$user->last_name}}</h1>
                            <span>Mobile Number:</i>
                                <p>{{$user->phone}}</p>
                            </span>
                            <span>Role:</i>
                                <p>{{$user->roles->title}}</p>
                            </span>
                            <span>Email Id:<p>{{$user->email}}</p></span>
                            <!-- <span>Current Points:</i><p>dffdf</p></span> -->
                            <span>Member Since:</i>
                                <p>{{date('d-M-Y', strtotime($user->created_at))}}</p>
                            </span>
                            <span>Last Active:</i>
                            	@if($user->userLog->count() > 0)
                                	<p>{{date('d-M-Y', strtotime($user->userLog[0]->login_time))}}</p>
                                @else
                                	<p>---</p>
                                @endif
                            </span>
                            <span>Status:</i>
                            	@if($user->status == 0)
                                	<p>Inactive</p>
                                @else
                                	<p>Active</p>
                                @endif
                            </span>
                            
                        </div>
                    </div>
                </div>
                            </div>
                        </div>
                    </div>
                </div>
           
            </div>
            <div class="flex-grow-1"></div>

            <!-- fotter end -->
        </div>
    </div>
@stop
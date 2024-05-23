@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold">Add Role</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin')}}">
                                <span class="las la-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{URL('admin/roles')}}">
                                Roles
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                           Add Role
                        </li>

                    </ol>
                </nav>
                
                <div class="separator-breadcrumb border-top"></div>
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <form method="POST" action="{{URL('admin/roles/store')}}">
                                	@csrf
                                    <div class="row">
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Title</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter your role title" name="title" required>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Description</label>
                                            <textarea class="form-control" name="description" ></textarea>
                                        </div>

                                        <div class="col-md-12 form-group mb-3">
                                            <label >Permissions</label>
											<div class="row">
												@foreach($permissions as $perms)
                                                    @if($perms->title != 'Dashboard')
    		                                            <div class="col-md-3 form-group">
    			                                            <label class="checkbox checkbox-outline-primary">
    			                                    			<input type="checkbox" name="perms[]" value="{{$perms->id}}" ><span>{{$perms->title}}</span><span class="checkmark"></span>
    			                                			</label>
    			                                		</div>
                                                    @endif
			                                	@endforeach
											</div>
                                            @if(session()->has('message'))
                                                <span class="has-danger">
                                                    <strong class="form-control-feedback">{{ session()->get('message') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="col-md-12 d-flex">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a class="btn btn-light ml-3" href="{{URL('admin/roles')}}">Back</a>
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
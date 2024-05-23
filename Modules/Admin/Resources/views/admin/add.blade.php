@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold">Add Admin User</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin')}}">
                                <span class="las la-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{URL('admin/admin-users')}}">
                                Admin Users
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                           Add Admin User
                        </li>

                    </ol>
                </nav>


                <div class="separator-breadcrumb border-top"></div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <form method="POST" action="{{URL('admin/admin-users/store')}}" enctype='multipart/form-data'>
                                	@csrf
                                    <div class="row add-member">
                                        <div class="col-md-6 form-group mb-3">
                                            <label>Name*</label>
                                            <input class="form-control" type="text" placeholder="Enter name" name="name" required>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label>Email address*</label>
                                            <input class="form-control" type="email" placeholder="Enter email" name="email" required>

                                            @if ($errors->has('email'))
								                <span class="has-danger">
								                    <strong class="form-control-feedback">{{ $errors->first('email') }}</strong>
								                </span>
								            @endif
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label>Password*</label>
                                            <input class="form-control" type="password" placeholder="Enter password" name="password" required>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label>Role*</label>
                                            <select class="form-control" name="role_id">
                                                <option value="">Select Role</option>
                                                @foreach($roles as $role)
                                                	<option value="{{$role->id}}">{{$role->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label>Status</label>
                                            <select class="form-control" name="status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>


                                        <div class="col-md-12 d-flex">
                                            <button type="submit" class="btn btn-info">Add Admin</button>
                                            <a type="button" href="{{URL('admin/admin-users')}}" class="btn btn-light ml-3">Back</a>
                                        </div>
                                    </div>
                                </form>
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
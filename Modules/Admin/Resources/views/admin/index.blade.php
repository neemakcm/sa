@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content admin-content">
                <h4 class="mr-2 font-weight-bold">Admin Users</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin')}}">
                                <span class="las la-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                           Admin Users
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
                
            </div>

            <div class="row mb-4">
                <div class="col-md-12 mb-4">
                    <div class="card text-left">
                        <div class="card-body">
                            <div class="card-body d-flex filter-member">
                                <a href="{{URL('admin/admin-users/add')}}" type="button" class="btn btn-primary ripple m-1">Add Admin</a>
                            </div>  
                            <div class="table-responsive">
                                <table class="display table table-striped table-bordered" id="admin_users_table"
                                    style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Email</th>
                                            <th>Member Since</th>
                                            <th>Status</th>
                                            <th class="no-sort" width="10px">View</th>
                                        </tr>
                                    </thead>
                                </table>
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
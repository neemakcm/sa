@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold">Home Page Design</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin')}}">
                                <span class="las la-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin/homePage')}}">
                                Home Page Design
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            @if($id == 1)
                                Blocks
                            @endif

                            @if($id == 2)
                                New Arrivals
                            @endif

                            @if($id == 3)
                                Most Popular
                            @endif

                            @if($id == 4)
                                New Launches
                            @endif

                            @if($id == 5)
                                Other Products
                            @endif

                            @if($id == 6)
                                Offers
                            @endif
                        </li>

                    </ol>
                </nav>

                <div class="separator-breadcrumb border-top"></div>
                
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
                
                <input type="hidden" id="type" value="{{$id}}">
                    
                <div class="row mb-4 role-management">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">

                                @if(($id == 1 && $count < 4) || $id > 1)
                                    <a href="{{URL('admin/homePage/add')}}/{{$id}}" type="button" class="btn btn-primary ripple m-1 addBtn">Add Product</a>
                                @endif

                                <div class="table-responsive">      
                                    <table class="display table table-striped table-bordered" id="homepage_list_table" style="width: 100%;">
                                        <thead>
                                            <tr role="row">
                                                @if($id == 1 || $id == 5)
                                                    <th>Category</th>
                                                @else
                                                    <th>Product</th>
                                                @endif
                                                <th>Image</th>
                                                <th>Position</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>                                             
                                    </table>
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
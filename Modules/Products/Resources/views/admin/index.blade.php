@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold">Products</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin')}}">
                                <span class="las la-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                           Products
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
                @if($errors->has('*'))
   @foreach ($errors->all() as $error)
    <!-- // Do Some custom validation here to check if the "user.x" is present? -->
      <div>{{ $error }}</div>
  @endforeach
@endif 
                <div class="row mb-4 role-management">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">

                                <a href="{{URL('admin/products/add')}}" type="button" class="btn btn-primary ripple m-1 addBtn">Add Product</a>
                                
                                <div class="table-responsive">                           
                                    <table class="display table table-striped table-bordered" id="products_table" style="width: 100%;">
                                        <thead>
                                            <tr role="row">
                                                <th>Name</th>
                                                <th>Sku</th>
                                                <th>Category</th>
                                                <th>Type</th>
                                                <th>Image</th>
                                                <th>Status</th>
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
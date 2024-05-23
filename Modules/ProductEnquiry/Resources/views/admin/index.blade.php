@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold">Product Enquiry</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin')}}">
                                <span class="las la-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                        Product Enquiry
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
                <div class="row mb-4 role-management">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                
                                <a href="{{URL('admin/product-enquiry/export')}}" class="btn btn-primary float-right">Export</a>
                                <div class="table-responsive">                           
                                    <table class="display table table-striped table-bordered" id="product_enquiry_table" style="width: 100%;">
                                        <thead>
                                            <tr role="row">
                                                <th>Sl no</th>
                                                <th>First Name</th>
                                                <th>Last name</th>
                                               <th>Email</th>
                                                <th>Mobile</th>
                                                <th>Product</th>
                                                <th>Date</th>
                                                <th width="30px">Action</th>
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
@section('script')
    <script src="{{asset('public/admins/js/product-enquiry.js')}}"></script>
@endsection
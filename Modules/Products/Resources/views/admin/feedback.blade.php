@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold">Product Feedbacks</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin')}}">
                                <span class="las la-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            Product Feedbacks
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
                            <form method="post" action="{{URL('admin/products/product-feedback-export')}}">
                                @csrf
                                    <div class="row">
                                        <div class="col-md-4 form-group mb-3">
                                            <label>From Date*</label>
                                            <input class="form-control" type="date" placeholder="Enter date"
                                                name="from_date"  id="from_date">
                                        </div>
                                        <div class="col-md-4 form-group mb-3">
                                            <label>To Date*</label>
                                            <input class="form-control" type="date" placeholder="Enter date"
                                                name="to_date"  id="to_date">
                                        </div>
                                        <div class="col-md-2 form-group mb-3">
                                            <button type="button" class="btn btn-primary " id="searchFeedback"> Search </button>

                                            <button type="submit" class="btn btn-primary "
                                               >export</button>
                                        </div>
                                    </div>
                                </form>
                                <!-- <a href="{{URL('admin/products/feedbackExport')}}" class="btn btn-primary float-right">Export</a> -->
                                <div class="table-responsive">                           
                                    <table class="display table table-striped table-bordered" id="product_feedback_table" style="width: 100%;">
                                        <thead>
                                            <tr role="row">
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Product</th>
                                                <th>Category</th>
                                                <th>Serial Number</th>
                                                <th>Date</th>
                                                <th width="30px">View</th>
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
    <script src="{{ asset('public/admins/js/product-feedback.js') }}"></script>
@endsection
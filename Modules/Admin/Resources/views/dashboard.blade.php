@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <div class="breadcrumb">
                <ul>
                    <li><a href="">Dashboard</a></li>
                </ul>
            </div>
            <div class="separator-breadcrumb border-top"></div>
            <div class="row mb-4 role-management">
                <div class="col-md-12 mb-4">
                    <div class="card text-left">
                        <div class="card-body">

                            <a href="{{URL('admin/page-cache')}}" type="button" class="btn btn-primary ripple m-1 addBtn"> Clear Cache</a>
                        </div>
                    </div>
                </div>
            </div>    
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
            <div class="row">
               
                <!-- ICON BG-->
                @if( in_array('products',$permissions))
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{URL('admin/products')}}">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><i class="i-File-Clipboard-File--Text"></i>
                                <div class="content">
                                    <p class="text-muted mt-2 mb-0">Product</p>
                                    <p class="text-primary text-24 line-height-1 mb-2">{{$product_count}}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                @if( in_array('services',$permissions))
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{URL('admin/service')}}">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><i class="i-File-Clipboard-File--Text"></i>
                                <div class="content">
                                    <p class="text-muted mt-2 mb-0">Service Request</p>
                                    <p class="text-primary text-24 line-height-1 mb-2">{{$service_request_count}}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                @if(in_array('product_enquiry',$permissions))
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{URL('admin/product-enquiry')}}">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><i class="i-Checkout-Basket"></i>
                                <div class="content">
                                    <p class="text-muted mt-2 mb-0">Product Enquiry</p>
                                    <p class="text-primary text-24 line-height-1 mb-2">{{$product_enquiry_count}}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endif 
            @if(in_array('sales_enquiry',$permissions))
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <a href="{{URL('admin/sales-enquiry')}}">
                        <div class="card card-icon-bg card-icon-bg-primary o-hidden mb-4">
                            <div class="card-body text-center"><i class="i-File-Clipboard-File--Text"></i>
                                <div class="content">
                                    <p class="text-muted mt-2 mb-0">Sales Enquiry</p>
                                    <p class="text-primary text-24 line-height-1 mb-2">{{$sales_enquiry_count}}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endif
            </div>
        </div>
        <b>Welcome to Impex</b>

        @stop
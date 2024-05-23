@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                
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
                    

                <div class="main-content shopList">
                    <h4 class="mr-2 font-weight-bold">Latest Videos</h4>

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb p-0">
                            <li class="breadcrumb-item">
                                <a href="{{URL('/')}}">
                                    <span class="las la-home"></span>
                                </a>
                            </li>
                            <li class="breadcrumb-item">
                                Latest Videos
                            </li>
                        </ol>
                    </nav>

                    <div class="separator-breadcrumb border-top"></div>
                    
                </div>


                <div class="row mb-4 role-management">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <div class="card-body d-flex filter-member">
                                    <a href="{{URL('admin/latestVideos/add')}}" type="button" class="btn btn-primary ripple m-1">Add Video</a>
                                </div>
                                
                                <div class="table-responsive">                           
                                    <table class="display table table-striped table-bordered" id="latest_table" style="width: 100%;">
                                        <thead>
                                            <tr role="row">
                                                <th>Tile</th>
                                                <th>Description</th>
                                                <th>Thumbnail</th>
                                                <th>Type</th>
                                                <th>Video</th>
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
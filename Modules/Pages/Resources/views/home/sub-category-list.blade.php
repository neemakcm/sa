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
                            <a href="{{URL('/admin/homePage/list',$type)}}">
                                Other Products
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                          Other Products Subcategory
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

                <div class="row mb-4 role-management">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">

                                <div class="table-responsive">
                                    <div class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                        <table class="display table table-striped table-bordered dataTable no-footer" id="homepage_index_table" style="width: 100%;" role="grid" aria-describedby="homepage_index_table_info">
                                            <thead>
                                                <tr role="row">
                                                    <th>Sub Category</th>
                                                </tr>
                                                @foreach($subcategories as $category)
                                                    <tr role="row">
                                                        <td>{{$category->categories->name}}</td>
                                                         @if($category->deleted_at)
                                                        <td><a href="{{URL('/admin/homePage/sub-category/restore',$category->id)}}" title="Delete">Active</td>
                                                        @else
                                                        <td><a href="{{URL('/admin/homePage/sub-category/delete',$category->id)}}" title="Delete">Inactive</a></td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </thead>
                                        </table>
                                    </div>
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

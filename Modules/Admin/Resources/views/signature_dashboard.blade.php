@extends('admin::layouts.signature')

@section('content')

	
	<div class="main-content-wrap sidenav-open d-flex flex-column">
        <!-- ============ Body content start ============= -->
        <div class="main-content">

            <!-- Quick Search -->
            <div class="row">
                <div class="col-12">
                    <div class="widget-inline mb-30px">
                        <div class="card-body p-0">
                            <!-- Item -->
                            <div class="card h-100 br-0 text-center">
                                <div class="card-header bg-color-w pt-4 pb-4">
                                    <h6 class="mb-0 t-font-boldest text-uppercase text-left">Quick Search</h6>
                                </div>
                                <div class="card-body pt-4 pb-4 text-left">
                                    <!-- Quick Search -->
                                    <div class="quick-search-panel">
                                        <form class="d-sm-inline-block w-100">
                                            @csrf
                                            <div class="input-group input-group-search">
                                                <input type="text" class="form-control" placeholder="Quick Search..." id="dashboard_search_input" aria-label="Search">
                                                <div class="input-group-append">
                                                    <a class="btn btn-quick-search" type="button" href="#" id="dashboard_search">
                                                        <i class="las la-search"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- Quick Search END -->
                                </div>
                            </div>
                            <!-- Item END -->
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Search END -->
            <div class="breadcrumb">
                <h4 class="t-font-bolder mr-2">Signature Club Members</h4>
            </div>

            <div class="separator-breadcrumb border-top"></div>

            <div class="row">
                <div class="col-12">
                    <div class="widget-inline mb-30px">
                        <div class="card-body p-0">
                            <div class="row">

                                <!-- Item -->
                                <div class="col-sm-6 col-xl-3">
                                    <div class="card widget-inline z-depth-1 m-0">
                                        <div class="card-body text-center">
                                            <i class="dripicons-tags text-muted"></i>
                                            <h2><span class=" t-font-boldest text-info">26</span></h2>
                                            <p class="text-muted t-font-bolder mb-0 text-uppercase">Total Users
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Item END -->

                                <!-- Item -->
                                <div class="col-sm-6 col-xl-3">
                                    <div class="card widget-inline z-depth-1 m-0">
                                        <div class="card-body text-center">
                                            <!-- <i class="las la-user"></i> -->
                                            <h2><span class=" t-font-boldest text-info">13</span></h2>
                                            <p class="text-muted t-font-bolder mb-0 text-uppercase">Male</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Item END -->
                                <!-- Item -->
                                <div class="col-sm-6 col-xl-3">
                                    <div class="card widget-inline z-depth-1 m-0">
                                        <div class="card-body text-center">
                                            <i class="dripicons-link-broken text-muted"></i>
                                            <h2><span class=" t-font-boldest text-info">10</span></h2>
                                            <p class="text-muted t-font-bolder mb-0 text-uppercase">Female</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Item END -->
                                <!-- Item -->
                                <div class="col-sm-6 col-xl-3">
                                    <div class="card widget-inline z-depth-1 m-0">
                                        <div class="card-body text-center">
                                            <i class="dripicons-star text-muted"></i>
                                            <h2><span class=" t-font-boldest text-info">3</span></h2>
                                            <p class="text-muted t-font-bolder mb-0 text-uppercase">Others</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Item END -->


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="breadcrumb">
                <h4 class="t-font-bolder mr-2">Plans</h4>
            </div>

            <div class="separator-breadcrumb border-top"></div>

            <div class="row">
                <div class="col-12">
                    <div class="widget-inline mb-30px">
                        <div class="card-body p-0">
                            <div class="row">

                                <!-- Item -->
                                <div class="col-sm-6 col-xl-3 mb-4">
                                    <div class="card h-100 br-0 text-center">
                                        <div class="card-header bg-color-w pt-4 pb-4">
                                            <h6 class="mb-0 t-font-boldest text-uppercase">Plan 01</h6>
                                        </div>
                                        <div class="card-body pt-4 pb-4 text-center">
                                            <h2 class="t-font-boldest text-info">2000 / 2500</h2>
                                            <p class="text-muted t-font-bolder mb-0 text-uppercase">50 Users</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Item END -->

                                <!-- Item -->
                                <div class="col-sm-6 col-xl-3 mb-4">
                                    <div class="card h-100 br-0 text-center">
                                        <div class="card-header bg-color-w pt-4 pb-4">
                                            <h6 class="mb-0 t-font-boldest text-uppercase">Plan 02</h6>
                                        </div>
                                        <div class="card-body pt-4 pb-4 text-center">
                                            <h2 class="t-font-boldest text-info">200 / 250</h2>
                                            <p class="text-muted t-font-bolder mb-0 text-uppercase">50 Users</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Item END -->

                                <!-- Item -->
                                <div class="col-sm-6 col-xl-3 mb-4">
                                    <div class="card h-100 br-0 text-center">
                                        <div class="card-header bg-color-w pt-4 pb-4">
                                            <h6 class="mb-0 t-font-boldest text-uppercase">Plan 03</h6>
                                        </div>
                                        <div class="card-body pt-4 pb-4 text-center">
                                            <h2 class="t-font-boldest text-info">1890 / 2000</h2>
                                            <p class="text-muted t-font-bolder mb-0 text-uppercase">50 Users</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Item END -->

                                <!-- Item -->
                                <div class="col-sm-6 col-xl-3 mb-4">
                                    <div class="card h-100 br-0 text-center">
                                        <div class="card-header bg-color-w pt-4 pb-4">
                                            <h6 class="mb-0 t-font-boldest text-uppercase">Plan 04</h6>
                                        </div>
                                        <div class="card-body pt-4 pb-4 text-center">
                                            <h2 class="t-font-boldest text-info">6980 / 8000</h2>
                                            <p class="text-muted t-font-bolder mb-0 text-uppercase">50 Users</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Item END -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>




        </div>
    </div>

    <div class="modal fade" id="modalSearchFail" tabindex="-1" role="dialog" aria-labelledby="modalSearchFailLabel" style="padding-right: 15px;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="p-3 text-center modal-search--result pb-5">

                        <div class="icon-sad">
                            <i class="las la-frown"></i>
                        </div>
                        <h4 class="text-info t-font-bolder mb-3">Sorry! Nothing Found.</h4>
                        <p class="font-14 small muted">
                            User not a loyalty member. You can Create an account Using the Button below.
                        </p>

                        <a href="{{URL('admin/app-users/add?redirect=signature')}}" class="btn btn-info btn-md mb-2 mb-md-0 mx-md-2" id="new_member" style="min-width: 40%">Not a Loyalty Member</a>
                        <a href="{{URL('admin/app-users/add?redirect=signature')}}" class="btn btn-info btn-md mb-2 mb-md-0 mx-md-2" id="loyalty_member" style="min-width: 40%">Loyalty Member</a>
                    </div>
                </div>

            </div>
        </div>
    </div>


@stop
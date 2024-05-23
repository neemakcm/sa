@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold">Edit Support</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin')}}">
                                <span class="las la-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{URL('admin/products')}}">
                                Products
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{URL('admin/products/support')}}/{{$support->product_id}}">
                                Supports
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                           Edit Support
                        </li>

                    </ol>
                </nav>

                <div class="separator-breadcrumb border-top"></div>
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <form method="POST" action="{{URL('admin/products/support/update')}}" enctype='multipart/form-data'>
                                	@csrf
                                    <input type="hidden" name="id" value="{{$id}}">
                                    <div class="row">
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Support*</label>
                                            <select class="form-control" name="support_id" required>
                                                <option value="{{$support->support_id}}">{{$support->support->name}}</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Type*</label>
                                            <select class="form-control" name="type" id="support_type">
                                                <option value="0" <?php echo $support->type == 0?'selected':''; ?>>Text</option>
                                                <option value="1" <?php echo $support->type == 1?'selected':''; ?>>Image</option>
                                                <option value="2" <?php echo $support->type == 2?'selected':''; ?>>File</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Value*</label>

                                                @if($support->type == 0)
                                                    <input class="form-control"  type="text" placeholder="Enter value" name="value" id="support_value" value="{{$support->value}}" required>
                                                @elseif($support->type == 1)
                                                    <input class="form-control"  type="file" placeholder="Enter value" name="value" id="support_value">
                                                    <br>
                                                    <img src="{{storage_url()}}/{{$support->value}}" width="60">
                                                @elseif($support->type == 2)
                                                    <input class="form-control"  type="file" placeholder="Enter value" name="value" id="support_value">
                                                    <br>
                                                    <a href="{{storage_url()}}/{{$support->value}}">File</a>
                                                @endif
                                        </div>

                                        <div class="col-md-12 d-flex">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a class="btn btn-light ml-3" href="{{URL('admin/products/support')}}/{{$id}}">Back</a>
                                        </div>
                                    </div>
                                </form>
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
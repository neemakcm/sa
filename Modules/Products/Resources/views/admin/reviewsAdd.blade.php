@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold">Add Review</h4>

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
                            <a href="{{URL('admin/products/reviews')}}/{{$id}}">
                                Reviews
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                           Add Review
                        </li>

                    </ol>
                </nav>

                <div class="separator-breadcrumb border-top"></div>
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <form method="POST" action="{{URL('admin/products/reviews/store')}}" enctype='multipart/form-data'>
                                	@csrf
                                    <input type="hidden" name="product_id" value="{{$id}}">
                                    <div class="row">
                                        
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Name*</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter name" name="name" required>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label id="image_label">Image</label>

                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" id="image" type="file" name="image" accept=".jpeg,.jpg,.png,.gif">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    <label id="file-name"></label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Title*</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter title" name="title" required>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Rating*</label>
                                            <input class="form-control"  type="number"
                                                placeholder="Enter rating" name="rating" min="1" max="5" required>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Review*</label>
                                            <textarea class="form-control" required name="review"></textarea>
                                        </div>

                                        <div class="col-md-12 d-flex">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a class="btn btn-light ml-3" href="{{URL('admin/products/reviews')}}/{{$id}}">Back</a>
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
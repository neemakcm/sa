@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold">Edit Review</h4>

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
                            <a href="{{URL('admin/products/reviews')}}/{{$review->product_id}}">
                                Reviews
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                           Edit Review
                        </li>

                    </ol>
                </nav>

                <div class="separator-breadcrumb border-top"></div>
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <form method="POST" action="{{URL('admin/products/reviews/update')}}" enctype='multipart/form-data'>
                                    @csrf
                                    <input type="hidden" name="id" value="{{$id}}">
                                    <div class="row">
                                        
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Name*</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter name" name="name" disabled value="{{$review->name}}">
                                        </div>
                                    </div>
                                    
                                    <div class="row">

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Title*</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter title" name="title" required value="{{$review->title}}">
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Rating*</label>
                                            <input class="form-control"  type="number"
                                                placeholder="Enter rating" name="rating" min="1" max="5" required value="{{$review->rating}}">
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Review*</label>
                                            <textarea class="form-control" required name="review">{{$review->review}}</textarea>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Status</label>
                                            <select class="form-control" name="status">
                                                <option <?php echo $review->status == 1?'selected':''; ?> value="1">Active</option>
                                                <option <?php echo $review->status == 0?'selected':''; ?> value="0">Inactive</option>
                                            </select>
                                        </div>

                                        <div class="col-md-12 d-flex">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a class="btn btn-light ml-3" href="{{URL('admin/products/reviews')}}/{{$review->product_id}}">Back</a>
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
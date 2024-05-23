@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold">Edit Offer</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin')}}">
                                <span class="las la-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{URL('admin/offers')}}">
                                Offers
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                           Edit Offer
                        </li>

                    </ol>
                </nav>

                @if(session()->has('message_duplicate'))
                    <span class="has-danger">
                        <strong class="form-control-feedback">{{ session()->get('message_duplicate') }}</strong>
                    </span>
                @endif

                <div class="separator-breadcrumb border-top"></div>
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <form method="POST" action="{{URL('admin/offers/update')}}" enctype='multipart/form-data'>
                                	@csrf
                                    <input type="hidden" name="id" value="{{$offer->id}}">
                                    <div class="row">
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Product*</label>
                                            <select class="form-control" name="product_id">
                                                @foreach($products as $product)
                                                    <option <?php echo $offer->product_id == $product->id?'selected':''; ?> value="{{$product->id}}">{{$product->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Visibility Type</label>
                                            <select class="form-control" name="type">
                                                <option value="0" <?php echo $offer->type == 0?'selected':''; ?>>Without Form</option>
                                                <option value="1" <?php echo $offer->type == 1?'selected':''; ?>>With Form</option>
                                            </select>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >From Date*</label>
                                            <input class="form-control"  type="date"
                                                placeholder="Enter date" name="from_date" required value="{{$offer->from_date}}" id="from_date">
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >To Date*</label>
                                            <input class="form-control"  type="date"
                                                placeholder="Enter date" name="to_date" min="{{$offer->from_date}}" required value="{{$offer->to_date}}" id="to_date">
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Title*</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter title" name="title" required value="{{$offer->title}}">
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Sub title*</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter sub title" name="sub_title" required value="{{$offer->sub_title}}">
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Description*</label>
                                            <textarea class="form-control" name="description" required>{{$offer->description}}</textarea>
                                        </div>

                                        <div class="col-md-12 d-flex">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a class="btn btn-light ml-3" href="{{URL('admin/offers')}}">Back</a>
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
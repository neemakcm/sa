@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold">Edit Footer Link</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin')}}">
                                <span class="las la-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="URL('/admin/footerSettings')">Footer Design</a>
                        </li>
                        <li class="breadcrumb-item">
                            Edit Footer Link
                        </li>

                    </ol>
                </nav>

                <div class="separator-breadcrumb border-top"></div>
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <form method="POST" action="{{URL('admin/footerSettings/update')}}" enctype='multipart/form-data'>
                                    <input type="hidden" name="id" value="{{$footer->id}}">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Title*</label>
                                            <input class="form-control" type="text" name="title" required value="{{$footer->title}}">
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Link*</label>
                                            <input class="form-control" type="url" name="link" required value="{{$footer->link}}">
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Type</label>
                                            <select class="form-control" name="type">
                                                <option value="1" <?php echo $footer->type == 1?'selected':''; ?>>Service & Support</option>
                                                <option value="2" <?php echo $footer->type == 2?'selected':''; ?>>Quick Links</option>
                                            </select>
                                        </div>

                                        <div class="col-md-12 d-flex">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a class="btn btn-light ml-3" href="{{URL('admin/footerSettings')}}">Back</a>
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
@section('script')
    <script src="{{asset('public/admins/js/home-page.js')}}"></script>
@endsection
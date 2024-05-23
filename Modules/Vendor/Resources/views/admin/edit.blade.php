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
                
                <h4 class="mr-2 font-weight-bold">Edit Vendor</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin')}}">
                                <span class="las la-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{URL('admin/vendor')}}">
                            Vendor
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                           Edit Video
                        </li>

                    </ol>
                </nav>

                <div class="separator-breadcrumb border-top"></div>
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                            <form method="POST" enctype='multipart/form-data' action="{{URL('admin/vendor/update',$vendor->id)}}" >
                                	@csrf
                                        <input type="hidden" name="id" value="{{$vendor->id}}">
                                        <div class="row add-member">
                                            
                                            <div class="col-md-6 form-group mb-3">
                                                <label for="firstName1">Name*</label>
                                                <input class="form-control" type="text" placeholder="Enter title" name="name" required value="{{$vendor->name}}">
                                            </div>

                                            

                                            <div class="col-md-6 form-group mb-3">
                                                <label >Thumbnail</label><small> (180x50 px)</small>

                                                <div class="input-group mb-3">
                                                    <div class="custom-file">
                                                        <input class="custom-file-input" id="file-upload" type="file" name="image" accept=".jpg,.png,.jpeg">
                                                        <label class="custom-file-label" for="inputGroupFile02"
                                                            aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                        <label id="file-name"></label>
                                                    </div>
                                                </div>

                                                <img src="{{storage_url()}}/{{$vendor->image}}" width="60">

                                            </div>    
                                            <div class="col-md-6 form-group mb-3">
                                                <label for="firstName1">Link*</label>
                                                <input class="form-control" type="text" placeholder="Enter link" name="link" required value="{{$vendor->link}}">
                                            </div>

                                        <div class="col-md-12 d-flex">
                                            <button type="submit" class="btn btn-primary" >Submit</button>
                                            <a class="btn btn-light ml-3" href="{{URL('admin/vendor')}}">Back</a>
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
    <script src="{{asset('public/admins/js/video-tutorial-list.js')}}"></script>
@endsection
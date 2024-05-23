@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold">Edit Banner</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin')}}">
                                <span class="las la-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{URL('admin/about/banners')}}">
                                Banners
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                           Edit Banner
                        </li>

                    </ol>
                </nav>

                <div class="separator-breadcrumb border-top"></div>
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <form method="POST" action="{{URL('admin/about/banners/update')}}" enctype='multipart/form-data'>
                                	@csrf

                                    <input type="hidden" name="id" value="{{$banner->id}}">
                                    <div class="row">
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Name*</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter Name" name="name" required value="{{$banner->name}}">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Title*</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter title" name="title" required value="{{$banner->title}}">
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Image*</label><small> (1520x760 px)</small>

                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" id="image_upload" type="file" name="image" accept=".jpeg,.jpg,.png,.gif">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    <label id="file-name"></label>
                                                </div>
                                            </div>

                                            <img id="imagePreview" width="70">

                                            <img src="{{storage_url()}}/{{$banner->image}}" width="100">
                                        </div>
                                        <div class="col-md-6 form-group mb-3 ">
                                            <label id="image_label">Mobile Image (360px * 540px)</label>

                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" id="mobile_image_upload" type="file" name="mobile_image" accept=".jpeg,.jpg,.png,.gif">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    <label id="file-name"></label>
                                                </div>
                                            </div>
                                            <img id="mobile_imagePreview" width="70">

                                            @if($banner->mobile_image != null)
                                                <img src="{{storage_url()}}/{{$banner->mobile_image}}" width="100">
                                            @endif
                                        </div>
                                        <div class="col-md-6 form-group mb-3 ">
                                            <label id="image_label">Tablet Image (768 * 1024 px)</label>

                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" id="tablet_image_upload" type="file" name="tablet_image" accept=".jpeg,.jpg,.png,.gif">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    <label id="file-name"></label>
                                                </div>
                                            </div>
                                            <img id="tablet_imagePreview" width="70">

                                            @if($banner->tablet_image != null)
                                                <img src="{{storage_url()}}/{{$banner->tablet_image}}" width="100">
                                            @endif
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Status</label>
                                            <select class="form-control" name="status">
                                                <option <?php echo $banner->status == 1?'selected':''; ?> value="1">Active</option>
                                                <option <?php echo $banner->status == 0?'selected':''; ?> value="0">Inactive</option>
                                            </select>
                                        </div>
                                        <div class="col-md-12 d-flex">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a class="btn btn-light ml-3" href="{{URL('admin/about/banners')}}">Back</a>
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
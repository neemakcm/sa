@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold">Edit Job</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin')}}">
                                <span class="las la-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{URL('admin/jobs')}}">
                                Jobs
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                           Edit Job
                        </li>

                    </ol>
                </nav>

                <div class="separator-breadcrumb border-top"></div>
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <form method="POST" action="{{URL('admin/jobs/update')}}" enctype='multipart/form-data'>
                                	@csrf

                                    <input type="hidden" name="id" value="{{$banner->id}}">
                                    <div class="row">
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Title*</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter title" name="title" required value="{{$banner->title}}">
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Job Category*</label>
                                            <select class="form-control" name="job_field_id" required>
                                                <option value="">Select</option>
                                                @foreach($fields as $field)
                                                    <option <?php echo $banner->job_field_id == $field->id?'selected':''; ?> value="{{$field->id}}">{{$field->title}}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Location*</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter location" name="location" required value="{{$banner->location}}">
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label >Company Description*</label>
                                            <textarea class="form-control" required name="company">{{$banner->company}}</textarea>
                                        </div>

                                        <div class="col-md-12 form-group mb-3">
                                            <label >Qualifications*</label>
                                            <textarea class="form-control tinymce" name="qualifications">{{$banner->qualifications}}</textarea>
                                        </div>

                                        <div class="col-md-12 form-group mb-3">
                                            <label >Responsibilities*</label>
                                            <textarea class="form-control tinymce" name="responsibilities">{{$banner->responsibilities}}</textarea>
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
                                            <a class="btn btn-light ml-3" href="{{URL('admin/jobs')}}">Back</a>
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
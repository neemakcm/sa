@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold">Add Video Tutorial</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin')}}">
                                <span class="las la-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{URL('admin/video-tutorials')}}">
                                Video Tutorial
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                           Add Video Tutorial
                        </li>

                    </ol>
                </nav>
                
                <div class="separator-breadcrumb border-top"></div>
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <form method="POST" id="video_tutorial_add_form" name="tutorial_add_form">
                                	@csrf
                                    <div class="row">
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Category</label>
                                            <select class="form-control" name="category_id" required>
                                                <option value="" disabled selected>Select</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                            <div class="col-md-6 form-group mb-3">
                                                <label for="firstName1">Title*</label>
                                                <input class="form-control" type="text" placeholder="Enter title" name="title" required>
                                            </div>

                                            <div class="col-md-6 form-group mb-3">
                                                <label for="phone">Description*</label>
                                                <textarea class="form-control" name="description" required></textarea>
                                            </div>

                                            <div class="col-md-6 form-group mb-3">
                                                <label >Thumbnail*</label><small> (340x220 px)</small>

                                                <div class="input-group mb-3">
                                                    <div class="custom-file">
                                                        <input class="custom-file-input" id="image_upload" type="file" name="thumbnail" required accept=".jpeg,.jpg,.png,.gif">
                                                        <label class="custom-file-label" for="inputGroupFile02"
                                                            aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                        <label id="file-name"></label>
                                                    </div>
                                                </div>
                                                <img id="imagePreview" width="70">
                                            </div> 

                                            <div class="col-md-6 form-group mb-3">
                                                <label >Type*</label>
                                                <select class="form-control" name="type" id="type">
                                                    <option value="0">Video</option>
                                                    <option value="1">YouTube</option>
                                                </select>
                                            </div>

                                            <input type="hidden" id="page_type" value="add">

                                            <div class="col-md-6 form-group mb-3 video_holder">
                                                <label >Video*</label>

                                                <div class="input-group mb-3">
                                                    <div class="custom-file">
                                                        <input class="custom-file-input video-upload video_input" id="video_upload" type="file" name="video" accept=".mp4">
                                                        <label class="custom-file-label" for="inputGroupFile02"
                                                            aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                        <!-- <label id="file-name"></label> -->
                                                    </div>
                                                    
                                                </div>
                                                <video style="display:block" id="video_div" width="400" controls class="video">
                                                        <source  id="video_here">
                                                        Your browser does not support HTML5 video.
                                                    </video>
                                            </div>   

                                            <div class="col-md-6 form-group mb-3 youtube_holder hide">
                                                <label >Video*</label>
                                                <input class="form-control youtube_input" type="url" placeholder="Enter url" name="video">
                                            </div>     
                                         

                                        <div class="col-md-12 d-flex">
                                            <button type="submit" class="btn btn-primary" id="add_tutorial_submit">Submit</button>
                                            <a class="btn btn-light ml-3" href="{{URL('admin/video-tutorials')}}">Back</a>
                                        </div>
                                    </div>
                                </form>
                                <div class='upload-progress col-md-12' id="progressDivId">
                                    <div class='progress-status-bar' id='progressBar'></div>
                                </div>
                                <div style="height: 10px;"></div>
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
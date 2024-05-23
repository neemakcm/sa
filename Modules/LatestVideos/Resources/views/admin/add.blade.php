@extends('admin::layouts.master')
@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.1/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>
@endsection
@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold">Add Video</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin')}}">
                                <span class="las la-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{URL('admin/latestVideos')}}">
                                Latest Videos
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                           Add Video
                        </li>

                    </ol>
                </nav>

                <div class="separator-breadcrumb border-top"></div>
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <form method="POST" id="latest_add_form" name="event_add_form">
                                	@csrf
                                        
                                        <div class="row add-member">
                                            <div class="col-md-6 form-group mb-3">
                                                <label for="firstName1">Title*</label>
                                                <input class="form-control" type="text" placeholder="Enter title" name="title" required>
                                            </div>
                                            <div class="col-md-3 form-group mb-3">
                                                <label >Title Color</label>
                                                <input class="form-control colorpicker"  type="text"
                                                    placeholder="Enter color code" name="title_color_code" value="">
                                            </div>
                                            <div class="col-md-2 form-group mb-3">
                                                <label >Title font size(px)</label>
                                                <input class="form-control "  type="number" placeholder="Enter Font Size" name="title_font_size" value="">
                                            </div>
                                            <div class="col-md-6 form-group mb-3">
                                                <label for="phone">Description*</label>
                                                <textarea class="form-control" name="description" required></textarea>
                                            </div>
                                            <div class="col-md-2 form-group mb-3">
                                                <label >Description Color</label>
                                                <input class="form-control colorpicker"  type="text"
                                                    placeholder="Enter color code" name="description_color_code" value="">
                                            </div>
                                            <div class="col-md-2 form-group mb-3">
                                                <label >Description Font Size(px)</label>
                                                <input class="form-control "  type="number"
                                                     name="description_font_size" value="">
                                            </div>
                                            <div class="col-md-6 form-group mb-3">
                                                <label >Thumbnail*</label><small> (600x630 px)</small>

                                                <div class="input-group mb-3">
                                                    <div class="custom-file">
                                                        <input class="custom-file-input" id="file-upload" type="file" name="thumbnail" accept=".jpg,.png,.jpeg" required>
                                                        <label class="custom-file-label" for="inputGroupFile02"
                                                            aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                        <label id="file-name"></label>
                                                    </div>
                                                </div>
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

                                            </div>    

                                            <div class="col-md-6 form-group mb-3 youtube_holder hide">
                                                <label >Video*</label>
                                                <input class="form-control youtube_input" type="url" placeholder="Enter url" name="video">
                                            </div>    

                                         

                                        <div class="col-md-12 d-flex">
                                            <button type="submit" class="btn btn-primary" id="add_event_submit">Submit</button>
                                            <a class="btn btn-light ml-3" href="{{URL('admin/latestVideos')}}">Back</a>
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
    <script>
        $('.colorpicker').colorpicker();
    </script>
@endsection
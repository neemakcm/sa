@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <div class="breadcrumb">
                    <h1 class="mr-2">Edit Page</h1>

                </div>
                
                <div class="separator-breadcrumb border-top"></div>
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <form method="POST" action="{{URL('admin/pages/update')}}" enctype='multipart/form-data'>
                                    @csrf
                                    <input type="hidden" name="id" value="{{$page->id}}">
                                    <div class="row">
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Title</label>
                                            <input class="form-control"  readonly type="text"
                                                placeholder="Enter your title" name="title" required value="{{$page->title}}">
                                        </div>
                                       

                                        <div class="col-md-6 form-group mb-3 ">
                                            <label id="image_label">First Image(1366 px × 480 px)</label>
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" id="image_upload" type="file" name="image" accept=".jpeg,.jpg,.png,.gif">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    <label id="file-name"></label>
                                                </div>
                                            </div>
                                            <img id="imagePreview" width="70">
                                            @if($page->image != null)
                                                <img src="{{storage_url()}}/{{$page->image}}" width="100">
                                            @endif
                                        </div>
                                           
                                        <div class="col-md-6 form-group mb-3  ">
                                            <label id="image_label">Mobile First Image (360px * 540px)</label>

                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" id="mobile_image_upload" type="file" name="mobile_image" accept=".jpeg,.jpg,.png,.gif">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    <label id="file-name"></label>
                                                </div>
                                            </div>
                                            <img id="mobile_imagePreview" width="70">

                                            @if($page->mobile_image != null)
                                                <img src="{{storage_url()}}/{{$page->mobile_image}}" width="100">
                                            @endif
                                        </div>
                                        <div class="col-md-12 form-group mb-3 ">
                                            <label >Sub Content</label>
                                            <textarea class="form-control" name="sub_description">{{$page->sub_description}}</textarea>
                                        </div>
                                        <div class="col-md-6 form-group mb-3 ">
                                            <label id="image_label">Description Desktop Image(1366 px × 480 px)</label>
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" id="description_desktop_image_upload" type="file" name="description_desktop_image_upload" accept=".jpeg,.jpg,.png,.gif">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    <label id="file-name"></label>
                                                </div>
                                            </div>
                                            <img id="description_imagePreview" width="70">
                                            @if($page->description_desktop_image_upload != null)
                                                <img src="{{storage_url()}}/{{$page->description_desktop_image_upload}}" width="100">
                                            @endif
                                        </div>
                                           
                                        <div class="col-md-6 form-group mb-3  ">
                                            <label id="image_label">Description Mobile Image (360px * 540px)</label>

                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" id="description_mobile_image_upload" type="file" name="description_mobile_image_upload" accept=".jpeg,.jpg,.png,.gif">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    <label id="file-name"></label>
                                                </div>
                                            </div>
                                            <img id="description_mobile_imagePreview" width="70">

                                            @if($page->description_mobile_image_upload != null)
                                                <img src="{{storage_url()}}/{{$page->description_mobile_image_upload}}" width="100">
                                            @endif
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Title Content</label>
                                            <input class="form-control"   type="text"
                                                placeholder="Enter your title" name="sub_title" required value="{{$page->sub_title}}">
                                        </div>
                                        <div class="col-md-12 form-group mb-3 ">
                                            <label >Content</label>
                                            <textarea class="form-control tinymce" name="description">{{$page->description}}</textarea>
                                        </div>
                                        <div class="col-md-6 form-group mb-3 ">
                                            <label id="image_label">Footer Desktop Image(1366 px × 480 px)</label>
                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" id="footer_desktop_image_upload" type="file" name="footer_desktop_image_upload" accept=".jpeg,.jpg,.png,.gif">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    <label id="file-name"></label>
                                                </div>
                                            </div>
                                            <img id="footer_imagePreview" width="70">
                                            @if($page->footer_desktop_image_upload != null)
                                                <img src="{{storage_url()}}/{{$page->footer_desktop_image_upload}}" width="100">
                                            @endif
                                        </div>
                                           
                                        <div class="col-md-6 form-group mb-3  ">
                                            <label id="image_label">Footer Mobile Image (360px * 540px)</label>

                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" id="footer_mobile_image_upload" type="file" name="footer_mobile_image_upload" accept=".jpeg,.jpg,.png,.gif">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    <label id="file-name"></label>
                                                </div>
                                            </div>
                                            <img id="footer_mobile_imagePreview" width="70">

                                            @if($page->footer_mobile_image_upload != null)
                                                <img src="{{storage_url()}}/{{$page->footer_mobile_image_upload}}" width="100">
                                            @endif
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Footer Title</label>
                                            <input class="form-control"   type="text"
                                                placeholder="Enter your title" name="footer_title" required value="{{$page->footer_title}}">
                                        </div>
                                        <div class="col-md-12 form-group mb-3 ">
                                            <label >Footer Content</label>
                                            <textarea class="form-control " name="footer_description">{{$page->footer_description}}</textarea>
                                        </div>


                                        <div class="col-md-6 form-group mb-3">
                                            <label >Status</label>
                                            <select class="form-control" name="status" required>
                                                <option value="1" <?php echo $page->status == 1?'selected':''; ?>>Active</option>
                                                <option value="0" <?php echo $page->status == 0?'selected':''; ?>>Inactive</option>
                                            </select>
                                        </div>
                                        
                                       
                                        
                                        <div class="col-md-12 ">
                                            <h4>Meta Fields</h4>
                                        </div>
                                        <div class="col-md-6 form-group mb-3 ">
                                            <label >Meta Title</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter your meta title" name="meta_title" value="{{$page->meta_title}}">
                                        </div>

                                        <div class="col-md-6 form-group mb-3 ">
                                            <label >Meta Keywords</label><small>( Seperate by commas)</small>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter your meta keywords" name="meta_tags" value="{{$page->meta_tags}}">
                                        </div>

                                        <div class="col-md-6 form-group mb-3 ">
                                            <label >Meta Description</label>
                                            <textarea class="form-control" name="meta_description">{{$page->meta_description}}</textarea>
                                        </div>
                                        <div class="col-md-12 d-flex">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a class="btn btn-light ml-3" href="{{URL('admin/pages')}}">Back</a>
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
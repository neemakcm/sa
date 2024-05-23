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
                                            <input class="form-control"  @if($page->slug!='covid-19-support') readonly @endif type="text"
                                                placeholder="Enter your title" name="title" required value="{{$page->title}}">
                                        </div>
                                        @php
                                            $nobanner = array('cookie-preferences','privacy-policy','terms-conditions','overview','our-history-images','our-history-content','user-manuals','drop-point','awards','our-milestone','our-management','our-values');
                                            $slug = array('what-we-believe','cookie-preferences','cookie-preferences','covid-19-support','working-at-impex','privacy-policy','terms-conditions','make-an-impact','drop-point','shape-the-future','take-on-big-challenges','job-fields','warranty-terms-condition','overview','user-manuals','our-history-images','our-history-content','our-mission','our-vision','manufacturing' ,'techzone','our-milestone','our-management','our-values','our-team','awards','careers');
                                            $meta = array('what-we-believe','home-page-latest-blog','cookie-preferences','cookie-preferences','covid-19-support','working-at-impex','privacy-policy','terms-conditions','make-an-impact','drop-point','shape-the-future','take-on-big-challenges','job-fields','warranty-terms-condition','overview','user-manuals','our-history-images','our-history-content','our-mission','our-vision','manufacturing' ,'techzone','our-milestone','our-management','our-values','our-team','awards','careers');
                                        
                                            
                                        @endphp
                                        <div class="col-md-6 form-group mb-3 @if(in_array($page->slug, $nobanner)) hide @endif">
                                            <label id="image_label">Image(1366 px × 480 px)</label>

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
                                           
                                        <div class="col-md-6 form-group mb-3  @if(in_array($page->slug, $slug)) hide @endif">
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

                                            @if($page->mobile_image != null)
                                                <img src="{{storage_url()}}/{{$page->mobile_image}}" width="100">
                                            @endif
                                        </div>
                                        <div class="col-md-6 form-group mb-3  @if(in_array($page->slug, $meta)) hide @endif">
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

                                            @if($page->tablet_image != null)
                                                <img src="{{storage_url()}}/{{$page->tablet_image}}" width="100">
                                            @endif
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Status</label>
                                            <select class="form-control" name="status" required>
                                                <option value="1" <?php echo $page->status == 1?'selected':''; ?>>Active</option>
                                                <option value="0" <?php echo $page->status == 0?'selected':''; ?>>Inactive</option>
                                            </select>
                                        </div>
                                        @if($page->slug == 'manufacturing' ||  $page->slug == 'careers')
                                            <div class="col-md-6 form-group mb-3">
                                                <label >Sub Title</label>
                                                <textarea class="form-control" name="sub_title">{{$page->sub_title}}</textarea>
                                            </div>
                                        @endif
                                        <div class="col-md-12 form-group mb-3 ">
                                            <label >Content</label>
                                            <textarea class="form-control tinymce" name="description">{{$page->description}}</textarea>
                                        </div>
                                        
                                        <div class="col-md-12 @if(in_array($page->slug, $meta)) hide @endif">
                                            <h4>Meta Fields</h4>
                                        </div>
                                        <div class="col-md-6 form-group mb-3 @if(in_array($page->slug, $meta)) hide @endif">
                                            <label >Meta Title</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter your meta title" name="meta_title" value="{{$page->meta_title}}">
                                        </div>

                                        <div class="col-md-6 form-group mb-3 @if(in_array($page->slug, $meta)) hide @endif">
                                            <label >Meta Keywords</label><small>( Seperate by commas)</small>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter your meta keywords" name="meta_tags" value="{{$page->meta_tags}}">
                                        </div>

                                        <div class="col-md-6 form-group mb-3 @if(in_array($page->slug, $meta)) hide @endif">
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
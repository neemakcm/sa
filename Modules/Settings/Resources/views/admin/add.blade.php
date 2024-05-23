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
                    <h1 class="mr-2">Site Settings</h1>
                </div>
                
                <div class="separator-breadcrumb border-top"></div>
                <div class="row mb-4">
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
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <form method="POST" action="{{URL('admin/settings/store')}}" enctype='multipart/form-data'>
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Title</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter title" name="title" value="@if($settings){{$settings->title}}@endif" required>
                                        </div>

                                        <div class="col-md-6 form-group mb-3">
                                            <label id="image_label">Image</label> <small>(87x63 px)</small>

                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" id="image_upload" type="file" name="media" accept=".jpeg,.jpg,.png,.gif">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    <label id="file-name"></label>
                                                </div>
                                            </div>
                                            <img id="imagePreview" @if($settings)src="{{storage_url()}}/{{$settings->logo}}" @endif width="70">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label id="image_label">Fav Icon</label> <small>(87x63 px)</small>

                                            <div class="input-group mb-3">
                                                <div class="custom-file">
                                                    <input class="custom-file-input" id="fav_icon" type="file" name="fav_icon" accept=".jpeg,.jpg,.png,.gif">
                                                    <label class="custom-file-label" for="inputGroupFile02"
                                                        aria-describedby="inputGroupFileAddon02">Choose file</label>
                                                    <label id="file-name"></label>
                                                </div>
                                            </div>
                                            <img id="favPreview"  @if($settings) src="{{storage_url()}}/{{$settings->fav_icon}}" @endif  width="70">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Meta Title</label>
                                            <input class="form-control" type="text" placeholder="Enter Meta Title" name="meta_title" id="meta_title"   value="@if($settings){{$settings->meta_title}}@endif" required>
                                        </div> 
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Meta Tag</label>
                                            <input class="form-control" data-role="tagsinput"  type="text" placeholder="Enter Meta Tag" name="meta_tag" id="meta_tag"   value="@if($settings){{$settings->meta_tag}}@endif" required>
                                        </div> 
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Meta Description</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter Meta Description" name="meta_description" value="@if($settings){{$settings->meta_description}}@endif"required>
                                        </div> 
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Email</label>
                                            <input class="form-control"  type="email"
                                                placeholder="Enter email" name="email" required value="@if($settings){{$settings->email}}@endif">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Whatsapp Number</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter whatsapp" name="whatsapp"  value="@if($settings){{$settings->whatsapp}}@endif">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Toll Free Number</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter Toll Free Number" name="mobile"  value="@if($settings){{$settings->mobile}}@endif">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Chat Number</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter chat" name="chat"  value="@if($settings){{$settings->chat}}@endif">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Address 1</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter address 1" name="address_1" required value="@if($settings){{$settings->address_1}}@endif">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Address 2</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter address 2" name="address_2" required value="@if($settings){{$settings->address_2}}@endif">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Office Hours</label>
                                            <input class="form-control"  type="text"
                                                placeholder="office hours" name="timing" required value="@if($settings){{$settings->timing}}@endif">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Facebook</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter Facebook" name="facebook" required value="@if($settings){{$settings->facebook}}@endif">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Twitter</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter Twitter" name="twitter" required value="@if($settings){{$settings->twitter}}@endif">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >linkedIn</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter linkedIn" name="linkedin" required value="@if($settings){{$settings->linkedin}}@endif">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Instagram</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter Instagram" name="instagram" required  value="@if($settings){{$settings->instagram}}@endif">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Youtube</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter Youtube" name="youtube" required  value="@if($settings){{$settings->youtube}}@endif">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Copyright</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter Instagram" name="copyright" required value="@if($settings){{$settings->copyright}}@endif">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Notification</label>
                                            <input class="form-control"  type="text"
                                                placeholder="Enter notification" name="notification"  value="@if($settings){{$settings->notification}}@endif">
                                        </div>
                                    </div>
                                    
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Institutional/Corporate Gifting or Dealership/Distribution Enquiry</label>
                                            <input class="form-control"  type="text"
                                                placeholder="email" name="institution_dealership_email" required value="@if($settings){{$settings->institution_dealership_email}}@endif">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Dealership/Distribution Enquiry</label>
                                            <input class="form-control"  type="text"
                                                placeholder="email" name="dealer_email" required value="@if($settings){{$settings->dealer_email}}@endif">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Other Enquiry types</label>
                                            <input class="form-control"  type="text"
                                                placeholder="email" name="otheremail" required value="@if($settings){{$settings->otheremail}}@endif">
                                        </div>        
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Product Register</label>
                                            <input class="form-control"  type="text"
                                                placeholder="email" name="product_register_mail" required value="@if($settings){{$settings->product_register_mail}}@endif">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Warranty extension</label>
                                            <input class="form-control"  type="text"
                                                placeholder="email" name="waranty_extension_mail" required value="@if($settings){{$settings->waranty_extension_mail}}@endif">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Product Feedback</label>
                                            <input class="form-control"  type="text"
                                                placeholder="email" name="product_feedback_mail" required value="@if($settings){{$settings->product_feedback_mail}}@endif">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Service Feedback</label>
                                            <input class="form-control"  type="text"
                                                placeholder="email" name="service_feedback_mail" required value="@if($settings){{$settings->service_feedback_mail}}@endif">
                                        </div>
                                        <div class="col-md-6 form-group mb-3">
                                            <label >Escalate To Service</label>
                                            <input class="form-control"  type="text"
                                                placeholder="email" name="escalate_to_service_mail" required value="@if($settings){{$settings->escalate_to_service_mail}}@endif">
                                        </div>
                                        <div class="col-md-12 d-flex">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                            <a class="btn btn-light ml-3" href="{{URL('admin/settings')}}">Back</a>
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
<script>
console.clear();

$(function() {
  $('#meta_tag').on('change', function(event) {

    var $element = $(event.target);
    var $container = $element.closest('.example');

    if (!$element.data('tagsinput'))
      return;

    var val = $element.val();
    if (val === null)
      val = "null";
    var items = $element.tagsinput('items');
    // console.log(items[items.length - 1]);

    // $('code', $('pre.val', $container)).html(($.isArray(val) ? JSON.stringify(val) : "\"" + val.replace('"', '\\"') + "\""));
    // $('code', $('pre.items', $container)).html(JSON.stringify($element.tagsinput('items')));

   
  }).trigger('change');
});
</script>
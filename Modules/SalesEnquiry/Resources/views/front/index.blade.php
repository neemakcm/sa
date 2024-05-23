@extends('pages::layouts.master')

@section('meta_title', $banner->meta_title)
@section('meta_tags', $banner->meta_tags)
@section('meta_description', $banner->meta_description)

@section('content')
<!-- Main Wrapper -->
<main>

    <!-- Baner Area -->
    <div class="inner-hero-area bg-image <?php echo $banner->mobile_image != ''?'web':''; ?> deferImage" data-src="{{storage_url()}}/{{$banner->image}}">
        <div class="d-flex flex-grow-1">
            <div class="container align-self-center">
                <div class="row">
                    <div class="col-lg-12">
                        {!! $banner->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Area END -->
    @if($banner->tablet_image != '')
    <!-- Banner Area Tab -->
        <div class="inner-hero-area bg-image tab deferImage"  data-src="{{storage_url()}}/{{$banner->tablet_image}}">
            <div class="d-flex flex-grow-1">
                <div class="container align-self-center">
                    <div class="row">
                        <div class="col-lg-12">
                            {!! $banner->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- Banner Area END -->
    @endif
    @if($banner->mobile_image != '')
        <!-- Baner Area -->
        <div class="inner-hero-area bg-image mobile deferImage"  data-src="{{storage_url()}}/{{$banner->mobile_image}}">
            <div class="d-flex flex-grow-1">
                <div class="container align-self-center">
                    <div class="row">
                        <div class="col-lg-12">
                            {!! $banner->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner Area END -->
    @endif

    @if(session()->has('message'))
        <div class="col-12 alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session()->get('message') }}
        </div>
    @endif
    <div class="page-product-reg">
        <div class="container">
        <form method="post" enctype="multipart/form-data" action="{{URL('business-enquiry/store')}}">
        @csrf
            <!-- Register Form -->
            <div class="reg-block-content">
                <div class="reg-block__header">
                    Business Enquiry
                </div>
                <div class="reg-block__body">
                    <div>
                        <div class="row">

                        <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        First Name  <sup class="mandatory">*</sup>
                                    </label>
                                    <input type="text"  name="first_name" value="{{old('first_name')}}" class="form-control input-field__block {{ $errors->has('first_name') ? ' is-invalid' : '' }}" required onkeyup="this.value=this.value.replace(/[^a-zA-Z ]/g,'')">
                                    @if($errors->has('first_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('first_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        Last Name <sup class="mandatory">*</sup>
                                    </label>
                                    <input type="text" name="last_name" value="{{old('last_name')}}" class="form-control input-field__block {{ $errors->has('last_name') ? ' is-invalid' : '' }}" required onkeyup="this.value=this.value.replace(/[^a-zA-Z ]/g,'')">
                                    @if($errors->has('last_name'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('last_name') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        Email ID <sup class="mandatory">*</sup>
                                    </label>
                                    <input type="email" name="email" value="{{old('email')}}" class="form-control input-field__block {{ $errors->has('email') ? ' is-invalid' : '' }}" required>
                                    @if($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        Mobile Number <sup class="mandatory">*</sup>
                                    </label>
                                    <input class="form-control"  type="text" placeholder="Enter Mobile No." id="mobile" value="{{old('mobile')}}" name="mobile" onkeypress="return ValidateDrop(event);" required>
                                         @if($errors->has('mobile'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('mobile') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                    Address 
                                    </label>
                                    <input type="text" name="address1" value="{{old('address1')}}"  class="form-control input-field__block" >
                                    
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                    City /Town
                                    </label>
                                    <input type="text" name="address2"value="{{old('address2')}}" class="form-control input-field__block" >
                                    
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                    District/City/Town 
                                    </label>
                                    <input type="text" name="district"  value="{{old('district')}}" class="form-control input-field__block " >
                                    @if($errors->has('district'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('district') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                       State
                                    </label>
                                    <select class="input-select form-control "  name="state_id" id="state_id" >
                                        <option value="">Select</option>
                                        @foreach($states as $state)
                                            <option value="{{$state->id}}" {{ (Input::old("state_id") == $state->id ? "selected":"") }}>{{$state->name}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('state_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('state_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                    Pincode
                                    </label>
                                    <input type="text" name="pincode" value="{{old('pincode')}}"  class="form-control input-field__block" >
                                    
                                </div>
                            </div>
                            
                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">Select Enquiry Type<sup class="mandatory">*</sup></label>
                                    <select class="input-select form-control " name="enquiry_type" id="enquiry_type" required>
                                        <option value="" disabled selected>Select Enquiry Type</option>
                                        <!-- <option value="warranty Extension">Warranty Extension</option> -->
                                        {{-- <option value="Product Specification">Product Specification</option>
                                        <option value="Where to Buy">Where to Buy</option>
                                        <option value="Product Price">Product Price</option>
                                        <option value="Advtertisment/Promotional Offers">Advtertisment/Promotional Offers</option>
                                     --}}
                                     <option value="Institutional/Corporate Gifting">Institutional/Corporate Gifting</option>
                                     <option value="Dealership/Distribution Enquiry">Dealership/Distribution Enquiry</option>
                                     <option value="Others">Others</option>
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-12">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">Query/Comments</label>
                                    <textarea type="text" name="enquiry" class="form-control input-field__block resize-none "
                                        rows="3">{{old('enquiry')}}</textarea>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">Attach Files</label>
                                    <label class="d-block btn file-upload-button" for="upload-files">
                                        Upload Image
                                    </label>

                                        <input type="file" class="form-control input-field__block {{ $errors->has('invoice') ? ' is-invalid' : '' }}"
                                            id="upload-files" hidden name="invoice" accept="image/jpeg,image/jpg,image/gif,image/png,application/pdf">
                                            @if($errors->has('invoice'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('invoice') }}</strong>
                                                </span>
                                            @endif
                                    <small class="caution"> <i class="far fa-question-circle"></i> File must be less than 10MB. Allowed file types : jpeg, jpg, gif, pdf, png, tif, zip.</small>
                                </div>
                            </div>
                        </div>
                        <div class="checkbox-wrapper">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="agree" class="custom-control-input {{ $errors->has('agree') ? ' is-invalid' : '' }}" id="customControlInline">
                                <label class="custom-control-label" for="customControlInline">
                                    * By clicking "Submit", I have read, agreed and giving consent to the terms of use
                                    and the Privacy Policy
                                </label>
                                @if($errors->has('agree'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('agree') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="tems-and-privacy">
                                <ul>
                                    <li>
                                        <a href="{{URL('privacyPolicy')}}" target="_blank">Privacy Policy </a>
                                    </li>
                                    <li>
                                        <a href="{{URL('terms')}}" target="_blank">Terms and Conditions</a>
                                    </li>
                                </ul>
                            </div>
                            {!! NoCaptcha::display() !!}
                            <div class="col-12 col-sm-12 col-md-6 field-width{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                                <div class="d-flex justify-content-between align-items-center mt-md-5">
                                    <!-- <label for="">Captcha</label> -->
                                    <div class="col-md-12">
                                    @if ($errors->has('g-recaptcha-response'))
                                        <span class="help-block "style="color:red">
                                            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                        </span>
                                        @endif 
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Register Form -->
        

            <!-- Button Group -->
            <div class="group-form-action d-flex justify-content-between">
                <a class="btn btn-reset" href="{{URL('/business-enquiry')}}">
                    Reset
                </a>
                <button class="btn btn-form-submit " type="submit">
                            Submit
                        </button>
            </div>
            <!-- Button Group END-->
            </form>
        </div>
    </div>

</main>
@stop
@section('script')
    <script src="{{asset('public/front/script/excalate-to-service.js')}}"></script>
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>

@endsection
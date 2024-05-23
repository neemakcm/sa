@extends('pages::layouts.master')

@section('meta_title', $banner->meta_title)
@section('meta_tags', $banner->meta_tags)
@section('meta_description', $banner->meta_description)

@section('content')
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
        <div class="inner-hero-area bg-image tab deferImage" data-src="{{storage_url()}}/{{$banner->tablet_image}}">
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
        <div class="inner-hero-area bg-image mobile deferImage" data-src="{{storage_url()}}/{{$banner->mobile_image}}">
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


    <div class="page-product-reg">
  
        <div class="container">
        @if(session()->has('message'))
        <div class="col-12 alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            {{ session()->get('message') }}
        </div>
    @endif
            <form method="post" enctype="multipart/form-data" action="{{URL('warranty-extension/store')}}">
                @csrf
            <!-- Register Form -->
            <div class="reg-block-content">
                <div class="reg-block__header">
                    Register your product and get additional warranty
                </div>
               
                <div class="reg-block__body grid-pad-40">
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
                                    <input class="form-control"  type="text" placeholder="Enter mobile" id="mobile" name="mobile" onkeypress="return ValidateDrop(event);" required>
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
                                    Address 1 
                                    </label>
                                    <input type="text" name="address1" value="{{old('address1')}}"  class="form-control input-field__block" >
                                    
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                    Address 2 
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
                                            <option value="{{$state->id}}">{{$state->name}}</option>
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
                                    <label class="input-field__label">
                                        Category <sup class="mandatory">*</sup>
                                    </label>
                                    <select class="input-select form-control " name="category_id" id="category_id" required>
                                        <option value="">Select</option>
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        Product <sup class="mandatory">*</sup>
                                    </label>
                                    <select class="input-select form-control " name="product_id" id="product_id" required>
                                        <option value="">Select Category First</option>
                                       
                                    </select>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        Product Model  <sup class="mandatory">*</sup>
                                    </label>
                                    <input type="text" class=" form-control {{ $errors->has('model') ? ' is-invalid' : '' }}" value="{{old('model')}}" readonly name="model" id="model">
                                    
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        Purchased Date
                                    </label>
                                    <input type="text" name="purchase_date" value="{{old('purchase_date')}}" class="form-control input-field__block js-date-picker" >
                                   
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        Purchased from  <sup class="mandatory">*</sup>
                                    </label>
                                    <input type="text" name="purchase_from"  value="{{old('purchase_from')}}" class="form-control input-field__block {{ $errors->has('purchase_from') ? ' is-invalid' : '' }}" required>
                                    @if($errors->has('purchase_from'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('purchase_from') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        Serial Number
                                    </label>
                                    <input type="text" name="serial_number" value="{{old('serial_number')}}" class="form-control input-field__block" >
                                   
                                </div>
                            </div>
                           
                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">Invoice / Warranty Card <sup class="mandatory">*</sup>
                                    </label>
                                    <label class="d-block btn file-upload-button input-field__block" for="upload-files">
                                        Choose File
                                        </label>
                                       
                                        <input type="file" name="invoice" class="form-control  {{ $errors->has('invoice') ? ' is-invalid' : '' }}" id="upload-files"
                                        style="display:none;"  accept="image/jpeg,image/jpg,image/gif,image/png,application/pdf">
                                    @if($errors->has('invoice'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('invoice') }}</strong>
                                        </span>
                                    @endif
                                    <small class="caution"> <i class="far fa-question-circle"></i> File must be less than 10MB. Allowed file types : jpeg, jpg, gif, pdf, png, tif, zip.</small>
                                </div>
                            </div>


                        </div>
                    </div>

                    <div>

                        <div class="checkbox-wrapper">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="policy" class="custom-control-input {{ $errors->has('policy') ? ' is-invalid' : '' }}" id="customControlInline" required>
                                <label class="custom-control-label" for="customControlInline">
                                    * By clicking "Submit", I have read, agreed and giving consent to the terms of use
                                    and the Privacy Policy
                                </label>
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
                        </div>
                    </div>
                      <div class="col-12 col-sm-12 col-md-6 field-width{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">
                        <div class="d-flex justify-content-between align-items-center mt-md-5">
                            <label for="">Captcha</label>
                            <div class="col-md-12">
                            @if ($errors->has('g-recaptcha-response'))
                                <span class="help-block "style="color:red">
                                    <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
                                </span>
                                @endif 
                            </div>
                        </div>
                    </div>
                               
                    {!! NoCaptcha::display() !!}
                    
     
                    </div>
            </div>
            <!-- Register Form -->

            <!-- Register Form -->

            <!-- Button Group -->
            <div class="group-form-action d-flex justify-content-between">
                <a class="btn btn-reset" href="#">
                    Reset
                </a>
                <button type="submit" class="btn btn-form-submit ">
                    Submit
                </button>
            </div>
    </form>
            <!-- Button Group END-->
        </div>
    </div>

</main>

@stop
@section('script')
    <script src="{{asset('public/front/script/warranty-extension.js')}}"></script>
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
@endsection
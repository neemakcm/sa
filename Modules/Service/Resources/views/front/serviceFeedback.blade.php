@extends('pages::layouts.master')

@section('meta_title', $banner->meta_title)
@section('meta_tags', $banner->meta_tags)
@section('meta_description', $banner->meta_description)

@section('content')

<main>

    <!-- Baner Area -->
    <div class="inner-hero-area bg-image <?php echo $banner->mobile_image != ''?'web':''; ?> deferImage"  data-src="{{storage_url()}}/{{$banner->image}}">
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

    <div class="page-product-reg">
        <div class="container">
        	<form method="POST" action="{{URL('storeServiceFeedback')}}" enctype='multipart/form-data'>
        		@csrf
	            <!-- Register Form -->
	            <div class="reg-block-content">
	                <div class="reg-block__header">
	                    Service Feedback
	                </div>
	                <div class="reg-block__body">
	                    <div>
	                        <div class="row">

	                            <div class="col-12 col-md-6">
	                                <div class="form-group form-input-field">
	                                    <label class="input-field__label">First Name <sup class="mandatory">*</sup></label>
	                                    <input type="text" class="form-control input-field__block" name="first_name" required value="{{old('first_name')}}" pattern="[A-Z a-z]*" oninvalid="setCustomValidity('Accept alphabets only')" onchange="try{setCustomValidity('')}catch(e){}">
	                                </div>
	                            </div>

	                            <div class="col-12 col-md-6">
	                                <div class="form-group form-input-field">
	                                    <label class="input-field__label">Last Name <sup class="mandatory">*</sup></label>
	                                    <input type="text" class="form-control input-field__block" name="last_name" required value="{{old('last_name')}}" pattern="[A-Z a-z]*" oninvalid="setCustomValidity('Accept alphabets only')" onchange="try{setCustomValidity('')}catch(e){}">
	                                </div>
	                            </div>

	                            <div class="col-12 col-md-6">
	                                <div class="form-group form-input-field">
	                                    <label class="input-field__label">Email <sup class="mandatory">*</sup></label>
	                                    <input type="email" class="form-control input-field__block" name="email"  value="{{old('email')}}" required>
	                                </div>
	                            </div>

	                            <div class="col-12 col-md-6">
	                                <div class="form-group form-input-field">
	                                    <label class="input-field__label">Mobile Number <sup class="mandatory">*</sup></label>
	                                    <input type="text" class="form-control input-field__block" name="mobile" required value="{{old('mobile')}}"  pattern="[0-9-+, ?]*" oninvalid="setCustomValidity('Invalid format')" onchange="try{setCustomValidity('')}catch(e){}">
	                                </div>
	                            </div>

	                            <div class="col-12 col-md-6">
	                                <div class="form-group form-input-field">
	                                    <label class="input-field__label">Case Number <sup class="mandatory">*</sup></label>
	                                    <input type="text" class="form-control input-field__block" name="case_number" required value="{{old('case_number')}}">
	                                </div>
	                            </div>

	                            <div class="col-12 col-md-6">
	                            	<div class="form-group form-input-field">
		                                <label class="input-field__label">Attach Document</label>
	                                    <label class="d-block btn file-upload-button" for="upload-files">
	                                        Choose File
	                                    </label>
	                                    <input type="file" class="form-control input-field__block upload-files" id="upload-files" name="attachment" accept="application/pdf,image/*" hidden>
	                                    <small class="caution"> <i class="far fa-question-circle"></i> File must be less than 10MB. Allowed file types : jpeg, jpg, pdf, png.</small>
	                                    @if($errors->has('attachment'))
		                                	<br>
                                            <span class="error" role="alert">
                                                <strong>{{ $errors->first('attachment') }}</strong>
                                            </span>
                                        @endif
		                                </div>
		                            </div>

	                                <span class="danger" id="service_proof_error"></span>
	                            </div>

	                        </div>

	                        <div class="col-12">
		                        <div class="form-group form-input-field">
		                            <label class="input-field__label">Please take a few moments to complete this feedback form.</label>
		                        </div>
		                    </div>

		                    <div class="col-12">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">Was your issue fixed?</label>
                                    <br>
                                    <div class="form-check form-check-inline mt-2">
                                        <label class="form-check-label">
                                        <input type="radio" class="product_type" id="is_fixed-2" name="is_fixed" value="1" required> Yes</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-2">
                                        <label class="form-check-label">
                                        <input type="radio" class="product_type" id="is_fixed-1" name="is_fixed" value="0" required> No</label>
                                    </div>
                                </div>
                            </div>

		                    <div class="col-12">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">Overall, how satisfied are you with the service provided?</label>
                                    <br>
                                    <div class="form-check form-check-inline mt-2">
                                        <label class="form-check-label">
                                        <input type="radio" class="product_type" id="type-2" name="rating" value="5" required> Very Good</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-2">
                                        <label class="form-check-label">
                                        <input type="radio" class="product_type" id="type-1" name="rating" value="4" required> Good</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-2">
                                        <label class="form-check-label">
                                        <input type="radio" class="product_type" id="type-1" name="rating" value="3" required> Average</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-2">
                                        <label class="form-check-label">
                                        <input type="radio" class="product_type" id="type-1" name="rating" value="2" required> Bad</label>
                                    </div>
                                    <div class="form-check form-check-inline mt-2">
                                        <label class="form-check-label">
                                        <input type="radio" class="product_type" id="type-1" name="rating" value="1" required> Very Bad</label>
                                    </div>
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">Additional comments</label>
                                    <textarea class="form-control input-field__block" name="comments">{{old('comments')}}</textarea>
                                </div>
                            </div>


                            <div class="checkbox-wrapper">
                            	<div class="custom-control custom-checkbox">
	                                <input type="checkbox" class="custom-control-input" id="customControlInline" required>
	                                <label class="custom-control-label" for="customControlInline">
	                                    * By clicking "Submit", I have read, agreed and giving consent to the terms of use and the Privacy Policy
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

	                <div class="group-form-action d-flex justify-content-between">
		                <button class="btn btn-reset" type="reset">
		                    Reset
		                </button>
		                <button class="btn btn-form-submit" type="submit">
		                    Submit
		                </button>
		            </div>
	            </div>
	            <!-- Register Form -->


	            
	        </form>
            <!-- Button Group END-->
        </div>
    </div>

</main>

@stop

@section('script')
   
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>

@endsection
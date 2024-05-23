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
        	<form method="POST" action="{{URL('service/requestService')}}" enctype='multipart/form-data'>
        		@csrf
	            <!-- Register Form -->
	            <div class="reg-block-content">
	                <div class="reg-block__header">
	                    Product Info
	                </div>
	                <div class="reg-block__body grid-pad-40">
	                    <div>
	                        <div class="row">
	                            <div class="col-12 col-lg-6">
	                                <div class="row">
	                                    <div class="col-12">
	                                        <div class="form-group form-input-field">
	                                            <label class="input-field__label">Service Type <sup class="mandatory">*</sup></label>
	                                            <select class="input-select form-control " name="service_type" id="" required>
	                                            	<option value="">Select</option>
	                                                <option value="installation" <?php echo old('service_type') == 'installation'?'selected':''; ?>>Installation</option>
	                                                <option value="repair" <?php echo old('service_type') == 'repair'?'selected':''; ?>>Repair</option>
	                                            </select>
	                                        </div>
	                                    </div>

	                                    <div class="col-12">
	                                        <div class="form-group form-input-field">
	                                            <label class="input-field__label">Enter Model Number</label>
	                                            <div class="position-relative">
	                                                <input type="text" class="form-control input-field__block" name="model_number" id="model_number" required value="{{old('model_number')}}">
	                                                <div class="inline-icon">
	                                                    <img src="{{asset('public/front/images/icons/search-icn.svg')}}" class="img-fluid"
	                                                        alt="icon">
	                                                </div>
	                                            </div>

	                                            <div id="model-suggestion-box"></div>

	                                            @if(session()->has('message_invalid'))
	                                                <span class="has-danger">
	                                                    <strong class="form-control-feedback">{{ session()->get('message_invalid') }}</strong>
	                                                </span>
	                                            @endif
	                                        </div>
	                                    </div>

	                                    <div class="col-12">
	                                        <div class="form-group form-input-field">
	                                            <label class="input-field__label">OR Select By Product Category</label>
	                                            <select class="input-select form-control " name="category_id" id="category_id">
	                                                <option value="">Category</option>
	                                                @foreach($categories as $category)
	                                                	<option value="{{$category->id}}">{{$category->name}}</option>
	                                                @endforeach
	                                            </select>
	                                        </div>
	                                    </div>

	                                    <div class="col-12">
	                                        <div class="form-group form-input-field">
	                                            <select class="input-select form-control " name="type" id="type">
	                                                <option value="">Product Type</option>
	                                            </select>
	                                        </div>
	                                    </div>
	                                    <div class="col-12">
	                                        <div class="form-group form-input-field mb-0">
	                                            <select class="input-select form-control " name="" id="model_id">
	                                                <option value="">Model Number</option>
	                                            </select>
	                                        </div>
	                                    </div>

	                                </div>
	                            </div>

	                            <div class="col-12 col-lg-6">
	                                <div class="preview-image-container">
	                                    <div class="boxing">

	                                        <div class="img-box">
	                                            <img class="img-fluid  lazyloaded model_image"
	                                                src="{{asset('public/front/images/icons/product-preview.png')}}">
	                                        </div>

	                                        <div class="text-content">
	                                            <span class="text model_name">
	                                                Enter Model Number or Select by
	                                                Product Category*
	                                            </span>
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <!-- Register Form -->

	            <!-- Register Form -->
	            <div class="reg-block-content">
	                <div class="reg-block__header">
	                    Other Info
	                </div>
	                <div class="reg-block__body">
	                    <div>
	                        <div class="row">

	                            <div class="col-12 col-md-6">
	                                <div class="form-group form-input-field">
	                                    <label class="input-field__label">Serial Number <sup class="mandatory">*</sup></label>
	                                    <input type="text" class="form-control input-field__block" name="serial_number" required value="{{old('serial_number')}}">
	                                </div>
	                            </div>

	                            <div class="col-12 col-md-6">
	                                <div class="form-group form-input-field">
	                                    <label class="input-field__label">Purchase Date <sup class="mandatory">*</sup></label>
	                                    <div class="position-relative">
	                                        <input type="text" class="form-control input-field__block js-date-picker" name="purchased_date" required value="{{old('purchased_date')}}">
	                                        <div class="inline-icon">
	                                            <img src="{{asset('public/front/images/icons/icon-date-picker.svg')}}" class="img-fluid"
	                                                alt="calender">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>

	                            <div class="col-12 col-md-6">
	                                <div class="form-group form-input-field">
	                                    <label class="input-field__label">Warranty Type <sup class="mandatory">*</sup></label>
	                                    <select class="input-select form-control " name="warranty_type" required>
	                                        <option value="">Select</option>
	                                        <option value="full" <?php echo old('warranty_type') == 'full'?'selected':''; ?>>Full</option>
	                                        <option value="partial" <?php echo old('warranty_type') == 'partial'?'selected':''; ?>>Partial</option>
	                                    </select>
	                                </div>
	                            </div>

	                            <div class="col-12 col-md-6">
	                                <div class="form-group form-input-field">
	                                    <label class="input-field__label">Upload Proof of Purchase <sup class="mandatory">*</sup></label>
	                                    <label class="d-block btn file-upload-button" for="upload-files">
	                                        Choose File
	                                    </label>
	                                    <input type="file" class="form-control input-field__block" id="upload-files" name="proof" accept="application/pdf,image/*" 
	                                            hidden>
	                                    <small class="caution"> <i class="far fa-question-circle"></i> File must be less than 10MB. Allowed file types : jpeg, jpg, pdf, png.</small>
	                                </div>

	                                @if($errors->has('attachment'))
		                                	<br>
                                            <span class="error" role="alert">
                                                <strong>{{ $errors->first('attachment') }}</strong>
                                            </span>
                                        @endif

	                                <span class="danger" id="service_proof_error"></span>
	                            </div>



	                        </div>
	                    </div>
	                </div>
	            </div>
	            <!-- Register Form -->

	            <!-- Register Form -->
	            <div class="reg-block-content">
	                <div class="reg-block__header">
	                    Issue Description
	                </div>
	                <div class="reg-block__body">
	                    <div>
	                        <div class="row">

	                            <div class="col-12 col-md-12">
	                                <div class="form-group form-input-field">
	                                    <label class="input-field__label">Description <sup class="mandatory">*</sup></label>
	                                    <textarea type="text" class="form-control input-field__block resize-none" name="description" required 
	                                        rows="5">{{old('description')}}</textarea>
	                                </div>
	                            </div>

	                        </div>
	                    </div>
	                </div>
	            </div>
	            <!-- Register Form -->


	            <!-- Register Form -->
	            <div class="reg-block-content">
	                <div class="reg-block__header">
	                    Contact Info
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
	                                    <input type="text" class="form-control input-field__block" required name="email" value="{{old('email')}}">
	                                </div>
	                            </div>

	                            <div class="col-12 col-md-6">
	                                <div class="form-group form-input-field">
	                                    <label class="input-field__label">Mobile No <sup class="mandatory">*</sup></label>
	                                    <input type="text" class="form-control input-field__block" name="mobile" required  pattern="[0-9-+, ?]*" oninvalid="setCustomValidity('Accept numbers only')" onchange="try{setCustomValidity('')}catch(e){}" value="{{old('mobile')}}">
	                                </div>
	                            </div>
	                            <div class="col-12 col-md-6">
	                                <div class="form-group form-input-field">
	                                    <label class="input-field__label">Address 1 <sup class="mandatory">*</sup></label>
	                                    <input type="text" required name="address_1" class="form-control input-field__block" value="{{old('address_1')}}">
	                                </div>
	                            </div>

	                            <div class="col-12 col-md-6">
	                                <div class="form-group form-input-field">
	                                    <label class="input-field__label">Address 2 <sup class="mandatory">*</sup></label>
	                                    <input type="text" class="form-control input-field__block" name="address_2" required value="{{old('address_2')}}">
	                                </div>
	                            </div>

	                            <div class="col-12 col-md-6">
	                                <div class="form-group form-input-field">
	                                    <label class="input-field__label">District/City/Town <sup class="mandatory">*</sup></label>
	                                    <input type="text" required name="district" class="form-control input-field__block" value="{{old('district')}}">
	                                </div>
	                            </div>
	                            <div class="col-12 col-md-6">
	                                <div class="form-group form-input-field">
	                                    <label class="input-field__label">State <sup class="mandatory">*</sup></label>
	                                    <select class="input-select form-control "  name="state" id="state" required>
	                                        <option value="">Select</option>
	                                        @foreach($states as $state)
	                                            <option value="{{$state->name}}" <?php echo old('state') == $state->name?'selected':''; ?>>{{$state->name}}</option>
	                                        @endforeach
	                                    </select>
	                                </div>
	                            </div>
	                            <div class="col-12 col-md-6">
	                                <div class="form-group form-input-field">
	                                    <label class="input-field__label">Pin Code <sup class="mandatory">*</sup></label>
	                                    <input type="text" class="form-control input-field__block" name="pincode" required value="{{old('pincode')}}">
	                                </div>
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
	            </div>
	            <!-- Register Form -->

	            <!-- Button Group -->
	            <div class="group-form-action d-flex justify-content-between">
	                <a class="btn btn-reset" type="reset">
	                    Cancel
	                </a>
	                <button class="btn btn-form-submit " type="submit">
	                    Submit Request
	                </button>
	            </div>
	            <!-- Button Group END-->
	        </form>
        </div>
    </div>

</main>

@stop
@section('script')
  
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>

@endsection
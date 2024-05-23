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
        	<form method="POST" action="{{URL('storeProductRegister')}}" enctype='multipart/form-data'>
        		@csrf
				<!--  Form Type -->
	            <div class="reg-block-content">
	                <div class="reg-block__header">
						<div class="row">
							<div class="col-12 col-md-6">
								<div class="form-group form-input-field">
									<label class="input-field__label">Select</label>
									<select class="input-select form-control"  name="product_page" id="product_page" >
										<option value="1">Product Registration </option>
										<option value="2">Warranty Extension</option>
										
									</select>
								</div>
								@if(session()->has('message_invalid'))
									<span class="has-danger danger">
										<strong class="form-control-feedback">{{ session()->get('message_invalid') }}</strong>
									</span>
								@endif
							</div>
						</div>
	                </div>
	               
	            </div>
	            <!-- Register Form -->
	            <!-- Register Form -->
	            <div class="reg-block-content product_registration">
	                <div class="reg-block__header">
	                    Product Information
	                </div>
	                <div class="reg-block__body">
	                    <div>
	                        <div class="row">
								<div class="col-12 col-md-6">
									<div class="form-group form-input-field">
										<label class="input-field__label">
											Category <sup class="mandatory">*</sup>
										</label>
										<select class="input-select form-control  product_reg" name="category_id" id="category_id" >
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
										<select class="input-select form-control product_reg" name="product_id" id="product_id" >
											<option value="">Select Category First</option>
										   
										</select>
									</div>
								</div>
	                            {{-- <div class="col-12 col-md-6">
	                                <div class="form-group form-input-field">
	                                    <label class="input-field__label">Model Number <sup class="mandatory">*</sup></label>
	                                    <input type="text" class="form-control input-field__block" name="model_number"  value="{{old('model_number')}}">
	                                </div>

	                                @if(session()->has('message_invalid'))
                                        <span class="has-danger danger">
                                            <strong class="form-control-feedback">{{ session()->get('message_invalid') }}</strong>
                                        </span>
                                    @endif
	                            </div> --}}

	                            <div class="col-12 col-md-6">
	                                <div class="form-group form-input-field">
	                                    <label class="input-field__label">Serial Number <sup class="mandatory">*</sup></label>
	                                    <input type="text" class="form-control input-field__block product_reg" name="serial_number" value="{{old('serial_number')}}" >
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	            <!-- Register Form -->

	            <!-- Register Form -->
	            <div class="reg-block-content product_registration">
	                <div class="reg-block__header">
	                    Your Information
	                </div>
	                <div class="reg-block__body">
	                    <div>
	                        <div class="row">

	                            <div class="col-12 col-md-6">
	                                <div class="form-group form-input-field">
	                                    <label class="input-field__label">First Name <sup class="mandatory">*</sup></label>
	                                    <input type="text" class="form-control input-field__block product_reg" name="first_name"  value="{{old('first_name')}}" pattern="[A-Z a-z]*" oninvalid="setCustomValidity('Accept alphabets only')" onchange="try{setCustomValidity('')}catch(e){}">
	                                </div>
	                            </div>

	                            <div class="col-12 col-md-6">
	                                <div class="form-group form-input-field">
	                                    <label class="input-field__label">Last Name <sup class="mandatory">*</sup></label>
	                                    <input type="text" class="form-control input-field__block product_reg" name="last_name"  value="{{old('last_name')}}" pattern="[A-Z a-z]*" oninvalid="setCustomValidity('Accept alphabets only')" onchange="try{setCustomValidity('')}catch(e){}">
	                                </div>
	                            </div>

	                            <div class="col-12 col-md-6">
	                                <div class="form-group form-input-field">
	                                    <label class="input-field__label">Email Address <sup class="mandatory">*</sup></label>
	                                    <input type="email" class="form-control input-field__block product_reg" name="email"  value="{{old('email')}}" >
	                                </div>
	                            </div>

	                            <div class="col-12 col-md-6">
	                                <div class="form-group form-input-field">
	                                    <label class="input-field__label">Mobile Number <sup class="mandatory">*</sup></label>
	                                    <input type="text" class="form-control input-field__block product_reg" name="mobile"  value="{{old('mobile')}}"  pattern="[0-9-+, ?]*" oninvalid="setCustomValidity('Accept numbers only')" onchange="try{setCustomValidity('')}catch(e){}">
	                                </div>
	                            </div>

	                            <div class="col-12 col-md-6">
	                                <div class="form-group form-input-field">
	                                    <label class="input-field__label">Address 1 <sup class="mandatory">*</sup></label>
	                                    <input type="text" class="form-control input-field__block product_reg" name="address_1" value="{{old('address_1')}}">
	                                </div>
	                            </div>

	                            <div class="col-12 col-md-6">
	                                <div class="form-group form-input-field">
	                                    <label class="input-field__label">Address 2 <sup class="mandatory">*</sup></label>
	                                    <input type="text" class="form-control input-field__block product_reg" name="address_2"  value="{{old('address_2')}}">
	                                </div>
	                            </div>

	                            <div class="col-12 col-md-6">
	                                <div class="form-group form-input-field">
	                                    <label class="input-field__label">District/City/Town <sup class="mandatory">*</sup></label>
	                                    <input type="text" class="form-control input-field__block product_reg" name="district"  value="{{old('district')}}">
	                                </div>
	                            </div>

	                            <div class="col-12 col-md-6">
	                                <div class="form-group form-input-field">
	                                    <label class="input-field__label">State <sup class="mandatory">*</sup></label>
	                                    <select class="input-select form-control product_reg"  name="state" id="state" >
	                                        <option value="">Select</option>
	                                        @foreach($states as $state)
	                                            <option value="{{$state->name}}">{{$state->name}}</option>
	                                        @endforeach
	                                    </select>
	                                </div>
	                            </div>

	                            <div class="col-12 col-md-6">
	                                <div class="form-group form-input-field">
	                                    <label class="input-field__label">Pincode <sup class="mandatory">*</sup></label>
	                                    <input type="text" class="form-control input-field__block product_reg" name="pincode"  value="{{old('pincode')}}">
	                                </div>
	                            </div>

	                        </div>
	                    </div>
	                </div>
	            </div>
	            <!-- Register Form -->

	            <!-- Register Form -->
	            <div class="reg-block-content product_registration ">
	                <div class="reg-block__header">
	                    Product Information
	                </div>
	                <div class="reg-block__body">
	                    <div>
	                        <div class="row">
	                            <div class="col-12 col-md-6">
	                                <div class="form-group form-input-field">
	                                    <label class="input-field__label">Purchase Date *</label>
	                                    <div class="position-relative">
	                                        <input type="text" class="form-control input-field__block js-date-picker product_reg" name="purchased_date"  value="{{old('purchased_date')}}">
	                                        <div class="inline-icon">
	                                            <img src="{{asset('public/front/images/icons/icon-date-picker.svg')}}" class="img-fluid"
	                                                alt="calender">
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>

	                            <div class="col-12 col-md-6">
	                                <div class="form-group form-input-field">
	                                    <label class="input-field__label">Purchased From *</label>
	                                    <input type="text" class="form-control input-field__block product_reg" name="purchased_from" value="{{old('purchased_from')}}">
	                                </div>
	                            </div>

	                            <div class="col-12 col-md-6">
	                            	<div class="form-group form-input-field">
		                                <label class="input-field__label">Attach Document <sup class="mandatory">*</sup></label>
	                                    <label class="d-block btn file-upload-button" for="upload-files">
	                                        Choose File
	                                    </label>
	                                    <input type="file" class=" product_reg form-control input-field__block upload-files" id="upload-files"  name="document" accept="application/pdf,image/*"  hidden>
	                                    <small class="caution"> <i class="far fa-question-circle"></i> File must be less than 10MB. Allowed file types : jpeg, jpg, pdf, png.</small>
		                                </div>
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

	                        {{-- <div class="checkbox-wrapper">
	                            <div class="custom-control custom-checkbox">
	                                <input type="checkbox" class="custom-control-input" id="customControlInline" >
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
                            </div> --}}


	                    </div>
	                </div>
	                 <!-- Register Form -->
				<div class="reg-block-content warranty_extension hide">
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
										<input type="text"  name="warranty_first_name" value="{{old('warranty_first_name')}}" class="form-control input-field__block {{ $errors->has('warranty_first_name') ? ' is-invalid' : '' }} warranty" onkeyup="this.value=this.value.replace(/[^a-zA-Z ]/g,'')">
										@if($errors->has('warranty_first_name'))
											<span class="invalid-feedback" role="alert">
												<strong>{{ $errors->first('warranty_first_name') }}</strong>
											</span>
										@endif
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group form-input-field">
										<label class="input-field__label">
											Last Name <sup class="mandatory">*</sup>
										</label>
										<input type="text" name="warranty_last_name" value="{{old('warranty_last_name')}}" class="warranty form-control input-field__block {{ $errors->has('warranty_last_name') ? ' is-invalid' : '' }}" onkeyup="this.value=this.value.replace(/[^a-zA-Z ]/g,'')">
										@if($errors->has('warranty_last_name'))
											<span class="invalid-feedback" role="alert">
												<strong>{{ $errors->first('warranty_last_name') }}</strong>
											</span>
										@endif
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group form-input-field">
										<label class="input-field__label">
											Email ID <sup class="mandatory">*</sup>
										</label>
										<input type="email" name="warranty_email" value="{{old('warranty_email')}}" class=" warranty form-control input-field__block {{ $errors->has('warranty_email') ? ' is-invalid' : '' }}" >
										@if($errors->has('warranty_email'))
											<span class="invalid-feedback" role="alert">
												<strong>{{ $errors->first('warranty_email') }}</strong>
											</span>
										@endif
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group form-input-field">
										<label class="input-field__label">
											Mobile Number <sup class="mandatory">*</sup>
										</label>
										<input class="form-control warranty"  type="text" placeholder="Enter mobile" id="mobile" name="warranty_mobile" onkeypress="return ValidateDrop(event);" >
											 @if($errors->has('warranty_mobile'))
											<span class="invalid-feedback" role="alert">
												<strong>{{ $errors->first('warranty_mobile') }}</strong>
											</span>
										@endif
									</div>
								</div>
	
								<div class="col-12 col-md-6">
									<div class="form-group form-input-field">
										<label class="input-field__label">
										Address 1 
										</label>
										<input type="text" name="warranty_address1" value="{{old('warranty_address1')}}"  class="warranty form-control input-field__block" >
										
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group form-input-field">
										<label class="input-field__label">
										Address 2 
										</label>
										<input type="text" name="warranty_address2"value="{{old('warranty_address2')}}" class="warranty form-control input-field__block" >
										
									</div>
								</div>
	
								<div class="col-12 col-md-6">
									<div class="form-group form-input-field">
										<label class="input-field__label">
										District/City/Town 
										</label>
										<input type="text" name="warranty_district"  value="{{old('warranty_district')}}" class="warranty form-control input-field__block " >
										@if($errors->has('warranty_district'))
											<span class="invalid-feedback" role="alert">
												<strong>{{ $errors->first('warranty_district') }}</strong>
											</span>
										@endif
									</div>
								</div>
	
								<div class="col-12 col-md-6">
									<div class="form-group form-input-field">
										<label class="input-field__label">
										   State
										</label>
										<select class="input-select form-control warranty "  name="warranty_state_id" id="state_id" >
											<option value="">Select</option>
											@foreach($states as $state)
												<option value="{{$state->id}}">{{$state->name}}</option>
											@endforeach
										</select>
										@if($errors->has('warranty_state_id'))
											<span class="invalid-feedback" role="alert">
												<strong>{{ $errors->first('warranty_state_id') }}</strong>
											</span>
										@endif
									</div>
								</div>
	
								<div class="col-12 col-md-6">
									<div class="form-group form-input-field">
										<label class="input-field__label">
										Pincode
										</label>
										<input type="text" name="warranty_pincode" value="{{old('warranty_pincode')}}"  class="warranty form-control input-field__block" >
										
									</div>
								</div>
								<div class="col-12 col-md-6">
									<div class="form-group form-input-field">
										<label class="input-field__label">
											Category <sup class="mandatory">*</sup>
										</label>
										<select class="input-select form-control warranty" name="warranty_category_id" id="warranty_category_id" >
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
										<select class="input-select form-control warranty" name="warranty_product_id" id="warranty_product_id" >
											<option value="">Select Category First</option>
										   
										</select>
									</div>
								</div>
	
								 <div class="col-12 col-md-6">
									<div class="form-group form-input-field">
										<label class="input-field__label">
											Product Model  <sup class="mandatory">*</sup>
										</label>
										<input type="text" class=" form-control warranty {{ $errors->has('warranty_model') ? ' is-invalid' : '' }}" value="{{old('warranty_model')}}" readonly name="warranty_model" id="warranty_model">
										
									</div>
								</div>
	
								<div class="col-12 col-md-6">
									<div class="form-group form-input-field">
										<label class="input-field__label">
											Purchased Date
										</label>
										<input type="text" name="warranty_purchase_date" value="{{old('warranty_purchase_date')}}" class="warranty form-control input-field__block js-date-picker" >
									   
									</div>
								</div>
	 
								 <div class="col-12 col-md-6">
									<div class="form-group form-input-field">
										<label class="input-field__label">
											Purchased from  <sup class="mandatory">*</sup>
										</label>
										<input type="text" name="warranty_purchase_from"  value="{{old('warranty_purchase_from')}}" class="warranty form-control input-field__block {{ $errors->has('warranty_purchase_from') ? ' is-invalid' : '' }}" >
										@if($errors->has('warranty_purchase_from'))
											<span class="invalid-feedback" role="alert">
												<strong>{{ $errors->first('warranty_purchase_from') }}</strong>
											</span>
										@endif
									</div>
								</div> 
	
								<div class="col-12 col-md-6">
									<div class="form-group form-input-field">
										<label class="input-field__label">
											Serial Number
										</label>
										<input type="text" name="warranty_serial_number" value="{{old('warranty_serial_number')}}" class="warranty form-control input-field__block" >
									   
									</div>
								</div>
							   
								{{-- <div class="col-12 col-md-6">
									<div class="form-group form-input-field">
										<label class="input-field__label">Invoice / Warranty Card <sup class="mandatory">*</sup>
										</label>
										<label class="d-block btn file-upload-button input-field__block" for="upload-files">
											Choose File
											</label>
										   
											<input type="file" name="warranty_invoice" class="form-control warranty  {{ $errors->has('warranty_invoice') ? ' is-invalid' : '' }}" id="upload-files"
											style="display:none;"  accept="image/jpeg,image/jpg,image/gif,image/png,application/pdf">
										@if($errors->has('warranty_invoice'))
											<span class="invalid-feedback" role="alert">
												<strong>{{ $errors->first('warranty_invoice') }}</strong>
											</span>
										@endif
										<small class="caution"> <i class="far fa-question-circle"></i> File must be less than 10MB. Allowed file types : jpeg, jpg, gif, pdf, png, tif, zip.</small>
									</div>
								</div> --}}
								<div class="col-12 col-md-6">
	                            	<div class="form-group form-input-field">
		                                <label class="input-field__label">Invoice / Warranty Card <sup class="mandatory">*</sup></label>
	                                    <label class="d-block btn file-upload-button" for="upload-warranty">
	                                        Choose File
	                                    </label>
	                                    <input type="file" class="  form-control input-field__block upload-warranty" id="upload-warranty" name="warranty_invoice" accept="application/pdf,image/*"  hidden>
	                                    <small class="caution"> <i class="far fa-question-circle"></i> File must be less than 10MB. Allowed file types : jpeg, jpg, pdf, png.</small>
		                                </div>
		                            </div>

		                            @if($errors->has('warranty_invoice'))
	                                	<br>
                                        <span class="error" role="alert">
                                            <strong>{{ $errors->first('warranty_invoice') }}</strong>
                                        </span>
                                    @endif

	                                <span class="danger" id="service_proof_error"></span>
	                            </div>
	
							</div>
						</div>
	
						<div>
	
							
				</div> 
				
			</div>
			
			 
					   
			
		{{-- </div> --}}
		<div class="reg-block-content ">
			
			<div class="checkbox-wrapper">
				<div class="custom-control custom-checkbox">
					<input type="checkbox" name="policy" class="custom-control-input {{ $errors->has('policy') ? ' is-invalid' : '' }}" id="customControlInline" >
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
			<div class="reg-block__body grid-pad-40">
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

				<!-- Button Group -->
				<div class="group-form-action d-flex justify-content-between">
					<button class="btn btn-reset" type="reset">
						Reset
					</button>
					<button class="btn btn-form-submit" type="submit">
						Register
					</button>
				</div>
	            </div>
	           
	            
	        </form>
            <!-- Button Group END-->
        </div>
    </div>

</main>

@stop
@section('script')
    <script src="{{asset('public/front/script/product-register.js')}}"></script>
	<script src='https://www.google.com/recaptcha/api.js' async defer></script>

    
@endsection
@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold">  Escalate To Service Head</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin')}}">
                                <span class="las la-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{URL('admin/escalate-to-service')}}">
                            Escalate To Service Head
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                        Escalate To Service Head
                        </li>

                    </ol>
                </nav>
                
                <div class="separator-breadcrumb border-top"></div>
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">

                            <div class="row">
                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        First Name  <sup class="mandatory">*</sup>
                                    </label>
                                    <input type="text"  name="first_name" value="{{$service->first_name}}" class="form-control input-field__block {{ $errors->has('first_name') ? ' is-invalid' : '' }}" required>
                                   
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        Last Name <sup class="mandatory">*</sup>
                                    </label>
                                    <input type="text" name="last_name" value="{{$service->last_name}}" class="form-control input-field__block {{ $errors->has('last_name') ? ' is-invalid' : '' }}" required>
                                    
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        Email ID <sup class="mandatory">*</sup>
                                    </label>
                                    <input type="email" name="email" value="{{$service->email}}" class="form-control input-field__block {{ $errors->has('email') ? ' is-invalid' : '' }}" required>
                                   
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        Mobile Number <sup class="mandatory">*</sup>
                                    </label>
                                    <input type="text" name="mobile" value="{{$service->mobile}}" class="form-control input-field__block {{ $errors->has('mobile') ? ' is-invalid' : '' }}" required onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                                   
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                    Address 1 
                                    </label>
                                    <input type="text" name="address1" value="{{$service->address_1}}" required class="form-control input-field__block" >
                                    
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                    Address 2 
                                    </label>
                                    <input type="text" name="address2"value="{{$service->address_2}}" class="form-control input-field__block" >
                                    
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                    District/City/Town 
                                    </label>
                                    <input type="text" name="district" required value="{{$service->district}}" class="form-control input-field__block " >
                                    
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                       State
                                    </label>
                                    <input type="text" name="district" required value="@if($service->states){{$service->states->name}}@endif" class="form-control input-field__block " >

                                    
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                    Pincode
                                    </label>
                                    <input type="text" name="pincode" value="{{$service->pincode}}"  class="form-control input-field__block" >
                                    
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        Product <sup class="mandatory">*</sup>
                                    </label>
                                    <input type="text" name="pincode" value="@if($service->products){{$service->products->name}}@endif"  class="form-control input-field__block" >

                                    
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        Product Model  <sup class="mandatory">*</sup>
                                    </label>
                                    <input type="text" class=" form-control {{ $errors->has('model') ? ' is-invalid' : '' }}" value="@if($service->products){{$service->products->sku}}@endif" readonly name="model" id="model">
                                    
                                </div>
                            </div>

                            
                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        Purchased from  <sup class="mandatory">*</sup>
                                    </label>
                                    <input type="text" name="purchase_from"  value="{{$service->purchased_from}}" class="form-control input-field__block {{ $errors->has('purchase_from') ? ' is-invalid' : '' }}" required>
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
                                        subject <sup class="mandatory">*</sup>
                                    </label>
                                    <textarea  class="form-control input-field__block resize-none" rows="5">{{$service->subject}}</textarea>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        Message <sup class="mandatory">*</sup>
                                    </label>
                                    <textarea id="message" name="message" required type="text" class="form-control input-field__block resize-none {{ $errors->has('message') ? ' is-invalid' : '' }}"
                                        rows="5">{{$service->message}}</textarea>
                                </div>
                            </div>
                           
                           
                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">Invoice / Warranty Card <sup class="mandatory">*</sup>
                                    </label>
                                    @if($service->invoice)
	              		                <a target="_blank" href="{{storage_url()}}/{{$service->invoice}}"><img src="{{base_url()}}/public/admins/images/pdf.png" width="30"></a>';
                                    @endif
                                    </div>
                            </div>


                        </div>    
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
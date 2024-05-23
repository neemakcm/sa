@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold"> Product Enquiry</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin')}}">
                                <span class="las la-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{URL('admin/product-enquiry')}}">
                            Product Enquiry
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                        Product Enquiry
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
                                    <input type="text"  name="first_name" value="{{$enquiry->first_name}}" class="form-control input-field__block {{ $errors->has('first_name') ? ' is-invalid' : '' }}" required>
                                   
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        Last Name <sup class="mandatory">*</sup>
                                    </label>
                                    <input type="text" name="last_name" value="{{$enquiry->last_name}}" class="form-control input-field__block {{ $errors->has('last_name') ? ' is-invalid' : '' }}" required>
                                    
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        Email ID <sup class="mandatory">*</sup>
                                    </label>
                                    <input type="email" name="email" value="{{$enquiry->email}}" class="form-control input-field__block {{ $errors->has('email') ? ' is-invalid' : '' }}" required>
                                   
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        Mobile Number <sup class="mandatory">*</sup>
                                    </label>
                                    <input type="text" name="mobile" value="{{$enquiry->mobile}}" class="form-control input-field__block {{ $errors->has('mobile') ? ' is-invalid' : '' }}" required onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                                   
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                    Address 1 
                                    </label>
                                    <input type="text" name="address1" value="{{$enquiry->address_1}}" required class="form-control input-field__block" >
                                    
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                    Address 2 
                                    </label>
                                    <input type="text" name="address2"value="{{$enquiry->address_2}}" class="form-control input-field__block" >
                                    
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                    District/City/Town 
                                    </label>
                                    <input type="text" name="district" required value="{{$enquiry->district}}" class="form-control input-field__block " >
                                    
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                       State
                                    </label>
                                    <input type="text" name="district" required value="@if($enquiry->states){{$enquiry->states->name}}@endif" class="form-control input-field__block " >

                                    
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        Product <sup class="mandatory">*</sup>
                                    </label>
                                    <input type="text" name="pincode" value="@if($enquiry->products){{$enquiry->products->name}}@endif"  class="form-control input-field__block" >

                                    
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        Product Model  <sup class="mandatory">*</sup>
                                    </label>
                                    <input type="text" class=" form-control {{ $errors->has('model') ? ' is-invalid' : '' }}" value="{{$enquiry->product_model}}" readonly name="model" id="model">
                                    
                                </div>
                            </div>

                           
                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        Enquiry Type <sup class="mandatory">*</sup>
                                    </label>
                                    <input type="text" value="{{$enquiry->enquiry_type}}"  class="form-control input-field__block" >
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        Message <sup class="mandatory">*</sup>
                                    </label>
                                    <textarea id="message" name="message" required type="text" class="form-control input-field__block resize-none {{ $errors->has('message') ? ' is-invalid' : '' }}"
                                        rows="5">{{$enquiry->message}}</textarea>
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
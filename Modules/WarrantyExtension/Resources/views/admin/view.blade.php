@extends('admin::layouts.master')

@section('content')

<body class="text-left">
    <div class="app-admin-wrap layout-sidebar-large">

        @include('admin::layouts.main-header')
        @include('admin::layouts.side-content-wrap')

        <div class="main-content-wrap sidenav-open d-flex flex-column">
            <!-- ============ Body content start ============= -->
            <div class="main-content">
                <h4 class="mr-2 font-weight-bold"> Warranty Extension</h4>

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb p-0">
                        <li class="breadcrumb-item">
                            <a href="{{URL('/admin')}}">
                                <span class="las la-home"></span>
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="{{URL('admin/waranty-extension')}}">
                            Warranty Extension
                            </a>
                        </li>
                        <li class="breadcrumb-item">
                        Warranty Extension
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
                                    <input type="text"  name="first_name" value="{{$warranty->first_name}}" class="form-control input-field__block {{ $errors->has('first_name') ? ' is-invalid' : '' }}" required>
                                   
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        Last Name <sup class="mandatory">*</sup>
                                    </label>
                                    <input type="text" name="last_name" value="{{$warranty->last_name}}" class="form-control input-field__block {{ $errors->has('last_name') ? ' is-invalid' : '' }}" required>
                                    
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        Email ID <sup class="mandatory">*</sup>
                                    </label>
                                    <input type="email" name="email" value="{{$warranty->email}}" class="form-control input-field__block {{ $errors->has('email') ? ' is-invalid' : '' }}" required>
                                   
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        Mobile Number <sup class="mandatory">*</sup>
                                    </label>
                                    <input type="number" name="mobile" value="{{$warranty->mobile}}" class="form-control input-field__block {{ $errors->has('mobile') ? ' is-invalid' : '' }}" required onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                                   
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                    Address 1 
                                    </label>
                                    <input type="text" name="address1" value="{{$warranty->address_1}}" required class="form-control input-field__block" >
                                    
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                    Address 2 
                                    </label>
                                    <input type="text" name="address2"value="{{$warranty->address_2}}" class="form-control input-field__block" >
                                    
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                    District/City/Town 
                                    </label>
                                    <input type="text" name="district" required value="{{$warranty->district}}" class="form-control input-field__block " >
                                    
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                       State
                                    </label>
                                    <input type="text" name="district" required value="@if($warranty->states){{$warranty->states->name}}@endif" class="form-control input-field__block " >

                                    
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                    Pincode
                                    </label>
                                    <input type="text" name="pincode" value="{{$warranty->pincode}}"  class="form-control input-field__block" >
                                    
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        Product <sup class="mandatory">*</sup>
                                    </label>
                                    <input type="text" name="pincode" value="@if($warranty->products){{$warranty->products->name}}@endif"  class="form-control input-field__block" >

                                    
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        Product Model  <sup class="mandatory">*</sup>
                                    </label>
                                    <input type="text" class=" form-control {{ $errors->has('model') ? ' is-invalid' : '' }}" value="{{$warranty->product_model}}" readonly name="model" id="model">
                                    
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        Purchased Date
                                    </label>
                                    <input type="text" name="purchase_date" value="{{$warranty->purchased_date}}" class="form-control input-field__block js-date-picker" >
                                   
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">
                                        Purchased from  <sup class="mandatory">*</sup>
                                    </label>
                                    <input type="text" name="purchase_from"  value="{{$warranty->purchased_from}}" class="form-control input-field__block {{ $errors->has('purchase_from') ? ' is-invalid' : '' }}" required>
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
                                    <input type="text" name="serial_number" value="{{$warranty->serial_number}}" class="form-control input-field__block" >
                                   
                                </div>
                            </div>
                           
                            <div class="col-12 col-md-6">
                                <div class="form-group form-input-field">
                                    <label class="input-field__label">Invoice / Warranty Card <sup class="mandatory">*</sup>
                                    </label>
                                    @if($warranty->invoice)
	              		                <a target="_blank" href="{{storage_url()}}/{{$warranty->invoice}}"><img src="{{base_url()}}/public/admins/images/pdf.png" width="30"></a>';
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
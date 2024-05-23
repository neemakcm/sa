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
                    <h1 class="mr-2">Settings</h1>

                    @if(session()->has('message'))
                        <div class="container"> 
                            <div class="row"> 
                               <div class="col-12 alert alert-dismissible alert-success error_container">
                                    <button type="button" class="close">&times;</button>
                                    <p>{{ session()->get('message') }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
                <div class="separator-breadcrumb border-top"></div>
                <div class="row mb-4">
                    <div class="col-md-12 mb-4">
                        <div class="card text-left">
                            <div class="card-body">
                                <form method="POST" action="{{URL('admin/saveSettings')}}" enctype='multipart/form-data'>
                                	@csrf
                                        
                                        <div class="row add-member">
                                            <div class="col-md-6 form-group mb-3">
                                                <label for="firstName1">Mall Title*</label>
                                                <input class="form-control" type="text" placeholder="Enter mall title" name="mall_title" required value="{{$settings['mall_title']}}">
                                            </div>

                                            <div class="col-md-6 form-group mb-3">
                                                <label for="firstName1">Mall Image*</label>
                                                <input class="form-control" type="file" accept="image/*" placeholder="Enter mall image" name="mall_image" >
                                                <img src="{{storage_url()}}/{{$settings['mall_image']}}" width="50">
                                            </div>
                                        </div>

                                        <div class="row add-member">
                                            <div class="col-md-6 form-group mb-3">
                                                <label for="firstName1">Description*</label>
                                                <textarea class="form-control" placeholder="Enter description" name="description" required>{{$settings['description']}}</textarea>
                                            </div>

                                            <div class="col-md-6 form-group mb-3">
                                                <label for="firstName1">Call Us*</label>
                                                <textarea class="form-control" placeholder="Enter call us" name="call_us" required>{{$settings['call_us']}}</textarea>
                                            </div>
                                        </div>

                                        <div class="row add-member">
                                            <div class="col-md-6 form-group mb-3">
                                                <label for="firstName1">Mail Us*</label>
                                                <input class="form-control" type="text" placeholder="Enter mail us" name="mail_us" required value="{{$settings['mail_us']}}">
                                            </div>

                                            <div class="col-md-6 form-group mb-3">
                                                <label for="firstName1">Telephone*</label>
                                                <input class="form-control" type="text" placeholder="Enter Number" name="telnumber" required value="{{$settings['telnumber']}}">
                                            </div>
                                        </div>

                                        <div class="row add-member">
                                            <div class="col-md-6 form-group mb-3">
                                                <label for="firstName1">Feedback Mail*</label>
                                                <input class="form-control" type="text" placeholder="Enter feedback" name="feedback" required value="{{$settings['feedback']}}">
                                            </div>

                                            <div class="col-md-6 form-group mb-3">
                                                <label for="firstName1">Leasing Mail*</label>
                                                <input class="form-control" type="text" placeholder="Enter leasing" name="leasing" required value="{{$settings['leasing']}}">
                                            </div>
                                        </div>

                                        <div class="row add-member">
                                            <div class="col-md-6 form-group mb-3">
                                                <label for="firstName1">Marketing Mail*</label>
                                                <input class="form-control" type="text" placeholder="Enter marketing" name="marketing" required value="{{$settings['marketing']}}">
                                            </div>
                                        </div>

                                        <div class="row add-member">
                                            <div class="col-md-6 form-group mb-3">
                                                <label for="firstName1">Address*</label>
                                                <textarea class="form-control" placeholder="Enter address" name="address" required>{{$settings['address']}}</textarea>
                                            </div>

                                            <div class="col-md-6 form-group mb-3">
                                                <label for="firstName1">Terms and Condition*</label>
                                                <textarea class="form-control" placeholder="Enter Terms and Condition" name="interest_terms_condition" required>{{$settings['interest_terms_condition']}}</textarea>
                                            </div>
                                        </div>

                                        <div class="row add-member">
                                            <div class="col-md-6 form-group mb-3">
                                                <label for="firstName1">Facebook*</label>
                                                <input class="form-control" type="text" placeholder="Enter facebook" name="facebook" required value="{{$settings['facebook']}}">
                                            </div>

                                            <div class="col-md-6 form-group mb-3">
                                                <label for="firstName1">Twitter*</label>
                                                <input class="form-control" type="text" placeholder="Enter twitter" name="twitter" required value="{{$settings['twitter']}}">
                                            </div>
                                        </div>

                                        <div class="row add-member">
                                            <div class="col-md-6 form-group mb-3">
                                                <label for="firstName1">Youtube*</label>
                                                <input class="form-control" type="text" placeholder="Enter youtube" name="youtube" required value="{{$settings['youtube']}}">
                                            </div>

                                            <div class="col-md-6 form-group mb-3">
                                                <label for="firstName1">Instagram*</label>
                                                <input class="form-control" type="text" placeholder="Enter instagram" name="instagram" required value="{{$settings['instagram']}}">
                                            </div>
                                        </div>

                                        <!-- <div class="row add-member">
                                            <div class="col-md-6 form-group mb-3">
                                                <label for="firstName1">Insurance Company Name*</label>
                                                <input class="form-control" type="text" placeholder="Enter >Insurance Company Name" name="insurance_company_name" required value="{{$settings['insurance_company_name']}}">
                                            </div>

                                            <div class="col-md-6 form-group mb-3">
                                                <label for="firstName1">Inusrance Company Mobile*</label>
                                                <input class="form-control" type="text" placeholder="Enter Inusrance Company Mobile" name="insurance_company_mobile" required value="{{$settings['insurance_company_mobile']}}">
                                            </div>
                                        </div>

                                        <div class="row add-member">
                                            <div class="col-md-6 form-group mb-3">
                                                <label for="firstName1">Insurance Company Logo*</label>
                                                <input class="form-control" type="file" placeholder="Enter Insurance Company Logo" name="insurance_company_logo" value="{{$settings['insurance_company_logo']}}" accept="image/*">

                                                <img src="{{storage_url()}}/{{$settings['insurance_company_logo']}}" width="50">
                                            </div>

                                            <div class="col-md-6 form-group mb-3">
                                                <label for="firstName1">Insurance Company Description*</label>
                                                <textarea class="form-control" name="insurance_company_description" required>{{$settings['insurance_company_description']}}</textarea>
                                            </div>
                                        </div> -->

                                        <div class="row add-member">
                                            <div class="col-md-6 form-group mb-3">
                                                <label for="firstName1">Insurance Not Covered Dialog*</label>
                                                <input class="form-control" type="text" placeholder="Enter >Insurance Not Covered Dialog" name="insurance_not_covered_dialog" required value="{{$settings['insurance_not_covered_dialog']}}">
                                            </div>

                                            <div class="col-md-6 form-group mb-3">
                                                <label for="firstName1">Inusrance Covered Dialog*</label>
                                                <input class="form-control" type="text" placeholder="Enter Inusrance Covered Dialog" name="insurance_covered_dialog" required value="{{$settings['insurance_covered_dialog']}}">
                                            </div>
                                        </div>

                                        <div class="row add-member">
                                            <div class="col-md-6 form-group mb-3">
                                                <label for="firstName1">Inusrance Not Eligible Dialog*</label>
                                                <input class="form-control" type="text" placeholder="Enter Inusrance Not Eligible Dialog" name="insurance_not_eligible_dialog" required value="{{$settings['insurance_not_eligible_dialog']}}">
                                            </div>

                                            <!-- <div class="col-md-6 form-group mb-3">
                                                <label for="firstName1">Insurance Terms & Conditions*</label>
                                                <textarea class="form-control" name="insurance_t_c" required>{{$settings['insurance_t_c']}}</textarea>
                                            </div> -->
                                        </div>
                                         

                                        <div class="col-md-12 d-flex">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                            <a class="btn btn-light ml-3" href="{{URL('admin/settings')}}">Back</a>
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
@extends('pages::layouts.master')

@section('meta_title', $banner->meta_title)
@section('meta_tags', $banner->meta_tags)
@section('meta_description', $banner->meta_description)

@section('content')

<!-- Main Wrapper -->
<main>

    <!-- Subheader -->
    {{-- <section class="sub-banner_career cover-image deferImage" data-src="{{storage_url()}}/{{$banner->image}}">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-5 order-2">
                    <div class="card text-block">
                        {!! $banner->description !!}
                    </div>
                </div>

            </div>
        </div>
    </section> --}}
    @if($banner)
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
@endif
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
    <!-- Subheader END -->

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

    <!-- Search Wrapper -->
    <div class="search-wrapper">
        <div class="container">
            <div class="career-search-form" data-aos="fade">
                <form method="GET" action="{{URL('careers/search')}}">
                    <div class="d-flex w-100 row-inputs">
                        <div class="form-group align-self-end">
                            <label for="">Search by Keyword</label>
                            <input type="text" class="form-control" name="Keyword">
                        </div>
                        <div class="form-group align-self-end">
                            <label for="">Search by Location</label>
                            <select class="form-control" name="location">
                            	<option value="">Show all</option>
                            	@foreach($locations as $location)
                            		<option value="{{$location}}">{{$location}}</option>
                            	@endforeach
                            </select>
                        </div>
                        <div class="align-self-end text-center text-md-left">
                            <button type="submit" class="btn quick-search-btn">Search</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Search Wrapper END -->

    <!-- Search List -->
    <div class="career-detail">
        <div class="container">
            <div class="d-flex row-wrap justify-content-between">
                <div class="job-content" data-aos="fade">
                    <h4 class="job-title">{{$job->title}}</h4>

                    <div class="list-text">
                        <ul class="list-unstyled">
                            <li>
                                <span class="text-black">Date :</span> {{date('M d, Y',strtotime($job->created_at))}}
                            </li>
                            <li>
                                <span class="text-black">Location :</span> {{$job->location}}
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="apply-job mb-3" data-aos="fade">
                    <button class="btn quick-apply-btn" data-toggle="modal" data-target="#applicationForm">Apply
                        Now</button>
                </div>
            </div>

            <div class="single_wrap" data-aos="fade">
                <h4 class="sec-title">Company</h4>
                <p>{{$job->company}}</p>
            </div>

            <div class="single_wrap" data-aos="fade">
                <h4 class="sec-title">Qualifications</h4>
                {!! $job->qualifications !!}
            </div>

            <div class="single_wrap" data-aos="fade">
                <h4 class="sec-title">Responsibilities</h4>
                {!! $job->responsibilities !!}
            </div>
        </div>
    </div>
    <!-- Search List END -->


</main>
<!-- Main Wrapper END -->



<!-- Modal Application Form -->
<div class="modal fade" id="applicationForm" tabindex="-1" role="dialog" aria-labelledby="applicationFormLabel"
    aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header border-none pb-2">
                <h5 class="modal-title" id="applicationFormLabel">Apply Job</h5>
                <button type="button" class="btn closeModal" data-dismiss="modal" aria-label="Close">
                    <i class="lni lni-close"></i>
                </button>
            </div>
            <form action="{{URL('careers/submitJobRequest')}}" method="POST"  enctype='multipart/form-data'>
                <div class="modal-body">

                    <!-- Applicatopn Form -->
                    <div class="application-wrapper">
                        <div class="d-flex flex-wrap mb-3">
                            <div class="application-label">
                                Applying For :
                            </div>
                            <div class="application-post">
                                {{$job->title}}
                            </div>
                        </div>
                    
                    	@csrf
                    	<input type="hidden" name="id" value="{{$job->id}}">
                        <!-- Block -->
                        <div class="application-block">
                            <div class="application-header">
                                Basic Info
                            </div>
                            <div class="application-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">First Name*</label>
                                            <input type="text" class="form-control" name="first_name" placeholder=""  pattern="[A-Z a-z]*" oninvalid="setCustomValidity('Accept alphabets only')" onchange="try{setCustomValidity('')}catch(e){}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Last Name*</label>
                                            <input type="text" class="form-control" name="last_name" placeholder=""  pattern="[A-Z a-z]*" oninvalid="setCustomValidity('Accept alphabets only')" onchange="try{setCustomValidity('')}catch(e){}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Email*</label>
                                            <input type="email" class="form-control" placeholder="" name="email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">Phone*</label>
                                            <input type="text" class="form-control" placeholder="" name="mobile" pattern="[0-9-+, ?]*" oninvalid="setCustomValidity('Accept numbers only')" onchange="try{setCustomValidity('')}catch(e){}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Block END -->

                        <!-- Block -->
                        <div class="application-block">
                            <div class="application-header">
                                Address Info
                            </div>
                            <div class="application-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">City*</label>
                                            <input type="text" class="form-control" placeholder="" name="city" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="">State*</label>
                                            <select class="form-control" name="state" required>
                                                <option value="">Select</option>
                                                @foreach($states as $state)
                                                    <option value="{{$state->name}}">{{$state->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Address*</label>
                                            <textarea class="w-100 textarea " rows='1' name="address" required id=""></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Block END -->

                        <!-- Block -->
                        <div class="application-block">
                            <div class="application-header">
                                Professional Details
                            </div>
                            <div class="application-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Skill Set*</label>
                                            <input type="text" data-role="tagsinput" class="form-control" placeholder="" name="skill_set" required>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Block END -->

                        <!-- Block -->
                        <div class="application-block">
                            <div class="application-header">
                                Educational Details
                            </div>
                            <div class="application-body">
                                <div class="educational_wrapper">
                                    <div class="row educational_clone">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Institute / School:</label>
                                                <input type="text" class="form-control" placeholder="" name="institute[]" required>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="">Major / Department:</label>
                                                <input type="text" class="form-control" placeholder="" name="department[]" required>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group mt-32 remove_education hide">
                                                <a class="icon">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Degree</label>
                                                <input type="text" class="form-control" placeholder="" name="degree[]" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-half">
                                                <div class="left-el">
                                                    <div class="form-group">
                                                        <label for="">From</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control mr-2 datepicker_month date_from" placeholder="" name="from[]" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="right-el">
                                                    <div class="form-group">
                                                        <label for="">To</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control mr-2 datepicker_month date_to" placeholder="" name="to[]" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-3 mb-3">
                                    <a id="add_education" class="btn btn-details-more">
                                        Add Education Details
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>

                            </div>
                        </div>
                        <!-- Block END -->

                        <!-- Block -->
                        <div class="application-block">
                            <div class="application-header">
                                Experience Details
                            </div>

                            <div class="application-body">
                                <div class="experience_wrapper">
                                    <div class="row experience_clone">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Institute / Company:</label>
                                                <input type="text" class="form-control" placeholder="" name="exp_institute[]" required>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="">Position:</label>
                                                <input type="text" class="form-control" placeholder="" name="job_title[]" required>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group mt-32 remove_experience hide">
                                                <a class="icon">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="">Experience</label>
                                                <input type="text" class="form-control" placeholder="" name="experience[]" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="col-half">
                                                <div class="left-el">
                                                    <div class="form-group">
                                                        <label for="">From</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control mr-2 datepicker_month exp_date_from" placeholder="" name="exp_from[]" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="right-el">
                                                    <div class="form-group">
                                                        <label for="">To</label>
                                                        <div class="input-group">
                                                            <input type="text" class="form-control mr-2 datepicker_month exp_date_to" placeholder="" name="exp_to[]" required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="text-center mt-3 mb-3">
                                    <a id="add_experience" class="btn btn-details-more">
                                        Add Experience Details
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>

                            </div>
                        </div>
                        <!-- Block END -->

                        <!-- Block -->
                        <div class="application-block">
                            <div class="application-header">
                                Attachment Info
                            </div>
                            <div class="application-body">
                                <div class="group-btn">
                                    <div class="btn-holder text-center">
                                        <label for="">Resume</label>
                                        <div class="btn btn-browse btn-block position-relative overflow-hidden">
                                            <span class="upload_label">Browse</span>
                                            <input type="file" class="position-absolute file-upload-transparent upload_file" name="resume" required accept="application/pdf">
                                        </div>
                                    </div>
                                    <div class="btn-holder text-center">
                                        <label for="">Cover Letter</label>
                                        <div class="btn btn-browse btn-block position-relative overflow-hidden">
                                            <span class="upload_label">Browse</span>
                                            <input type="file" class="position-absolute file-upload-transparent upload_file" name="cover_letter" required accept="application/pdf">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Block END -->

                        <!-- Block -->
                        <div class="application-block">
                            <div class="application-header">
                                Compliance Info
                            </div>
                            <div class="application-body">
                                <div class="media media-checkbox">
                                    <div class="media-left">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="customCheck1" required>
                                            <label class="custom-control-label" for="customCheck1"></label>
                                        </div>
                                    </div>
                                    <div class="media-body">
                                        I agree to the collection and use of my personal data (the“Recruitment Data”) in
                                        connection with my application for employment with Impex
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- Block END -->
                    </div>
                    <!-- Application Form END -->

                </div>
                <div class="modal-footer border-none pt-2">
                    <button type="reset" class="btn modal-close-btn " data-dismiss="modal">Close</button>
                    <button type="submit" class="btn application-submit ml-auto">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal Application Form END -->


@stop
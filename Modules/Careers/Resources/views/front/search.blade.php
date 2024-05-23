@extends('pages::layouts.master')

@section('meta_title', $banner->meta_title)
@section('meta_tags', $banner->meta_tags)
@section('meta_description', $banner->meta_description)

@section('content')

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

    <!-- Search Wrapper -->
    <div class="search-wrapper">
        <div class="container">
            <div class="career-search-form" data-aos="fade">
                <form method="GET" action="{{URL('careers/search')}}">
                    <div class="d-flex w-100 row-inputs">
                        <div class="form-group align-self-end">
                            <label for="">Search by Keyword</label>
                            <input type="text" class="form-control" value="<?php echo isset($_GET['Keyword'])?$_GET['Keyword']:''; ?>" placeholder="" name="Keyword">
                        </div>
                        <div class="form-group align-self-end">
                            <label for="">Search by Location</label>
                            <select class="form-control" name="location">
                            	<option value="">Show all</option>
                            	@foreach($locations as $location)
                            		<option value="{{$location}}" <?php echo isset($_GET['location']) && $_GET['location'] == $location?'selected':''; ?>>{{$location}}</option>
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
    <section class="search-result_list" data-aos="fade">
        <div class="container">
            <div class="d-flex flex-wrap justify-content-between mb-1">
                <div class="result-count">
                    Results {{$jobs->count()}}
                </div>
                <div class="search-filter">
                    <select class="form-control" name="" id="job_search">
                        <option value="latest" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'latest'?'selected':''; ?>>Sort by : Latest Updated</option>
                        <option value="old" <?php echo isset($_GET['sort']) && $_GET['sort'] == 'old'?'selected':''; ?>>Sort by : Old</option>
                    </select>
                </div>
            </div>

            <div class="rounded-edge">
                <div class="table-responsive result-table">
                    <table class="table">
                        <tbody>
                        	@foreach($jobs as $job)
	                            <tr>
	                                <td>
	                                    <a href="{{URL('careers/detail')}}/{{$job->slug}}">
	                                        {{$job->title}}
	                                    </a>
	                                </td>
	                                <td>{{$job->location}}</td>
	                                <td>{{date('M d, Y',strtotime($job->created_at))}}</td>
	                            </tr>
	                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="d-flex flex-wrap justify-content-between mb-1">
                <div class="tbl-footer">
                    Result {{($jobs->currentPage()-1)*$jobs->perpage()+$jobs->count()}} of {{$jobs->total()}}
                </div>
                <div class="tbl-pagination">
                    {{$jobs->appends($_GET)->links()}}
                </div>
            </div>
        </div>
    </section>
    <!-- Search List END -->


</main>

@stop
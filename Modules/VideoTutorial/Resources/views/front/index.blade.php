@extends('pages::layouts.master')

@section('meta_title', $banner->meta_title)
@section('meta_tags', $banner->meta_tags)
@section('meta_description', $banner->meta_description)

@section('content')

<!-- Main Wrapper -->
<main>
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

    <!-- Media Center -->
    <section class="video-tut-component video-tut-component--gap">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-12">
                    <div class="product-selector ">
                        <label class="product-selector__label" for="">Choose Product Category</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="D--flex">
                        <div class="category">
                            <div class="product-selector ">
                                <div class="form-group">
                                    <select class="form-control" name="category_id" id="category_id">
                                    <option value="all">All Videos</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="sorting">
                            <div class="form-group">
                                <label class="product-selector__label" for="">Sort By  :</label>
                                <select class="form-control" name="" id="">
                                    <option value="">Latest</option>
                                    <option value="">High to low</option>
                                </select>
                            </div>
                        </div> -->
                    </div>
                </div>

            </div>
        </div>
        <div class="video-tut-component__inner">
            <ul class="video-tut-component__list"  id="posts">
                @include('videotutorial::front.video-tutorial')

                
            </ul>
            @if($total_videos > $tutorials->count())
            <div class="more view_more">
                <a  class="btn learn-button more_data"  id="more">
                
                    View more
                 </a>
            </div>
            @endif
        </div>
        
    </section>
    <!-- Media Center END -->
</main>

@stop
@section('script')
    <script src="{{asset('public/front/script/video-tutorial.js')}}"></script>
@endsection
@extends('pages::layouts.master')

@section('meta_title', $banner->meta_title)
@section('meta_tags', $banner->meta_tags)
@section('meta_description', $banner->meta_description)

@section('content')

<!-- Main Wrapper -->
<main>

    <!-- Baner Area -->
    {{-- <div class="inner-hero-area bg-image gredient-purple-bg banner-full-img">
        <div class="d-flex flex-grow-1">
            <div class="container align-self-center">
                <div class="row align-items-center">
                    <div class="col-12 col-md-12 col-lg-5 mb-4">
                        {!! $banner->description !!}
                    </div>
                    <div class="col-12 col-md-6 col-lg-6 offset-lg-1 mb-4">
                        <img src="{{storage_url()}}/{{$banner->image}}" class="img-fluid" alt="banner">
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
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
    <!-- Banner Area END -->

   <div class="blog-detail">
       <div class="container">
           <div class="row">
               <div class="col-12">
                   <div class="blog-content">
                        <h4 class="blog-title">{{$blog->title}}</h4>

                        <div class="list-text">
                            <ul class="list-unstyled">
                                <li>
                                    <span class="text-black">Date :</span> {{date('F d, Y',strtotime($blog->created_at))}}
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="single_wrap">
                    {!!$blog->description!!}
                    
                    </div>
               </div>
           </div>
       </div>
   </div>
</main>
<!-- Main Wrapper END -->
@stop
@section('script')
    <script src="{{asset('public/front/script/blog-and-news.js')}}"></script>
@endsection
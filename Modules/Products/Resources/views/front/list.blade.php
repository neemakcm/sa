@extends('pages::layouts.master')

@section('meta_title', $brudcrumb->meta_title)
@section('meta_tags', $brudcrumb->meta_tags)
@section('meta_description', $brudcrumb->meta_description)

@section('content')

<main>

    <section class="margin-sub">
        <div class="container">
            <nav aria-label="breadcrumb" class="breadcrumb-top">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{URL('/')}}">Home</a></li>
                    @if($brudcrumb->parent != null && $brudcrumb->parent->parent_id != 0)
                        <li class="breadcrumb-item"><a href="{{URL('/products')}}/{{$brudcrumb->parent->slug}}">{{$brudcrumb->parent->name}}</a></li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">{{$brudcrumb->name}}</li>
                </ol>
            </nav>
        </div>
    </section>

    @csrf

    @if($brudcrumb->desktop_banner != '')
        <!-- Sub Banner -->
        <section class="page-sub-banner">
            <div class="image-cover web" style="background-image:url('{{storage_url()}}/{{$brudcrumb->desktop_banner}}');">
                <div class="container">
                    <div class="col-md-8 col-lg-6 col-xl-6 ml-auto">
                        <div class="card transpatrent-layer animation-in">
                            <h4 class="small-title " data-sal="slide-up" data-sal-delay="300" data-sal-easing="ease-out-back" style="color:{{$brudcrumb->main_title_color}}; font-size:{{$brudcrumb->main_title_size}}">{{$brudcrumb->banner_main_title}}</h4>
                            <h1 class="bold-title" data-sal="slide-up" data-sal-delay="500" data-sal-easing="ease-out-back" style="color:{{$brudcrumb->sub_title_color}}; font-size:{{$brudcrumb->sub_title_size}}">{{$brudcrumb->banner_sub_title}}</h1>
                            <div class="short-note" data-sal="slide-up" data-sal-delay="700" data-sal-easing="ease-out-back" style="color:{{$brudcrumb->short_description_color}}; font-size:{{$brudcrumb->short_description_size}}">{{$brudcrumb->banner_small_description}}</div>

                            @if($brudcrumb->banner_link != '')
                                <div class="group-button"><a class="btn learn-button" href="{{$brudcrumb->banner_link}}" data-sal="flip-right" data-sal-delay="900" data-sal-easing="ease-out-back"  style="color:{{$brudcrumb->learn_more_color_code}};background-color: {{$brudcrumb->learn_more_bg_color}};" > Learn More </a></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="image-cover mobile" style="background-image:url('{{storage_url()}}/{{$brudcrumb->mobile_banner}}');">
                <div class="container">
                    <div class="col-md-8 col-lg-6 col-xl-6 ml-auto">
                        <div class="card transpatrent-layer animation-in">
                            <h4 class="small-title " data-sal="slide-up" data-sal-delay="300" data-sal-easing="ease-out-back" style="color:{{$brudcrumb->main_title_color}}; font-size:{{$brudcrumb->main_title_size}}">{{$brudcrumb->banner_main_title}}</h4>
                            <h1 class="bold-title" data-sal="slide-up" data-sal-delay="500" data-sal-easing="ease-out-back" style="color:{{$brudcrumb->sub_title_color}} ; font-size:{{$brudcrumb->sub_title_size}}">{{$brudcrumb->banner_sub_title}}</h1>
                            <div class="short-note" data-sal="slide-up" data-sal-delay="700" data-sal-easing="ease-out-back" style="color:{{$brudcrumb->short_description_color}}; font-size:{{$brudcrumb->short_description_size}}">{{$brudcrumb->banner_small_description}}</div>

                            @if($brudcrumb->banner_link != '')
                                <div class="group-button"><a class="btn learn-button" href="{{$brudcrumb->banner_link}}" data-sal="flip-right" data-sal-delay="900" data-sal-easing="ease-out-back" style="color:{{$brudcrumb->learn_more_color_code}};background-color: {{$brudcrumb->learn_more_bg_color}};"> Learn More </a></div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Sub Banner END -->
    @else
        <!-- Sub Banner -->
        <section class="page-sub-banner">
            <div class="image-cover deferImage" data-src="{{storage_url()}}/{{$banner->image}}">
                <div class="container">
                    <div class="col-md-8 col-lg-6 col-xl-6 ml-auto">
                        {!! $banner->description !!}
                    </div>
                </div>
            </div>
        </section>
        <!-- Sub Banner END -->
    @endif


    <input type="hidden" id="category_id" value="{{$brudcrumb->slug}}">
    <input type="hidden" id="min_price" value="{{$price->min}}">
    <input type="hidden" id="max_price" value="{{$price->max}}">
    <input type="hidden" id="filtered_min_price" value="{{isset($_GET['min'])?$_GET['min']:$price->min}}">
    <input type="hidden" id="filtered_max_price" value="{{isset($_GET['max'])?$_GET['max']:$price->max}}">

    <section class="product-list-main">
        <div class="product-list__container">

            <div class="product-list__inner">

                <!-- Filter Option -->
                <div class="mob-filter-panel align-items-center d-lg-none">
                    <a class="filter-button-link js-filter-button" href="javascript:void(0)">
                        <i class="lni lni-funnel mr-2"></i>
                        Filter
                    </a>
                    <div>
                        <div class="form-group mb-0">
                            <select class="form-control custom-select sort_change">
                                <option value="new" <?php echo isset($_GET['Sort']) && $_GET['Sort'] == 'new'?'selected':''; ?>>New Arrivals</option>
                                <option value="rated" <?php echo isset($_GET['Sort']) && $_GET['Sort'] == 'rated'?'selected':''; ?>>Highest Rated</option>
                                <option value="price_high" <?php echo isset($_GET['Sort']) && $_GET['Sort'] == 'price_high'?'selected':''; ?>>Price: High to Low</option>
                                <option value="price_low" <?php echo isset($_GET['Sort']) && $_GET['Sort'] == 'price_low'?'selected':''; ?>>Price: Low to High</option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- Filter Option END-->

                <!-- Side Panel -->
                <div class="side-panel">
                    <!-- Filetr Mobile Closebar -->
                    <div class="filter-mob-header align-items-center d-lg-none">
                        <h4 class="header-title">
                            Filter
                        </h4>
                        <button class="filter-mob-close js-filter-mob-close">
                            <i class="lni lni-close"></i>
                        </button>
                    </div>
                    <!-- Filetr Mobile Closebar END -->

                    <div class="side-panel__header d-none d-lg-block">
                        <h4 class="side-panel__title">
                            Filter
                        </h4>

                        <a href="{{URL('products/'.$brudcrumb->slug)}}">Clear</a>
                    </div>

                    <!-- Sidepanel Body -->
                    <div class="side-panel__body">

                        <!-- Filter -->
                        <div class="filters-list">
                            <div class="filters-list__header">
                                Price Range
                            </div>
                            <div class="filters-list__body">

                                <div class="price-range-slider">
                                    <!-- Slider -->
                                    <div id="js-price-slider"></div>
                                    <div class="price-values d-flex  justify-content-between">
                                        <div class="amount">
                                            <div class="position-relative ">
                                                <input type="text" class="form-control" id="minPriceField" data-value="<?php echo isset($_GET['min'])?$_GET['min']:$price->min; ?>">
                                            </div>
                                        </div>
                                        <div class="amount">
                                            <div class="position-relative ">
                                                <input type="text" class="form-control" id="maxPriceField" data-value="<?php echo isset($_GET['max'])?$_GET['max']:$price->max; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Filter -->
                        <?php $i = 1; ?>
                        @foreach($filter as $key => $value)
                            <?php
                                $key_name= $key;

                                $key= str_replace(' ', '_', $key);
                                $attr = isset($_GET[$key])?$_GET[$key]:'';
                                $attr_split = $attr == ''?array():explode(',', $attr);
                            // dd($attr);
                            ?>

                            @if(!empty($value))
                                <!-- Filter -->
                                <div class="filters-list">
                                    <div class="filters-list__header">
                                        {{$key_name}}
                                    </div>
                                    <div class="filters-list__body">
                                        @foreach($value as $fltr)
                                            <div class="checkbox-list">
                                                <div class="custom-control custom-checkbox radio-check">
                                                    <input type="checkbox" class="custom-control-input type_filters filter_change " id="customCheck{{$i}}" value="{{$fltr}}" name="{{$key}}" @if(count($attr_split) > 0)<?php echo in_array($fltr, $attr_split)?'checked':''; ?> @endif>
                                                    <label class="custom-control-label" for="customCheck{{$i}}">{{$fltr}}</label>
                                                </div>
                                            </div>
                                            <?php $i++; ?>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- Filter -->
                            @endif
                        @endforeach
                        @foreach($filters as $keys => $values)
                        <?php
                            $key_names= $keys;
                            $keys= str_replace(' ', '_', $keys);
                            $attrs = isset($_GET[$keys])?$_GET[$keys]:'';
                            $attr_splits = $attrs == ''?array():explode(',', $attrs);
                        ?>

                        @if(!empty($values))
                            <!-- Filter -->
                            <div class="filters-list">
                                <div class="filters-list__header">
                                    {{$key_names}}
                                </div>
                                <div class="filters-list__body">
                                    @foreach($values as $fltrs)
                                        <div class="checkbox-list">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input filter_change filter_changes" id="customCheck{{$i}}" value="{{$fltrs}}" name="{{$keys}}" <?php echo in_array($fltrs, $attr_splits)?'checked':''; ?>>
                                                <label class="custom-control-label" for="customCheck{{$i}}">{{$fltrs}}</label>
                                            </div>
                                        </div>
                                        <?php $i++; ?>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Filter -->
                        @endif
                    @endforeach

                    </div>
                    <!-- Sidepanel Body END -->

                    <!-- Filetr Mobile Closebar -->
                    <div class="filter-mob-footer align-items-center d-lg-none">
                        <div class="text-right">
                            <button class="btn btn-apply-filter">
                                Apply Filters
                            </button>
                        </div>
                    </div>
                    <!-- Filetr Mobile Closebar END -->

                </div>
                <!-- Side Panel END -->

                <!-- Product Content -->
                <div class="product-list__right">
                    <div class="prd-shop__content">
                        <div class="filter-main-header">
                            <div class="filter-main__title">
                                {{$products->count()}} Results
                            </div>
                            <div>
                                <div class="form-group mb-0">
                                    <select class="form-control custom-select sort_change" data-type="sort">
                                        <option value="price_high" <?php echo isset($_GET['Sort']) && $_GET['Sort'] == 'price_high'?'selected':''; ?>>Price: High to Low</option>

                                        <option value="new" <?php echo isset($_GET['Sort']) && $_GET['Sort'] == 'new'?'selected':''; ?>>New Arrivals</option>
                                        <option value="rated" <?php echo isset($_GET['Sort']) && $_GET['Sort'] == 'rated'?'selected':''; ?>>Highest Rated</option>
                                        <option value="price_low" <?php echo isset($_GET['Sort']) && $_GET['Sort'] == 'price_low'?'selected':''; ?>>Price: Low to High</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <?php
                            if($compare->count() > 0)
                                $compare_list = $compare->pluck('id')->toArray();
                            else
                                $compare_list = array();

                        ?>

                        <div class="row">
                            @foreach($products as $product)
                                <!-- Products -->
                                @if(($product->type == 1 && $product->varients->count() > 0) || $product->type == 0)
                                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-6 col-12 product-grid-gap">
                                        <div class="ps-product">
                                            <div class="ps-product__thumbnail">
                                            @if($product->type == 0)
                                                        <a href="{{URL('products/detail')}}/{{$product->slug}}" >
                                                        <img class="img-fluid ps-product__image product_image"
                                                    src="{{storage_url()}}/resized/medium/{{$product->thumbnail}}" alt="product">

                                                        </a>
                                                    @else
                                                        <a class="product_image_link" href="{{URL('products/detail')}}/{{$product->varients[0]->slug}}" class="btn btn-block button-buy-now">
                                                        <img class="img-fluid ps-product__image product_image"
                                                    src="{{storage_url()}}/resized/medium/{{$product->thumbnail}}" alt="product">

                                                        </a>
                                                    @endif
                                                </div>

                                            @if($product->type == 1)
                                                <div class="pd-size-slider">
                                                    <div class="position-relative">
                                                        <div class="ps-size-carousel owl-carousel owl-theme">
                                                            @foreach($product->varients as $key => $varient)
                                                                @if(isset($varient->attributes[0]))
                                                                    @php
                                                                        // $width = strlen($varient->attributes[0]->value)*15;
                                                                    @endphp
                                                                    <div class="item varient_select <?php echo $key == 0?'active':''; ?>" data-sku="{{$varient->slug}}" data-product_id="{{$varient->id}}">
                                                                        {{-- <div class="item varient_select <?php echo $key == 0?'active':''; ?>" data-sku="{{$varient->slug}}" style="<?php //echo 'width: '.$width.'px' ?>" data-product_id="{{$varient->id}}"> --}}
                                                                        <button class="btn btn-size-picker">
                                                                            {{$varient->attributes[0]->value}}
                                                                        </button>
                                                                    </div>
                                                                @endif
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            @else
                                                @if($product->attributes->count() > 0)
                                                    @php
                                                        // $width = strlen($product->attributes[0]->value)*11;
                                                    @endphp
                                                    <div class="pd-size-slider">
                                                        <div class="position-relative">
                                                            <div class="ps-size-carousel owl-carousel owl-theme">
                                                                {{-- <div class="item varient_select active" style="<?php echo 'width: '.$width.'px' ?>" data-sku="{{$product->slug}}" data-product_id="{{$product->id}}"> --}}
                                                                <div class="item varient_select active"  data-sku="{{$product->slug}}" data-product_id="{{$product->id}}">

                                                                    <button class="btn btn-size-picker">
                                                                        {{$product->attributes[0]->value}}
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif

                                            <div class="ps-product__content">
                                                <div class="ps-product__title product_title">
                                                    @if($product->type == 0)
                                                        <a href="{{URL('products/detail')}}/{{$product->slug}}" class="button-buy-now">
                                                            {{$product->name}}
                                                        </a>
                                                    @else
                                                        <a href="{{URL('products/detail')}}/{{$product->varients[0]->slug}}" class="button-buy-now">
                                                            {{$product->varients[0]->name}}
                                                        </a>
                                                    @endif


                                                </div>
                                                @if($product->type == 0)
                                                    <div class="ps-product__price">
                                                        <div class="price">
                                                            <span class="unit">SAR</span><span class="number product_offer_price">{{$product->offer_price}}</span>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex flex-wrap mb-3 product_discount_wrapper <?php echo $product->offer_price != $product->price?'':'hide'; ?>">
                                                        <del class="ps-product__price-prev mr-3">
                                                            <span class="unit">SAR</span><span class="number product_price "> {{$product->price}}</span>
                                                        </del>
                                                        <div class="ps-product__price-prev">
                                                            <span class="unit">Save SAR </span><span class="number product_discount"> {{round($product->price - $product->offer_price,2)}}</span>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="ps-product__price">
                                                        <div class="price">
                                                            <span class="unit">SAR</span><span class="number product_offer_price">{{$product->varients[0]->offer_price}}</span>
                                                        </div>
                                                    </div>

                                                    <div class="d-flex flex-wrap mb-3 product_discount_wrapper <?php echo $product->varients[0]->offer_price != $product->varients[0]->price?'':'hide'; ?>">
                                                        <del class="ps-product__price-prev mr-3">
                                                            <span class="unit">SAR</span><span class="number product_price"> {{$product->varients[0]->price}}</span>
                                                        </del>
                                                        <div class="ps-product__price-prev">
                                                            <span class="unit">Save SAR </span><span class="number product_discount"> {{round($product->varients[0]->price - $product->varients[0]->offer_price,2)}}</span>
                                                        </div>
                                                    </div>
                                                @endif

                                                <div class="line-divider mb-3"></div>
                                                <div class="ps-product__desc">
                                                    {!! $product->short_description !!}
                                                </div>
                                            </div>

                                            <div class="button-content">
                                                @if($product->type == 0)
                                                    <a rel="noopener" href="{{URL('products/detail')}}/{{$product->slug}}" class="btn btn-block button-buy-now product_link">
                                                        Buy Now
                                                    </a>
                                                @else
                                                    <a rel="noopener" href="{{URL('products/detail')}}/{{$product->varients[0]->slug}}" class="btn btn-block button-buy-now product_link">
                                                        Buy Now
                                                    </a>
                                                @endif
                                                <a class="btn btn-block button-visit-store" href="{{URL('stores')}}">
                                                    Visit Store
                                                </a>
                                                @if($product->type == 0)
                                                    <button class="btn btn-block button-compare  js-add-slide add_compare <?php echo in_array($product->id, $compare_list)?'active':'';  ?>" data-product_id="{{$product->id}}">
                                                @else
                                                    <button class="btn btn-block button-compare  js-add-slide add_compare <?php echo in_array($product->varients[0]->id, $compare_list)?'active':'';  ?>" data-product_id="{{$product->varients[0]->id}}">
                                                @endif
                                                    <i class="fas fa-check"></i>
                                                    <i class="lni lni-plus"></i>
                                                    Add to Compare
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <!-- Products END -->
                            @endforeach

                        </div>

                        <div class="float-right text-center mt-2">
                            {{$products->appends($_GET)->links()}}
                        </div>

                    </div>
                </div>
                <!-- Product Content END -->

            </div>
        </div>
    </section>

</main>

<div class="product-compare-wrapper product_compare_slider <?php echo $compare->count() > 0?'':'hide'; ?>">
    <div class="product-wrapper__inner">
        <div class="row align-items-center">
            <div class="col-md-9">
                <div class="position-relative">
                    <div class="slider add-remove">
                        @foreach($compare as $comp)
                            <div class="item">
                                <div class="product-content">
                                    <div class="product-image">
                                        <img class="img-fluid ps-product__image "
                                            src="{{storage_url()}}/resized/medium/{{$comp->thumbnail}}" alt="product">
                                    </div>
                                    <div class="product-desc">
                                        <h4>{{$comp->name}}</h4>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

            </div>
            <div class="col-md-3">
                <div class="comp-wrapper text-center">
                    <div class="title compare_count">Compare ({{$compare->count()}})</div>
                    <a class="d-block btn-clr-box compare_clear" href="javascript:void(0)">Clear All</a>
                    <a href="{{URL('compare')}}" class="btn btn-compare">Compare</a>
                </div>
            </div>
        </div>
    </div>
</div>


@stop



@section('script')
    <script src="{{asset('public/admins/js/product-detail.js')}}"></script>

    {{-- <script src="{{asset('public/front/plugins/plugin-bundle.js')}}"></script> --}}

    <!-- Custom Script -->

    {{-- <script src="{{asset('public/front/script/app.js')}}"></script> --}}
    {{-- <script src="{{asset('public/front/script/dev.js')}}"></script> --}}

@endsection

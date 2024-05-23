@extends('pages::layouts.master')

@section('meta_title', $banner->meta_title)
@section('meta_tags', $banner->meta_tags)
@section('meta_description', $banner->meta_description)

@section('content')
<main>

   <!-- <div class="manual-products">
       <div class="container">
           <div class="row">
               <div class="col-12">
                   <h6 class="title">{{$banner->title}}</h6>
                   {!! $banner->description !!}
                    <div class="D--flex">
                        @foreach($parentCategories as $prentCategory)
                            <div class="prdts prdts-hover" id="{{encrypt($prentCategory->id)}}">
                                         <div class="prdt-item ">
                                    <div class="prdt-icon">
                                        <div class="make-center">
                                            @if($prentCategory->icon)
                                            <img src="{{storage_url()}}/{{$prentCategory->icon}}" width="100px" height="100px">
                                       
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-name">
                                        <h6>{{$prentCategory->name}}</h6>
                                    </div>
                                    <div class="down-arrow">
                                        <img src="{{base_url()}}/public/front/images/user-manual/down-arrow.png">
                                    </div>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
           </div>
       </div>
   </div>

   <div class="manual-show" id="manual_show">
       <div class="container">
           <div class="row">
               <div class="col-12">
                   <div class="D--flex">
                       <div class="manual-findings">
                           <div class="find-content">
                               <h5 class="type-title">
                                   Type
                               </h5>
                               <div class="more-type">
                                   <ul id="type">
                                       <li>
                                        <div class="prdt-n"></div>
                                       </li>
                                      
                                   </ul>
                               </div>
                           </div>
                       </div>
                       <div class="manual-findings">
                        <div class="find-content">
                            <h5 class="type-title">
                                Sub Type
                            </h5>
                            <div class="more-type">
                                <ul id="sub_type">
                                   
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="manual-findings">
                        <div class="find-content">
                            <h5 class="type-title">
                                Product
                            </h5>
                            <div class="more-type">
                                <div class="search" id="search_div">
                                    <div class="form-group">
                                        <input type="text" id="search" name="search" class="form-control" placeholder="Enter model ">
                                        <div class="srch-icon">
                                            <img src="{{base_url()}}/public/front/images/user-manual/search-icon.png">
                                        </div>
                                    </div>
                                </div>
                                <div class="prodts">
                                    <ul id="product">
                                       
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="manual-findings">
                        <div class="find-content">
                            <h5 class="type-title">
                                User Manual
                            </h5>
                            <div class="more-type">
                                <ul id="user_manual">
                                   
                                </ul>
                            </div>
                        </div>
                    </div>
                   </div>
               </div>
           </div>
       </div>
   </div> -->


   <div class="manual-products">
       <div class="container">
           <div class="row">
               <div class="col-12">
                   <h6 class="title">{{$banner->title}}</h6>
                   {!! $banner->description !!}
                    <div class="D--flex">
                        <div class="manual-products-carousel owl-carousel owl-theme">
                        @foreach($parentCategories as $prentCategory)
                            <div class="prdts prdts-hover item" id="{{encrypt($prentCategory->id)}}">
                                <div class="prdt-item ">
                                    <div class="prdt-icon">
                                        <div class="make-center">
                                            @if($prentCategory->icon)
                                            <img src="{{storage_url()}}/{{$prentCategory->icon}}" width="100px" height="100px">
                                       
                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-name">
                                        <h6>{{$prentCategory->name}}</h6>
                                    </div>
                                    <div class="down-arrow">
                                        <img src="{{base_url()}}/public/front/images/user-manual/down-arrow.png">
                                    </div>
                                </div>

                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>
           </div>
       </div>
   </div>

   <div class="manual-show" id="manual_show">
       <div class="container">
           <div class="row">
               <div class="col-12">
                   <div class="D--flex">
                       <div class="manual-findings">
                           <div class="find-content">
                               <h5 class="type-title">
                                   Type
                               </h5>
                               <div class="more-type">
                                   <ul id="type">
                                       <li>
                                        <div class="prdt-n"></div>
                                       </li>
                                      
                                   </ul>
                               </div>
                           </div>
                       </div>
                       <div class="manual-findings">
                        <div class="find-content">
                            <h5 class="type-title">
                                Sub Type
                            </h5>
                            <div class="more-type">
                                <ul id="sub_type">
                                   
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="manual-findings">
                        <div class="find-content">
                            <h5 class="type-title">
                                Product
                            </h5>
                            <div class="more-type">
                                <div class="search" id="search_div">
                                    <div class="form-group">
                                        <input type="text" id="search" name="search" class="form-control" placeholder="Enter model ">
                                        <div class="srch-icon">
                                            <img src="{{base_url()}}/public/front/images/user-manual/search-icon.png">
                                        </div>
                                    </div>
                                </div>
                                <div class="prodts">
                                    <ul id="product">
                                       
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="manual-findings">
                        <div class="find-content">
                            <h5 class="type-title">
                                User Manual
                            </h5>
                            <div class="more-type">
                                <ul id="user_manual">
                                   
                                </ul>
                            </div>
                        </div>
                    </div>
                   </div>
               </div>
           </div>
       </div>
   </div>

</main>
@stop
@section('script')
<script src="{{URL('public/front/script/user-manual.js')}}"></script>
<script src="{{URL('public/front/script/dev.js')}}"></script>
@endsection
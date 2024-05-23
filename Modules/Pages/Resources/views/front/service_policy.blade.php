@extends('pages::layouts.master')

@section('meta_title', $banner->meta_title)
@section('meta_tags', $banner->meta_tags)
@section('meta_description', $banner->meta_description)

@section('content')
<!-- Service Policy & charges -->

<main>

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


    <div class="page-service-policy">
        <div class="container">
            <div class="service-details__desc">
                {{$page->description}}
            </div>
            @if($page->home_appilance_table)
            <?php
                $home_appilance_tables = json_decode($page->home_appilance_table, true);
            ?>
            @if(!empty($home_appilance_tables[0]['product']))
            <div class="service-details">
                <div class="service-details__title">
                    Home Appliances
                </div>
                <div class="table-container">
                    <!-- Table Responsive -->
                    <div class="table-responsive">
                        <table class="table table-bordered data-list-table mb-0">
                            <thead class="table-head">
                                <tr>
                                    <th scope="col" style="text-align:center">Product</th>
                                    <th scope="col" style="text-align:center">Work at Customer Place <br/>(SAR)</th>
                                    <th scope="col" style="text-align:center">Work at Dealer Place <br/>(SAR)</th>
                                    <th scope="col" style="text-align:center">Work at Service Center <br/>(SAR)</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">
                                
                                @foreach($home_appilance_tables as $key=>$home_appilance_table)
                                    <tr>
                                        <td style="text-align:center">{{$home_appilance_table['product']}}</td>
                                        <td style="text-align:center">{{$home_appilance_table['customer_place']}}</td>
                                        <td style="text-align:center">{{$home_appilance_table['dealer_place']}}</td>
                                        <td style="text-align:center">{{$home_appilance_table['service_center']}}</td>
                                    </tr>
                               @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                    <!-- Table Responsive END -->
                   
                </div>
            </div>
            @endif
            @endif
            @if($page->ac_table)
            <?php
                $ac_tables = json_decode($page->ac_table, true);
            ?>
            @if(!empty($ac_tables[0]['product']))
            <div class="service-details">
                <div class="service-details__title">
                   Air Conditioners
                </div>
                <div class="table-container">
                    <!-- Table Responsive -->
                    <div class="table-responsive">
                        <table class="table table-bordered data-list-table mb-0">
                            <thead class="table-head">
                                <tr>
                                    <th scope="col" style="text-align:center">Product</th>
                                    <th scope="col" style="text-align:center">Service</th>
                                    <th scope="col" style="text-align:center"> Gas Charging <br/>(SAR)</th>
                                    <th scope="col" style="text-align:center">Installation <br/>(SAR)</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">
                            
                                @foreach($ac_tables as $keys=>$actable)
                                    <tr>
                                        <td style="text-align:center">{{$actable['product']}}</td>
                                        <td style="text-align:center">{{$actable['ac_service']}}</td>
                                        <td style="text-align:center">{{$actable['gas_charging']}}</td>
                                        <td style="text-align:center">{{$actable['installation']}}</td>
                                    </tr>
                               @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Table Responsive END -->
                   
                </div>
            </div>
            @endif
            @endif
            <!-- entertainment -->
            @if($page->entertainment_table)
            <?php
                $entertainment_tables = json_decode($page->entertainment_table, true);
            ?>
            @if(!empty($entertainment_tables[0]['product']))
            <div class="service-details">
                <div class="service-details__title">
                    Entertainment
                </div>
                <div class="table-container">
                    <!-- Table Responsive -->
                    <div class="table-responsive">
                        <table class="table table-bordered data-list-table mb-0">
                            <thead class="table-head">
                                <tr>
                                    <th scope="col" style="text-align:center">Product</th>
                                    <th scope="col" style="text-align:center">Work at Customer Place <br/> (SAR)</th>
                                    <th scope="col" style="text-align:center">Work at Dealer Place <br/>(SAR)</th>
                                    <th scope="col" style="text-align:center">Work at Service Center <br/> (SAR)</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">
                                
                                @foreach($entertainment_tables as $entertainment_table)
                                    <tr>
                                        <td style="text-align:center">{{$entertainment_table['product']}}</td>
                                        <td style="text-align:center">{{$entertainment_table['customer_place']}}</td>
                                        <td style="text-align:center">{{$entertainment_table['dealer_place']}}</td>
                                        <td style="text-align:center">{{$entertainment_table['service_center']}}</td>
                                    </tr>
                               @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                    <!-- Table Responsive END -->
                   
                </div>
            </div>
            @endif
            @endif
            <!-- //entertainment end -->
            <!-- lighting -->
            @if($page->lighting_table)
            <?php
                $lighting_tables = json_decode($page->lighting_table, true);
            ?>
            @if(!empty($lighting_tables[0]['product']))
            <div class="service-details">
                <div class="service-details__title">
                    Lighting
                </div>
                <div class="table-container">
                    <!-- Table Responsive -->
                    <div class="table-responsive">
                        <table class="table table-bordered data-list-table mb-0">
                            <thead class="table-head">
                                <tr>
                                    <th scope="col" style="text-align:center">Product</th>
                                    <th scope="col" style="text-align:center">Work at Customer Place <br/> (SAR)</th>
                                    <th scope="col" style="text-align:center">Work at Dealer Place <br/> (SAR)</th>
                                    <th scope="col" style="text-align:center">Work at Service Center <br/>(SAR)</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">
                               
                                @foreach($lighting_tables as $lighting_table)
                                    <tr>
                                        <td style="text-align:center">{{$lighting_table['product']}}</td>
                                        <td style="text-align:center">{{$lighting_table['customer_place']}}</td>
                                        <td style="text-align:center">{{$lighting_table['dealer_place']}}</td>
                                        <td style="text-align:center">{{$lighting_table['service_center']}}</td>
                                    </tr>
                               @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                    <!-- Table Responsive END -->
                   
                </div>
            </div>
            @endif
            @endif
            <!-- lighting end -->
            <!-- personal care -->
            @if($page->personal_care_table)
            <?php
            $personal_care_tables = json_decode($page->personal_care_table, true);
            ?>
           @if(!empty($personal_care_tables[0]['product']))
            <div class="service-details">
                <div class="service-details__title">
                    Personal Care
                </div>
                <div class="table-container">
                    <!-- Table Responsive -->
                    <div class="table-responsive">
                        <table class="table table-bordered data-list-table mb-0">
                            <thead class="table-head">
                                <tr>
                                    <th scope="col" style="text-align:center">Product</th>
                                    <th scope="col" style="text-align:center">Work at Customer Place <br/> (SAR)</th>
                                    <th scope="col" style="text-align:center">Work at Dealer Place <br/>(SAR)</th>
                                    <th scope="col" style="text-align:center">Work at Service Center <br/>(SAR)</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">
                                
                                @foreach($personal_care_tables as $key=>$personal_care_table)
                                    <tr>
                                        <td style="text-align:center">{{$personal_care_table['product']}}</td>
                                        <td style="text-align:center">{{$personal_care_table['customer_place']}}</td>
                                        <td style="text-align:center">{{$personal_care_table['dealer_place']}}</td>
                                        <td style="text-align:center">{{$personal_care_table['service_center']}}</td>
                                    </tr>
                               @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                    <!-- Table Responsive END -->
                   
                </div>
            </div>
            @endif
            @endif
            <!-- personal care end -->
            @if($page->kitchen_appliances_table)
            <?php
                $kitchen_appliances_tables = json_decode($page->kitchen_appliances_table, true);
            ?>
            @if(!empty($kitchen_appliances_tables[0]['product']))
            <div class="service-details">
                <div class="service-details__title">
                   Kitchen Appliances
                </div>
                <div class="table-container">
                    <!-- Table Responsive -->
                    <div class="table-responsive">
                        <table class="table table-bordered data-list-table mb-0">
                            <thead class="table-head">
                                <tr>
                                    <th scope="col" style="text-align:center">Product</th>
                                    <th scope="col" style="text-align:center">Work at Customer Place <br/>(SAR)</th>
                                    <th scope="col" style="text-align:center">Work at Dealer Place <br/>(SAR)</th>
                                    <th scope="col" style="text-align:center">Work at Service Center <br/>(SAR)</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">
                                
                                @foreach($kitchen_appliances_tables as $keya=>$kitchen_appliances_table)
                                    <tr>
                                        <td style="text-align:center">{{$kitchen_appliances_table['product']}}</td>
                                        <td style="text-align:center">{{$kitchen_appliances_table['customer_place']}}</td>
                                        <td style="text-align:center">{{$kitchen_appliances_table['dealer_place']}}</td>
                                        <td style="text-align:center">{{$kitchen_appliances_table['service_center']}}</td>
                                    </tr>
                               @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                    <!-- Table Responsive END -->
                   
                </div>
            </div>
            @endif
            @endif
            @if($page->inspection_charge_table)
            <?php
                $inspection_charge_tables = json_decode($page->inspection_charge_table, true);
            ?>
            @if(!empty($inspection_charge_tables[0]['product']))
            <div class="service-details">
                <div class="service-details__title">
                   Visting/Inspection Charge
                </div>
                <div class="table-container">
                    <!-- Table Responsive -->
                    <div class="table-responsive">
                        <table class="table table-bordered data-list-table mb-0">
                            <thead class="table-head">
                                <tr>
                                    <th scope="col" style="text-align:center">Product</th>
                                    <th scope="col" style="text-align:center">Work at Customer Place <br/>(SAR)</th>
                                    <th scope="col" style="text-align:center">Work at Dealer Place <br/>(SAR)</th>
                                    <th scope="col" style="text-align:center">Work at Service Center <br/>(SAR)</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">
                                
                                @foreach($inspection_charge_tables as $keya=>$inspection_charge_table)
                                    <tr>
                                        <td style="text-align:center">{{$inspection_charge_table['product']}}</td>
                                        <td style="text-align:center">{{$inspection_charge_table['customer_place']}}</td>
                                        <td style="text-align:center">{{$inspection_charge_table['dealer_place']}}</td>
                                        <td style="text-align:center">{{$inspection_charge_table['service_center']}}</td>
                                    </tr>
                               @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                    <!-- Table Responsive END -->
                   
                </div>
            </div>
            @endif
            @endif
            @if($page->other_brand_table)
            <?php
                $other_brand_tables = json_decode($page->other_brand_table, true);
            ?>
            @if(!empty($other_brand_tables[0]['product']))
            <div class="service-details">
                <div class="service-details__title">
                  Other Brand
                </div>
                <div class="table-container">
                    <!-- Table Responsive -->
                    <div class="table-responsive">
                        <table class="table table-bordered data-list-table mb-0">
                            <thead class="table-head">
                                <tr>
                                    <th scope="col" style="text-align:center">Product</th>
                                    <th scope="col" style="text-align:center">Work at Customer Place <br/>(SAR)</th>
                                    <th scope="col" style="text-align:center">Work at Dealer Place <br/>(SAR)</th>
                                    <th scope="col" style="text-align:center">Work at Service Center <br/>(SAR)</th>
                                </tr>
                            </thead>
                            <tbody class="table-body">
                                
                                @foreach($other_brand_tables as $keya=>$other_brand_table)
                                    <tr>
                                        <td style="text-align:center">{{$other_brand_table['product']}}</td>
                                        <td style="text-align:center">{{$other_brand_table['customer_place']}}</td>
                                        <td style="text-align:center">{{$other_brand_table['dealer_place']}}</td>
                                        <td style="text-align:center">{{$other_brand_table['service_center']}}</td>
                                    </tr>
                               @endforeach
                               
                            </tbody>
                        </table>
                    </div>
                    <!-- Table Responsive END -->
                   
                </div>
            </div>
            @endif
            @endif
        </div>
    </div>

</main>

@stop


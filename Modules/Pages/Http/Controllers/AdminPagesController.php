<?php

namespace Modules\Pages\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\Pages\Entities\Settings;
use Modules\Pages\Entities\Pages;

use Session,Str;

class AdminPagesController extends Controller
{
    public function index()
    {
        return view('pages::admin.index');
    }

    public function list(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;

        $pages = Pages::where('id','>',0);
        if ($search != '') 
        {
            $pages->where('title', 'LIKE', '%'.$search.'%');
        }

        $total  = $pages->count();

        $result['data'] = $pages->take($request->length)->skip($request->start)->get();
        //dd($result['data']);
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }

    public function add()
    {
        return view('pages::admin.add');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'description' => 'required',
        ]);
        $industry = new Pages;
        $industry->title = $request->title;
        $industry->sub_title = $request->sub_title;
        $industry->description = $request->description;
        if($request->image)
        {
            $org_name         =   $request->file('image')->getClientOriginalName();
            $names                =   pathinfo($org_name, PATHINFO_FILENAME);
            $slug_name=Str::slug($names,'-');
            $certificateextension       =   $request->file('image')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $image_name = substr(str_shuffle($str_result), 0, 10);
            $imageToStore         =   $slug_name."-" . $image_name . '.' . $certificateextension;
            $request->file('image')->storeAs('page', $imageToStore);
            $industry->image  =   'page/'.$imageToStore;
        }
        if($request->mobile_image){
            $mobile_org_name         =   $request->file('mobile_image')->getClientOriginalName();
            $mobile_names                =   pathinfo($mobile_org_name, PATHINFO_FILENAME);
            $mobile_slug_name=Str::slug($mobile_names,'-');
            $mobile_extension       =   $request->file('mobile_image')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $mobile_image_name = substr(str_shuffle($str_result), 0, 10);
            $mobileToStore         =   $mobile_slug_name."-" . $mobile_image_name . '.' . $mobile_extension;
            $request->file('mobile_image')->storeAs('page', $mobileToStore);
            $industry->mobile_image  =   'page/'.$mobileToStore;
        }
        if($request->tablet_image){
            $tablet_org_name         =   $request->file('tablet_image')->getClientOriginalName();
            $tablet_names                =   pathinfo($tablet_org_name, PATHINFO_FILENAME);
            $tablet_slug_name=Str::slug($tablet_names,'-');
            $tablet_extension       =   $request->file('tablet_image')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $tablet_image_name = substr(str_shuffle($str_result), 0, 10);
            $tabletToStore         =   $tablet_slug_name."-" . $tablet_image_name . '.' . $tablet_extension;
            $request->file('tablet_image')->storeAs('page', $tabletToStore);
            $industry->tablet_image  =   'page/'.$tabletToStore;
        }  
        // if($request->file('image'))
        //     $industry->image = $request->image->store('page');
        // if($request->file('mobile_image'))
        //     $industry->mobile_image = $request->mobile_image->store('page');
        // if($request->file('tablet_image'))
        //     $industry->tablet_image = $request->tablet_image->store('page');
        
        $industry->status = $request->status;
        $industry->meta_title = $request->meta_title;
        $industry->meta_tags = $request->meta_tags;
        $industry->meta_description = $request->meta_description;
        $industry->generateSlug();
        $industry->save();

        Session::flash('message', 'Entry added successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/pages');

    }

    public function edit($id)
    {
        $page = Pages::find($id);
        return view('pages::admin.edit',compact('page'));
    }

    public function update(Request $request)
    {
        
        $industry                           = Pages::find($request->id);
        $industry->title                    = $request->title;
        $industry->sub_title = $request->sub_title;

        if($industry->slug=='service-policy-charges-1')
        {
            $industry->description          = $request->service_description;
            $ha_product                     =   $request->ha_product;
            $ha_customer_place              =   $request->ha_customer_place;
            $ha_dealer_place                =   $request->ha_dealer_place;
            $ha_service_center              =   $request->ha_service_center;
            $result                         =   array();
            if( $ha_product)
            {
                foreach ($ha_product as $id => $product) {
                    $result[] = array(
                        'product'               =>  $product,
                        'customer_place'        =>  $ha_customer_place[$id],
                        'dealer_place'          =>  $ha_dealer_place[$id],
                        'service_center'        =>  $ha_service_center[$id],
                    );
                }
                $ha_table                       =   json_encode($result);
                $industry->home_appilance_table	=   $ha_table;
    
            }
            $ac_products                 =   $request->ac_product;
            $ac_service                  =   $request->ac_service;
            $gas_charging                =   $request->gas_charging;
            $installation                =   $request->installation;
            $ac_result                   =   array();
            if( $ac_products)
            {
                foreach ($ac_products as $id => $ac_product) {
                    $ac_result[] = array(
                        'product'                   =>  $ac_product,
                        'ac_service'                  =>  $ac_service[$id],
                        'gas_charging'                  =>  $gas_charging[$id],
                        'installation'                   =>  $installation[$id],
                    );
                }
                $ac_table                   =   json_encode($ac_result);
                $industry->ac_table         =   $ac_table;
    
            }
            $entertaiment_product                     =   $request->entertaiment_product;
            $entertaiment_customer_place              =   $request->entertaiment_customer_place;
            $entertaiment_dealer_place                =   $request->entertaiment_dealer_place;
            $entertaiment_service_center              =   $request->entertaiment_service_center;
            $result_entertainment                         =   array();
            if( $ha_product)
            {
                foreach ($entertaiment_product as $Eid => $eproduct) {
                    $result_entertainment[] = array(
                        'product'               =>  $eproduct,
                        'customer_place'        =>  $entertaiment_customer_place[$Eid],
                        'dealer_place'          =>  $entertaiment_dealer_place[$Eid],
                        'service_center'        =>  $entertaiment_service_center[$Eid],
                    );
                }
                $entertainment_table            =   json_encode($result_entertainment);
                $industry->entertainment_table	=   $entertainment_table;
    
            }
            $lighting_product                     =   $request->lighting_product;
            $lighting_customer_place              =   $request->lighting_customer_place;
            $lighting_dealer_place                =   $request->lighting_dealer_place;
            $lighting_service_center              =   $request->lighting_service_center;
            $result_lighting                         =   array();
            if( $ha_product)
            {
                foreach ($lighting_product as $lid => $lproduct) {
                    $result_lighting[] = array(
                        'product'               =>  $lproduct,
                        'customer_place'        =>  $lighting_customer_place[$lid],
                        'dealer_place'          =>  $lighting_dealer_place[$lid],
                        'service_center'        =>  $lighting_service_center[$lid],
                    );
                }
                $lighting_table                 =   json_encode($result_lighting);
                $industry->lighting_table		=   $lighting_table;
            }

            $personal_care_product                     =   $request->personal_care_product;
            $personal_care_customer_place              =   $request->personal_care_customer_place;
            $personal_care_dealer_place                =   $request->personal_care_dealer_place;
            $personal_care_service_center              =   $request->personal_care_service_center;
            $result_personal_care                         =   array();
            if( $ha_product)
            {
                foreach ($personal_care_product as $pid => $pproduct) {
                    $result_personal_care[] = array(
                        'product'               =>  $pproduct,
                        'customer_place'        =>  $personal_care_customer_place[$pid],
                        'dealer_place'          =>  $personal_care_dealer_place[$pid],
                        'service_center'        =>  $personal_care_service_center[$pid],
                    );
                }
                $personal_care_table            =   json_encode($result_personal_care);
                $industry->personal_care_table	=   $personal_care_table;
    
            }
            $kitchen_appliances_product                     =   $request->kitchen_appliances_product;
            $kitchen_appliances_customer_place              =   $request->kitchen_appliances_customer_place;
            $kitchen_appliances_dealer_place                =   $request->kitchen_appliances_dealer_place;
            $kitchen_appliances_service_center              =   $request->kitchen_appliances_service_center;
            $result_kitchen_appliances                         =   array();
            if( $kitchen_appliances_product)
            {
                foreach ($kitchen_appliances_product as $kaid => $kaproduct) {
                    $result_kitchen_appliances[] = array(
                        'product'               =>  $kaproduct,
                        'customer_place'        =>  $kitchen_appliances_customer_place[$kaid],
                        'dealer_place'          =>  $kitchen_appliances_dealer_place[$kaid],
                        'service_center'        =>  $kitchen_appliances_service_center[$kaid],
                    );
                }
                $kitchen_appliances_table            =   json_encode($result_kitchen_appliances);
                $industry->kitchen_appliances_table	=   $kitchen_appliances_table;
    
            }
            $other_brand_products                     =   $request->other_brand_product;
            $other_brand_customer_place              =   $request->other_brand_customer_place;
            $other_brand_dealer_place                =   $request->other_brand_dealer_place;
            $other_brand_service_center              =   $request->other_brand_service_center;
            $result_other_brands                         =   array();
            if( $other_brand_products)
            {
                foreach ($other_brand_products as $obid => $obproduct) {
                    $result_other_brands[] = array(
                        'product'               =>  $obproduct,
                        'customer_place'        =>  $other_brand_customer_place[$obid],
                        'dealer_place'          =>  $other_brand_dealer_place[$obid],
                        'service_center'        =>  $other_brand_service_center[$obid],
                    );
                }
                $other_brand_table            =   json_encode($result_other_brands);
                $industry->other_brand_table	=   $other_brand_table;
            }
            $inspection_charge_product                     =   $request->inspection_charge_product;
            $inspection_charge_customer_place              =   $request->inspection_charge_customer_place;
            $inspection_charge_dealer_place                =   $request->inspection_charge_dealer_place;
            $inspection_charge_service_center              =   $request->inspection_charge_service_center;
            $result_inspection_charge                        =   array();
            if( $inspection_charge_product)
            {
                foreach ($inspection_charge_product as $icid => $ocproduct) {
                    $result_inspection_charge[] = array(
                        'product'               =>  $ocproduct,
                        'customer_place'        =>  $inspection_charge_customer_place[$icid],
                        'dealer_place'          =>  $inspection_charge_dealer_place[$icid],
                        'service_center'        =>  $inspection_charge_service_center[$icid],
                    );
                }
                $inspection_charge_table            =   json_encode($result_inspection_charge);
                $industry->inspection_charge_table	=   $inspection_charge_table;
            }
        }
        else if($industry->slug=='drop-point'){
            $request->validate([
                'description' => 'required',
                ]);
                $industry->description = $request->description;
            
            if($request->file('description_desktop_image_upload')){
                $desk_org_name         =   $request->file('description_desktop_image_upload')->getClientOriginalName();
                $desk_names                =   pathinfo($desk_org_name, PATHINFO_FILENAME);
                $desk_slug_name=Str::slug($desk_names,'-');
                $desk_extension       =   $request->file('description_desktop_image_upload')->getClientOriginalExtension();
                $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                $desk_image_name = substr(str_shuffle($str_result), 0, 10);
                $desk_imageToStore         =   $desk_slug_name."-" . $desk_image_name . '.' . $desk_extension;
                $request->file('description_desktop_image_upload')->storeAs('page', $desk_imageToStore);
                $industry->description_desktop_image_upload  =   'page/'.$desk_imageToStore;
                // $industry->description_desktop_image_upload = $request->description_desktop_image_upload->store('page');
            }
            if($request->file('description_mobile_image_upload')){
                $mob_org_name         =   $request->file('description_mobile_image_upload')->getClientOriginalName();
                $mob_names                =   pathinfo($mob_org_name, PATHINFO_FILENAME);
                $mob_slug_name=Str::slug($mob_names,'-');
                $mob_extension       =   $request->file('description_mobile_image_upload')->getClientOriginalExtension();
                $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                $mob_image_name = substr(str_shuffle($str_result), 0, 10);
                $mob_imageToStore         =   $mob_slug_name."-" . $mob_image_name . '.' . $mob_extension;
                $request->file('description_mobile_image_upload')->storeAs('page', $mob_imageToStore);
                $industry->description_mobile_image_upload  =   'page/'.$mob_imageToStore;
                // $industry->description_mobile_image_upload = $request->description_mobile_image_upload->store('page');
            }
            if($request->file('footer_desktop_image_upload')){
                $footer_org_name         =   $request->file('footer_desktop_image_upload')->getClientOriginalName();
                $footer_names                =   pathinfo($footer_org_name, PATHINFO_FILENAME);
                $footer_slug_name=Str::slug($footer_names,'-');
                $footer_extension       =   $request->file('footer_desktop_image_upload')->getClientOriginalExtension();
                $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                $footer_image_name = substr(str_shuffle($str_result), 0, 10);
                $footer_imageToStore         =   $footer_slug_name."-" . $footer_image_name . '.' . $footer_extension;
                $request->file('footer_desktop_image_upload')->storeAs('page', $footer_imageToStore);
                $industry->footer_desktop_image_upload  =   'page/'.$footer_imageToStore;
                // $industry->footer_desktop_image_upload = $request->footer_desktop_image_upload->store('page');
            }
            if($request->file('footer_mobile_image_upload')){
                $ft_mb_org_name         =   $request->file('footer_mobile_image_upload')->getClientOriginalName();
                $ft_mb_names                =   pathinfo($ft_mb_org_name, PATHINFO_FILENAME);
                $slug_name=Str::slug($ft_mb_names,'-');
                $ft_mb_extension       =   $request->file('footer_mobile_image_upload')->getClientOriginalExtension();
                $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                $ft_mb_image_name = substr(str_shuffle($str_result), 0, 10);
                $ft_mb_imageToStore         =   $ft_mb_slug_name."-" . $ft_mb_image_name . '.' . $ft_mb_extension;
                $request->file('footer_mobile_image_upload')->storeAs('page', $ft_mb_imageToStore);
                $industry->footer_mobile_image_upload  =   'page/'.$ft_mb_imageToStore;
                // $industry->footer_mobile_image_upload = $request->footer_mobile_image_upload->store('page');
            }
        
            $industry->footer_title = $request->footer_title;
            $industry->footer_description = $request->footer_description;
            $industry->sub_description = $request->sub_description;
            
        }
        else{
            
                $request->validate([
                'description' => 'required',
                ]);
                $industry->description = $request->description;
            
        }
        $industry->status = $request->status;
        if($request->image)
        {
            $org_name         =   $request->file('image')->getClientOriginalName();
            $names                =   pathinfo($org_name, PATHINFO_FILENAME);
            $slug_name=Str::slug($names,'-');
            $certificateextension       =   $request->file('image')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $image_name = substr(str_shuffle($str_result), 0, 10);
            $imageToStore         =   $slug_name."-" . $image_name . '.' . $certificateextension;
            $request->file('image')->storeAs('page', $imageToStore);
            $industry->image  =   'page/'.$imageToStore;
        }
        if($request->mobile_image){
            $mobile_org_name         =   $request->file('mobile_image')->getClientOriginalName();
            $mobile_names                =   pathinfo($mobile_org_name, PATHINFO_FILENAME);
            $mobile_slug_name=Str::slug($mobile_names,'-');
            $mobile_extension       =   $request->file('mobile_image')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $mobile_image_name = substr(str_shuffle($str_result), 0, 10);
            $mobileToStore         =   $mobile_slug_name."-" . $mobile_image_name . '.' . $mobile_extension;
            $request->file('mobile_image')->storeAs('page', $mobileToStore);
            $industry->mobile_image  =   'page/'.$mobileToStore;
        }
        if($request->tablet_image){
            $tablet_org_name         =   $request->file('tablet_image')->getClientOriginalName();
            $tablet_names                =   pathinfo($tablet_org_name, PATHINFO_FILENAME);
            $tablet_slug_name=Str::slug($tablet_names,'-');
            $tablet_extension       =   $request->file('tablet_image')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $tablet_image_name = substr(str_shuffle($str_result), 0, 10);
            $tabletToStore         =   $tablet_slug_name."-" . $tablet_image_name . '.' . $tablet_extension;
            $request->file('tablet_image')->storeAs('page', $tabletToStore);
            $industry->tablet_image  =   'page/'.$tabletToStore;
        }  
        // if($request->file('image'))
        //     $industry->image = $request->image->store('page');
        // if($request->file('mobile_image'))
        //     $industry->mobile_image = $request->mobile_image->store('page');
        // if($request->file('tablet_image'))
        //     $industry->tablet_image = $request->tablet_image->store('page');
        
            $industry->meta_title = $request->meta_title;
        $industry->meta_tags = $request->meta_tags;
        $industry->meta_description = $request->meta_description;
        $industry->update();

        Session::flash('message', 'Entry updated successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/pages');

    }
    public function servicePolicyEdit()
    {
        $page = Pages::where('slug','service-policy-charges-1')->first();
        // $page = Pages::find($id);
        return view('pages::admin.service-policy',compact('page'));
    }
    public function dropPointEdit()
    {
        $page = Pages::where('slug','drop-point')->first();
        return view('pages::admin.drop-point',compact('page'));
    }
}

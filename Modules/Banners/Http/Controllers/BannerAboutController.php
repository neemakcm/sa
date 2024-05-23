<?php

namespace Modules\Banners\Http\Controllers;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Banners\Entities\AboutBanner;
use Session,Image,Str;
class BannerAboutController extends Controller
{
    public function index()
    {
        return view('banners::about.index');
    }

    public function list(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;
        $banners = AboutBanner::where('id','>',0);
        if ($search != '') 
        {
            $banners->where('title', 'LIKE', '%'.$search.'%')->orwhere('name', 'LIKE', '%'.$search.'%');
        }
        $total  = $banners->count();
        $result['data'] = $banners->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;
        echo json_encode($result);
    }


    public function add()
    {
        return view('banners::about.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'title' => 'required',
        ]);
        $banner = new AboutBanner;
        $banner->title = $request->title;


        if($request->image)
        {
            $org_name         =   $request->file('image')->getClientOriginalName();
            $names                =   pathinfo($org_name, PATHINFO_FILENAME);
            $slug_name=Str::slug($names,'-');
            $certificateextension       =   $request->file('image')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $image_name = substr(str_shuffle($str_result), 0, 10);
            $imageToStore         =   $slug_name."-" . $image_name . '.' . $certificateextension;
            $request->file('image')->storeAs('about-banner', $imageToStore);
            $banner->image  =   'about-banner/'.$imageToStore;
        }
        if($request->mobile_image){
            $mobile_org_name         =   $request->file('mobile_image')->getClientOriginalName();
            $mobile_names                =   pathinfo($mobile_org_name, PATHINFO_FILENAME);
            $mobile_slug_name=Str::slug($mobile_names,'-');
            $mobile_extension       =   $request->file('mobile_image')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $mobile_image_name = substr(str_shuffle($str_result), 0, 10);
            $mobileToStore         =   $mobile_slug_name."-" . $mobile_image_name . '.' . $mobile_extension;
            $request->file('mobile_image')->storeAs('about-banner', $mobileToStore);
            $banner->mobile_image  =   'about-banner/'.$mobileToStore;
        }
        if($request->tablet_image){
            
            $tablet_org_name         =   $request->file('tablet_image')->getClientOriginalName();
            $tablet_names                =   pathinfo($tablet_org_name, PATHINFO_FILENAME);
            $tablet_slug_name=Str::slug($tablet_names,'-');
            $tablet_extension       =   $request->file('tablet_image')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $tablet_image_name = substr(str_shuffle($str_result), 0, 10);
            $tabletToStore         =   $tablet_slug_name."-" . $tablet_image_name . '.' . $mobile_extension;
            $request->file('tablet_image')->storeAs('about-banner', $tabletToStore);
            $banner->tablet_image  =   'about-banner/'.$tabletToStore;
        }  
        $banner->name = $request->name;
        $banner->status = $request->status;
        $banner->save();
        Session::flash('message', 'Entry added successfully' ); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/about/banners');
    }

    public function edit($id)
    {
        $banner = AboutBanner::find($id);
        return view('banners::about.edit',compact('banner'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);
        $banner = AboutBanner::find($request->id);
        $banner->title = $request->title;
        if($request->image)
        {
            $org_name         =   $request->file('image')->getClientOriginalName();
            $names                =   pathinfo($org_name, PATHINFO_FILENAME);
            $slug_name=Str::slug($names,'-');
            $certificateextension       =   $request->file('image')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $image_name = substr(str_shuffle($str_result), 0, 10);
            $imageToStore         =   $slug_name."-" . $image_name . '.' . $certificateextension;
            $request->file('image')->storeAs('about-banner', $imageToStore);
            $banner->image  =   'about-banner/'.$imageToStore;
        }
        if($request->mobile_image){
            $mobile_org_name         =   $request->file('mobile_image')->getClientOriginalName();
            $mobile_names                =   pathinfo($mobile_org_name, PATHINFO_FILENAME);
            $mobile_slug_name=Str::slug($mobile_names,'-');
            $mobile_extension       =   $request->file('mobile_image')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $mobile_image_name = substr(str_shuffle($str_result), 0, 10);
            $mobileToStore         =   $mobile_slug_name."-" . $mobile_image_name . '.' . $mobile_extension;
            $request->file('mobile_image')->storeAs('about-banner', $mobileToStore);
            $banner->mobile_image  =   'about-banner/'.$mobileToStore;
        }
        if($request->tablet_image){
            $tablet_org_name         =   $request->file('tablet_image')->getClientOriginalName();
            $tablet_names                =   pathinfo($tablet_org_name, PATHINFO_FILENAME);
            $tablet_slug_name=Str::slug($tablet_names,'-');
            $tablet_extension       =   $request->file('tablet_image')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $tablet_image_name = substr(str_shuffle($str_result), 0, 10);
            $tabletToStore         =   $tablet_slug_name."-" . $tablet_image_name . '.' . $tablet_extension;
            $request->file('tablet_image')->storeAs('about-banner', $tabletToStore);
            $banner->tablet_image  =   'about-banner/'.$tabletToStore;
        }  
        $banner->name = $request->name;
        $banner->status = $request->status;
        $banner->save();
        Session::flash('message', 'Entry updated successfully' ); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/about/banners');
    }

    public function delete($id)
    {
        $banner = AboutBanner::find($id);
        $banner->delete();

        Session::flash('message', 'Entry deleted successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/about/banners');
    }

}

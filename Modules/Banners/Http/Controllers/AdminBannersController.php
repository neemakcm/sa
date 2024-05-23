<?php

namespace Modules\Banners\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\Banners\Entities\Banners;
use Str;
use Session,Image;

class AdminBannersController extends Controller
{
    public function index()
    {
        return view('banners::admin.index');
    }

    public function list(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;

        $banners = Banners::where('id','>',0)->orderBy('prioritise','asc');

        if ($search != '')
        {
            $banners->where('title', 'LIKE', '%'.$search.'%');
        }

        $total  = $banners->count();

        $result['data'] = $banners->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }


    public function add()
    {
        return view('banners::admin.add');
    }

    public function store(Request $request)
    {
        // dd(1);
        $banner = new Banners;
        $banner->title = $request->title;
        $banner->type = $request->type;
        $banner->prioritise = $request->prioritise;

        $banner->title_color_code = $request->title_color_code;
        $banner->short_color_code = $request->short_color_code;
        $banner->description_color_code = $request->description_color_code;
        $banner->buy_now_bg_color_code = $request->buy_now_bg_color_code;
        $banner->buy_now_color_code = $request->buy_now_color_code;
        $banner->learn_more_bg_color = $request->learn_more_bg_color;
        $banner->learn_more_color_code = $request->learn_more_color_code;
        if($request->image)
        {
            // $files = $request->file('image'); // will get all files
            $org_name         =   $request->file('image')->getClientOriginalName();
            $names                =   pathinfo($org_name, PATHINFO_FILENAME);
            $slug_name=Str::slug($names,'-');
            $certificateextension       =   $request->file('image')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $image_name = substr(str_shuffle($str_result), 0, 10);
            $imageToStore         =   $slug_name."-" . $image_name . '.' . $certificateextension;
            $request->file('image')->storeAs('banners', $imageToStore);
            $banner->image  =   'banners/'.$imageToStore;
            // $banner->image = $request->file('image')->store('banners');
        }
        if($request->image_mobile){

            $mobile_org_name         =   $request->file('image_mobile')->getClientOriginalName();
            $mobile_names                =   pathinfo($mobile_org_name, PATHINFO_FILENAME);
            $mobile_slug_name=Str::slug($mobile_names,'-');
            $mobile_extension       =   $request->file('image_mobile')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $mobile_image_name = substr(str_shuffle($str_result), 0, 10);
            $mobileToStore         =   $mobile_slug_name."-" . $mobile_image_name . '.' . $mobile_extension;
            $request->file('image_mobile')->storeAs('banners', $mobileToStore);
            $banner->image_mobile  =   'banners/'.$mobileToStore;
            // $banner->image_mobile = $request->file('image_mobile')->store('banners');
        }
        if($request->video)
            $banner->video = $request->file('video')->store('banners');
        $banner->description = $request->description;
        $banner->short_description = $request->short_description;
        $banner->status = $request->status;
        $banner->position = $request->position;
        $banner->position_mobile = $request->position_mobile;
        $banner->buy_now = $request->buy_now;
        $banner->buy_now_title = $request->buy_now_title;
        $banner->learn_more_title = $request->learn_more_title;
        $banner->learn_more = $request->learn_more;
        $banner->save();


        Session::flash('message', 'Entry added successfully' );
        Session::flash('alert-class', 'alert-success');

        echo json_encode(array('status' => true));
    }

    public function edit($id)
    {
        $banner = Banners::find($id);

        return view('banners::admin.edit',compact('banner'));
    }

    public function update(Request $request)
    {


        $banner = Banners::find($request->id);
        $banner->title = $request->title;
        $banner->type = $request->type;
        $banner->prioritise = $request->prioritise;

        $banner->title_color_code = $request->title_color_code;
        $banner->short_color_code = $request->short_color_code;
        $banner->description_color_code = $request->description_color_code;
        $banner->buy_now_bg_color_code = $request->buy_now_bg_color_code;
        $banner->buy_now_color_code = $request->buy_now_color_code;
        $banner->learn_more_bg_color = $request->learn_more_bg_color;
        $banner->learn_more_color_code = $request->learn_more_color_code;

        // if($request->image){}
        //     $banner->image = $request->file('image')->store('banners');
        // if($request->image_mobile)
        //     // $banner->image_mobile = $request->file('image_mobile')->store('banners');



            if($request->image)
            {
                // $files = $request->file('image'); // will get all files
                $org_name         =   $request->file('image')->getClientOriginalName();
                $names                =   pathinfo($org_name, PATHINFO_FILENAME);
                $slug_name=Str::slug($names,'-');
                $certificateextension       =   $request->file('image')->getClientOriginalExtension();
                $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                $image_name = substr(str_shuffle($str_result), 0, 10);
                $imageToStore         =   $slug_name."-" . $image_name . '.' . $certificateextension;
                $request->file('image')->storeAs('banners', $imageToStore);
                $banner->image  =   'banners/'.$imageToStore;
                // $banner->image = $request->file('image')->store('banners');
            }
            if($request->image_mobile){

                $mobile_org_name         =   $request->file('image_mobile')->getClientOriginalName();
                $mobile_names                =   pathinfo($mobile_org_name, PATHINFO_FILENAME);
                $mobile_slug_name=Str::slug($mobile_names,'-');
                $mobile_extension       =   $request->file('image_mobile')->getClientOriginalExtension();
                $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                $mobile_image_name = substr(str_shuffle($str_result), 0, 10);
                $mobileToStore         =   $mobile_slug_name."-" . $mobile_image_name . '.' . $mobile_extension;
                $request->file('image_mobile')->storeAs('banners', $mobileToStore);
                $banner->image_mobile  =   'banners/'.$mobileToStore;
                // $banner->image_mobile = $request->file('image_mobile')->store('banners');
            }



        if($request->video)
            $banner->video = $request->file('video')->store('banners');
        $banner->description = $request->description;
        $banner->short_description = $request->short_description;
        $banner->status = $request->status;
        $banner->position = $request->position;
        $banner->position_mobile = $request->position_mobile;
        $banner->buy_now = $request->buy_now;
        $banner->learn_more = $request->learn_more;

        $banner->buy_now_title = $request->buy_now_title;
        $banner->learn_more_title = $request->learn_more_title;
        $banner->save();

        Session::flash('message', 'Entry updated successfully' );
        Session::flash('alert-class', 'alert-success');

        echo json_encode(array('status' => true));
    }

    public function delete($id)
    {
        $banner = Banners::find($id);
        $banner->delete();

        Session::flash('message', 'Entry deleted successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/banners');
    }
}

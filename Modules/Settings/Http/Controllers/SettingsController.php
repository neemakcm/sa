<?php

namespace Modules\Settings\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Settings\Entities\Settings;
use Modules\Categories\Entities\Categories;
use Modules\Settings\Entities\FooterLinks;
use Modules\Settings\Entities\FooterCategories;
use Str;

use Image , Session;
class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $settings= Settings::first();
        return view('settings::admin.add',compact('settings'));
    }

    public function store(Request $request)
    {
        // dd(1);
        $settings = Settings::first();
        if(empty($settings))
        {
            $settings = new Settings;
        }
        $settings->title = $request->title;
        $settings->facebook = $request->facebook;
        $settings->twitter = $request->twitter;
        $settings->email = $request->email;
        $settings->whatsapp = $request->whatsapp;
        $settings->mobile = $request->mobile;
        $settings->timing = $request->timing;
        $settings->linkedin = $request->linkedin;
        $settings->instagram = $request->instagram;
        $settings->youtube = $request->youtube;
        $settings->meta_title = $request->meta_title;
        $settings->meta_tag = $request->meta_tag;
        $settings->copyright = $request->copyright;
        $settings->notification = $request->notification;

        $settings->institution_dealership_email = $request->institution_dealership_email;
        $settings->dealer_email = $request->dealer_email;
        $settings->otheremail = $request->otheremail;

        $settings->product_register_mail = $request->product_register_mail;
        $settings->waranty_extension_mail = $request->waranty_extension_mail;
        $settings->product_feedback_mail = $request->product_feedback_mail;
        $settings->service_feedback_mail = $request->service_feedback_mail;
        $settings->escalate_to_service_mail = $request->escalate_to_service_mail;

        $settings->chat = $request->chat;
        $settings->address_1 = $request->address_1;
        $settings->address_2 = $request->address_2;
        $settings->meta_description = $request->meta_description;
        if($request->media)
        {
            $files = $request->file('media'); // will get all files
            $org_name         =   $request->file('media')->getClientOriginalName();
            $names                =   pathinfo($org_name, PATHINFO_FILENAME);
            $slug_name=Str::slug($names,'-');
            $certificateextension       =   $request->file('media')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $image_name = substr(str_shuffle($str_result), 0, 10);
            $imageToStore         =   $slug_name."-" . $image_name . '.' . $certificateextension;
            $request->file('media')->storeAs('media', $imageToStore);
            $settings->logo  =   'media/'.$imageToStore;
            // $settings->logo = $request->file('media')->store('logo');
        }
        if($request->fav_icon)
        {
            // $files = $request->file('fav_icon'); // will get all files
            $fav_org_name         =   $request->file('fav_icon')->getClientOriginalName();
            $fav_names                =   pathinfo($fav_org_name, PATHINFO_FILENAME);
            $fav_slug_name=Str::slug($fav_names,'-');
            $favextension       =   $request->file('fav_icon')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $fav_image_name = substr(str_shuffle($str_result), 0, 10);
            $fav_imageToStore         =   $fav_slug_name."-" . $fav_image_name . '.' . $favextension;
            $request->file('fav_icon')->storeAs('fav_icon', $fav_imageToStore);
            $settings->fav_icon  =   'fav_icon/'.$fav_imageToStore;
            // $settings->fav_icon = $request->file('fav_icon')->store('fav_icon');
        }
        $settings->save();
        if($request->media)
        {
            Image::make(storage_path('app/' . $settings->logo))
            ->resize(87, 63)
            ->save(storage_path('app/' . $settings->logo));
        }
        if($request->fav_icon)
        {
            Image::make(storage_path('app/' . $settings->fav_icon))
            ->resize(87, 63)
            ->save(storage_path('app/' . $settings->fav_icon));
        }
        Session::flash('message', 'Entry updated successfully' );
        Session::flash('alert-class', 'alert-success');
        return redirect('admin/settings');
    }


    public function footerIndex()
    {
        return view('settings::footer.index');
    }

    public function footerList(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;
        $type     = $request->type;
        $floor     = $request->floor;

        $plan = FooterLinks::where('id','>',0);

        if ($search != '')
        {
            $plan->where('title',$search)
                ->orWhere('link',$search);
        }

        $total  = $plan->count();

        $result['data'] = $plan->orderBy('created_at','desc')->take($request->length)->skip($request->start)->get();

        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }

    public function footerAdd()
    {
        return view('settings::footer.add');
    }

    public function footerStore(Request $request)
    {
        $footer = new FooterLinks;
        $footer->title = $request->title;
        $footer->link = $request->link;
        $footer->type = $request->type;
        $footer->save();

        Session::flash('message', 'Entry added successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/footerSettings');
    }

    public function footerEdit($id)
    {
        $footer = FooterLinks::find($id);

        return view('settings::footer.edit',compact('footer'));
    }

    public function footerUpdate(Request $request)
    {
        $footer = FooterLinks::find($request->id);
        $footer->title = $request->title;
        $footer->link = $request->link;
        $footer->type = $request->type;
        $footer->save();

        Session::flash('message', 'Entry updated successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/footerSettings');
    }

    public function footerDelete($id)
    {
        $footer = FooterLinks::find($id);
        $footer->delete();

        Session::flash('message', 'Entry deleted successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/footerSettings');
    }
    //Footer Categoty

    public function footerCategoryIndex()
    {
        return view('settings::footer.category.index');
    }

    public function footerCategoryList(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;
        $type     = $request->type;
        $floor     = $request->floor;

        $plan = FooterCategories::with('category')->where('id','>',0);

        // if ($search != '')
        // {
        //     $plan->where('title',$search)
        //         ->orWhere('link',$search);
        // }

        $total  = $plan->count();

        $result['data'] = $plan->orderBy('created_at','desc')->take($request->length)->skip($request->start)->get();

        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;
// dd($result['data'] );
        echo json_encode($result);
    }

    public function footerCategoryAdd()
    {
        $categories=(new Categories())->listFirstChildCategories();
        return view('settings::footer.category.add',compact('categories'));
    }

    public function footerCategoryStore(Request $request)
    {

        $position = FooterCategories::where('position',$request->position)->first();
        if($position != null)
        {
            return redirect()->back()->withInput($request->input())->with('message_duplicate', 'Position already fixed.');
        }
        $footer = new FooterCategories;
        $footer->category_id = $request->category_id;
        $footer->position = $request->position;
        $footer->save();

        Session::flash('message', 'Entry added successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/footerCategorySettings');
    }

    public function footerCategoryEdit($id)
    {

        $footer = FooterCategories::find($id);
        $categories=(new Categories())->categoryDetail($footer->category_id);
        return view('settings::footer.category.edit',compact('footer','categories'));
    }

    public function footerCategoryUpdate(Request $request)
    {
        // dd($request->category_id);
        $position = FooterCategories::where('category_id','!=',5)->where('position',$request->position)->first();
        if($position != null)
        {
            return redirect()->back()->withInput($request->input())->with('message_duplicate', 'Position already fixed.');
        }
        $footer = FooterCategories::find($request->id);
        $footer->category_id = $request->category_id;
        $footer->position = $request->position;
        $footer->save();

        Session::flash('message', 'Entry updated successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/footerCategorySettings');
    }

    public function footerCategoryDelete($id)
    {
        $footer = FooterCategories::find($id);
        $footer->delete();

        Session::flash('message', 'Entry deleted successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/footerCategorySettings');
    }
}

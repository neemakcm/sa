<?php

namespace Modules\Categories\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\Attributes\Entities\Attributes;
use Modules\Categories\Entities\Categories;
use Modules\Categories\Entities\CategoryAttributes;
use Str;
use Session,DB;

class AdminCategoriesController extends Controller
{
    public function index()
    {
        return view('categories::admin.index');
    }

    public function list(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;

        $category = Categories::with(['products' => function($q) {
                                        $q->whereIn('type',array(0,1));
                                    }])->with('parent','children','category_attributes');

        if ($search != '')
        {
            $category->where('name', 'LIKE', '%'.$search.'%');
            $category->orWhere('sub_title', 'LIKE', '%'.$search.'%');
        }

        $total  = $category->count();

        $result['data'] = $category->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }


    public function add()
    {
        $parents = Categories::where('is_last_child',0)->where('status',1)->get();

        return view('categories::admin.add',compact('parents'));
    }

    public function store(Request $request)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $exist = Categories::where('name',$request->name)->where('parent_id',$request->parent_id)->first();

        if($exist != null)
        {
            return redirect()->back()->withInput($request->input())->with('duplicate_message', 'Category already exist under same parent');
        }

        // $exist = Categories::where('sort_oder',$request->sort_oder)->where('parent_id',$request->parent_id)->first();

        // if($exist != null)
        // {
        //     return redirect()->back()->withInput($request->input())->with('duplicate_position', 'Position already set for '.$exist->name);
        // }

        $category = new Categories;
        $category->name = $request->name;
        $category->sub_title = $request->sub_title;
        $category->parent_id = $request->parent_id;
        $category->is_last_child = $request->is_last_child;


        $category->main_title_color = $request->title_color_code;
        $category->main_title_size = $request->title_font_size;
        $category->sub_title_color = $request->sub_title_color_code;
        $category->sub_title_size = $request->sub_title_font_size;
        $category->short_description_color = $request->description_color_code;
        $category->short_description_size = $request->description_font_size;

        $category->learn_more_bg_color = $request->learn_more_bg_color;
        $category->learn_more_color_code = $request->learn_more_color_code;

        if($request->icon){
            $org_name         =   $request->file('icon')->getClientOriginalName();
            $names                =   pathinfo($org_name, PATHINFO_FILENAME);
            $slug_name=Str::slug($names,'-');
            $certificateextension       =   $request->file('icon')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $image_name = substr(str_shuffle($str_result), 0, 10);
            $imageToStore         =   $slug_name."-" . $image_name . '.' . $certificateextension;
            $request->file('icon')->storeAs('categories', $imageToStore);
            $category->icon  =   'categories/'.$imageToStore;
            // $category->icon = $request->file('icon')->store('categories');
        }
        else{
            $category->icon = '';
        }
        if($request->mobile_image){
            $mobile_org_name         =   $request->file('mobile_image')->getClientOriginalName();
            $mobile_names                =   pathinfo($mobile_org_name, PATHINFO_FILENAME);
            $mobile_slug_name=Str::slug($mobile_names,'-');
            $mobile_extension       =   $request->file('mobile_image')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $mobile_image_name = substr(str_shuffle($str_result), 0, 10);
            $mobileToStore         =   $mobile_slug_name."-" . $mobile_image_name . '.' . $mobile_extension;
            $request->file('mobile_image')->storeAs('categories', $mobileToStore);
            $category->mobile_image  =   'categories/'.$mobileToStore;
            // $category->mobile_image = $request->file('mobile_image')->store('categories');
        }
        else{
            $category->mobile_image = '';
        }
        $category->status = $request->status;
        $category->sort_oder = $request->sort_oder;
        $category->meta_title = $request->meta_title;
        $category->meta_tags = $request->meta_tags;
        $category->meta_description = $request->meta_description;

        if($request->desktop_banner){
            $desktop_org_name         =   $request->file('desktop_banner')->getClientOriginalName();
            $desktop_names                =   pathinfo($desktop_org_name, PATHINFO_FILENAME);
            $desktop_slug_name=Str::slug($desktop_names,'-');
            $desktop_extension       =   $request->file('desktop_banner')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $desktop_image_name = substr(str_shuffle($str_result), 0, 10);
            $desktopToStore         =   $desktop_slug_name."-" . $desktop_image_name . '.' . $desktop_extension;
            $request->file('desktop_banner')->storeAs('categories', $desktopToStore);
            $category->desktop_banner  =   'categories/'.$desktopToStore;
        }
            // $category->desktop_banner = $request->file('desktop_banner')->store('categories');
        if($request->mobile_banner){
            $mobile_banner_org_name         =   $request->file('mobile_banner')->getClientOriginalName();
            $mobile_banner_names                =   pathinfo($mobile_banner_org_name, PATHINFO_FILENAME);
            $mobile_banner_slug_name=Str::slug($mobile_banner_names,'-');
            $mobile_banner_extension       =   $request->file('mobile_banner')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $mobile_banner_image_name = substr(str_shuffle($str_result), 0, 10);
            $mobileBAnnerToStore         =   $mobile_banner_slug_name."-" . $mobile_banner_image_name . '.' . $mobile_banner_extension;
            $request->file('mobile_banner')->storeAs('categories', $mobileBAnnerToStore);
            $category->mobile_banner  =   'categories/'.$mobileBAnnerToStore;
        }
            // $category->mobile_banner = $request->file('mobile_banner')->store('categories');
        $category->banner_main_title = $request->banner_main_title;
        $category->banner_sub_title = $request->banner_sub_title;
        $category->banner_small_description = $request->banner_small_description;
        $category->banner_link = $request->banner_link;
        $category->generateSlug();
        $category->save();

        Categories::createThumbnail($category);

        Session::flash('message', 'Entry added successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/categories');
    }

    public function edit($id)
    {
        $category = Categories::find($id);
        $parents = Categories::where('is_last_child',0)->get();

        return view('categories::admin.edit',compact('category','parents'));
    }

    public function update(Request $request)
    {
        $exist = Categories::where('name',$request->name)->where('parent_id',$request->parent_id)->where('id','!=',$request->id)->first();

        if($exist != null)
        {
            return redirect()->back()->withInput($request->input())->with('duplicate_message', 'Category already exist under same parent');
        }

        // $exist = Categories::where('sort_oder',$request->sort_oder)->where('parent_id',$request->parent_id)->where('id','!=',$request->id)->first();

        // if($exist != null)
        // {
        //     return redirect()->back()->withInput($request->input())->with('duplicate_position', 'Position already set for '.$exist->name);
        // }

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $category = Categories::find($request->id);
        $category->name = $request->name;
        $category->sub_title = $request->sub_title;
        $category->parent_id = $request->parent_id;
        $category->is_last_child = $request->is_last_child;
        // if($request->icon)
        //     $category->icon = $request->file('icon')->store('categories');
        // if($request->mobile_image)
        //     $category->mobile_image = $request->file('mobile_image')->store('categories');

        if($request->icon){
            $org_name         =   $request->file('icon')->getClientOriginalName();
            $names                =   pathinfo($org_name, PATHINFO_FILENAME);
            $slug_name=Str::slug($names,'-');
            $certificateextension       =   $request->file('icon')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $image_name = substr(str_shuffle($str_result), 0, 10);
            $imageToStore         =   $slug_name."-" . $image_name . '.' . $certificateextension;
            $request->file('icon')->storeAs('categories', $imageToStore);
            $category->icon  =   'categories/'.$imageToStore;
            // $category->icon = $request->file('icon')->store('categories');
        }
        else{
            $category->icon = '';
        }
        if($request->mobile_image){
            $mobile_org_name         =   $request->file('mobile_image')->getClientOriginalName();
            $mobile_names                =   pathinfo($mobile_org_name, PATHINFO_FILENAME);
            $mobile_slug_name=Str::slug($mobile_names,'-');
            $mobile_extension       =   $request->file('mobile_image')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $mobile_image_name = substr(str_shuffle($str_result), 0, 10);
            $mobileToStore         =   $mobile_slug_name."-" . $mobile_image_name . '.' . $mobile_extension;
            $request->file('mobile_image')->storeAs('categories', $mobileToStore);
            $category->mobile_image  =   'categories/'.$mobileToStore;
            // $category->mobile_image = $request->file('mobile_image')->store('categories');
        }
        else{
            $category->mobile_image = '';
        }

            $category->status = $request->status;
        $category->sort_oder = $request->sort_oder;
        $category->meta_title = $request->meta_title;
        $category->meta_tags = $request->meta_tags;
        $category->meta_description = $request->meta_description;
        if($request->desktop_banner){
            $desktop_org_name         =   $request->file('desktop_banner')->getClientOriginalName();
            $desktop_names                =   pathinfo($desktop_org_name, PATHINFO_FILENAME);
            $desktop_slug_name=Str::slug($desktop_names,'-');
            $desktop_extension       =   $request->file('desktop_banner')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $desktop_image_name = substr(str_shuffle($str_result), 0, 10);
            $desktopToStore         =   $desktop_slug_name."-" . $desktop_image_name . '.' . $desktop_extension;
            $request->file('desktop_banner')->storeAs('categories', $desktopToStore);
            $category->desktop_banner  =   'categories/'.$desktopToStore;
        }
            // $category->desktop_banner = $request->file('desktop_banner')->store('categories');
        if($request->mobile_banner){
            $mobile_banner_org_name         =   $request->file('mobile_banner')->getClientOriginalName();
            $mobile_banner_names                =   pathinfo($mobile_banner_org_name, PATHINFO_FILENAME);
            $mobile_banner_slug_name=Str::slug($mobile_banner_names,'-');
            $mobile_banner_extension       =   $request->file('mobile_banner')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $mobile_banner_image_name = substr(str_shuffle($str_result), 0, 10);
            $mobileBAnnerToStore         =   $mobile_banner_slug_name."-" . $mobile_banner_image_name . '.' . $mobile_banner_extension;
            $request->file('mobile_banner')->storeAs('categories', $mobileBAnnerToStore);
            $category->mobile_banner  =   'categories/'.$mobileBAnnerToStore;
        }
        // if($request->desktop_banner)
        //     $category->desktop_banner = $request->file('desktop_banner')->store('categories');
        // if($request->mobile_banner)
        //     $category->mobile_banner = $request->file('mobile_banner')->store('categories');

        $category->banner_main_title = $request->banner_main_title;
        $category->banner_sub_title = $request->banner_sub_title;
        $category->banner_small_description = $request->banner_small_description;
        $category->banner_link = $request->banner_link;
        $category->main_title_color = $request->title_color_code;
        $category->main_title_size = $request->title_font_size;
        $category->sub_title_color = $request->sub_title_color_code;
        $category->sub_title_size = $request->sub_title_font_size;
        $category->short_description_color = $request->description_color_code;
        $category->short_description_size = $request->description_font_size;

        $category->learn_more_bg_color = $request->learn_more_bg_color;
        $category->learn_more_color_code = $request->learn_more_color_code;

        $category->generateSlug();
        $category->save();

        Categories::createThumbnail($category);

        Session::flash('message', 'Entry updated successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/categories');
    }

    public function delete($id)
    {
        $category = Categories::find($id);
        $category->delete();

        Session::flash('message', 'Entry deleted successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/categories');
    }

    public function attributesIndex($id)
    {
        return view('categories::admin.attributesIndex',compact('id'));
    }

    public function attributesList(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;
        $category = $request->category;

        $category = CategoryAttributes::with('attribute','category.products')->where('category_id',$category);

        if ($search != '')
        {
            $category->whereHas('attribute', function($q) use($search)
                    {
                        $q->where('name', 'LIKE', '%'.$search.'%');
                    });
        }

        $total  = $category->count();

        $result['data'] = $category->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }


    public function attributesAdd($id)
    {
        $category_attributes = CategoryAttributes::where('category_id',$id)->get();
        $category_attributes = $category_attributes->count() == 0?array():$category_attributes->pluck('attribute_id')->toArray();

        $attributes = Attributes::whereNotIn('id',$category_attributes)->get();

        return view('categories::admin.attributesAdd',compact('attributes','id'));
    }

    public function attributesStore(Request $request)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        if($request->is_varient == 1)
        {
            $varient = CategoryAttributes::where('category_id',$request->category_id)->where('is_varient',1)->first();

            if($varient != null)
            {
                return redirect()->back()->withInput($request->input())->with('message_duplicate', 'Varient already fixed.');
            }
        }

        $category = new CategoryAttributes;
        $category->category_id = $request->category_id;
        $category->attribute_id = $request->attribute_id;
        $category->is_varient = $request->is_varient;
        $category->save();


        Session::flash('message', 'Entry added successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/categories/attributes/'.$request->category_id);
    }

    public function attributesDelete($id)
    {
        $category = CategoryAttributes::find($id);
        $category_id = $category->category_id;
        $category->delete();

        Session::flash('message', 'Entry deleted successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/categories/attributes/'.$category_id);
    }
}

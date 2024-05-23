<?php

namespace Modules\Pages\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\Pages\Entities\HomeDesign;
use Modules\Pages\Entities\HomeDesignSubcategory;
use Modules\Products\Entities\Products;
use Modules\Categories\Entities\Categories;
use Str;
use Session;

class AdminHomeDesignController extends Controller
{
    public function index()
    {
        return view('pages::home.index');
    }

    public function list($id)
    {
        $count = HomeDesign::where('type',$id)->has('categories')->count();

        return view('pages::home.list',compact('id','count'));
    }

    public function detailList(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;
        $type     = $request->type;
        $floor     = $request->floor;

        $plan = HomeDesign::with('products','categories')->where('type',$request->type);

        if($request->type == 1 || $request->type == 5)
        {
            $plan->has('categories');
            if ($search != '')
            {
                $plan->whereHas('categories', function($q) use ($search) {
                            $q->where('name', 'LIKE', '%'.$search.'%');
                        })
                    ->orWhere('position',$search);
            }
        }
        else
        {
            $plan->has('products');
            if ($search != '')
            {
                $plan->whereHas('products', function($q) use ($search) {
                            $q->where('name', 'LIKE', '%'.$search.'%');
                        })
                    ->orWhere('position',$search);
            }
        }



        $total  = $plan->count();

        $result['data'] = $plan->orderBy('created_at','desc')->take($request->length)->skip($request->start)->get();

        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }

    public function add($id)
    {
        $products = Products::whereIn('type',array(0,2))->where('is_active',1)->get();
        $available = HomeDesign::where('type',$id)->groupBy('product_id')->get()->pluck('product_id')->toArray();
        $categories = Categories::with('children')->whereNotIn('id',$available)->get();

        return view('pages::home.add',compact('id','products','categories'));
    }

    public function store(Request $request)
    {
        if($request->type == 4)
        {
            $product = Products::with('category.parent')->find($request->product_id);
            $category = $product->category->parent->parent_id == 0? $product->category->id:$product->category->parent->id;
            $all_categories = Categories::where('parent_id',$category);
            $all_categories = $all_categories->pluck('id')->toArray();
            array_push($all_categories, $category);

            $category_products = Products::whereIn('category_id',$all_categories)->get();
            $category_products = $category_products->count() == 0?array():$category_products->pluck('id')->toArray();

            $position = HomeDesign::where('type',$request->type)->where('position',$request->position)->whereIn('product_id',$category_products)->first();

            if($position != null)
            {
                return redirect()->back()->withInput($request->input())->with('message_duplicate', 'Position already fixed.');
            }
        }
        else
        {
            $position = HomeDesign::where('type',$request->type)->where('position',$request->position)->first();

            if($position != null)
            {
                return redirect()->back()->withInput($request->input())->with('message_duplicate', 'Position already fixed.');
            }
        }

        $design = new HomeDesign;
        $design->type = $request->type;
        $design->product_id = $request->product_id;
        $design->position = $request->position;
        $design->learn_more = $request->learn_more;
        if($request->type == 1 || $request->type == 2 || $request->type == 3 || $request->type == 6)
        {
            $files = $request->file('image'); // will get all files
            $org_name         =   $request->file('image')->getClientOriginalName();
            $names                =   pathinfo($org_name, PATHINFO_FILENAME);
            $slug_name=Str::slug($names,'-');
            $certificateextension       =   $request->file('image')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $image_name = substr(str_shuffle($str_result), 0, 10);
            $imageToStore         =   $slug_name."-" . $image_name . '.' . $certificateextension;
            $request->file('image')->storeAs('home_page', $imageToStore);
            $design->image  =   'home_page/'.$imageToStore;
            // $design->image = $request->file('image')->store('home_page');
            $design->description = $request->description;
        }
        if($request->type == 1)
        {

        $design->buy_now_title = $request->buy_now_title;
        $design->learn_more_title = $request->learn_more_title;
            if($request->category_color_code)
                $design->category_color_code = $request->category_color_code;
            if($request->category_font_size)
                $design->category_font_size = $request->category_font_size;
            if($request->learn_more_bg_color)
                $design->learn_more_bg_color = $request->learn_more_bg_color;
            if($request->learn_more_color_code)
                $design->learn_more_color_code = $request->learn_more_color_code;
            if($request->description_font_size)
                $design->description_font_size = $request->description_font_size;
            if($request->description_color_code)
                $design->description_color_code = $request->description_color_code;
            if($request->buy_now_bg_color_code)
                $design->buy_now_bg_color_code = $request->buy_now_bg_color_code;
            if($request->buy_now_color_code)
                $design->buy_now_color_code = $request->buy_now_color_code;

        }

        $design->save();

        if($request->type == 5)
        {
            $link=$request->learn_more_link;
            $subcategories=$request->sub_category;

            $category_color_code = $request->category_color_code;
            $category_font_size = $request->category_font_size;
            $learn_more_bg_color = $request->learn_more_bg_color;
            $learn_more_color_code = $request->learn_more_color_code;
            $buy_now_bg_color_code = $request->buy_now_bg_color_code;
            $buy_now_color_code = $request->buy_now_color_code;
            $result= array();
            if($subcategories)
            {
                foreach ($subcategories as $key => $subcategory)
                {
                    $sub = new HomeDesignSubcategory;
                    $sub->home_design_id = $design->id;
                    $sub->sub_category_id = $subcategory;
                    $sub->online_link = $link[$key];
                    $sub->category_color_code = $category_color_code[$key];
                    $sub->category_font_size = $category_font_size[$key];
                    $sub->learn_more_bg_color = $learn_more_bg_color[$key];
                    $sub->learn_more_color_code = $learn_more_color_code[$key];
                    $sub->buy_now_bg_color_code = $buy_now_bg_color_code[$key];
                    $sub->buy_now_color_code = $buy_now_color_code[$key];
                    $sub->save();
                }
            }
            //
            // if(isset($online_link) && $online_link != '')
            // {
            //     foreach($online_link as $key => $link)
            //     {
            //         $sub = new HomeDesignSubcategory;
            //         $sub->home_design_id = $design->id;
            //         $sub->sub_category_id = $key;
            //         $sub->online_link = $link;
            //         $sub->save();
            //     }
            // }

        }

        if($request->type == 2 || $request->type == 3 || $request->type == 6)
        {
            HomeDesign::createThumbnail($design);
        }

        Session::flash('message', 'Entry added successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/homePage/list/'.$request->type);
    }

    public function edit($id)
    {
        $categories = Categories::all();
        $design = HomeDesign::find($id);
        $products = Products::whereIn('type',array(0,2))->where('is_active',1)->get();

        return view('pages::home.edit',compact('id','design','categories','products'));
    }

    public function update(Request $request)
    {
        $design = HomeDesign::find($request->id);

        if($design->type == 4)
        {
            $product = Products::with('category.parent')->find($request->product_id);
            $category = $product->category->parent->parent_id == 0? $product->category->id:$product->category->parent->id;
            $all_categories = Categories::where('parent_id',$category);
            $all_categories = $all_categories->pluck('id')->toArray();
            array_push($all_categories, $category);

            $category_products = Products::whereIn('category_id',$all_categories)->get();
            $category_products = $category_products->count() == 0?array():$category_products->pluck('id')->toArray();
            if (($key = array_search($request->product_id, $category_products)) !== false) {
                unset($category_products[$key]);
            }

            $position = HomeDesign::where('type',$design->type)->where('position',$request->position)->whereIn('product_id',$category_products)->first();

            if($position != null)
            {
                return redirect()->back()->withInput($request->input())->with('message_duplicate', 'Position already fixed.');
            }
        }
        else
        {
            // $position = HomeDesign::where('type',$design->type)->where('position',$request->position)->where('product_id','!=',$request->product_id)->first();

            // if($position != null)
            // {
            //     return redirect()->back()->withInput($request->input())->with('message_duplicate', 'Position already fixed.');
            // }
            $position = HomeDesign::where('type',$design->type)->where('position',$request->position)->first();
            if($position != null)
            {
                $category = HomeDesign::where('type',$design->type)->where('product_id',$request->product_id)->first();
                if($category != null){
                     if($request->id != $category->id){
                    return redirect()->back()->withInput($request->input())->with('message_duplicate_category', 'Category already Taken.');
                     }
                }
                if($position->id !=$request->id)
                {
                    return redirect()->back()->withInput($request->input())->with('message_duplicate', 'Position already fixed.');
                }


            }
        }

        $design->product_id = $request->product_id;
        $design->learn_more = $request->learn_more;
// dd($request->category_color_code);
        $design->buy_now_title = $request->buy_now_title;
        $design->learn_more_title = $request->learn_more_title;

    // if($request->category_color_code)
    //     $design->category_color_code = $request->category_color_code;
    // if($request->category_font_size)
    //     $design->category_font_size = $request->category_font_size;
    // if($request->learn_more_bg_color)
    //     $design->learn_more_bg_color = $request->learn_more_bg_color;
    // if($request->learn_more_color_code)
    //     $design->learn_more_color_code = $request->learn_more_color_code;
    // if($request->description_font_size)
    //     $design->description_font_size = $request->description_font_size;
    // if($request->description_color_code)
    //     $design->description_color_code = $request->description_color_code;
    // if($request->buy_now_bg_color_code)
    //     $design->buy_now_bg_color_code = $request->buy_now_bg_color_code;
    // if($request->buy_now_color_code)
    //     $design->buy_now_color_code = $request->buy_now_color_code;
if($request->category_color_code)
        $design->category_color_code = $request->category_color_code;
    else
        $design->category_color_code ="";
    if($request->category_font_size)
        $design->category_font_size = $request->category_font_size;
    else
        $design->category_font_size ="";
    if($request->learn_more_bg_color)
        $design->learn_more_bg_color = $request->learn_more_bg_color;
    else
        $design->learn_more_bg_color = "";
    if($request->learn_more_color_code)
        $design->learn_more_color_code = $request->learn_more_color_code;
    else
        $design->learn_more_color_code = "";
    if($request->description_font_size)
        $design->description_font_size = $request->description_font_size;
    else
        $design->description_font_size = "";
    if($request->description_color_code)
        $design->description_color_code = $request->description_color_code;
    else
        $design->description_color_code = "";
    if($request->buy_now_bg_color_code)
        $design->buy_now_bg_color_code = $request->buy_now_bg_color_code;
    else
        $design->buy_now_bg_color_code = "";
    if($request->buy_now_color_code)
        $design->buy_now_color_code = $request->buy_now_color_code;
    else
        $design->buy_now_color_code = "";

        if($request->image){
            $files = $request->file('image'); // will get all files
            $org_name         =   $request->file('image')->getClientOriginalName();
            $names                =   pathinfo($org_name, PATHINFO_FILENAME);
            $slug_name=Str::slug($names,'-');
            $certificateextension       =   $request->file('image')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $image_name = substr(str_shuffle($str_result), 0, 10);
            $imageToStore         =   $slug_name."-" . $image_name . '.' . $certificateextension;
            $request->file('image')->storeAs('home_page', $imageToStore);
            $design->image  =   'home_page/'.$imageToStore;
        }
            // $design->image = $request->file('image')->store('home_page');
        if($request->image_mobile){
            $mobile_org_name         =   $request->file('image_mobile')->getClientOriginalName();
            $mobile_names                =   pathinfo($mobile_org_name, PATHINFO_FILENAME);
            $mobile_slug_name=Str::slug($mobile_names,'-');
            $mobile_extension       =   $request->file('image_mobile')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $mobile_image_name = substr(str_shuffle($str_result), 0, 10);
            $mobileToStore         =   $mobile_slug_name."-" . $mobile_image_name . '.' . $mobile_extension;
            $request->file('image_mobile')->storeAs('mobile_home_page', $mobileToStore);
            $design->mobile_image  =   'mobile_home_page/'.$mobileToStore;
        }
            // $design->mobile_image = $request->file('image_mobile')->store('mobile_home_page');
        $design->description = $request->description;
        $design->position = $request->position;
        $design->save();

        if($design->type == 2 || $design->type == 3 || $design->type == 6)
        {
            HomeDesign::createThumbnail($design);
        }

        Session::flash('message', 'Entry updated successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/homePage/list/'.$design->type);
    }

    public function delete($id)
    {
        $design = HomeDesign::find($id);
        $sub =  HomeDesignSubcategory::where('home_design_id',$id)->delete();
        $type = $design->type;
        $design->delete();

        Session::flash('message', 'Entry deleted successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/homePage/list/'.$design->type);
    }
    public function productCategory(Request $request)
    {
        $subcategory= Categories::with('children.children')->where('parent_id',$request->id)->get();
        echo json_encode($subcategory);
    }
    public function subCategoryList(Request $request)
    {
        $design = HomeDesign::find($request->id);
        $type=$design->type;
        $sub =  HomeDesignSubcategory::with('categories')->where('home_design_id',$request->id)->withTrashed()->get();
        return view('pages::home.sub-category-list',['subcategories'=> $sub,'type'=>$type]);
    }
    public function deleteCategory($id)
    {
        $design = HomeDesignSubcategory::find($id);
        // $design->home_design_id
        $sub =  HomeDesignSubcategory::where('id',$id)->delete();
        Session::flash('message', 'Entry deleted successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/homePage/view/'.$design->home_design_id);
    }
    public function restoreCategory($id)
    {
        $design = HomeDesignSubcategory::where('id',$id)->withTrashed()->first();
        $design->restore();
        // // $design->home_design_id
        // $sub =  HomeDesignSubcategory::where('id',$id)->delete();
        Session::flash('message', 'Entry restore successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/homePage/view/'.$design->home_design_id);
    }
    public function otherProductEdit($id)
    {
        $categories = Categories::all();
        $design = HomeDesign::find($id);
        $products = Products::whereIn('type',array(0,2))->where('is_active',1)->get();
        $subcategories =  HomeDesignSubcategory::with('categories')->where('home_design_id',$id)->get();
        $subcategories_id =  HomeDesignSubcategory::with('categories')->where('home_design_id',$id)->withTrashed()->get()->pluck('sub_category_id')->toArray();
        $subcategory= Categories::with('children.children')->where('parent_id',$design->product_id)->whereNotIn('id',$subcategories_id)->get();
        return view('pages::home.other-product-edit',compact('id','design','categories','products','subcategories','subcategory'));
    }
    public function deleteSubCategory(Request $request)
    {
        $category =  HomeDesignSubcategory::where('id',$request->id)->first();
       $home_design_id =  $category->home_design_id;
        $sub =  HomeDesignSubcategory::where('id',$request->id)->delete();
        return response(['status' => 'success']);
    }

    public function updateOtherProduct(Request $request)
    {
        $design = HomeDesign::find($request->id);
        $position = HomeDesign::where('type',$design->type)->where('position',$request->position)->first();
        if($position != null)
        {
            $category = HomeDesign::where('type',$design->type)->where('product_id',$request->product_id)->first();
            if($category != null){
                    if($request->id != $category->id){
                    return redirect()->back()->withInput($request->input())->with('message_duplicate_category', 'Category already Taken.');
                    }
            }
            if($position->id !=$request->id)
            {
                return redirect()->back()->withInput($request->input())->with('message_duplicate', 'Position already fixed.');
            }
        }
            $links=$request->learn_more_links;
            $subcategoriess=$request->sub_categorys;
            // dd( $subcategoriess);
            $category_color_codes = $request->category_color_codes;
            $category_font_sizes = $request->category_font_sizes;
            $learn_more_bg_colors = $request->learn_more_bg_colors;
            $learn_more_color_codes = $request->learn_more_color_codes;
            $buy_now_bg_color_codes = $request->buy_now_bg_color_codes;
            $buy_now_color_codes = $request->buy_now_color_codes;
            $results= array();
            if($subcategoriess)
            {
                foreach ($subcategoriess as $keys => $subcategorys)
                {
                    $subs =  HomeDesignSubcategory::where('sub_category_id', $subcategorys)->first();
                    $subs->home_design_id = $design->id;
                    $subs->sub_category_id = $subcategorys;
                    $subs->online_link = $links[$keys];
                    $subs->category_color_code = $category_color_codes[$keys];
                    $subs->category_font_size = $category_font_sizes[$keys];
                    $subs->learn_more_bg_color = $learn_more_bg_colors[$keys];
                    $subs->learn_more_color_code = $learn_more_color_codes[$keys];
                    $subs->buy_now_bg_color_code = $buy_now_bg_color_codes[$keys];
                    $subs->buy_now_color_code = $buy_now_color_codes[$keys];
                    $subs->save();
                }
            }

            $link=$request->learn_more_link;
            $subcategories=$request->sub_category;
            $category_color_code = $request->category_color_code;
            $category_font_size = $request->category_font_size;
            $learn_more_bg_color = $request->learn_more_bg_color;
            $learn_more_color_code = $request->learn_more_color_code;
            $buy_now_bg_color_code = $request->buy_now_bg_color_code;
            $buy_now_color_code = $request->buy_now_color_code;
            $result= array();
            if($subcategories)
            {
                foreach ($subcategories as $key => $subcategory)
                {
                    $already =  HomeDesignSubcategory::where('home_design_id',$design->id)->where('sub_category_id', $subcategory)->withTrashed()->first();
                    if($already){
                        return redirect()->back()->withInput($request->input())->with('message_duplicate_category', 'Category already Taken.');

                    }
                    $sub = new HomeDesignSubcategory;
                    $sub->home_design_id = $design->id;
                    $sub->sub_category_id = $subcategory;
                    $sub->online_link = $link[$key];
                    $sub->category_color_code = $category_color_code[$key];
                    $sub->category_font_size = $category_font_size[$key];
                    $sub->learn_more_bg_color = $learn_more_bg_color[$key];
                    $sub->learn_more_color_code = $learn_more_color_code[$key];
                    $sub->buy_now_bg_color_code = $buy_now_bg_color_code[$key];
                    $sub->buy_now_color_code = $buy_now_color_code[$key];
                    $sub->save();
                }
            }

        $design->position = $request->position;
        $design->save();


        Session::flash('message', 'Entry updated successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/homePage/list/'.$design->type);
    }
}

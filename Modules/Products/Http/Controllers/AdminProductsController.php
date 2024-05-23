<?php

namespace Modules\Products\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

use Modules\Products\Entities\Products;
use Modules\Products\Entities\ProductFaq;
use Modules\Products\Entities\ProductOnline;
use Modules\Products\Entities\ProductImages;
use Modules\Products\Entities\ProductReviews;
use Modules\Products\Entities\ProductFeedback;
use Modules\Products\Entities\ProductSupports;
use Modules\Products\Entities\ProductAttributes;
use Modules\Supports\Entities\Supports;
use Modules\Categories\Entities\Categories;
use Modules\Categories\Entities\CategoryAttributes;
use Modules\Products\Entities\ProductRegistration;
use Modules\LatestVideos\Entities\LatestVideos;
use Modules\Pages\Entities\HomeDesign;
use Modules\Vendor\Entities\Vendor;
// use App\Image;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Exports\ProductFeedbackexport;
use App\Exports\ProductRegistrationexport;
use Maatwebsite\Excel\Facades\Excel;
use Session,DB;
use Image,File;
use Carbon\Carbon;
class AdminProductsController extends Controller
{
    public function index()
    {
        return view('products::admin.index');
    }

    public function list(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;
        $type     = $request->type;
        $floor     = $request->floor;

        $plan = Products::with('category')->has('category')->whereIn('type',array(0,1));

        if ($search != '')
        {
            $plan->where('name', 'LIKE', '%'.$search.'%')
                ->orWhere('sku', 'LIKE', '%'.$search.'%')
                ->orWhereHas('category', function($q) use ($search) {
                        $q->where('name', 'LIKE', '%'.$search.'%');
                    })
                ->orWhereHas('varients', function($q) use ($search) {
                        $q->where('name', 'LIKE', '%'.$search.'%');
                    });
        }

        $total  = $plan->count();

        $result['data'] = $plan->orderBy('created_at','desc')->take($request->length)->skip($request->start)->get();

        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }

    public function add()
    {
        $categories = Categories::where('is_last_child',1)->where('status',1)->has('category_attributes')->get();
        $vendors = Vendor::get();

        return view('products::admin.add',compact('categories','vendors'));
    }

    public function store(Request $request)
    {
        if($request->type == 1)
        {
            $request->validate([
                'description' => 'required',
                'short_description' => 'required',
            ]);
        }
        else{
            $request->validate([
                'specification' => 'required',
                'description' => 'required',
                'short_description' => 'required',
            ]);

        }
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $sku = Products::where('sku',$request->sku)->first();

        if($sku != null)
        {
            return redirect()->back()->withInput($request->input())->with('message_duplicate', 'Model Number already used.');
        }
$product_code = Products::where('sku',$request->product_code)->first();

        // if($product_code != null)
        // {
        //     return redirect()->back()->withInput($request->input())->with('message_duplicate_code', 'Product code already used.');
        // }

        if($request->is_flagship == 1)
        {
            $flagship = Products::where('category_id',$request->category_id)->where('is_flagship',1)->first();

            if($flagship != null)
            {
                return redirect()->back()->withInput($request->input())->with('message_flagship', 'Flagship product already set.');
            }
        }

        $product = new Products;
        $product->type = $request->type;
        $product->category_id = $request->category_id;
        $product->sku = $request->sku;
        $product->product_code = $request->product_code;

        $product->url = $request->url;
        $product->video_position = $request->video_position;
        $product->name = $request->name;
        $product->slug = Str::slug($request->name,'-');



        // $product->thumbnail = $request->file('thumbnail')->store('products');
        $files = $request->file('thumbnail'); // will get all files
        $org_name         =   $request->file('thumbnail')->getClientOriginalName();
        $names                =   pathinfo($org_name, PATHINFO_FILENAME);
        $slug_name=Str::slug($names,'-');
        $certificateextension       =   $request->file('thumbnail')->getClientOriginalExtension();
        $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $image_name = substr(str_shuffle($str_result), 0, 10);
        $imageToStore         =   $slug_name."-" . $image_name . '.' . $certificateextension;
        $request->file('thumbnail')->storeAs('products', $imageToStore);
        $product->thumbnail  =   'products/'.$imageToStore;

        $product->stock = $request->stock;
        $product->is_active = $request->is_active;
        $product->is_new = $request->is_new;
        $product->is_flagship = $request->is_flagship;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->meta_title = $request->meta_title;
        $product->meta_tags = $request->meta_tags;
        $product->meta_description = $request->meta_description;
        if($request->is_flagship == 1)
        {
            $product->flagship_description = $request->flagship_description;
        }
        if($request->type == 1)
        {
            $product->price = 0;
            $product->offer_price = 0;
            $product->overview = '';
            $product->specification = '';
        }
        else
        {
            $product->price = $request->price;
            if($request->offer_price == '' || $request->offer_price == 0)
                $product->offer_price = $request->price;
            else
                $product->offer_price = $request->offer_price;
            $product->overview = $request->overview;
            $product->specification = $request->specification;
        }
        $product->generateSlug();
        $product->save();

        if($request->type == 0)
        {

            if(isset($request->attribute))
            {
                foreach($request->attribute as $key=>$value)
                {
                    if( $value){
                        $attribute = new ProductAttributes;
                        $attribute->product_id = $product->id;
                        $attribute->attribute_id = $key;
                        $attribute->value = $value;
                        $attribute->save();
                    }

                }
            }


        }
        $link=$request->link;
        $vendor=$request->vendor_id;
        $online_link=array_combine($vendor,$link);
        if(isset($online_link) && $online_link != '')
        {
            foreach($online_link as $key => $link)
            {
                if($link != '' || $link != null)
                {
                    $url = new ProductOnline;
                    $url->product_id = $product->id;
                    $url->online_store = '';
                    $url->vendor_id = $key;
                    $url->online_link = $link;
                    $url->save();
                }
            }
            // $url = new ProductOnline;
            // $url->product_id = $product->id;
            // $url->online_store = '';
            // $url->online_link = $request->link;
            // $url->save();
        }
        if(isset($request->images) && count($request->images) > 0)
        {
            foreach($request->images as $key=>$value)
            {
                $images = new ProductImages;
                $images->product_id = $product->id;
                $images->alt = $product->name;
                // $images->image = $value->store('products');
                $files = $value; // will get all files
            $org_name         =   $value->getClientOriginalName();
            $names                =   pathinfo($org_name, PATHINFO_FILENAME);
            $slug_name=Str::slug($names,'-');
            $imageextension       =   $value->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $image_name = substr(str_shuffle($str_result), 0, 10);
            $imageToStore         =   $slug_name."-" . $image_name . '.' . $imageextension;
            $value->storeAs('products', $imageToStore);
                // $images->save();
                $images->image  =   'products/'.$imageToStore;
                $images->save();
            }
        }

        $image_resize = Products::with('images')->find($product->id);
        Products::createThumbnail($image_resize);

        Session::flash('message', 'Entry added successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/products');
    }

    public function getCategoryAttributes($id)
    {
        $attributes = CategoryAttributes::with('attribute')->where('category_id',$id)->get();

        echo json_encode($attributes);
    }

    public function overview($id)
    {
        $product = Products::find($id);

        return view('products::admin.overview',compact('product'));
    }

    public function updateOverview(Request $request)
    {
        $overview = Products::find($request->id);
        $overview->overview = $request->content;
        $overview->overview_style = $request->css;
        $overview->save();

        Session::flash('message', 'Content updated successfully' );
        Session::flash('alert-class', 'alert-success');

        echo json_encode('success');
    }

    public function getProductBasics($id)
    {
        $basics = Products::find($id);

        echo json_encode($basics);
    }

    public function edit($id)
    {
        $vendors = Vendor::get();
        $product = Products::with('category','attributes.attribute','images','online')->find($id);
        $vendor_id=$product->online->pluck('vendor_id');
        $new_vendors = Vendor::whereNotIn('id',$vendor_id)->get();
        $attribute_id=$product->attributes->pluck('attribute_id')->toArray();
        // dd($attribute_id);
        $attributes = CategoryAttributes::with('attribute')->where('category_id',$product->category_id)->whereNotIn('attribute_id',$attribute_id)->get();
    //    dd($attributes);
        return view('products::admin.edit',compact('product','new_vendors','vendors','attributes'));
    }

    public function update(Request $request)
    {

            $request->validate([
                'description' => 'required',
                'short_description' => 'required',
                'sku' => 'required|unique:products,sku,'.$request->id.',id,deleted_at,NULL',
                // 'product_code' => 'required|unique:products,product_code,'.$request->id.',id,deleted_at,NULL',

            ]);
            $flagship_time=null;
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $product = Products::find($request->id);

        if($request->is_flagship == 1)
        {
            $flagship = Products::where('category_id',$product->category_id)->where('is_flagship',1)->where('id','!=',$request->id)->first();
            $flagship_time=date('Y-m-d H:i:s');
            if($flagship != null)
            {
                return redirect()->back()->withInput($request->input())->with('message_flagship', 'Flagship product already set.');
            }
        }

        $product->name = $request->name;
        if($request->thumbnail){
            // $product->thumbnail = $request->file('thumbnail')->store('products');

            $files = $request->file('thumbnail'); // will get all files
            $org_name         =   $request->file('thumbnail')->getClientOriginalName();
            $names                =   pathinfo($org_name, PATHINFO_FILENAME);
            $slug_name=Str::slug($names,'-');
            $certificateextension       =   $request->file('thumbnail')->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $image_name = substr(str_shuffle($str_result), 0, 10);
            $imageToStore         =   $slug_name."-" . $image_name . '.' . $certificateextension;
            $request->file('thumbnail')->storeAs('products', $imageToStore);
            $product->thumbnail  =   'products/'.$imageToStore;
        }
        $product->stock = $request->stock;
        $product->is_active = $request->is_active;
        $product->url = $request->url;
        $product->sku = $request->sku;
        $product->product_code = $request->product_code;

        $product->video_position = $request->video_position;
        $product->is_new = $request->is_new;
        $product->short_description = $request->short_description;
        $product->description = $request->description;
        $product->meta_title = $request->meta_title;
        $product->meta_tags = $request->meta_tags;
        $product->meta_description = $request->meta_description;
        if($product->type == 0)
        {
            $product->is_flagship = $request->is_flagship;
            if($request->is_flagship == 1)
            {
                $product->flagship_description = $request->flagship_description;
                $product->flagship_time = $flagship_time;
                $categories = Categories::where('id',$product->category_id)->first();
                $categories->flagship_time = $flagship_time;
                $categories->save();
            }
            $product->price = $request->price;
            if($request->offer_price == '' || $request->offer_price == 0)
                $product->offer_price = $request->price;
            else
                $product->offer_price = $request->offer_price;
            //$product->overview = $request->overview;
            $product->specification = $request->specification;
        }
        $product->generateSlug();
        $product->save();

        if($product->type == 0)
        {
            if(isset($request->attribute))
            {
                foreach($request->attribute as $key=>$value)
                {
                    $attribute = ProductAttributes::where('product_id',$product->id)->where('attribute_id',$key)->first();

                    // dd($value);
                    if($value)
                    {
                        if($attribute == null)
                        {
                            $attribute = new ProductAttributes;
                            $attribute->product_id = $product->id;
                            $attribute->attribute_id = $key;
                        }
                        $attribute->value = $value;
                        $attribute->save();
                    }
                    else{
                        if($attribute)
                        {
                            $attribute->delete();

                        }
                    }
                }
            }



        }
        $link=$request->link;
        $vendor=$request->vendor_id;
        $online_link=array_combine($vendor,$link);
        $productonline = ProductOnline::where('product_id',$request->id)->delete();
        if(isset($online_link) && $online_link != '')
        {
            foreach($online_link as $key => $link){
                if($link != '' || $link != null)
                {
                    $url = new ProductOnline;
                    $url->product_id = $product->id;
                    $url->online_store = '';
                    $url->vendor_id = $key;
                    $url->online_link = $link;
                    $url->save();
                }
            }
        }
        if(isset($request->images) && count($request->images) > 0)
        {
            foreach($request->images as $key=>$value)
            {
                $images = new ProductImages;
                $images->product_id = $product->id;
                $images->alt = $product->name;

                $files = $value; // will get all
                $org_name         =   $value->getClientOriginalName();
                $names                =   pathinfo($org_name, PATHINFO_FILENAME);
                $slug_name=Str::slug($names,'-');
                $certificateextension       =   $value->getClientOriginalExtension();
                $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
                $image_name = substr(str_shuffle($str_result), 0, 10);
                $imageToStore         =   $slug_name."-" . $image_name . '.' . $certificateextension;
                $value->storeAs('products', $imageToStore);
                $images->image  =   'products/'.$imageToStore;
                // $images->image = $value->store('products');
                $images->save();
            }
        }

        $image_resize = Products::with('images')->find($product->id);
        Products::createThumbnail($image_resize);


        Session::flash('message', 'Entry updated successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/products');
    }

    public function deleteImage($id)
    {
        $image = ProductImages::find($id);
        $product_id = $image->product_id;
        $image->delete();

        Session::flash('message', 'Image deleted successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/products/edit/'.$product_id);
    }

    public function delete($id)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $product = Products::find($id);
        HomeDesign::where('product_id', $product->id)->delete();

        $product->delete();

        Session::flash('message', 'Entry deleted successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/products');
    }

    public function resizeImage($id)
    {
        $product = Products::with('images')->find($id);
        Products::createThumbnail($product);

        Session::flash('message', 'Images resized successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/products');
    }


    // Varient

    public function varientIndex($id)
    {
        return view('products::admin.varientIndex',compact('id'));
    }

    public function varientList(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;
        $product_id     = $request->product_id;

        $plan = Products::with('category')->has('category')->where('parent_id',$product_id);

        if ($search != '')
        {
            $plan->where('name', 'LIKE', '%'.$search.'%')->orWhere('sku', 'LIKE', '%'.$search.'%');
        }

        $total  = $plan->count();

        $result['data'] = $plan->orderBy('created_at','desc')->take($request->length)->skip($request->start)->get();

        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }

    public function varientAdd($id)
    {
        $product = Products::find($id);
        $attributes = CategoryAttributes::with('attribute')->where('category_id',$product->category_id)->get();

        return view('products::admin.varientAdd',compact('id','attributes'));
    }

    public function varientStore(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'specification' => 'required',
            // 'attribute.*'=>'required',
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $sku = Products::where('sku',$request->sku)->first();

        if($sku != null)
        {
            return redirect()->back()->withInput($request->input())->with('message_duplicate', 'SKU already used.');
        }

        $parent = Products::find($request->parent_id);
        $product = new Products;
        $product->type = 2;
        $product->parent_id = $request->parent_id;
        $product->category_id = $parent->category_id;
        $product->sku = $request->sku;
        $product->name = $request->name;
        $product->url = $request->url;
        $product->video_position = $request->video_position;

        $product->slug = Str::slug($request->name,'-');
        $product->thumbnail = $request->file('thumbnail')->store('products');
        $product->stock = $request->stock;
        $product->is_active = $request->is_active;
        $product->is_new = $request->is_new;
        $product->is_flagship = $request->is_flagship;
        $product->description = $request->description;
        $product->price = $request->price;
        if($request->is_flagship == 1)
        {
            $product->flagship_description = $request->flagship_description;
        }
        if($request->offer_price == '' || $request->offer_price == 0)
            $product->offer_price = $request->price;
        else
            $product->offer_price = $request->offer_price;
        $product->overview = $request->overview;
        $product->specification = $request->specification;
        $product->meta_title = $request->meta_title;
        $product->meta_tags = $request->meta_tags;
        $product->meta_description = $request->meta_description;
        $product->generateSlug();
        $product->save();

        if(isset($request->attribute))
        {
            foreach($request->attribute as $key=>$value)
            {
                if($value)
                {
                    $attribute = new ProductAttributes;
                    $attribute->product_id = $product->id;
                    $attribute->attribute_id = $key;
                    $attribute->value = $value;
                    $attribute->save();
                }
            }
        }


        foreach($request->images as $key=>$value)
        {
            $images = new ProductImages;
            $images->product_id = $product->id;
            $images->image = $value->store('products');
            $images->save();
        }



        $image_resize = Products::with('images')->find($product->id);
        Products::createThumbnail($image_resize);

        Session::flash('message', 'Entry added successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/products/varient/'.$request->parent_id);
    }

    public function varientEdit($id)
    {
        $product = Products::with('category','attributes.attribute','images','online')->find($id);
        $attributes = CategoryAttributes::with('attribute')->where('category_id',$product->category_id)->get();

        return view('products::admin.varientEdit',compact('product','attributes','id'));
    }

    public function varientUpdate(Request $request)
    {
        $request->validate([
            'description' => 'required',
            'specification' => 'required',
            // 'attribute.*'=>'required',
            'sku' => 'required|unique:products,sku,'.$request->id.',id,deleted_at,NULL',
        ]);
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $product = Products::find($request->id);

        if($request->is_flagship == 1)
        {
            $flagship = Products::where('category_id',$product->category_id)->where('is_flagship',1)->where('id','!=',$request->id)->first();

            if($flagship != null)
            {
                return redirect()->back()->withInput($request->input())->with('message_flagship', 'Flagship product already set.');
            }
        }

        $product->name = $request->name;
        if($request->thumbnail)
            $product->thumbnail = $request->file('thumbnail')->store('products');
        $product->stock = $request->stock;
        $product->is_active = $request->is_active;
        $product->is_new = $request->is_new;
        $product->url = $request->url;
        $product->sku = $request->sku;
        $product->video_position = $request->video_position;

        $product->description = $request->description;
        $product->is_flagship = $request->is_flagship;
        if($request->is_flagship == 1)
        {
            $product->flagship_description = $request->flagship_description;
        }
        $product->price = $request->price;
        if($request->offer_price == '' || $request->offer_price == 0)
            $product->offer_price = $request->price;
        else
            $product->offer_price = $request->offer_price;
        //$product->overview = $request->overview;
        $product->specification = $request->specification;
        $product->meta_title = $request->meta_title;
        $product->meta_tags = $request->meta_tags;
        $product->meta_description = $request->meta_description;
        $product->generateSlug();
        $product->save();

        if(isset($request->attribute))
        {
            foreach($request->attribute as $key=>$value)
            {
                $attribute = ProductAttributes::where('product_id',$product->id)->where('attribute_id',$key)->first();
                if($attribute == null)
                {
                    $attribute = new ProductAttributes;
                    $attribute->product_id = $product->id;
                    $attribute->attribute_id = $key;
                }
                $attribute->value = $value;
                $attribute->save();
            }
        }


        if(isset($request->images) && count($request->images) > 0)
        {
            foreach($request->images as $key=>$value)
            {
                $images = new ProductImages;
                $images->product_id = $product->id;
                $images->image = $value->store('products');
                $images->save();
            }
        }



        $image_resize = Products::with('images')->find($product->id);
        Products::createThumbnail($image_resize);


        Session::flash('message', 'Entry updated successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/products/varient/'.$product->parent_id);
    }

    public function varientDeleteImage($id)
    {
        $image = ProductImages::find($id);
        $product_id = $image->product_id;
        $image->delete();

        Session::flash('message', 'Image deleted successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/products/varient/edit/'.$product_id);
    }

    public function varientDelete($id)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $product = Products::find($id);
        $parent_id = $product->parent_id;
        $product->delete();

        Session::flash('message', 'Entry deleted successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/products/varient/'.$parent_id);
    }


    // Support

    public function supportIndex($id)
    {
        return view('products::admin.supportIndex',compact('id'));
    }

    public function supportList(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;
        $product_id     = $request->product_id;

        $plan = ProductSupports::with('support')->where('product_id',$product_id);

        if ($search != '')
        {
            $plan->whereHas('support', function($q) use ($search) {
                        $q->where('name', 'LIKE', '%'.$search.'%');
                    });
        }

        $total  = $plan->count();

        $result['data'] = $plan->orderBy('created_at','desc')->take($request->length)->skip($request->start)->get();

        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }

    public function supportAdd($id)
    {
        $product_support = ProductSupports::where('product_id',$id)->get();
        $product_support = $product_support->count() == 0?array():$product_support->pluck('attribute_id')->toArray();

        $supports = Supports::whereNotIn('id',$product_support)->get();

        return view('products::admin.supportAdd',compact('id','supports'));
    }

    public function supportStore(Request $request)
    {
        $attribute = new ProductSupports;
        $attribute->product_id = $request->product_id;
        $attribute->support_id = $request->support_id;
        $attribute->type = $request->type;
        if($request->type == 0)
            $attribute->value = $request->value;
        else
            $attribute->value = $request->file('value')->store('product_support');
        $attribute->save();

        return redirect('admin/products/support/'.$request->product_id);
    }

    public function supportEdit($id)
    {
        $support = ProductSupports::with('support')->find($id);

        return view('products::admin.supportEdit',compact('support','id'));
    }

    public function supportUpdate(Request $request)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $attribute = ProductSupports::find($request->id);
        if($request->type == 0)
            $attribute->value = $request->value;
        else if($request->value)
            $attribute->value = $request->file('value')->store('product_support');
        $attribute->save();

        Session::flash('message', 'Entry updated successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/products/support/'.$attribute->product_id);
    }

    public function supportDelete($id)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $product = ProductSupports::find($id);
        $product_id = $product->product_id;
        $product->delete();

        Session::flash('message', 'Entry deleted successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/products/support/'.$product_id);
    }


    // Reviews

    public function pendingReviews()
    {
        return view('products::admin.pendingReviews');
    }

    public function pendingReviewsList(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;
        $product_id     = $request->product_id;

        $plan = ProductReviews::where('status',0)->with('product')->has('product');

        if ($search != '')
        {
            $plan->where('name', 'LIKE', '%'.$search.'%')->orWhere('review', 'LIKE', '%'.$search.'%')
                ->whereHas('product', function($q) use ($search) {
                        $q->where('name', 'LIKE', '%'.$search.'%');
                    });
        }

        $total  = $plan->count();

        $result['data'] = $plan->orderBy('created_at','desc')->take($request->length)->skip($request->start)->get();

        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }

    public function approveReviews($id)
    {
        $review = ProductReviews::find($id);
        $review->status = 1;
        $review->save();
// dd($id);
        Session::flash('message', 'Entry approved successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/products/pendingReviews');
    }

    public function rejectReviews($id)
    {
        $review = ProductReviews::find($id);
        $review->status = 2;
        $review->save();

        Session::flash('message', 'Entry rejected successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/products/pendingReviews');
    }

    public function reviewsIndex($id)
    {
        return view('products::admin.reviewsIndex',compact('id'));
    }

    public function reviewsList(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;
        $product_id     = $request->product_id;
// dd($request->product_id);
        $plan = ProductReviews::where('product_id',$product_id);

        if ($search != '')
        {
            $plan->where('name', 'LIKE', '%'.$search.'%')->orWhere('review', 'LIKE', '%'.$search.'%');
        }

        $total  = $plan->count();

        $result['data'] = $plan->orderBy('created_at','desc')->take($request->length)->skip($request->start)->get();

        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }

    public function reviewsAdd($id)
    {
        return view('products::admin.reviewsAdd',compact('id'));
    }

    public function reviewsStore(Request $request)
    {
        $attribute = new ProductReviews;
        $attribute->product_id = $request->product_id;
        $attribute->name = $request->name;
        if($request->image)
            $attribute->image = $request->file('image')->store('reviews');
        $attribute->title = $request->title;
        $attribute->rating = $request->rating;
        $attribute->review = $request->review;
        $attribute->status = 1;
        $attribute->save();

        return redirect('admin/products/reviews/'.$request->product_id);
    }

    public function reviewsEdit($id)
    {
        $review = ProductReviews::find($id);

        return view('products::admin.reviewsEdit',compact('review','id'));
    }

    public function reviewsUpdate(Request $request)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $attribute = ProductReviews::find($request->id);
        $attribute->title = $request->title;
        $attribute->rating = $request->rating;
        $attribute->review = $request->review;
        $attribute->status = $request->status;
        $attribute->save();

        Session::flash('message', 'Entry updated successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/products/reviews/'.$attribute->product_id);
    }

    public function reviewsDelete($id)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $product = ProductReviews::find($id);
        $product_id = $product->product_id;
        $product->delete();

        Session::flash('message', 'Entry deleted successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/products/reviews/'.$product_id);
    }


    // Faq

    public function faqIndex($id)
    {
        return view('products::admin.faqIndex',compact('id'));
    }

    public function faqList(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;
        $product_id     = $request->product_id;

        $plan = ProductFaq::where('product_id',$product_id);

        if ($search != '')
        {
            $plan->where('question', 'LIKE', '%'.$search.'%')->orWhere('answer', 'LIKE', '%'.$search.'%');
        }

        $total  = $plan->count();

        $result['data'] = $plan->orderBy('created_at','desc')->take($request->length)->skip($request->start)->get();

        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }

    public function faqAdd($id)
    {
        return view('products::admin.faqAdd',compact('id'));
    }

    public function faqStore(Request $request)
    {
        $attribute = new ProductFaq;
        $attribute->product_id = $request->product_id;
        $attribute->question = $request->question;
        $attribute->answer = $request->answer;
        $attribute->save();

        return redirect('admin/products/faq/'.$request->product_id);
    }

    public function faqEdit($id)
    {
        $faq = ProductFaq::find($id);

        return view('products::admin.faqEdit',compact('faq','id'));
    }

    public function faqUpdate(Request $request)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $attribute = ProductFaq::find($request->id);
        $attribute->question = $request->question;
        $attribute->answer = $request->answer;
        $attribute->save();

        Session::flash('message', 'Entry updated successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/products/faq/'.$attribute->product_id);
    }

    public function faqDelete($id)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $product = ProductFaq::find($id);
        $product_id = $product->product_id;
        $product->delete();

        Session::flash('message', 'Entry deleted successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/products/faq/'.$product_id);
    }

    public function createSlug()
    {
        $categories = Categories::all();

        foreach ($categories as $value)
        {
            $value->generateSlug();
            $value->save();
        }

        $products = Products::all();

        foreach ($products as $value)
        {
            $value->generateSlug();
            $value->save();
        }

        echo "success";
    }

    public function createThumbnail(Request $request)
    {
        if(isset($request->type) && $request->type != '' && $request->type == 'product')
        {
            $products = Products::with('images')->get();

            foreach ($products as $product)
            {
                Products::createThumbnail($product);
            }
        }

        if(isset($request->type) && $request->type != '' && $request->type == 'category')
        {
            $products = Categories::all();

            foreach ($products as $product)
            {
                Categories::createThumbnail($product);
            }
        }

        if(isset($request->type) && $request->type != '' && $request->type == 'vendor')
        {
            $products = Vendor::all();

            foreach ($products as $product)
            {
                Vendor::createThumbnail($product);
            }
        }

        if(isset($request->type) && $request->type != '' && $request->type == 'video')
        {
            $products = LatestVideos::all();

            foreach ($products as $product)
            {
                LatestVideos::createThumbnail($product);
            }
        }

        if(isset($request->type) && $request->type != '' && $request->type == 'trending')
        {
            $trendings = HomeDesign::with('products')->whereIn('type',array(2,3,6))->get();

            foreach ($trendings as $trending)
            {
                HomeDesign::createThumbnail($trending);
            }
        }

        echo "success";
    }


    public function registered()
    {
        return view('products::admin.registered');
    }

    public function registeredList(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;
        $category = ProductRegistration::select('*',DB::raw('DATE_FORMAT(DATE_ADD(created_at, INTERVAL "5:30" HOUR_MINUTE),"%Y-%c-%d") as change_date'))->with('products');
        if($request->from_date)
        {
            $category= $category->whereDate('created_at','>=',$request->from_date)->whereDate('created_at','<=',$request->to_date);
        }
        if ($search != '')
        {
            $category->where('first_name', 'LIKE', '%'.$search.'%');
            $category->orWhere('last_name', 'LIKE', '%'.$search.'%');
            $category->orWhere('mobile', 'LIKE', '%'.$search.'%');
            $category->orWhere('model_number', 'LIKE', '%'.$search.'%');
            $category->orWhere('serial_number', 'LIKE', '%'.$search.'%');
            $category->orWhereHas('product', function($q) use($search)
                        {
                            $q->where('name', 'LIKE', '%'.$search.'%');
                        });
        }

        $total  = $category->count();

        $result['data'] = $category->orderBy('created_at','desc')->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }

    public function registeredView($id)
    {
        $request = ProductRegistration::with('products')->find($id);
// dd($request);
        return view('products::admin.registeredView',compact('request'));
    }

    public function registeredExport()
    {
        $products = ProductRegistration::with('product.category')->has('product')->get();

        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="Product registered.csv";');

        $columns = array('Model Number','Serial Number','Name','Mobile','Email','Address 1','Address 2','District/City/Town','State','Pin Code','Purchase Date','Purchased From','Attached Document');

        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach($products as $value) {
            fputcsv($file, array($value->model_number,$value->serial_number,$value->first_name.' '.$value->last_name,$value->mobile,$value->email,$value->address_1,$value->address_2,$value->district,$value->state,$value->pincode,$value->purchased_date,$value->purchased_from,storage_url().'/'.$value->document));
        }
    }

    public function vendorList()
    {
        $request = Vendor::get();
        echo json_encode($request);
    }
    public function vendorsList(Request $request)
    {
        $product = Products::with('online')->find($request->id);
        $vendor_id= $product->online->pluck('vendor_id');
        $vendors = Vendor::whereNotIn('id',$vendor_id)->get();
        return view('products::admin.vendor-list' ,['vendors'=>$vendors,'id'=>$request->id]);
    }
    public function productVendorList(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;
        $vendor = ProductOnline::with('vendor')->where('product_id',$request->product_id);
        if ($search != '')
        {
            $vendor =$vendor->whereHas('vendor', function($q) use ($search) {
                $q->where('name', 'LIKE', '%'.$search.'%');
            });
        }
        $total  = $vendor->count();
        $data = $vendor->take($request->length)->skip($request->start)->get();
        $result['data'] = $vendor =$vendor->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;
        // dd()
        echo json_encode($result);
    }

    public function vendorStore(Request $request)
    {
        $url = new ProductOnline;
        $url->product_id = $request->id;
        $url->online_store = '';
        $url->online_link = $request->link;
        $url->vendor_id = $request->vendor_id;
        $url->save();
        Session::flash('message', 'Entry added successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('admin/products/vendor/'.$request->id);
    }
    public function vendorDelete(Request $request)
    {
        $url =  ProductOnline::where('id',$request->id)->first();
        $product_id = $url->product_id;
        $url->delete();
        Session::flash('message', 'Entry deleted successfully' );
        Session::flash('alert-class', 'alert-success');
        return redirect('admin/products/vendor/'.$product_id);
    }


    public function feedback()
    {
        return view('products::admin.feedback');
    }

    public function feedbackList(Request $request)
    {

        // dd($request);
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;

        $category = ProductFeedback::select('*',DB::raw('DATE_FORMAT(DATE_ADD(created_at, INTERVAL "5:30" HOUR_MINUTE),"%Y-%c-%d") as change_date'))->with('product.category')->has('product');
        if($request->from_date)
        {
            $category->whereDate('created_at','>=',$request->from_date)->whereDate('created_at','<=',$request->to_date);

        }
        if ($search != '')
        {
            $category->where('first_name', 'LIKE', '%'.$search.'%');
            $category->orWhere('last_name', 'LIKE', '%'.$search.'%');
            $category->orWhere('mobile', 'LIKE', '%'.$search.'%');
            $category->orWhere('serial_number', 'LIKE', '%'.$search.'%');
            $category->orWhereHas('product', function($q) use($search)
                        {
                            $q->where('name', 'LIKE', '%'.$search.'%');
                        });
        }

        $total  = $category->count();

        $result['data'] = $category=$category->orderBy('created_at','desc')->take($request->length)->skip($request->start)->get();
        // dd($category);
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }

    public function feedbackView($id)
    {
        $request = ProductFeedback::with('product.category')->has('product')->find($id);

        return view('products::admin.feedbackView',compact('request'));
    }

    public function feedbackExport()
    {
        $request = ProductFeedback::with('product.category')->has('product')->get();

        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="Product feedback.csv";');

        $columns = array('Product Category','Product','Model Number','Serial Number','Feedback Date','Name','Mobile','Email','Address 1','Address 2','District/City/Town','State','Pincode','Subject','Feedback','Attached Document');

        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach($request as $value) {
            fputcsv($file, array($value->product->category->name,$value->product->name,$value->product_model,$value->serial_number,date('Y-m-d',strtotime($value->created_at)),$value->first_name.' '.$value->last_name,$value->mobile,$value->email,$value->address_1,$value->address_2,$value->district,$value->state,$value->pincode,$value->feedback_subject,$value->feedback_description,storage_url().'/'.$value->attachment));
        }
    }

    public function deleteProductVendor($online_id,$product_id)
    {
        $url =  ProductOnline::where('vendor_id',$online_id)->where('product_id',$product_id)->first();
        // $product_id = $url->product_id;
        $url->delete();
        Session::flash('message', 'Entry deleted successfully' );
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
        // return redirect('admin/products/edit/'.$product_id);
    }
    public function productFeedbackExport(Request $request)
    {
        $start = $request->from_date;
        $end = $request->to_date;
        ob_end_clean();
        ob_start();
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=file.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        );
        return (new ProductFeedbackexport($request->from_date,$request->to_date))->download('product-feedback.xlsx');
        ob_flush();
    }
    public function registeredProductExport(Request $request)
    {
        $start = $request->from_date;
        $end = $request->to_date;
        // dd($start);
        ob_end_clean();
        ob_start();
        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=file.csv",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0",
        );
        return (new ProductRegistrationexport($request->from_date,$request->to_date))->download('product-registration.xlsx');
        ob_flush();
        // $products = ProductRegistration::with('product.category')->has('product')->get();

        // header('Content-Type: application/csv');
        // header('Content-Disposition: attachment; filename="Product registered.csv";');

        // $columns = array('Model Number','Serial Number','Name','Mobile','Email','Address 1','Address 2','District/City/Town','State','Pin Code','Purchase Date','Purchased From','Attached Document');

        // $file = fopen('php://output', 'w');
        // fputcsv($file, $columns);

        // foreach($products as $value) {
        //     fputcsv($file, array($value->model_number,$value->serial_number,$value->first_name.' '.$value->last_name,$value->mobile,$value->email,$value->address_1,$value->address_2,$value->district,$value->state,$value->pincode,$value->purchased_date,$value->purchased_from,storage_url().'/'.$value->document));
        // }
    }

}

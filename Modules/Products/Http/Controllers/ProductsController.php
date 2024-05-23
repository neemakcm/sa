<?php

namespace Modules\Products\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\Pages\Entities\Pages;
use Modules\Products\Entities\Products;
use Modules\Attributes\Entities\Attributes;
use Modules\Categories\Entities\Categories;
use Modules\Products\Entities\ProductFaq;
use Modules\Products\Entities\ProductReviews;
use Modules\Products\Entities\ProductFeedback;
use Modules\Products\Entities\ProductAttributes;
use Modules\Categories\Entities\CategoryAttributes;
use Modules\Products\Entities\ProductRegistration;
use Modules\WarrantyExtension\Entities\State;
use Modules\Settings\Entities\Settings;
use Modules\WarrantyExtension\Entities\WarrantyExtension;

use App\Mail\WarrantyExtensionMail;

use App\Mail\ProductFeedbackMail;
use App\Mail\ProductRegisterMail;


use Mail;
use DB,Session;

class ProductsController extends Controller
{
    public function productSearch(Request $request)
    {
        $banner = Pages::where('slug','product-offer')->first();

        $products = Products::with('category')->has('category');

        $words = explode(' ', $request->search);
        $products->where(function($q) use($words)
        {
            $firstWord = array_shift($words);
            $q->where('name','LIKE','%'.$firstWord.'%')
            ->orwhere('meta_tags','LIKE','%'.$firstWord.'%');
            foreach($words as $word)
            {
                $q->where('name','LIKE','%'.$word.'%')
                ->orwhere('meta_tags','LIKE','%'.$word.'%');
            }
        });
        $products = $products->first();
        // dd( $request->search);
        if($products == null)
            return view('products::front.no_products',compact('banner'));
            // return redirect('products/'.$products->category->slug.'?search='.$products->name);
        else
            // return redirect('products/'.$products->category->slug);

            return redirect('products/'.$products->category->slug.'?search='. $request->search);
    }
    public function index($id,Request $request)
    {
        // dd(1);
        $filters=array();
        $brudcrumb = Categories::with('parent')->where('slug',$id)->first();
        if($brudcrumb == null)
        {
            return redirect('404');
        }
        else
        {
            if(!is_null(Session::get('compare')))
            {
                $compare = array();
                $compare = Session::get('compare');
                $category = Products::select('id','category_id')->whereIn('id',$compare)->first();
                if($category->category->parent_id)
                {
                    if($brudcrumb->is_last_child==1){
                        // dd($brudcrumb);
                        // dd($category->category->parent_id);
                        if($brudcrumb->parent_id != $category->category->parent_id )
                        {
                            // dd(1);
                            Session::forget('compare');
                        }
                    }
                    else {
                        if($brudcrumb->id != $category->category->parent_id )
                        {
                            Session::forget('compare');
                        }
                    }
                }
            }
            // dd($brudcrumb);
            $banner = Pages::where('slug','product-offer')->first();
            $categories = array();
            if(!is_null($request->Type))
            {
                $types = explode(',', $request->Type);
                $categories = Categories::Where(function ($query) use($types) {
                    for ($i = 0; $i < count($types); $i++)
                    {
                        $query->orwhere('name', 'like',  $types[$i]);
                    }
                })->pluck('id')->toArray();
            }
            else{
        // dd($request->Type);

                $categories = Categories::where('parent_id',$brudcrumb->id)->get();
                $categories = $categories->count() > 0?$categories->pluck('id')->toArray():array();
                array_push($categories, $brudcrumb->id);
            }


            $price = Products::select(DB::raw('min(offer_price) as min'),DB::raw('max(offer_price) as max'))->whereIn('category_id',$categories)->where('is_active',1)->whereIn('type',array(0,2))->first();
            if($brudcrumb->is_last_child == 1)
            {
                $parent = Categories::find($brudcrumb->parent_id);

                if($parent->parent_id == 0)
                    $filter['Type'] = array();
                else
                    $filter['Type'] = Categories::where('parent_id',$brudcrumb->parent_id)->get()->pluck('name')->toArray();
            }
            else
                $filter['Type'] = Categories::where('parent_id',$brudcrumb->id)->get()->pluck('name')->toArray();
                $attributes = CategoryAttributes::with('attribute')->whereIn('category_id',$categories)->get();
                // dd($attributes);
            $products_ids = Products::whereIn('category_id',$categories)->pluck('id')->toArray();
            foreach ($attributes as $value)
            {
                $attr_values = ProductAttributes::where('attribute_id',$value->attribute_id)->whereIn('product_id',$products_ids)->groupBy('value')->get();
                // dd($products_div);
                $filters[$value->attribute->name] = $attr_values->count()>0?$attr_values->pluck('value')->toArray():array();

            }
            // dd($filters);

            $varient = CategoryAttributes::whereIn('category_id',$categories)->where('is_varient',1)->get();
            $varient = $varient->count()>0?$varient->pluck('attribute_id')->toArray():array();

            DB::connection()->enableQueryLog();

            $products = Products::with('varients','attributes')
                                ->with(['varients.attributes' => function ($q) use($varient)
                                {
                                    $q->whereIn('attribute_id',$varient);
                                }])
                                ->selectRaw('products.* , IF (products.type = 0, products.offer_price, varients.offer_price) as price_altered')->leftJoin('products as varients','varients.parent_id', '=','products.id')
                                ->where('products.is_active',1)->whereIn('products.type',array(0,1));
            $filtered = 0;
// dd($request->all());
            foreach ($request->all() as $key => $value)
            {
                // dd($key);
                if($key != 'category' && $key != 'Type' && $key != 'Sort' && $key != 'min' && $key != 'max' && $key != 'search' && $key != 'page')
                {
                   $key= str_replace('_', ' ', $key);
                    $attr = Attributes::where('name',$key)->first();

                    $products->where(function($query) use($attr,$value)
                            {
                                $query->whereHas('attributes', function($q) use($attr,$value)
                                        {
                                            $value = explode(',', $value);
                                            // dd( $attr->id);

                                            $q->where('attribute_id', $attr->id);
                                            $q->whereIn('value',$value);
                                        });
                                $query->orWhereHas('varients.attributes', function($q) use($attr,$value)
                                        {
                                            $value = explode(',', $value);

                                            $q->where('attribute_id', $attr->id);
                                            $q->whereIn('value',$value);
                                        });
                            });
                }
                else if($key == 'search')
                {
                    $words = explode(' ', $value);
                    // dd( $words);
                    $products->where(function($q) use($words)
                    {
                        $firstWord = array_shift($words);
                        $q->where('products.name','LIKE','%'.$firstWord.'%')
                        ->orwhere('products.meta_tags','LIKE','%'.$firstWord.'%');
                        foreach($words as $word)
                        {
                            $q->where('products.name','LIKE','%'.$word.'%')
                            ->orwhere('products.meta_tags','LIKE','%'.$word.'%');
                        }
                    });
                }
                else if($key == 'min')
                {
                    $products->whereRaw("IF (products.type = 0, products.offer_price, varients.offer_price) >= $value");


                    /*$products->where(function($query) use($value)
                    {
                        $query->where(DB::raw('ABS(offer_price)'),'>=',$value);
                        $query->orWhereHas('varients', function($q) use($value)
                                {
                                    $q->where(DB::raw('ABS(offer_price)'),'>=',$value);
                                });
                    });*/
                }
                else if($key == 'max')
                {
                    $products->whereRaw("IF (products.type = 0, products.offer_price, varients.offer_price) <= $value");

                   /* $products->where(function($query) use($value)
                    {
                        $query->where(DB::raw('ABS(offer_price)'),'<=',$value);
                        $query->orWhereHas('varients', function($q) use($value)
                                {
                                    $q->where(DB::raw('ABS(offer_price)'),'<=',$value);
                                });
                    });*/
                }
                else if($key == 'Type')
                {
                    $filtered = 1;
                    $types = explode(',', $request->Type);

                    $filtered_type = Categories::Where(function ($query) use($types) {
                        for ($i = 0; $i < count($types); $i++)
                        {
                            $query->orwhere('name', 'like',  $types[$i]);
                        }
                    })->get();

                    $filtered_type = $filtered_type->count() > 0?$filtered_type->pluck('id')->toArray():array();

                    $products->whereIn('products.category_id',$filtered_type);

                    $price = Products::select(DB::raw('min(offer_price) as min'),DB::raw('max(offer_price) as max'))->whereIn('category_id',$filtered_type)->where('is_active',1)->whereIn('type',array(0,2))->first();
                }

            }

            if($filtered == 0)
            {
                $price = Products::select(DB::raw('min(offer_price) as min'),DB::raw('max(offer_price) as max'))->whereIn('category_id',$categories)->where('is_active',1)->whereIn('type',array(0,2))->first();

                $products->whereIn('products.category_id',$categories);
            }

            if(isset($request->Sort))
            {
                $sort = $request->Sort;
// dd($sort);
                if($sort == 'new')
                    $products->orderBy('products.id','desc');
                else if($sort == 'rated')
                {
                    $products->leftJoin('product_reviews','product_reviews.product_id','=','products.id');
                    $products->orderBy(DB::raw('AVG(rating)'),'desc');
                }
                else if($sort == 'price_high')
                    $products->orderBy("price_altered" ,"desc");
                    //$products->orderBy(DB::raw('ABS(varients.offer_price)'),'desc')->orderBy(DB::raw('ABS(products.offer_price)'),'desc');
                else
                    $products->orderBy("price_altered" , "asc");
                    //$products->orderBy(DB::raw('ABS(varients.offer_price)'),'asc')->orderBy(DB::raw('ABS(products.offer_price)'),'asc');
            }
            else
            {
                // $products->orderBy('products.id','desc');
                $products->orderBy('price_altered','desc');
            }

            $products = $products->groupBy('products.id')->paginate(9);



            if(Session::get('compare'))
                $compare = Products::select('id','name','slug','thumbnail')->whereIn('id',Session::get('compare'))->get();
            else
                $compare = Collect();

            // if(!Session::get('compare'))
            //     return redirect('/products/diecast-cookware?Type=Diecast%20Cookware&Dimension_-_Diecast=2%20PCS,27cm,26%20cm&Sort=price_high');

            return view('products::front.list',compact('brudcrumb','products','filter','filters','price','compare','banner'));


        }
    }
    // public function index($id,Request $request)
    // {
    //     $brudcrumb = Categories::with('parent')->where('slug',$id)->first();
    //     if($brudcrumb == null)
    //     {
    //         return redirect('404');
    //     }
    //     else
    //     {
    //         $banner = Pages::where('slug','product-offer')->first();

    //         $categories = array();

    //             $categories = Categories::where('parent_id',$brudcrumb->id)->get();
    //             $categories = $categories->count() > 0?$categories->pluck('id')->toArray():array();
    //             array_push($categories, $brudcrumb->id);

    //         $price = Products::select(DB::raw('min(offer_price) as min'),DB::raw('max(offer_price) as max'))->whereIn('category_id',$categories)->where('is_active',1)->whereIn('type',array(0,2))->first();
    //         if($brudcrumb->is_last_child == 1)
    //         {
    //             $parent = Categories::find($brudcrumb->parent_id);

    //             if($parent->parent_id == 0)
    //                 $filter['Type'] = array();
    //             else
    //                 $filter['Type'] = Categories::where('parent_id',$brudcrumb->parent_id)->get()->pluck('name')->toArray();
    //         }
    //         else
    //             $filter['Type'] = Categories::where('parent_id',$brudcrumb->id)->get()->pluck('name')->toArray();


    //             // dd()
    //         $attributes = CategoryAttributes::with('attribute')->whereIn('category_id',$categories)->get();

    //         foreach ($attributes as $value)
    //         {
    //             $attr_values = ProductAttributes::where('attribute_id',$value->attribute_id)->groupBy('value')->get();
    //             $filter[$value->attribute->name] = $attr_values->count()>0?$attr_values->pluck('value')->toArray():array();
    //         }

    //         $varient = CategoryAttributes::whereIn('category_id',$categories)->where('is_varient',1)->get();
    //         $varient = $varient->count()>0?$varient->pluck('attribute_id')->toArray():array();

    //         DB::connection()->enableQueryLog();

    //         $products = Products::with('varients','attributes')
    //                             ->with(['varients.attributes' => function ($q) use($varient)
    //                             {
    //                                 $q->whereIn('attribute_id',$varient);
    //                             }])
    //                             ->selectRaw('products.* , IF (products.type = 0, products.offer_price, varients.offer_price) as price_altered')->leftJoin('products as varients','varients.parent_id', '=','products.id')
    //                             ->where('products.is_active',1)->whereIn('products.type',array(0,1));
    //         $filtered = 0;

    //         foreach ($request->all() as $key => $value)
    //         {
    //             if($key != 'category' && $key != 'Type' && $key != 'Sort' && $key != 'min' && $key != 'max' && $key != 'search' && $key != 'page')
    //             {
    //                 $attr = Attributes::where('name',$key)->first();

    //                 $products->where(function($query) use($attr,$value)
    //                         {
    //                             $query->whereHas('attributes', function($q) use($attr,$value)
    //                                     {
    //                                         $value = explode(',', $value);

    //                                         $q->where('attribute_id', $attr->id);
    //                                         $q->whereIn('value',$value);
    //                                     });
    //                             $query->orWhereHas('varients.attributes', function($q) use($attr,$value)
    //                                     {
    //                                         $value = explode(',', $value);

    //                                         $q->where('attribute_id', $attr->id);
    //                                         $q->whereIn('value',$value);
    //                                     });
    //                         });
    //             }
    //             else if($key == 'search')
    //             {
    //                 $words = explode(' ', $value);
    //                 // dd( $words);
    //                 $products->where(function($q) use($words)
    //                 {
    //                     $firstWord = array_shift($words);
    //                     $q->where('products.name','LIKE','%'.$firstWord.'%')
    //                     ->orwhere('products.meta_tags','LIKE','%'.$firstWord.'%');
    //                     foreach($words as $word)
    //                     {
    //                         $q->where('products.name','LIKE','%'.$word.'%')
    //                         ->orwhere('products.meta_tags','LIKE','%'.$word.'%');
    //                     }
    //                 });
    //             }
    //             else if($key == 'min')
    //             {
    //                 $products->whereRaw("IF (products.type = 0, products.offer_price, varients.offer_price) >= $value");


    //                 /*$products->where(function($query) use($value)
    //                 {
    //                     $query->where(DB::raw('ABS(offer_price)'),'>=',$value);
    //                     $query->orWhereHas('varients', function($q) use($value)
    //                             {
    //                                 $q->where(DB::raw('ABS(offer_price)'),'>=',$value);
    //                             });
    //                 });*/
    //             }
    //             else if($key == 'max')
    //             {
    //                 $products->whereRaw("IF (products.type = 0, products.offer_price, varients.offer_price) <= $value");

    //                /* $products->where(function($query) use($value)
    //                 {
    //                     $query->where(DB::raw('ABS(offer_price)'),'<=',$value);
    //                     $query->orWhereHas('varients', function($q) use($value)
    //                             {
    //                                 $q->where(DB::raw('ABS(offer_price)'),'<=',$value);
    //                             });
    //                 });*/
    //             }
    //             else if($key == 'Type')
    //             {
    //                 $filtered = 1;
    //                 $types = explode(',', $request->Type);

    //                 $filtered_type = Categories::Where(function ($query) use($types) {
    //                     for ($i = 0; $i < count($types); $i++)
    //                     {
    //                         $query->orwhere('name', 'like',  $types[$i]);
    //                     }
    //                 })->get();

    //                 $filtered_type = $filtered_type->count() > 0?$filtered_type->pluck('id')->toArray():array();

    //                 $products->whereIn('products.category_id',$filtered_type);

    //                 $price = Products::select(DB::raw('min(offer_price) as min'),DB::raw('max(offer_price) as max'))->whereIn('category_id',$filtered_type)->where('is_active',1)->whereIn('type',array(0,2))->first();
    //             }

    //         }

    //         if($filtered == 0)
    //         {
    //             $price = Products::select(DB::raw('min(offer_price) as min'),DB::raw('max(offer_price) as max'))->whereIn('category_id',$categories)->where('is_active',1)->whereIn('type',array(0,2))->first();

    //             $products->whereIn('products.category_id',$categories);
    //         }

    //         if(isset($request->Sort))
    //         {
    //             $sort = $request->Sort;

    //             if($sort == 'new')
    //                 $products->orderBy('products.id','desc');
    //             else if($sort == 'rated')
    //             {
    //                 $products->leftJoin('product_reviews','product_reviews.product_id','=','products.id');
    //                 $products->orderBy(DB::raw('AVG(rating)'),'desc');
    //             }
    //             else if($sort == 'price_high')
    //                 $products->orderBy("price_altered" ,"desc");
    //                 //$products->orderBy(DB::raw('ABS(varients.offer_price)'),'desc')->orderBy(DB::raw('ABS(products.offer_price)'),'desc');
    //             else
    //                 $products->orderBy("price_altered" , "asc");
    //                 //$products->orderBy(DB::raw('ABS(varients.offer_price)'),'asc')->orderBy(DB::raw('ABS(products.offer_price)'),'asc');
    //         }
    //         else
    //         {
    //             $products->orderBy('products.id','desc');
    //         }

    //         $products = $products->groupBy('products.id')->paginate(9);

    //         //$products = $products->toSql();

    //         //dd(DB::getQueryLog());

    //         // dd($products);

    //         if(Session::get('compare'))
    //             $compare = Products::select('id','name','slug','thumbnail')->whereIn('id',Session::get('compare'))->get();
    //         else
    //             $compare = Collect();
    //         return view('products::front.list',compact('brudcrumb','products','filter','price','compare','banner'));


    //     }
    // }


    public function detail($slug)
    {
        $product = Products::with('category.parent','attributes.attribute','images','online','varients','parent.online')->where('slug',$slug)->first();
        $images=array();
        $img_array=array();
        $images=array();

// dd($product);
        if($product->images->count() > 0){
            // if($product->url){
                if($product->video_position==0)
                {
                    foreach($product->images as $img)
                    {
                        $img_array[]=array(
                            "id" =>  $img->id,
                            'status'=>0,
                            "alt" => $img->alt,
                            "image" => $img->image
                        );
                    }
                    if($product->url){
                        $images[]=array(
                            "id" =>  $product->id,
                            "alt" =>'impex',
                            'status'=>1,
                            'position'=>0,
                            "image" => $product->thumbnail
                        );
                        array_splice( $img_array, $product->video_position, 0, $images );
                    }
                }
                else if($product->video_position==1){
                    foreach($product->images as $img)
                    {
                        $img_array[]=array(
                            "id" =>  $img->id,
                            'status'=>0,
                            "alt" => $img->alt,
                            "image" => $img->image
                        );
                    }
                    if($product->url){
                        $images=array(
                            "id" =>  $product->id,
                            "alt" =>'impex',
                            'status'=>1,
                            'position'=>1,
                            "image" => $product->thumbnail
                        );
                        array_push($img_array,$images);
                    }
                }
                // dd($img_array);
            // }
        }
        if($product == null)
        {
            return redirect('404');
        }
        else
        {
            // dd($product->type);
            if($product->type == 0)
            {
                $reviews = ProductReviews::where('product_id',$product->id)->where('status',1)->get();
                $faqs = ProductFaq::where('product_id',$product->id)->get();

                $varients = Collect();

                $varient_attributes = Collect();
            }
            else
            {
                // $reviews = ProductReviews::where('product_id',$product->parent_id)->where('status',1)->get();
                $reviews = ProductReviews::where('product_id',$product->id)->where('status',1)->get();
                $faqs = ProductFaq::where('product_id',$product->parent_id)->get();

                $varient_attributes = CategoryAttributes::with('attribute')->where('category_id',$product->category_id)->where('is_varient',1)->get();
                $varient_attr = $varient_attributes->count()>0?$varient_attributes->pluck('attribute_id')->toArray():array();
                $varients = Products::with('varients')
                                    ->with(['varients.attributes' => function ($q) use($varient_attr)
                                    {
                                        $q->whereIn('attribute_id',$varient_attr);
                                    }])->where('parent_id',$product->parent_id)->get();
                // dd($varient_attr);


            }


            if(Session::get('compare'))
                $compare = Products::select('id','name','slug','thumbnail')->whereIn('id',Session::get('compare'))->get();
            else
                $compare = Collect();

            $settings = Settings::first();

            $related = Products::with('images','parent')
                                ->selectRaw('products.* , IF (products.type = 0, products.offer_price, varients.offer_price) as price_altered')->leftJoin('products as varients','varients.parent_id', '=','products.id')
                                ->whereIn('products.type',array(0,2))
                                ->where('products.category_id',$product->category_id)->where('products.id','!=',$product->id)->where('products.is_active',1)->get();

            return view('products::front.detail',compact('product','reviews','faqs','varients','related','compare','varient_attributes','settings','img_array'));
        }
    }

    public function getProductBasics($slug)
    {
        $product = Products::select('thumbnail','offer_price','price','name','slug')->where('slug',$slug)->first();

        echo json_encode($product);
    }


    public function getModelNumber(Request $request)
    {
        $products = Products::select('sku','thumbnail','name')->where('sku','LIKE','%'.$request->keyword.'%')->whereIn('type',array(0,2))->get();

        echo json_encode($products);
    }

    public function getCategoryTypes($id)
    {
        $categories = Categories::select('id','name')->where('parent_id',$id)->where('is_last_child',1)->get();

        echo json_encode($categories);
    }

    public function getFeedbackCategoryTypes($id)
    {
        $categories = Categories::with('children')->select('id','name','is_last_child')->where('parent_id',$id)->get();

        echo json_encode($categories);
    }

    public function getCategoryModels($id)
    {
        $categories = Products::select('id','name','thumbnail','sku')->where('category_id',$id)->get();

        echo json_encode($categories);
    }

    // public function addToCompare(Request $request)
    // {
    //     $compare = array();

    //     if(Session::get('compare'))
    //     {
    //         $compare = Session::get('compare');
    //         $product = Products::where('id',$request->product_id)->first();
    //         $category = Products::select('id','category_id')->whereIn('id',$compare)->first()->toArray();
    //         if($product){
    //             if($product->category_id == $category->category_id){
    //                 array_push($compare, $request->product_id);
    //             }
    //             else{
    //                 $compare = array();
    //                 Session::forget('compare');
    //                 $compare[] = $request->product_id;
    //             }
    //         }
    //     }
    //     else
    //     {
    //         // dd(1);
    //         $compare[] = $request->product_id;
    //     }
    //    Session::put('compare', $compare);
    //    $compare = Session::get('compare');

    //     $products = Products::select('name','slug','thumbnail')->whereIn('id',$compare)->get();

    //     echo json_encode($products);
    // }
    public function addToCompare(Request $request)
    {
        if(!is_null(Session::get('compare')))
        {
            $compare = array();
            $compare = Session::get('compare');

            $product = Products::where('id',$request->product_id)->first();
            $category = Products::select('id','category_id')->whereIn('id',$compare)->first();

            if($product)
            {
                if($product->category->parent_id == $category->category->parent_id)
                {
                    array_push($compare,$request->product_id);
                } else {
                    Session::forget('compare');
                    $compare = array($request->product_id);
                }
            }
        } else {
            $compare = array($request->product_id);
        }

        Session::put('compare', $compare);
        $compare = Session::get('compare');

        $products = Products::select('name','slug','thumbnail')->whereIn('id',$compare)->get();

        echo json_encode($products);
    }

    public function clearCompare()
    {
        Session::forget('compare');

        echo 1;
    }

    public function compare()
    {
        $compare = Session::get('compare');

        $products = Products::with('attributes')->whereIn('id',$compare)->get();
        $categories = $products->pluck('category_id')->toArray();

        $attributes = CategoryAttributes::with('attribute')->whereIn('category_id',$categories)->get()->toArray();

        $attribute_list = array();

        foreach ($attributes as $attr)
        {
            $attribute_list[] = array(
                'id' => $attr['id'],
                'name' => $attr['attribute']['name']
            );
        }

        $compare_options = array();

        foreach ($products as $key => $value)
        {
            $attribute_array = array();
            $attribute = $value->attributes->toArray();

            foreach ($attributes as $value1)
            {
                $key1 = array_search($value1['attribute_id'], array_column($attribute, 'attribute_id'));

                if($key1 !== false)
                    $attribute_array[$value1['attribute_id']] = $attribute[$key1]['value'];
                else
                    $attribute_array[$value1['attribute_id']] = '---';
            }

            $compare_options[] = array(
                'name' => $value->name,
                'image' => $value->thumbnail,
                'attributes' => $attribute_array
            );
        }

        $banner = Pages::where('slug','product-offer')->first();

        return view('products::front.compare', compact('compare_options','attribute_list','banner'));
    }


    public function productRegister()
    {
       return redirect('https://impexappliances.com/sa');
      //  $states = State::where('country_id',101)->get();
        //$banner = Pages::where('slug','product-registration')->first();
       // $products=(new Products())->productListByType();
       // $categories=(new Categories())->listFirstChildCategories();

       // return view('products::front.productRegister',compact('states','banner','products','categories'));
    }

    public function storeProductRegister(Request $request)
    {

        // $this->validateStore($request);
    if($request->product_page==1){
    $request->validate([
        'g-recaptcha-response' => 'required|captcha',
        'document'=>'required',
        'category_id'=>'required',
        'product_id'=>'required',
        'first_name'=>'required',
        'email'=>'required',
        'address_1'=>'required',
        'address_2'=>'required',
        'district'=>'required',
        'state'=>'required',
        'pincode'=>'required',
        'mobile'=>'required'
    ]);
    $product = Products::where('id',$request->product_id)->first();
    if($product == null)
    {
        return redirect()->back()->withInput($request->input())->with('message_invalid', 'Please select a Product.');
    }

    $register = new ProductRegistration;
    // $register->model_number = $request->model_number;
    $register->category_id = $request->category_id;
    $register->product_id = $request->product_id;
    $register->serial_number = $request->serial_number;
    $register->first_name = $request->first_name;
    $register->last_name = $request->last_name;
    $register->email = $request->email;
    $register->mobile = $request->mobile;
    $register->address_1 = $request->address_1;
    $register->address_2 = $request->address_2;
    $register->district = $request->district;
    $register->state = $request->state;
    $register->pincode = $request->pincode;
    $register->unit = '';
    $register->purchased_date = date('Y-m-d',strtotime($request->purchased_date));
    $register->purchased_from = $request->purchased_from;
    $register->document = $request->file('document')->store('product_register');
    $register->save();
    $settings= Settings::first();
    $email=$settings->product_register_mail;
    $product=(new ProductRegistration())->productRegistrationDetailById($register->id);
    Mail::to($email)->send(new ProductRegisterMail($product));
    Session::flash('message', 'Product registered successfully.');
    Session::flash('alert-class', 'alert-success');
}
else{
    $request->validate([
        'g-recaptcha-response' => 'required|captcha',
        // 'first_name'=>'required',
        // 'email'=>'required',
        // 'address_1'=>'required',
        // 'address_2'=>'required',
        // 'district'=>'required',
        // 'state'=>'required',
        // 'pincode'=>'required',
        // 'mobile'=>'required'
    ]);
    $extension=(new WarrantyExtension())->storeWarranty($request);
    $warranty=(new WarrantyExtension())->warrantyExtensionDetailById($extension->id);

    $settings= Settings::first();
    $email=$settings->waranty_extension_mail;
    // dd($email);
    if($email){
        Mail::to($email)->send(new WarrantyExtensionMail($warranty));

    }
    Session::flash('message', 'Successfully Submitted' );
    Session::flash('alert-class', 'alert-success');
}


        return redirect('productRegister');
    }


    public function productFeedback()
    {
        $products = Products::whereIn('type',array(0,2))->where('is_active',1)->get();
        $categories = Categories::where('parent_id',0)->get();
        $states = State::where('country_id',101)->get();
        $banner = Pages::where('slug','product-feedback')->first();

        return view('products::front.productFeedback',compact('products','categories','states','banner'));
    }

    public function storeProductFeedback(Request $request)
    {
        $request->validate([
            'g-recaptcha-response' => 'required|captcha',
            // 'attachment'=>'required'
        ]);

        $product = Products::with('category')->find($request->product_id);
        // dd($product->category->name);

        $register = new ProductFeedback;
        $register->product_id = $request->product_id;
        $register->product_model = $product->sku;
        $register->product_type = $product->category->name;
        $register->serial_number = $request->serial_number;
        $register->first_name = $request->first_name;
        $register->last_name = $request->last_name;
        $register->email = $request->email;
        $register->mobile = $request->mobile;
        $register->address_1 = $request->address_1;
        $register->address_2 = $request->address_2;
        $register->district = $request->district;
        $register->state = $request->state;
        $register->pincode = $request->pincode;
        $register->feedback_subject = $request->subject;
        $register->feedback_description = $request->message;
        if($request->attachment != null)
        {
            $register->attachment = $request->file('attachment')->store('product_feedback');
        }
        $register->save();
        $settings= Settings::first();
        $email=$settings->product_feedback_mail	;
        $product=(new ProductFeedback())->productFeedbackDetailById($register->id);
        if($email){
            Mail::to($email)->send(new ProductFeedbackMail($product));
        }

        Session::flash('message', 'Feedback registered successfully.');
        Session::flash('alert-class', 'alert-success');

        return redirect('productFeedback');
    }

    public function postReview(Request $request)
    {
        // dd($request->review_product_id);
        $review = new ProductReviews;
        // $review->product_id = $request->product_id;
        $review->product_id = $request->review_product_id;
        $review->name = $request->name;
        $review->title = $request->title;
        $review->rating = $request->rating;
        $review->review = $request->review;
        if($request->image)
            $review->image = $request->file('image')->store('review');
        $review->save();

        Session::flash('message', 'Thank you for spending time for the review.');
        Session::flash('alert-class', 'alert-success');

        return redirect('products/detail/'.$request->product_slug);
    }
    ///////////////////Validation///////////////////////////////////////
    function validateStore($request)
    {
       return  $data =  $request->validate([
            'warranty_first_name'      => 'required',
            'policy'      => 'required',
            'g-recaptcha-response' => 'required|captcha',
            'warranty_last_name'=>'required',
            'warranty_mobile'=>'required' ,
            'warranty_email'=>'required',
            'warranty_product_id'=>'required',
            'warranty_model'=>'required',
            'warranty_purchase_from'=>'required',
            'warranty_invoice'=>'required',

        ]);
    }
}

<?php

namespace Modules\Pages\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\Offers\Entities\Offers;
use Modules\Offers\Entities\OfferInterests;
use Modules\Banners\Entities\Banners;
use Modules\Pages\Entities\HomeDesign;
use Modules\Pages\Entities\Management;
use Modules\Pages\Entities\Milestone;
use Modules\Pages\Entities\Award;
use Modules\Pages\Entities\CoreValues;
use Modules\Pages\Entities\Pages;
use Modules\Products\Entities\Products;
use Modules\Categories\Entities\Categories;
use Modules\LatestVideos\Entities\LatestVideos;
use Modules\Settings\Entities\Settings;
use Modules\Pages\Entities\Brands;
use Modules\MediaCenter\Entities\MediaCenter;
use Modules\Vendor\Entities\Vendor;
use Modules\Banners\Entities\AboutBanner;
use Modules\WarrantyExtension\Entities\State;

use Session,DB,Str;

class PagesController extends Controller
{
    public function home()
    {
        $banners = Banners::where('status',1)->orderBy('prioritise','asc')->get();
        $block = HomeDesign::with('categories')->where('type',1)->orderBy('position')->has('categories')->get();

        $pop_offer = Offers::with('products')->where('from_date','<=',date('Y-m-d'))->where('to_date','>=',date('Y-m-d'))->first();
        $flagship = Categories::with(['products' => function ($q) {
                                    // $q->orderBy('flagship_time','asc');
                                    $q->with('online');
                                    $q->where('is_flagship',1);
                                    $q->where('is_active',1);
                                    $q->whereIn('type',array(0,2));

                                }])
                                ->whereHas('products', function($q) {
                                    $q->where('is_flagship',1);
                                    $q->where('is_active',1);
                                    $q->whereIn('type',array(0,2));

                                })->limit(5)
                                ->orderBy('flagship_time','asc')
                                ->get();
                                // dd($flagship[0]->products);
        $other = HomeDesign::with('homeDesignSubcategory.categories')->where('type',5)->orderBy('position')->has('homeDesignSubcategory')->has('homeDesignSubcategory')->groupBy('product_id')->orderBy('position')->get();
        $newest = HomeDesign::with('products.category','products.online','products.parent.online')->where('type',2)->orderBy('position')->has('products')->orderBy('position')->get();
        $popular = HomeDesign::with('products.category','products.online','products.parent.online')->where('type',3)->orderBy('position')->has('products')->orderBy('position')->get();
        $launch = HomeDesign::with('products.category.parent','products.online','products.parent.online')->where('type',4)->orderBy('position')->has('products')->orderBy('position')->get();
        $launch_category_ids = $launch->count() > 0?$launch->pluck('products')->pluck('category_id')->toArray() :array();
        $launch_categories_parent = Categories::with('parent')->whereIn('id',$launch_category_ids)->groupBy('parent_id')->get();
// dd($launch_categories);
    //    dd($launch_categories_parent['parent']);

        // $launch_categories_parent = Categories::with('children')->whereIn('id',$launch_categories->pluck('parent_id'))->get();
        $launchs = array();
        $launches_link=array();
        foreach($launch as $pdt)
        {
            $launchs[$pdt->products->category->parent->slug]['products'][] = $pdt->products;
            $launches_link[$pdt->product_id] = $pdt->learn_more;
        }
        $offers = HomeDesign::with('products.category','products.online','products.parent.online')->where('type',6)->orderBy('position')->has('products')->orderBy('position')->get();
        $latest = LatestVideos::all();
        $settings = Settings::first();
        $latest_blogs = Pages::where('slug','home-page-latest-blog')->first();
        $states = State::where('country_id',101)->get();
        return view('pages::front.home',compact('launch_categories_parent','settings','banners','block','pop_offer','flagship','other','newest','popular','launchs','offers','latest','latest_blogs','states','launches_link'));
    }

    public function imageUpload(Request $request)
    {
        $image = $request->file('file')->store('images');
        return storage_url().'/'.$image;
    }

    public function imageUploadOverview(Request $request)
    {
        $images = array();

        foreach($request->file() as $file)
        {
            $fileType = $file->getClientOriginalExtension();

            $org_name         =   $file->getClientOriginalName();
            $names                =   pathinfo($org_name, PATHINFO_FILENAME);
            $slug_name=Str::slug($names,'-');
            $certificateextension       =   $file->getClientOriginalExtension();
            $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
            $image_name = substr(str_shuffle($str_result), 0, 10);
            $imageToStore         =   $slug_name."-" . $image_name . '.' . $certificateextension;
            $image =$file->storeAs('product_overview', $imageToStore);
            // $industry->image  =   'awards/'.$imageToStore;

            // $image = $file->store('product_overview');
            $content = base64_encode(file_get_contents($file->path()));

            $image_name = explode('/',$image);

            $result[] = array(
                        'name'=>$image_name[1],
                        'type'=>'image',
                        'src'=>storage_url().'/'.$image,
                        'height'=>350,
                        'width'=>250
                );
        }

        return json_encode(array( 'data' => $result ));
    }

    public function postOfferInterest(Request $request)
    {
        $offer = new OfferInterests;
        $offer->offer_id = $request->offer_id;
        $offer->first_name = $request->first_name;
        $offer->last_name = $request->last_name;
        $offer->email = $request->email;
        $offer->phone = $request->phone;
        $offer->state = $request->state;
        $offer->city = $request->city;
        $offer->save();

        Session::flash('message', 'Interest send successfully' );
        Session::flash('alert-class', 'alert-success');

        return redirect('products/detail/'.$request->product_slug);
    }

    public function servicePolicy()
    {
        $page = Pages::where('slug','service-policy-charges-1')->first();
        $banner = Pages::where('slug','service-policy-charges')->first();

        return view('pages::front.service_policy',compact('page','banner'));
    }

    public function privacyPolicy()
    {
        $page = Pages::where('slug','privacy-policy')->first();

        return view('pages::front.privacyPolicy',compact('page'));
    }

    public function termsConditions()
    {
        $page = Pages::where('slug','terms-conditions')->first();

        return view('pages::front.termsConditions',compact('page'));
    }

    public function about()
    {
        $ids = array('overview','what-we-believe','our-history-images','our-history-content','our-mission','our-vision','manufacturing','techzone','our-milestone','our-management','our-values','our-team','awards','careers');

        $ids_ordered = implode(',', $ids);

        $page = Pages::whereIn('slug',$ids)->orderByRaw('FIELD(slug, "'.$ids_ordered.'")')->get();

        $milestones = Milestone::all();
        $managements = Management::all();
        $awards = Award::where('status',1)->get();
        $values = CoreValues::where('status',1)->get();


        $medias = MediaCenter::all();
        $brands = Brands::all();

        $banners = AboutBanner::all();

        return view('pages::front.about',compact('banners','page','milestones','managements','awards','medias','brands','values'));
    }

    public function contact()
    {
        $banner = Pages::where('slug','contact-us')->first();
        $settings = Settings::first();

        return view('pages::front.contact',compact('banner','settings'));
    }
    public function serviceSupport()
    {
        $banner = Pages::where('slug','register-complaint-on-1800')->first();

        return view('pages::front.service-support',compact('banner'));
    }
    public function productSupport()
    {
        $banner = Pages::where('slug','product-support')->first();

        return view('pages::front.product-support',compact('banner'));
    }
    public function warrantytermsConditions()
    {
        $page = Pages::where('slug','warranty-terms-condition')->first();
        $banner = Pages::where('slug','warranty-terms-conditions')->first();

        return view('pages::front.warranty-terms-conditions',compact('page','banner'));
    }
    public function newLaunchesProducts(Request $request)
    {
        // dd($request->id);
        $launch = HomeDesign::with('products.category','products.online','products.parent.online')->where('type',4)->orderBy('position','desc')->has('products')->orderBy('position')->get();
        $launch = Categories::with('products.category','products.online','products.parent.online')->where('type',4)->orderBy('position','desc')->has('products')->orderBy('position')->get();

        $childSubCategories=(new Categories())->listChildCategories($request->id);
dd($childSubCategories);
    }

}


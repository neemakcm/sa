<?php

namespace Modules\WarrantyExtension\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Pages\Entities\Pages;
use Modules\Products\Entities\Products;
use Modules\WarrantyExtension\Entities\State;
use Modules\WarrantyExtension\Entities\WarrantyExtension;
use Session,DB;
use Modules\Settings\Entities\Settings;

use Modules\Categories\Entities\Categories;
use App\Mail\WarrantyExtensionMail;
use Mail;

class WarrantyExtensionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $banner = Pages::where('slug','warranty-extensionamc')->first();
        $products=(new Products())->productListByType();
        $categories=(new Categories())->listFirstChildCategories();
        // $categories=(new Categories())->listIsLastChildCategories();
        $states=(new State())->IndianStateList();
        return view('warrantyextension::front.index',['categories'=>$categories,'products'=>$products,'states'=>$states,'banner'=>$banner]);
    }
    public function productModel(Request $request)
    {
        $model=(new Products())->productModel($request->id);
        echo json_encode($model);
    }
    public function categoryProduct(Request $request)
    {
        $categories=(new Categories())->listChildCategories($request->id);
        $category_id=$categories->pluck('id');
        if($category_id->count() >0)
        {
            $product=(new Products())->listProductsByCatId($category_id);
        }
        else{
            $product=(new Products())->listProductsBySingleCatId($request->id);
        }
        echo json_encode($product);
        // $product=(new Products())->listProductsBySingleCatId($request->id);
        // echo json_encode($product);
    }
    public function store(Request $request)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->validateStore($request);
        $extension=(new WarrantyExtension())->storeWarranty($request);
        $settings= Settings::first();
        $email=$settings->waranty_extension_mail;
        if($email){
            Mail::to($email)->send(new WarrantyExtensionMail($extension));
        }
        Session::flash('message', 'Successfully Submitted' ); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }
    ///////////////////Validation///////////////////////////////////////
    function validateStore($request)
    {
       return  $data =  $request->validate([
            'first_name'      => 'required',
            'policy'      => 'required',
            'g-recaptcha-response' => 'required|captcha',
            'last_name'=>'required',
            'mobile'=>'required' ,
            'email'=>'required',
            'product_id'=>'required',
            'model'=>'required',
            'purchase_from'=>'required',
            'invoice'=>'required',

        ]);
    }

}

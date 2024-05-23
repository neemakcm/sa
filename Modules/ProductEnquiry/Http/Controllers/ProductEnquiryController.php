<?php

namespace Modules\ProductEnquiry\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Pages\Entities\Pages;
use Modules\Products\Entities\Products;
use Modules\WarrantyExtension\Entities\State;
use Modules\ProductEnquiry\Entities\ProductEnquiry;
use Session;
use Modules\Categories\Entities\Categories;

class ProductEnquiryController extends Controller
{
    public function index()
    {
        $products=(new Products())->productListByType();
        $states=(new State())->IndianStateList();
        $banner = Pages::where('slug','product-enquiry')->first();
        // $categories=(new Categories())->listIsLastChildCategories();
        $categories=(new Categories())->listFirstChildCategories();

        return view('productenquiry::front.index',['categories'=>$categories,'products'=>$products,'states'=>$states,'banner'=>$banner]);
    }
   
    public function store(Request $request)
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->validateStore($request);
        // dd(1);
        $model=(new ProductEnquiry())->storeProductEnquiry($request);
        Session::flash('message', 'Successfully Submitted' ); 
        Session::flash('alert-class', 'alert-success');
        return redirect()->back();
    }
    function validateStore($request)
    {
       return  $data =  $request->validate([
            'first_name'      => 'required',
            'agree'      => 'required',
            'g-recaptcha-response' => 'required|captcha',
            'last_name'=>'required',
            'mobile'=>'required' ,
            'email'=>'required',
            'product_id'=>'required',
            'model'=>'required',
            'enquiry_type'=>'required',

        ]);
    }
}

<?php

namespace Modules\EscalateToService\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Session;
use Modules\Pages\Entities\Pages;
use Modules\Products\Entities\Products;
use Modules\WarrantyExtension\Entities\State;
use Modules\EscalateToService\Entities\EscalateToService;
use Modules\Categories\Entities\Categories;
use Modules\Settings\Entities\Settings;

use App\Mail\EscalateToServiceHeadMail;
use Mail;
class EscalateToServiceController extends Controller
{
    
    public function index()
    {
        $categories=(new Categories())->listFirstChildCategories();
        $banner = Pages::where('slug','escalate-to-service-head')->first();
        $products=(new Products())->productListByType();
        $states=(new State())->IndianStateList();
        return view('escalatetoservice::front.index',['categories'=>$categories,'products'=>$products,'states'=>$states,'banner'=>$banner]);
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
    }
    public function productModel(Request $request)
    {
        $model=(new Products())->productModel($request->id);
        echo json_encode($model);
    }
    public function store(Request $request)
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->validateStore($request);
        $escalate=(new EscalateToService())->storeEscalateToService($request);
        $settings= Settings::first();
        $email=$settings->escalate_to_service_mail;
        $service=(new EscalateToService())->escalateServiceDetailById($escalate->id);
        if($email){
            Mail::to($email)->send(new EscalateToServiceHeadMail($service));
        }
        
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
            // 'model'=>'required',
            'purchase_from'=>'required',
            // 'invoice'=>'required',
            'subject'=>'required',
            'message'=>'required',

        ]);
    }
}

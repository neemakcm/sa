<?php

namespace Modules\SalesEnquiry\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Settings\Entities\Settings;
use Modules\Pages\Entities\Pages;
use Modules\Products\Entities\Products;
use Modules\WarrantyExtension\Entities\State;
use Modules\SalesEnquiry\Entities\SalesEnquiry;
use Session;

use App\Providers\MailConfigServiceProvider;
use App\Mail\BussinessEnguiryMail;
use Mail;
class SalesEnquiryController extends Controller
{
    
    public function index()
    {
        $banner = Pages::where('slug','bussiness-enquiry')->first();
        $products=(new Products())->productListByType();
        $states=(new State())->IndianStateList();
        return view('salesenquiry::front.index',['products'=>$products,'states'=>$states,'banner'=>$banner]);
    }
   
    public function store(Request $request)
    {
        // DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->validateStore($request);
        // dd(1);
        $enquiry=(new SalesEnquiry())->storeSalesEnquiry($request);
        $settings= Settings::first();
        if($request->enquiry_type=='Institutional/Corporate Gifting' || $request->enquiry_type=='Dealership/Distribution Enquiry'){
            if($request->enquiry_type=='Institutional/Corporate Gifting'){
                $email=$settings->institution_dealership_email;
            }
            else{
                $email=$settings->institution_dealership_email;
                $emails=$settings->dealer_email;
                if($emails){
                    Mail::to($emails)->send(new BussinessEnguiryMail($enquiry));
                }
            }
        }
        else{
            $email=$settings->otheremail;
        }
        if($email){
            Mail::to($email)->send(new BussinessEnguiryMail($enquiry));
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
            'invoice'=>'required',
            'enquiry_type'=>'required',

        ]);
    }
}

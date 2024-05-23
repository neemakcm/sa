<?php

namespace Modules\Service\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\Service\Entities\ServiceCenter;
use Modules\Service\Entities\ServiceStatus;
use Modules\Service\Entities\ServiceRequest;
use Modules\Service\Entities\ServiceFeedback;
use Modules\Categories\Entities\Categories;
use Modules\Pages\Entities\Pages;
use Modules\Products\Entities\Products;
use Modules\WarrantyExtension\Entities\State;
use Modules\Settings\Entities\Settings;
use App\Mail\ServiceFeedbackMail;
use Mail;
use Session,DB;

class ServiceController extends Controller
{
    public function index()
    {
        $categories = Categories::whereHas('children', function($q){
                                    $q->where('is_last_child',1);
                                })->get();

        $states = State::where('country_id',101)->get();
        $banner = Pages::where('slug','request-service')->first();

        return view('service::front.index',compact('categories','states','banner'));
    }

    public function requestService(Request $request)
    {
        $request->validate([
            'g-recaptcha-response' => 'required|captcha',
            'proof'=>'required'

        ]);

        $product = Products::where('sku',$request->model_number)->first();

        if($product == null)
        {
            return redirect()->back()->withInput($request->input())->with('message_invalid', 'Invalid Model Number.');
        }

        $service = new ServiceRequest;
        $service->product_id = $product->id;
        $service->reference_number = 'REF'.strtotime(now());
        $service->complaint_id = 'CMP'.strtotime(now());
        $service->model_number = $request->model_number;
        $service->service_type = $request->service_type;
        $service->serial_number = $request->serial_number;
        $service->purchased_date = date('Y-m-d',strtotime($request->purchased_date));
        $service->warranty_type = $request->warranty_type;
        $service->proof = $request->file('proof')->store('service_request');
        $service->description = $request->description;
        $service->first_name = $request->first_name;
        $service->last_name = $request->last_name;
        $service->email = $request->email;
        $service->mobile = $request->mobile;
        $service->address_1 = $request->address_1;
        $service->address_2 = $request->address_2;
        $service->district = $request->district;
        $service->state = $request->state;
        $service->pincode = $request->pincode;
        $service->save();

        Session::flash('message', 'Request posted successfully. Your refrence number is '.$service->reference_number ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('service');
    }

    public function track()
    {
        $banner = Pages::where('slug','track-your-service-request')->first();

        return view('service::front.track',compact('banner'));
    }

    public function trackService(Request $request)
    {
        $case = ServiceRequest::with(['requestStatus' => function($q)
                                {
                                    $q->orderBy('created_at', 'desc');
                                }])
                                ->where('complaint_id',$request->case_id)->first();

        if($case == null)
            echo json_encode(array('status'=>false,'message'=>'Wrong Case Number or the case number you entered is non-registered'));
        else
            echo json_encode(array('status'=>true,'message'=>$case->requestStatus));
    }

    public function centers()
    {
        $states = ServiceCenter::select('state')->groupBy('state')->get();
        $banner = Pages::where('slug','find-service-centers')->first();

        $centers = ServiceCenter::all();

        return view('service::front.centers',compact('states','centers','banner'));
    }

    public function getStateDistricts($state)
    {
        $districts = ServiceCenter::select('district')->where('state',$state)->groupBy('district')->get();

        echo json_encode($districts);
    }

    public function serviceFeedback()
    {
        $banner = Pages::where('slug','service-feedback')->first();

        return view('service::front.serviceFeedback',compact('banner'));
    }

    public function storeServiceFeedback(Request $request)
    {
        $request->validate([
            'g-recaptcha-response' => 'required|captcha'
        ]);

        $feedback = new ServiceFeedback;
        $feedback->first_name = $request->first_name;
        $feedback->last_name = $request->last_name;
        $feedback->email = $request->email;
        $feedback->mobile = $request->mobile;
        $feedback->case_number = $request->case_number;
        if($request->attachment)
            $feedback->attachment = $request->file('attachment')->store('service_feedback');
        $feedback->is_fixed = $request->is_fixed;
        $feedback->rating = $request->rating;
        $feedback->comments = $request->comments;
        $feedback->save();
        $settings= Settings::first();
        $email=$settings->service_feedback_mail;
        if($email){
            Mail::to($email)->send(new ServiceFeedbackMail($feedback));
        }
        
        Session::flash('message', 'Feedback registered successfully'); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('serviceFeedback');
    }
    public function mapContent(Request $request)
    {
        $centers = ServiceCenter::whereIn('id',explode(',',$request->id))->get();

        echo json_encode($centers);
    }
    
    public function districtDrop(Request $request)
    {
        $points = ServiceCenter::whereNotNull('id');
        if($request->state!='all' && $request->district!='all')
        {
            $points =$points->where('district',$request->district);
        }
        else{
            if($request->state!='all' && $request->district=='all')
            {
                $points =$points->where('state',$request->state);
            }
        }
        $points =$points->get();
        echo json_encode($points);
    }
}

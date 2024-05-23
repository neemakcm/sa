<?php

namespace Modules\Service\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\Service\Entities\ServiceStatus;
use Modules\Service\Entities\ServiceRequest;
use Modules\Service\Entities\ServiceFeedback;
use App\Exports\ServiceFeedbackexport;
use App\Exports\ServiceRequestexport;

use Maatwebsite\Excel\Facades\Excel;
use Session,DB;

class AdminServiceController extends Controller
{
    public function index()
    {
        return view('service::admin.index');
    }

    public function list(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;

        $category = ServiceRequest::select('*',DB::raw('DATE_FORMAT(DATE_ADD(created_at, INTERVAL "5:30" HOUR_MINUTE),"%Y-%c-%d") as change_date'))
                                    ->with('product')
                                    ->with(['requestStatus' => function($q)
                                    {
                                        $q->orderBy('created_at', 'desc');
                                    }]);
        if($request->from_date)
        {
            $category->whereDate('created_at','>=',$request->from_date)->whereDate('created_at','<=',$request->to_date);
            
        }
        if ($search != '') 
        {
            $category->where('first_name', 'LIKE', '%'.$search.'%');
            $category->orWhere('last_name', 'LIKE', '%'.$search.'%');
            $category->orWhere('mobile', 'LIKE', '%'.$search.'%');
            $category->orWhere('model_number', 'LIKE', '%'.$search.'%');
            $category->orWhere('service_type', 'LIKE', '%'.$search.'%');
            $category->orWhere('complaint_id', 'LIKE', '%'.$search.'%');
            $category->orWhere('reference_number', 'LIKE', '%'.$search.'%');
            $category->orWhereHas('product', function($q) use($search)
                        {
                            $q->where('name', 'LIKE', '%'.$search.'%');
                        });
            $category->orWhereHas('requestStatus', function($q) use($search)
                        {
                            $q->where('status', 'LIKE', '%'.$search.'%');
                        });
        }

        $total  = $category->count();

        $result['data'] = $category->has('product')->orderBy('id','desc')->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }

    public function view($id)
    {
        $request = ServiceRequest::with('product.category','requestStatus')->has('product')->find($id);

        return view('service::admin.view',compact('request'));
    }

    public function updateComplaint(Request $request)
    {
        $complaint = ServiceRequest::find($request->id);
        $complaint->complaint_number = $request->complaint_number;
        $complaint->save();

        Session::flash('message', 'Entry updated successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/service');
    }

   


    public function feedback()
    {
        return view('service::admin.feedback');
    }

    public function feedbackList(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;

        $category = ServiceFeedback::select('*',DB::raw('DATE_FORMAT(DATE_ADD(created_at, INTERVAL "5:30" HOUR_MINUTE),"%Y-%c-%d") as change_date'));

        if ($search != '') 
        {
            $category->where('first_name', 'LIKE', '%'.$search.'%');
            $category->orWhere('last_name', 'LIKE', '%'.$search.'%');
            $category->orWhere('mobile', 'LIKE', '%'.$search.'%');
            $category->orWhere('case_number', 'LIKE', '%'.$search.'%');

            if(strtolower($search) == 'very good')
                $category->orWhere('rating',5);
            else if(strtolower($search) == 'good')
                $category->orWhere('rating',4);
            else if(strtolower($search) == 'average')
                $category->orWhere('rating',3);
            else if(strtolower($search) == 'bad')
                $category->orWhere('rating',2);
            else
                $category->orWhere('rating',1);
        }

        $total  = $category->count();

        $result['data'] = $category->orderBy('id','desc')->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }

    public function feedbackView($id)
    {
        $request = ServiceFeedback::find($id);

        return view('service::admin.feedbackView',compact('request'));
    }

    public function feedbackExport()
    {
        $request = ServiceFeedback::all();

        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="Service feedback.csv";');

        $columns = array('Name','Mobile','Email','Case Number','Was your issue fixed?','Overall, how satisfied are you with the service provided?','Additional comments');

        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach($request as $value) {
            if($value->rating == 1)
                $rate = 'Very Bad';
            else if($value->rating == 2)
                $rate = 'Bad';
            else if($value->rating == 3)
                $rate = 'Average';
            else if($value->rating == 4)
                $rate = 'Good';
            else
                $rate = 'Very Good';
            fputcsv($file, array($value->first_name.' '.$value->last_name,$value->mobile,$value->email,$value->case_number,$value->is_fixed == 1?'Yes':'No',$rate,$value->comments));
        }
       
    }
    public function feedbackListPost(Request $request)
    {
        // dd($request->search);
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;

        $category = ServiceFeedback::select('*',DB::raw('DATE_FORMAT(DATE_ADD(created_at, INTERVAL "5:30" HOUR_MINUTE),"%Y-%c-%d") as change_date'));
        if($request->from_date)
        {
            $category= $category->whereDate('created_at','>=',$request->from_date)->whereDate('created_at','<=',$request->to_date);
           
        }
        if ($search != '') 
        {
            $category= $category->where('first_name', 'LIKE', '%'.$search.'%')->orWhere('last_name', 'LIKE', '%'.$search.'%')
            ->orWhere('mobile', 'LIKE', '%'.$search.'%')
            ->orWhere('case_number', 'LIKE', '%'.$search.'%');

            if(strtolower($search) == 'very good')
            $category= $category->orWhere('rating',5);
            else if(strtolower($search) == 'good')
            $category= $category->orWhere('rating',4);
            else if(strtolower($search) == 'average')
            $category= $category->orWhere('rating',3);
            else if(strtolower($search) == 'bad')
            $category= $category->orWhere('rating',2);
            
        }

        $total  = $category->count();

        $result['data'] = $category=$category->orderBy('id','desc')->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;
// dd($category);
        echo json_encode($result);
    }
    public function servicefeedbackExport(Request $request)
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
    return (new ServiceFeedbackexport($request->from_date,$request->to_date))->download('service-feedback.xlsx');
    // return Excel::download(new ServiceFeedbackexport, 'users.xlsx');
    ob_flush();
    }
    public function serviceExport(Request $request)
    {
        $start = $request->from_date;
        $end = $request->to_date;
        ob_end_clean();
        ob_start();
        return (new ServiceRequestexport($request->from_date,$request->to_date))->download('service-request.xlsx');
        ob_flush();
        // $request = ServiceRequest::select('*',DB::raw('DATE_FORMAT(DATE_ADD(created_at, INTERVAL "5:30" HOUR_MINUTE),"%Y-%c-%d") as change_date'))->with('product.category','requestStatus')->has('product')->get();

        // header('Content-Type: application/csv');
        // header('Content-Disposition: attachment; filename="Service request.csv";');

        // $columns = array('Complaint ID','Reference Number','complaint Number','Date','Service Type','Product Name','Model Number','Category','Serial Number','Purchase Date','Warranty Type','Upload Proof of Purchase','Description','Name','Mobile','Email','Address 1','Address 2','District/City/Town','State','Pin Code');

        // $file = fopen('php://output', 'w');
        // fputcsv($file, $columns);

        // foreach($request as $value) {
        //     fputcsv($file, array($value->complaint_id,$value->reference_number,$value->complaint_number,$value->change_date,$value->service_type,$value->product->name,$value->model_number,$value->product->category == null?'---':$value->product->category->name,$value->serial_number,$value->purchased_date,$value->warranty_type,storage_url().'/'.$value->proof,$value->description,$value->first_name.' '.$value->last_name,$value->mobile,$value->email,$value->address_1,$value->address_2,$value->district,$value->state,$value->pincode));
        // }
    }
}
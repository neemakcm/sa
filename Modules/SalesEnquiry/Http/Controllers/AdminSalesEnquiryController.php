<?php

namespace Modules\SalesEnquiry\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SalesEnquiry\Entities\SalesEnquiry;
use App\Exports\SalesEnquiryexport;

class AdminSalesEnquiryController extends Controller
{
    public function index()
    {
        return view('salesenquiry::admin.index');
    }
    public function list(Request $request)
    {
        $enquiry=(new SalesEnquiry())->listSalesEnquiry($request);
        echo json_encode($enquiry);
    }
    public function show($id)
    {
        $enquiry=(new SalesEnquiry())->salesEnquiryDetailById($id);
        return view('salesenquiry::admin.view',compact('enquiry'));
    }

    public function export($request)
    {
        $warranty = SalesEnquiry::with('states');
        if($request->from_date)
        {
            $warranty= $warranty->whereDate('created_at','>=',$request->from_date)->whereDate('created_at','<=',$request->to_date);
           
        }
        $warranty= $warranty->get();
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="Sales enquiry.csv";');

        $columns = array('Name','Mobile','Email','Address 1','Address 2','District/City/Town','State','Pincode','Enquiry Type','Message','Invoice / Warranty Card');

        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach($warranty as $value) {
            fputcsv($file, array($value->first_name.' '.$value->last_name,$value->mobile,$value->email,$value->address_1,$value->address_2,$value->district,$value->states->name,$value->pincode,$value->enquiry_type,$value->message,storage_url().'/'.$value->invoice));
        }
    }
    public function salesExport(Request $request)
    {
        $start = $request->from_date;
        // dd($start);
        $end = $request->to_date;
        ob_end_clean();
        ob_start();
        return (new SalesEnquiryexport($request->from_date,$request->to_date))->download('sales-enquiry.xlsx');
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

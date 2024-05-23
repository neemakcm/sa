<?php

namespace Modules\ProductEnquiry\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\ProductEnquiry\Entities\ProductEnquiry;
use Session;
class AdminProductEnquiryController extends Controller
{
    public function index()
    {
        return view('productenquiry::admin.index');
    }
    public function list(Request $request)
    {
        $product_enquiry=(new ProductEnquiry())->listProductEnquiry($request);
        echo json_encode($product_enquiry);
    }
    public function show($id)
    {
        $enquiry=(new ProductEnquiry())->productEnquiryDetailById($id);
        return view('productenquiry::admin.view',compact('enquiry'));
    }

    public function export()
    {
        $warranty = ProductEnquiry::with('products','states')->get();

        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="Product enquiry.csv";');

        $columns = array('Name','Mobile','Email','Address 1','Address 2','District/City/Town','State','Product','Model Number','Enquiry Type','Message');

        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach($warranty as $value) {
            fputcsv($file, array($value->first_name.' '.$value->last_name,$value->mobile,$value->email,$value->address_1,$value->address_2,$value->district,$value->states->name,$value->products->name,$value->model_number,$value->enquiry_type,$value->message));
        }
    }
}

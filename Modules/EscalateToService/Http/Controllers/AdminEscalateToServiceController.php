<?php

namespace Modules\EscalateToService\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\EscalateToService\Entities\EscalateToService;

class AdminEscalateToServiceController extends Controller
{
   /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('escalatetoservice::admin.index');
        // return view('warrantyextension::index');
    }
    public function list(Request $request)
    {
        $escalate_service=(new EscalateToService())->listEscalateService($request);
        echo json_encode($escalate_service);
    }
    public function show($id)
    {
        $service=(new EscalateToService())->escalateServiceDetailById($id);
        return view('escalatetoservice::admin.view',compact('service'));
    }
    public function export()
    {
        $service= EscalateToService::with('products','states')->get();

        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="Escalate to service.csv";');

        $columns = array('Name','Mobile','Email','Address 1','Address 2','District/City/Town','State','Pin Code','Product','Model Number','Purchase Date','Subject','Message','Invoice / Warranty Card');

        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach($service as $value) {
            fputcsv($file, array($value->first_name.' '.$value->last_name,$value->mobile,$value->email,$value->address_1,$value->address_2,$value->district,$value->states == null?'---':$value->states->name,$value->pincode,$value->products != null?$value->products->name:'---',$value->model_number,$value->purchased_date,$value->subject,$value->message,storage_url().'/'.$value->invoice));
        }


    }
}

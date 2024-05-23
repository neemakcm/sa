<?php

namespace Modules\WarrantyExtension\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\WarrantyExtension\Entities\WarrantyExtension;

class AdminWarrantyExtensionController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('warrantyextension::admin.index');
    }
    public function list(Request $request)
    {
        $warrantyExtension=(new WarrantyExtension())->listWarrantyExtension($request);
        echo json_encode($warrantyExtension);
    }
    public function show($id)
    {
        $warranty=(new WarrantyExtension())->warrantyExtensionDetailById($id);
        return view('warrantyextension::admin.view',compact('warranty'));
    }
    public function export()
    {
        $warranty = WarrantyExtension::with('products','states')->get();

        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename="Warranty extension.csv";');

        $columns = array('Name','Mobile','Email','Address 1','Address 2','District/City/Town','State','Pin Code','Product','Model Number','Purchase Date','Purchased From','Serial Number','Invoice / Warranty Card');

        $file = fopen('php://output', 'w');
        fputcsv($file, $columns);

        foreach($warranty as $value) {
            fputcsv($file, array($value->first_name.' '.$value->last_name,$value->mobile,$value->email,$value->address_1,$value->address_2,$value->district,$value->states->name,$value->pincode,$value->products != null?$value->products->name:'---',$value->model_number,$value->purchased_date,$value->purchased_from,$value->serial_number,storage_url().'/'.$value->invoice));
        }
    }

}

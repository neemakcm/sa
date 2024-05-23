<?php

namespace Modules\Vendor\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Session,DB;
use Image,File;

use Modules\Vendor\Entities\Vendor;
class AdminVendorController extends Controller
{
    public function index()
    {
        return view('vendor::admin.index');
    }
    public function list(Request $request)
    {
        $vendor=(new Vendor())->listVendor($request);
        echo json_encode($vendor);
    }

    public function add()
    {
        return view('vendor::admin.add');
    }

    public function store(Request $request)
    {
        $this->validateVendor($request);
        $vendor = new Vendor;
        $vendor->name = $request->name;
        $vendor->link = $request->link;
        $vendor->image = $request->file('image')->store('vendor');
        $vendor->save();
        
        Vendor::createThumbnail($vendor);
        
        Session::flash('message', 'Entry updated successfully' ); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/vendor');
    }

    public function edit($id)
    {
        $vendor=(new Vendor())->vendorDetailById($id);
        return view('vendor::admin.edit',compact('vendor'));
    }

    public function update(Request $request)
    {
        $this->validateVendorUpdate($request);
        $vendor=(new Vendor())->vendorDetailById($request->id);
        $vendor->name = $request->name;
        $vendor->link = $request->link;

        if($request->image)
        {
            $vendor->image = $request->file('image')->store('vendor');
        }
        $vendor->save();

        Vendor::createThumbnail($vendor);

        Session::flash('message', 'Entry updated successfully' ); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/vendor');
    }

    public function delete($id)
    {
        $vendor = Vendor::find($id);
        $vendor->delete();

        Session::flash('message', 'Entry deleted successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/vendor');
    }

    function validateVendor($request)
    {
       return  $data =  $request->validate([
            'name'      => 'required|unique:vendors,name',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            
        ]);
    }
    function validateVendorUpdate($request)
    {
       return  $data =  $request->validate([
            'name'      => 'required|unique:vendors,name,'.$request->id,
            
        ]);
    }
}

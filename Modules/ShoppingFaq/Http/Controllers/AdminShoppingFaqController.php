<?php

namespace Modules\ShoppingFaq\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ShoppingFaq\Entities\ShoppingFaq;
use DB;
use Session;
class AdminShoppingFaqController extends Controller
{
    public function index()
    {
        return view('shoppingfaq::admin.index');
    }

    public function list(Request $request)
    {
        $faq=(new ShoppingFaq())->listShoppingFaq($request);
        echo json_encode($faq);
        
    }
    public function add()
    {
        return view('shoppingfaq::admin.add');
    }

    public function store(Request $request)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->validateStore($request);
        $faq=(new ShoppingFaq())->storeShoppingFaq($request);
        Session::flash('message', 'Entry added successfully' ); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/shopping-faq');
    }

    public function edit($id)
    {
        $faq=(new ShoppingFaq())->shoppingFaqDetailById($id);
        return view('shoppingfaq::admin.edit',compact('faq'));
    }

    public function update(Request $request)
    {
        $faq=(new ShoppingFaq())->shoppingFaqUpdate($request);
        Session::flash('message', 'Entry updated successfully' ); 
        Session::flash('alert-class', 'alert-success'); 
        return redirect('admin/shopping-faq');
    }

    public function delete(Request $request)
    {
        $faq=(new ShoppingFaq())->shoppingFaqDelete($request);
        Session::flash('message', 'Entry deleted successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/shopping-faq');
    }
     ///////////////////Validation///////////////////////////////////////
     function validateStore($request)
     {
        return  $data =  $request->validate([
             'question'      => 'required',
             'answer'      => 'required',
 
         ]);
     }
}

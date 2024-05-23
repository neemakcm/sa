<?php

namespace Modules\ShoppingFaq\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\ShoppingFaq\Entities\ShoppingFaq;

class ShoppingFaqController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
   
    public function index()
    {
        $faqs=(new ShoppingFaq())->shoppingFaqList();
// dd($faqs);
        return view('shoppingfaq::front.index',['faqs'=>$faqs]);
    }
    public function getFaqList(Request $request)
    {
        $faq=(new ShoppingFaq())->shoppingFaqList();
        return response()->json($faq);
    }
}

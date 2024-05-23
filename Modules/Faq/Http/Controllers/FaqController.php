<?php

namespace Modules\Faq\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\Faq\Entities\Faq;
use Modules\Pages\Entities\Pages;
use Modules\Products\Entities\ProductFaq;
use Modules\Categories\Entities\Categories;
class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $banner = Pages::where('slug','faq')->first();

        $faqCategories=(new Categories())->listIsLastChildCategories();
        return view('faq::front.index',['faqCategories'=>$faqCategories,'banner'=>$banner]);
    }
    public function getFaqList(Request $request)
    {
        $cat_id = $request->id;
        $productFaqs=(new Faq())->faqByCategoryId($cat_id);
        return response()->json($productFaqs);
    }
    
}

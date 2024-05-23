<?php

namespace Modules\UserManual\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Pages\Entities\Pages;
use Modules\UserManual\Entities\UserManual;
use Modules\Categories\Entities\Categories;
use Illuminate\Support\Facades\Crypt;
use Modules\Products\Entities\Products;

class UserManualController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $banner = Pages::where('slug','user-manuals')->first();

        $parentCategories=(new Categories())->listParentCategories();
        if($request->id)
        {
            $id = decrypt($request->id);
        }
        else{
            $id ="";
        }
        $childCategories=(new Categories())->listChildCategories($id);
        $child=$childCategories->pluck('id');
        $childSubCategories=(new Categories())->listSubChildCategories($child);
        $childSubCategories=(new Categories())->listSubChildCategories($child);


        return view('usermanual::front.index',['childSubCategories'=>$childSubCategories,'childCategories'=>$childCategories,'parentCategories'=>$parentCategories,'id'=>$id,'banner'=>$banner]);
    }
    public function getChildCategoryList(Request $request)
    {
        $cat_id = decrypt($request->id);
        $childCategories=(new Categories())->listChildCategories($cat_id);
        $child=$childCategories->pluck('id');
        $childSubCategories=(new Categories())->listSubChildCategories($child);
        $subChild=$childSubCategories->pluck('id');
        $products=(new Products())->listProductsByCatIdSubCatId($child,$subChild);
        $prodId=$products->pluck('id');
        $userManual=(new UserManual())->listUserManualByProductId($prodId);
        return response()->json(['types'=>$childCategories,'sub_types'=>$childSubCategories,'products'=>$products,'user_manual'=>$userManual]);
    }
    public function getSubChildCategoryList(Request $request)
    {
        $cat_id = $request->id;
        $childSubCategories=(new Categories())->listChildCategories($cat_id);
        $subChild=$childSubCategories->pluck('id');
        $products=(new Products())->listProductsBySingleCatIdSubChildId($cat_id,$subChild);
        $prodId=$products->pluck('id');
        $userManual=(new UserManual())->listUserManualByProductId($prodId);
        return response()->json(['sub_types'=>$childSubCategories,'products'=>$products,'user_manual'=>$userManual]);
    }
    public function getProductList(Request $request)
    {
        $cat_id = $request->id;
        $products=(new Products())->listProductsBySingleCatId($cat_id);
        // dd($products);
        $prodId=$products->pluck('id');
        $userManual=(new UserManual())->listUserManualByProductId($prodId);
        return response()->json(['products'=>$products,'user_manual'=>$userManual]);
    }
    public function getUserManualList(Request $request)
    {
        $product_id = $request->id;
        $userManual=(new UserManual())->listUserManualBySingleProductId($product_id);
        return response()->json(['user_manual'=>$userManual]);
    }
    public function searchUserManualList(Request $request)
    {
        $search = $request->search;
        $products=(new Products())->searchProduct($search);
        $prodId=$products->pluck('id');
        $userManual=(new UserManual())->listUserManualByProductId($prodId);
        return response()->json(['products'=>$products,'user_manual'=>$userManual]);
    }
    public function download(Request $request)
    {
        // dd($id);
        $file = UserManual::find($request->id);
        // dd(storage_path('app/'. $file->manual));
        $response= response()->download(storage_path('app/'. $file->manual));
        // ob_end_clean();
        return  $response;
        
    }
   
}

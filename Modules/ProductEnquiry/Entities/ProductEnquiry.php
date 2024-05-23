<?php

namespace Modules\ProductEnquiry\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductEnquiry extends Model
{
    protected $table = 'product_enquiry';
    protected $fillable = [
        'first_name', 'last_name', 'mobile' ,'email', 'address_1', 'address_2', 'state', 'district', 'pincode' ,'product_id', 'product_model', 'purchased_from', 'enquiry_type', 'message','description', 'status','category_id'
    ];
    public function products()
    {
    	return $this->belongsTo("Modules\Products\Entities\Products","product_id");
    }
    public function states()
    {
    	return $this->belongsTo("Modules\WarrantyExtension\Entities\State","state");
    }
    public function storeProductEnquiry($request)
    {
        return self::create([
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'mobile'=>$request->mobile ,
            'email'=>$request->email,
            'address_1'=>$request->address1,
            'address_2'=>$request->address2,
            'state'=>$request->state_id,
            'district'=>$request->district,
            'category_id'=>$request->category_id ,
            'product_id'=>$request->product_id,
            'product_model'=>$request->model,
            'message'=>$request->enquiry,
            'enquiry_type'=>$request->enquiry_type,
        ]);
    }
    public function listProductEnquiry($request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;
        $enquiry = self::with('products','states');
        if ($search != '') 
        {
            // dd($search);
            $enquiry =$enquiry->where('first_name', 'LIKE', '%'.$search.'%')
            ->orwhere('last_name', 'LIKE', '%'.$search.'%');
            $enquiry =$enquiry->orwhereHas('products', function($q) use ($search) {
                        $q->where('name', 'LIKE', '%'.$search.'%');
                    });
        }
        $total  = $enquiry->count();
        $data = $enquiry->take($request->length)->skip($request->start)->get();
        $result['data']  =$enquiry->orderBy('created_at','desc')->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;
        return $result;
    }
    public function productEnquiryDetailById($id)
    {
        return self::with('states')->with('products')->where('id',$id)->first();
    }
    public function productEnquiryCount()
    {
        return self::all()->count();
    }
}

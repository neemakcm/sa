<?php

namespace Modules\WarrantyExtension\Entities;

use Illuminate\Database\Eloquent\Model;

class WarrantyExtension extends Model
{
    protected $table = 'warranty';

    protected $fillable = [
        'first_name', 'last_name', 'mobile' ,'email', 'address_1', 'address_2', 'state', 'district', 'pincode' ,'product_id','category_id', 'product_model', 'purchased_date', 'purchased_from', 'serial_number', 'invoice', 'status'
    ];
    public function products()
    {
    	return $this->belongsTo("Modules\Products\Entities\Products","product_id");
    }
    public function category()
    {
    	return $this->belongsTo("Modules\Categories\Entities\Categories","category_id");
    }
    public function states()
    {
    	return $this->belongsTo("Modules\WarrantyExtension\Entities\State","state");
    }
    public function storeWarranty($request)
    {
        // dd($request->file('warranty_invoice'));
        return self::create([
            'first_name'=>$request->warranty_first_name,
            'last_name'=>$request->warranty_last_name,
            'mobile'=>$request->warranty_mobile ,
            'email'=>$request->warranty_email,
            'address_1'=>$request->warranty_address1,
            'address_2'=>$request->warranty_address2,
            'state'=>$request->warranty_state_id,
            'district'=>$request->warranty_district,
            'pincode'=>$request->warranty_pincode ,
            'product_id'=>$request->warranty_product_id,
            'category_id'=>$request->warranty_category_id,

            'product_model'=>$request->warranty_model,
            'purchased_date'=>date('Y-m-d',strtotime($request->warranty_purchase_date)),
            'purchased_from'=>$request->warranty_purchase_from,
            'serial_number'=>$request->warranty_serial_number,
            'invoice'=>$request->file('warranty_invoice')->store('warranty_invoice')
        ]);
    }
    public function listWarrantyExtension($request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;
        $extensions = self::with('products','states');
        if ($search != '') 
        {
            $extensions =$extensions->where('first_name', 'LIKE', '%'.$search.'%')
            ->where('last_name', 'LIKE', '%'.$search.'%');
            $extensions =$extensions->whereHas('products', function($q) use ($search) {
                        $q->where('name', 'LIKE', '%'.$search.'%');
                    });
        }
        $total  = $extensions->count();
        $data = $extensions->take($request->length)->skip($request->start)->get();
        $result['data']  = $extensions->orderBy('created_at','desc')->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;
        return $result;
    }
    public function warrantyExtensionDetailById($id)
    {
        return self::with('states')->with('category','products')->where('id',$id)->first();
    }
}

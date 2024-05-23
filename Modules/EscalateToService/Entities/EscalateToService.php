<?php

namespace Modules\EscalateToService\Entities;

use Illuminate\Database\Eloquent\Model;

class EscalateToService extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'mobile' ,'email', 'address_1', 'address_2', 'state', 'district', 'pincode' ,'product_id', 'product_model', 'purchased_from', 'subject', 'message', 'invoice', 'status','category_id'

    ];
    public function products()
    {
    	return $this->belongsTo("Modules\Products\Entities\Products","product_id");
    }
    public function states()
    {
    	return $this->belongsTo("Modules\WarrantyExtension\Entities\State","state");
    }
    public function storeEscalateToService($request)
    {
        if($request->invoice){
            return self::create([
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'mobile'=>$request->mobile ,
                'email'=>$request->email,
                'address_1'=>$request->address1,
                'address_2'=>$request->address2,
                'state'=>$request->state_id,
                'district'=>$request->district,
                'pincode'=>$request->pincode ,
                'category_id'=>$request->category_id,
                'product_id'=>$request->product_id,
                // 'product_model'=>$request->model,
                'purchased_from'=>$request->purchase_from,
                'message'=>$request->message,
                'subject'=>$request->subject,
                'invoice'=>$request->file('invoice')->store('invoice')
            ]);
        }
        else{
            return self::create([
                'first_name'=>$request->first_name,
                'last_name'=>$request->last_name,
                'mobile'=>$request->mobile ,
                'email'=>$request->email,
                'address_1'=>$request->address1,
                'address_2'=>$request->address2,
                'state'=>$request->state_id,
                'district'=>$request->district,
                'pincode'=>$request->pincode ,
                'category_id'=>$request->category_id,
                'product_id'=>$request->product_id,
                // 'product_model'=>$request->model,
                'purchased_from'=>$request->purchase_from,
                'message'=>$request->message,
                'subject'=>$request->subject
            ]);

        }
       
    }
    public function listEscalateService($request)
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
        $result['data'] = $extensions =$extensions->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;
        return $result;
    }
    public function escalateServiceDetailById($id)
    {
        return self::with('states')->with('products')->where('id',$id)->first();
    }
}

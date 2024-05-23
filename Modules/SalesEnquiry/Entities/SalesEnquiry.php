<?php

namespace Modules\SalesEnquiry\Entities;

use Illuminate\Database\Eloquent\Model;

class SalesEnquiry extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'mobile' ,'email', 'address_1', 'address_2', 'state', 'district', 'pincode', 'enquiry_type', 'message','description', 'status','invoice'
    ];
   
    public function states()
    {
    	return $this->belongsTo("Modules\WarrantyExtension\Entities\State","state");
    }
    public function storeSalesEnquiry($request)
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
            'pincode'=>$request->pincode ,
            'message'=>$request->enquiry,
            'enquiry_type'=>$request->enquiry_type,
            'invoice'=>$request->file('invoice')->store('invoice')
        ]);
       
        // $email = $request->email;
        // Mail::to($email)->send(new MailPendingRegistration($user));

    }
    public function listSalesEnquiry($request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;
        $enquiry = self::with('states');
        if($request->from_date)
        {
            $enquiry= $enquiry->whereDate('created_at','>=',$request->from_date)->whereDate('created_at','<=',$request->to_date);
           
        }
        if ($search != '') 
        {
            $enquiry =$enquiry->where('first_name', 'LIKE', '%'.$search.'%')
            ->orwhere('last_name', 'LIKE', '%'.$search.'%');
        }
        $total  = $enquiry->count();
        $data = $enquiry->take($request->length)->skip($request->start)->get();
        $result['data']  =$enquiry->orderBy('created_at','desc')->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;
        return $result;
    }
    public function salesEnquiryDetailById($id)
    {
        return self::with('states')->where('id',$id)->first();
    }
    public function salesEnquiryCount()
    {
        return self::all()->count();
    }
}

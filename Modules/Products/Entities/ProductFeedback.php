<?php

namespace Modules\Products\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductFeedback extends Model
{
    protected $table = 'product_feedback';

    public function product() 
    {
        return $this->belongsTo("Modules\Products\Entities\Products","product_id");
    }

    public function category() 
    {
        return $this->belongsTo("Modules\Categories\Entities\Categories","product_type","slug");
    }
    public function states()
    {
    	return $this->belongsTo("Modules\WarrantyExtension\Entities\State","state");
    }
    public function productFeedbackDetailById($id)
    {
        return self::with('states')->with('category','product')->where('id',$id)->first();
    }
}

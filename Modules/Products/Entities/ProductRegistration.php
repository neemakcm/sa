<?php

namespace Modules\Products\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductRegistration extends Model
{
    protected $table = 'product_registration';

    public function product() 
    {
        return $this->belongsTo("Modules\Products\Entities\Products","model_number","sku");
    }
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
    public function productRegistrationDetailById($id)
    {
        return self::with('states')->with('category','products')->where('id',$id)->first();
    }
}

<?php

namespace Modules\UserManual\Entities;

use Illuminate\Database\Eloquent\Model;

class UserManual extends Model
{
    protected $table = 'user_manual';

    public function product()
    {
    	return $this->belongsTo("Modules\Products\Entities\Products","product_id");
    }

    public function category()
    {
    	return $this->belongsTo("Modules\Categories\Entities\Categories","category_id");
    }
    public function listUserManualByProductId($product_id)
    {
        return self::whereIn('product_id',$product_id)->get();
    }
    public function listUserManualBySingleProductId($product_id)
    {
        return self::where('product_id',$product_id)->get();
    }
}

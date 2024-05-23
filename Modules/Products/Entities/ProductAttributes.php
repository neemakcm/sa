<?php

namespace Modules\Products\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductAttributes extends Model
{
    protected $fillable = [];

    public function attribute() 
    {
        return $this->belongsTo("Modules\Attributes\Entities\Attributes","attribute_id");
    }

    public function product() 
    {
        return $this->belongsTo("Modules\Products\Entities\Products","product_id");
    }
}

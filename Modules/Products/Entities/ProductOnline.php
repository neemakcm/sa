<?php

namespace Modules\Products\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductOnline extends Model
{
    protected $table = 'product_online';
    public function vendor() 
    {
        return $this->belongsTo("Modules\Vendor\Entities\Vendor","vendor_id");
    }
}

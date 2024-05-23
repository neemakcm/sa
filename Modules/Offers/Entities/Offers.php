<?php

namespace Modules\Offers\Entities;

use Illuminate\Database\Eloquent\Model;

class Offers extends Model
{
    protected $table = 'offers';

    public function products()
    {
    	return $this->belongsTo("Modules\Products\Entities\Products","product_id");
    }
}

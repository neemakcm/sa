<?php

namespace Modules\Products\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductSupports extends Model
{
    protected $table = 'product_support';

    public function support()
    {
    	return $this->belongsTo('Modules\Supports\Entities\Supports','support_id');
    }
}

<?php

namespace Modules\Supports\Entities;

use Illuminate\Database\Eloquent\Model;

class Supports extends Model
{
    protected $table = 'support_options';

    public function products()
    {
    	return $this->hasMany('Modules\Products\Entities\ProductSupports','support_id');
    }
}

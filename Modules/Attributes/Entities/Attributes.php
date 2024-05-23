<?php

namespace Modules\Attributes\Entities;

use Illuminate\Database\Eloquent\Model;

class Attributes extends Model
{
    protected $fillable = [];

    public function products() {
        return $this->belongsToMany("Modules\Products\Entities\Products","product_attributes","attribute_id","product_id");
    }
}

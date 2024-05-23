<?php

namespace Modules\Categories\Entities;

use Illuminate\Database\Eloquent\Model;

class CategoryAttributes extends Model
{
    protected $table = 'category_attributes';

    public function category() 
    {
        return $this->belongsTo("Modules\Categories\Entities\Categories","category_id");
    }

    public function attribute() 
    {
        return $this->belongsTo("Modules\Attributes\Entities\Attributes","attribute_id");
    }
}

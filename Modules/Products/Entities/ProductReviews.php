<?php

namespace Modules\Products\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductReviews extends Model
{
    protected $table = 'product_reviews';

    public function product()
    {
        return $this->belongsTo('Modules\Products\Entities\Products','product_id');
    }
}

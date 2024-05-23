<?php

namespace Modules\Settings\Entities;

use Illuminate\Database\Eloquent\Model;

class FooterCategories extends Model
{
    protected $table = 'footer_categories';

    public function category()
    {
        return $this->belongsTo('Modules\Categories\Entities\Categories','category_id');
    }
}

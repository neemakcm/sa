<?php

namespace Modules\Pages\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HomeDesignSubcategory extends Model
{
    use SoftDeletes;

    protected $fillable = [];
    public function categories()
    {
        return $this->belongsTo("Modules\Categories\Entities\Categories","sub_category_id");
    }
}

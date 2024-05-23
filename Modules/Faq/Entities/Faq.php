<?php

namespace Modules\Faq\Entities;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $table = 'faq';

    public function category()
    {
    	return $this->belongsTo("Modules\Categories\Entities\Categories","category_id");
    }
    public function faqByCategoryId($id)
    {
        return self::where('category_id',$id)->get();
    }
}

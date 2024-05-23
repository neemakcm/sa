<?php

namespace Modules\Products\Entities;

use Illuminate\Database\Eloquent\Model;

class ProductFaq extends Model
{
    protected $table = 'product_faq';
    public function faqByCategoryId($id)
    {
        return self::where('product_id',$id)->get();
    }
}

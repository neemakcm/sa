<?php

namespace Modules\Offers\Entities;

use Illuminate\Database\Eloquent\Model;

class OfferInterests extends Model
{
    protected $table = 'offer_interest';

    public function offer()
    {
    	return $this->belongsTo("Modules\Offers\Entities\Offers","offer_id");
    }
}

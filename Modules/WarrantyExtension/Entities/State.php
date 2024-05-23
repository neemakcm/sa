<?php

namespace Modules\WarrantyExtension\Entities;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'state';

    protected $fillable = [];
    public function IndianStateList()
    {
        return self::where('country_id',101)->get();
    }
}

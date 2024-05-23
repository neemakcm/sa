<?php

namespace Modules\Service\Entities;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $table = 'service_request';

    public function requestStatus() 
    {
        return $this->hasMany("Modules\Service\Entities\ServiceStatus","request_id");
    }

    public function product() 
    {
        return $this->belongsTo("Modules\Products\Entities\Products","product_id");
    }
    public function requestCount()
    {
        return self::has('product')->get()->count();
    }
}

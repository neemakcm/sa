<?php

namespace Modules\Service\Entities;

use Illuminate\Database\Eloquent\Model;

class ServiceStatus extends Model
{
    protected $table = 'service_status';

    public function request() 
    {
        return $this->belongsTo("Modules\Service\Entities\ServiceRequest","request_id");
    }
}

<?php

namespace Modules\Careers\Entities;

use Illuminate\Database\Eloquent\Model;

class JobFields extends Model
{
    protected $table = 'job_fields';

    public function jobs() 
    {
        return $this->hasMany("Modules\Careers\Entities\Jobs","job_field_id");
    }
}

<?php

namespace Modules\Careers\Entities;

use Illuminate\Database\Eloquent\Model;

class JobRequests extends Model
{
    protected $table = 'job_requests';

    public function jobs() 
    {
        return $this->belongsTo("Modules\Careers\Entities\Jobs","job_id");
    }

    public function requestEducations() 
    {
        return $this->hasMany("Modules\Careers\Entities\JobRequestEducations","job_request_id");
    }

    public function requestExperience() 
    {
        return $this->hasMany("Modules\Careers\Entities\JobRequestExperiences","job_request_id");
    }
}

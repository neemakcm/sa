<?php

namespace Modules\Careers\Entities;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    protected $table = 'jobs';
    use HasSlug;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function jobField() 
    {
        return $this->belongsTo("Modules\Careers\Entities\JobFields","job_field_id");
    }

    public function jobRequest() 
    {
        return $this->hasMany("Modules\Careers\Entities\JobRequests","job_id");
    }
}

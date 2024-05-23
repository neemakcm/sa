<?php

namespace Modules\Roles\Entities;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table = "roles";

    public function permissions() {
        return $this->belongsToMany("Modules\Admin\Entities\Permissions","role_permission","role_id","permission_id");
    }
}

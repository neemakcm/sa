<?php

namespace Modules\Admin\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB, Config;

class Admin extends Authenticatable
{
	protected $connection = 'mysql';
	
    protected $table = 'admin_users';
    use SoftDeletes;

    public function roles() {
        return $this->belongsTo("Modules\Roles\Entities\Roles","role_id");
    }

}
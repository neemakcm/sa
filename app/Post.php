<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Artisan;

class Post extends Model
{
	
	public static function boot()
	{
	    parent::boot();

	    static::updated(function ($model) {
	        Artisan::call("page-cache:clear $model->slug");
	    });
	}
}

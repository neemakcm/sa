<?php

namespace Modules\Categories\Entities;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;

use Image,File;

class Categories extends Model
{
    protected $table = 'categories';

    use HasSlug;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    public function category_attributes() 
    {
        return $this->hasMany("Modules\Categories\Entities\CategoryAttributes","category_id");
    }

    public function products() 
    {
        return $this->hasMany("Modules\Products\Entities\Products","category_id");
    }

    public function parent() 
    {
        return $this->belongsTo("Modules\Categories\Entities\Categories","parent_id");
    }

    public function children() 
    {
        return $this->hasMany("Modules\Categories\Entities\Categories","parent_id");
    }

    public static function createThumbnail($category)
    {
        $medium_path = storage_path('app/resized/medium/categories');
   
        if(!File::isDirectory($medium_path)){
            File::makeDirectory($medium_path, 0777, true, true);
        }

        if($category->icon != '' && File::exists(storage_path().'/app/'.$category->icon))
        {
            $file_name = explode('/', $category->icon);

            if(pathinfo(storage_url().'/'.$category->icon, PATHINFO_EXTENSION) == 'webp')
            {
                $image = base64_encode(storage_url().'/'.$category->icon);

                \File::copy(storage_url().'/'.$category->icon , $medium_path.'/'.$file_name[1]);
            }      
            else
            {
                $image_resize = Image::make(storage_url().'/'.$category->icon);              
                $image_resize->resize(520,360, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image_resize->resizeCanvas(520,360, 'center', false, '#ffffff');
                $image_resize->save($medium_path.'/'.$file_name[1]);
            }
        }
        return true;
    }

    public function listIsLastChildCategories()
    {
        return self::where('is_last_child',1)->get();
    }
    public function listParentCategories()
    {
        return self::where('parent_id',0)->get();
    }
    public function listChildCategories($parent_id)
    {
        return self::select('id','name')->where('parent_id',$parent_id)->get();
    }
    public function listSubChildCategories($child)
    {
        return self::select('id','name')->whereIn('parent_id',$child)->get();
    }
    public function listFirstChildCategories()
    {
        // return self::where('is_last_child',0)->where('parent_id','!=',0)->get();
        return self::where('parent_id','!=',0)->get();
    }
    public function categoryDetail($id)
    {
        return self::select('id','name')->where('id',$id)->get();
    }
}

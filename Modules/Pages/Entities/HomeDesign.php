<?php

namespace Modules\Pages\Entities;

use Illuminate\Database\Eloquent\Model;
use Image,File;

class HomeDesign extends Model
{
    protected $table = 'home_design';

    public function products()
    {
        return $this->belongsTo("Modules\Products\Entities\Products","product_id")->where('is_active',1);
    }

    public function categories()
    {
        return $this->belongsTo("Modules\Categories\Entities\Categories","product_id");
    }

    public static function createThumbnail($design)
    {
        $medium_path = storage_path('app/resized/large/home_page');

        if(!File::isDirectory($medium_path)){
            File::makeDirectory($medium_path, 0777, true, true);
        }

        $xl_path = storage_path('app/resized/xl/home_page');

        if(!File::isDirectory($xl_path)){
            File::makeDirectory($xl_path, 0777, true, true);
        }

        if($design->image != '' && File::exists(storage_path().'/app/'.$design->image))
        {
            $file_name = explode('/', $design->image);

            if(pathinfo(storage_url().'/'.$design->image, PATHINFO_EXTENSION) == 'webp')
            {
                $image = base64_encode(storage_url().'/'.$design->image);

                \File::copy(storage_url().'/'.$design->image , $medium_path.'/'.$file_name[1]);
                \File::copy(storage_url().'/'.$design->image , $xl_path.'/'.$file_name[1]);
            }
            else
            {
                $image_resize = Image::make(storage_url().'/'.$design->image);
                $image_resize->resize(305, 376, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image_resize->resizeCanvas(305, 376, 'center', false, '#ffffff');
                $image_resize->save($medium_path.'/'.$file_name[1]);


                $image_resize = Image::make(storage_url().'/'.$design->image);
                $image_resize->resize(400, 493, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image_resize->resizeCanvas(400, 493, 'center', false, '#ffffff');
                $image_resize->save($xl_path.'/'.$file_name[1]);
            }
        }
        return true;
    }
    public function homeDesignSubcategory()
    {
        return $this->hasMany("Modules\Pages\Entities\HomeDesignSubcategory","home_design_id");
    }
}

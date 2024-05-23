<?php

namespace Modules\LatestVideos\Entities;

use Illuminate\Database\Eloquent\Model;

use Image,File;

class LatestVideos extends Model
{
    protected $table = 'latest_videos';

    public static function createThumbnail($videos)
    {
        $medium_path = storage_path('app/resized/medium/latestVideos');
   
        if(!File::isDirectory($medium_path)){
            File::makeDirectory($medium_path, 0777, true, true);
        }

        $small_path = storage_path('app/resized/small/latestVideos');
   
        if(!File::isDirectory($small_path)){
            File::makeDirectory($small_path, 0777, true, true);
        }

        if($videos->thumbnail != '' && File::exists(storage_path().'/app/'.$videos->thumbnail))
        {
            $file_name = explode('/', $videos->thumbnail);

            if(pathinfo(storage_url().'/'.$videos->thumbnail, PATHINFO_EXTENSION) == 'webp')
            {
                $image = base64_encode(storage_url().'/'.$videos->thumbnail);

                \File::copy(storage_url().'/'.$videos->thumbnail , $small_path.'/'.$file_name[1]);
                \File::copy(storage_url().'/'.$videos->thumbnail , $small_path.'/'.$file_name[1]);
            }      
            else
            {
                $image_resize = Image::make(storage_url().'/'.$videos->thumbnail);              
                $image_resize->resize(600, 630, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image_resize->resizeCanvas(600, 630, 'center', false, '#ffffff');
                $image_resize->save($medium_path.'/'.$file_name[1]);


                $image_resize->resize(300, 315, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image_resize->resizeCanvas(300, 315, 'center', false, '#ffffff');
                $image_resize->save($small_path.'/'.$file_name[1]);
            }
        }
        return true;
    }
}

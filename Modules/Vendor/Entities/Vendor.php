<?php

namespace Modules\Vendor\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Image,File;

class Vendor extends Model
{
    // use SoftDeletes;

    protected $fillable = [];

    public function listVendor($request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;
        $vendor = self::whereNotNull('id');
        if ($search != '') 
        {
            $vendor =$vendor->where('name', 'LIKE', '%'.$search.'%');
        }
        $total  = $vendor->count();
        $data = $vendor->take($request->length)->skip($request->start)->get();
        $result['data'] = $vendor =$vendor->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;
        return $result;
    }
    public function vendorDetailById($id)
    {
        return self::where('id',$id)->first();
    }
    
    public static function createThumbnail($vendor)
    {
        $medium_path = storage_path('app/resized/medium/vendor');
   
        if(!File::isDirectory($medium_path)){
            File::makeDirectory($medium_path, 0777, true, true);
        }

        $small_path = storage_path('app/resized/small/vendor');
   
        if(!File::isDirectory($small_path)){
            File::makeDirectory($small_path, 0777, true, true);
        }

        if($vendor->image != '' && File::exists(storage_path().'/app/'.$vendor->image))
        {
            $file_name = explode('/', $vendor->image);

            if(pathinfo(storage_url().'/'.$vendor->image, PATHINFO_EXTENSION) == 'webp')
            {
                $image = base64_encode(storage_url().'/'.$vendor->image);

                \File::copy(storage_url().'/'.$vendor->image , $medium_path.'/'.$file_name[1]);
                \File::copy(storage_url().'/'.$vendor->image , $small_path.'/'.$file_name[1]);
            }      
            else
            {
                $image_resize = Image::make(storage_url().'/'.$vendor->image);              
                $image_resize->resize(180, 50, function ($constraint) {
                    $constraint->aspectRatio();
                });
                //$image_resize->resizeCanvas(180, 50, 'center', false, '#ffffff');
                $image_resize->save($medium_path.'/'.$file_name[1]);


                $image_resize->resize(108, 30, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $image_resize->resizeCanvas(108, 30, 'center', false, '#ffffff');
                $image_resize->save($small_path.'/'.$file_name[1]);
            }
        }
        return true;
    }
}

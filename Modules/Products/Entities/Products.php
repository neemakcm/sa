<?php

namespace Modules\Products\Entities;

use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Image,File;

class Products extends Model
{
    protected $table = 'products';
    use SoftDeletes;

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

    public function category() 
    {
        return $this->belongsTo("Modules\Categories\Entities\Categories","category_id");
    }

    public function attributes() 
    {
        return $this->hasMany("Modules\Products\Entities\ProductAttributes","product_id");
    }

    public function images() 
    {
        return $this->hasMany("Modules\Products\Entities\ProductImages","product_id");
    }

    public function online() 
    {
        return $this->hasMany("Modules\Products\Entities\ProductOnline","product_id");
    }

    public function varients() 
    {
        return $this->hasMany("Modules\Products\Entities\Products","parent_id");
    }

    public function parent() 
    {
        return $this->belongsTo("Modules\Products\Entities\Products","parent_id");
    }

    public function reviews() 
    {
        return $this->hasMany("Modules\Products\Entities\ProductReviews","product_id");
    }

    /*public static function createThumbnail($product)
    {
        $large_path = storage_path('app/resized/large/products');
   
        if(!File::isDirectory($large_path)){
            File::makeDirectory($large_path, 0777, true, true);
        }

        $xl_path = storage_path('app/resized/xl/products');
   
        if(!File::isDirectory($xl_path)){
            File::makeDirectory($xl_path, 0777, true, true);
        }

        $medium_path = storage_path('app/resized/medium/products');
   
        if(!File::isDirectory($medium_path)){
            File::makeDirectory($medium_path, 0777, true, true);
        }

        $small_path = storage_path('app/resized/small/products');
   
        if(!File::isDirectory($small_path)){
            File::makeDirectory($small_path, 0777, true, true);
        }

        $detail_path = storage_path('app/resized/detail/products');
   
        if(!File::isDirectory($detail_path)){
            File::makeDirectory($detail_path, 0777, true, true);
        }

        if(File::exists(storage_path().'/app/'.$product->thumbnail))
        {
            $file_name = explode('/', $product->thumbnail);

            if(pathinfo(storage_url().'/'.$product->thumbnail, PATHINFO_EXTENSION) == 'webp')
            {
                $image = base64_encode(storage_url().'/'.$product->thumbnail);

                \File::copy(storage_url().'/'.$product->thumbnail , $medium_path.'/'.$file_name[1]);
                \File::copy(storage_url().'/'.$product->thumbnail , $small_path.'/'.$file_name[1]);
                \File::copy(storage_url().'/'.$product->thumbnail , $large_path.'/'.$file_name[1]);
                \File::copy(storage_url().'/'.$product->thumbnail , $xl_path.'/'.$file_name[1]);
            }    
            else
            {
                $image_resize = Image::make(storage_url().'/'.$product->thumbnail);              
                $image_resize->resize(290, 165, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $image_resize->save($large_path.'/'.$file_name[1]);
                
                $image_resize = Image::make(storage_url().'/'.$product->thumbnail);              
                $image_resize->resize(740, 420, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $image_resize->save($xl_path.'/'.$file_name[1]);

                $image_resize = Image::make(storage_url().'/'.$product->thumbnail);              
                $image_resize->resize(175, 100, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $image_resize->save($medium_path.'/'.$file_name[1]);

                $small_image_resize = Image::make(storage_url().'/'.$product->thumbnail);              
                $small_image_resize->resize(70, 66, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
                $small_image_resize->save($small_path.'/'.$file_name[1]);
            }
            
        }

        foreach($product->images as $image)
        {
            if(File::exists(storage_path().'/app/'.$image->image))
            {
                $file_name = explode('/', $image->image);

                if(pathinfo(storage_url().'/'.$image->image, PATHINFO_EXTENSION) == 'webp')
                {
                    $image = base64_encode(storage_url().'/'.$image->image);

                    \File::copy(storage_url().'/'.$image->image , $medium_path.'/'.$file_name[1]);
                    \File::copy(storage_url().'/'.$image->image , $small_path.'/'.$file_name[1]);
                    \File::copy(storage_url().'/'.$image->image , $large_path.'/'.$file_name[1]);
                    \File::copy(storage_url().'/'.$image->image , $xl_path.'/'.$file_name[1]);
                }    
                else
                {
                    $image_resize = Image::make(storage_url().'/'.$image->image);              
                    $image_resize->resize(290, 165, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $image_resize->save($large_path.'/'.$file_name[1]);
                    
                    $image_resize = Image::make(storage_url().'/'.$image->image);              
                    $image_resize->resize(740, 420, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $image_resize->save($xl_path.'/'.$file_name[1]);

                    $image_resize = Image::make(storage_url().'/'.$image->image);              
                    $image_resize->resize(175, 100, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $image_resize->save($medium_path.'/'.$file_name[1]);

                    $small_image_resize = Image::make(storage_url().'/'.$image->image);              
                    $small_image_resize->resize(70, 66, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $small_image_resize->save($small_path.'/'.$file_name[1]);

                    $detail_image_resize = Image::make(storage_url().'/'.$image->image);              
                    $detail_image_resize->resize(620, 420, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    });
                    $detail_image_resize->save($detail_path.'/'.$file_name[1]);
                }
                
            }
            
        }
        return true;
    }
*/
    public static function createThumbnail($product)
    {
        $large_path = storage_path('app/resized/large/products');
        if(!File::isDirectory($large_path)){
            File::makeDirectory($large_path, 0777, true, true);
        }

        $xl_path = storage_path('app/resized/xl/products');
   
        if(!File::isDirectory($xl_path)){
            File::makeDirectory($xl_path, 0777, true, true);
        }

        $medium_path = storage_path('app/resized/medium/products');
   
        if(!File::isDirectory($medium_path)){
            File::makeDirectory($medium_path, 0777, true, true);
        }

        $small_path = storage_path('app/resized/small/products');
   
        if(!File::isDirectory($small_path)){
            File::makeDirectory($small_path, 0777, true, true);
        }

        $detail_path = storage_path('app/resized/detail/products');
   
        if(!File::isDirectory($detail_path)){
            File::makeDirectory($detail_path, 0777, true, true);
        }

        $zoom_detail_path = storage_path('app/resized/zoom_detail/products');
   
        if(!File::isDirectory($zoom_detail_path)){
            File::makeDirectory($zoom_detail_path, 0777, true, true);
        }

        if(File::exists(storage_path().'/app/'.$product->thumbnail))
        {
            $file_name = explode('/', $product->thumbnail);

            if(pathinfo(storage_url().'/'.$product->thumbnail, PATHINFO_EXTENSION) == 'webp')
            {
                $image = base64_encode(storage_url().'/'.$product->thumbnail);

                \File::copy(storage_url().'/'.$product->thumbnail , $medium_path.'/'.$file_name[1]);
                \File::copy(storage_url().'/'.$product->thumbnail , $small_path.'/'.$file_name[1]);
                \File::copy(storage_url().'/'.$product->thumbnail , $large_path.'/'.$file_name[1]);
                \File::copy(storage_url().'/'.$product->thumbnail , $xl_path.'/'.$file_name[1]);
                \File::copy(storage_url().'/'.$product->thumbnail , $detail_path.'/'.$file_name[1]);
            }    
            else
            {
                Products::imageResizeWithPadding($product->thumbnail,290,165,$large_path);
                Products::imageResizeWithPadding($product->thumbnail,800,800,$detail_path);
                Products::imageResizeWithPadding($product->thumbnail,740,420,$xl_path);
                Products::imageResizeWithPadding($product->thumbnail,220,126,$medium_path);
                Products::imageResizeWithPadding($product->thumbnail,111,81,$small_path);
            }
            
        }

        foreach($product->images as $image)
        {
            if(File::exists(storage_path().'/app/'.$image->image))
            {
                $file_name = explode('/', $image->image);

                if(pathinfo(storage_url().'/'.$image->image, PATHINFO_EXTENSION) == 'webp')
                {
                    //$image = base64_encode(storage_url().'/'.$image->image);

                    \File::copy(storage_url().'/'.$image->image , $medium_path.'/'.$file_name[1]);
                    \File::copy(storage_url().'/'.$image->image , $small_path.'/'.$file_name[1]);
                    \File::copy(storage_url().'/'.$image->image , $large_path.'/'.$file_name[1]);
                    \File::copy(storage_url().'/'.$image->image , $xl_path.'/'.$file_name[1]);
                    \File::copy(storage_url().'/'.$image->image , $detail_path.'/'.$file_name[1]);
                    \File::copy(storage_url().'/'.$image->image , $zoom_detail_path.'/'.$file_name[1]);
                }    
                else
                {
                    Products::imageResizeWithPadding($image->image,290,165,$large_path);
                    Products::imageResizeWithPadding($image->image,740,420,$xl_path);
                    Products::imageResizeWithPadding($image->image,220,126,$medium_path);
                    Products::imageResizeWithPadding($image->image,111,81,$small_path);
                    Products::imageResizeWithPadding($image->image,800,800,$detail_path);
                    Products::imageResizeWithPadding($image->image,1200,1200,$zoom_detail_path);
                }
                
            }
            
        }
        return true;
    }

    public function listProductsByCatId($subchild)
    {
        return self::select('id','name','sku')->whereIn('category_id',$subchild)->get();
    }
    public function listProductsBySingleCatId($subchild)
    {
        return self::select('id','name','sku')->where('category_id',$subchild)->get();
    }
    public function searchProduct($search)
    {
        return self::select('id','name','sku')->where('sku', 'LIKE', '%' . $search . '%')->get();
    }
    
    /**product list */
    public function productListByType()
    {
        return self::whereIn('type',[0,2])->get();
    }
    public function productModel($id)
    {
        return self::select('sku')->where('id',$id)->first();
    }
    public function listProductsBySingle($subchild)
    {
        return self::select('id','name','sku')->where('parent_id',$subchild)->get();

    }
    public static function imageResizeWithPadding($image,$req_width,$req_height,$path)
    {
        $file_name = explode('/', $image);
        $img    = Image::make(storage_url().'/'.$image);

        $img->resize($req_width, $req_height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->resizeCanvas($req_width, $req_height, 'center', false, '#ffffff');
        $img->save($path.'/'.$file_name[1],100);
        // dd($path.'/'.$file_name[1],100);

    }
    public function productCount()
    {
        return self::where('is_active',1)->get()->count();
    }
    public function listProductsByCatIdSubCatId($child,$subchild)
    {
        return self::select('id','name','sku')->whereIn('category_id',$child)->orWhereIn('category_id',$subchild)->get();
    }
    public function listProductsBySingleCatIdSubChildId($child,$subchild)
    {
        return self::select('id','name','sku')->whereIn('category_id',$subchild)->orWhere('category_id',$child)->get();
    }
}


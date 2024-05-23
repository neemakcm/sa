<?php

namespace Modules\VideoTutorial\Entities;

use Illuminate\Database\Eloquent\Model;

class VideoTutorial extends Model
{
    protected $table = 'video_tutorial';
    protected $fillable = [];
    public function category()
    {
    	return $this->belongsTo("Modules\Categories\Entities\Categories","category_id");
    }
    public function listVideoTutorial($request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;
        $video_tutorial = VideoTutorial::with('category');
        if ($search != '') 
        {
            $video_tutorial =$video_tutorial->where('title', 'LIKE', '%'.$search.'%');
            // $video_tutorial =$video_tutorial->whereHas('category', function($q) use ($search) {
            //             $q->where('name', 'LIKE', '%'.$search.'%');
            //         });
        }
        $total  = $video_tutorial->count();
        // dd($video_tutorial);
        $data = $video_tutorial->take($request->length)->skip($request->start)->get();
        $result['data'] = $video_tutorial =$video_tutorial->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;
        // dd($result);

        return $result;

    }
    public function videoTutorialDetailById($id)
    {
        return self::with('category')->where('id',$id)->first();
    }
    public function videoTutorialByPaginate()
    {
        return self::with('category')->orderBy('created_at', 'DESC')->paginate(1);
        
    }

}

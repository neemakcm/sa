<?php

namespace Modules\ShoppingFaq\Entities;

use Illuminate\Database\Eloquent\Model;

class ShoppingFaq extends Model
{
    protected $fillable = ['question','answer'];
    public function listShoppingFaq($request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;
        $faq = self::WhereNotNull('id');
        if ($search != '') 
        {
            $faq->where('question', 'LIKE', '%'.$search.'%');
            $faq->orwhere('answer', 'LIKE', '%'.$search.'%');
        }
        $total  = $faq->count();
        $result['data'] = $faq->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;
        return $result;
    }
    public function storeShoppingFaq($request)
    {
        return self::create([
            'question'=>$request->question,
            'answer'=>$request->answer,
        ]);
    }
    public function shoppingFaqDetailById($id)
    {
        return self::where('id',$id)->first();
    }
    public function shoppingFaqUpdate($request)
    {
         return self::where('id', $request->id)
         ->update([
            'question'=>$request->question,
            'answer'=>$request->answer,
          ]); 
    }
    public function shoppingFaqDelete($request)
    {
         return self::where('id', $request->id)
         ->delete(); 
    }
    public function shoppingFaqList()
    {
        return self::get();
    }
}

<?php

namespace Modules\Faq\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Modules\Faq\Entities\Faq;
use Modules\Categories\Entities\Categories;

use Session,DB;

class AdminFaqController extends Controller
{
    public function index()
    {
        return view('faq::admin.index');
    }

    public function list(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;

        $category = Faq::with('category');

        if ($search != '') 
        {
            $category->where('question', 'LIKE', '%'.$search.'%');
            $category->where('answer', 'LIKE', '%'.$search.'%');
            $category->whereHas('category', function($q) use ($search) {
                        $q->where('name', 'LIKE', '%'.$search.'%');
                    });
        }

        $total  = $category->count();

        $result['data'] = $category->take($request->length)->skip($request->start)->get();
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }


    public function add()
    {
        $categories = Categories::where('is_last_child',1)->where('status',1)->get();
        return view('faq::admin.add',compact('categories'));
    }

    public function store(Request $request)
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $category = new Faq;
        $category->category_id = $request->category_id;
        $category->question = $request->question;
        $category->answer = $request->answer;
        $category->save();

        Session::flash('message', 'Entry added successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/faq');
    }

    public function edit($id)
    {
        $faq = Faq::with('category')->find($id);

        return view('faq::admin.edit',compact('faq'));
    }

    public function update(Request $request)
    {
        $category = Faq::find($request->id);
        $category->question = $request->question;
        $category->answer = $request->answer;
        $category->save();

        Session::flash('message', 'Entry updated successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/faq');
    }

    public function delete($id)
    {
        $category = Faq::find($id);
        $category->delete();

        Session::flash('message', 'Entry deleted successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/faq');
    }
}

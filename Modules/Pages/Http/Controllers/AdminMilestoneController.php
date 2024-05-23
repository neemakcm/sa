<?php

namespace Modules\Pages\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;

use Modules\Pages\Entities\Settings;
use Modules\Pages\Entities\Milestone;

use Session,Str;

class AdminMilestoneController extends Controller
{
    
    public function index()
    {
        return view('pages::milestone.index');
    }

    public function list(Request $request)
    {
        $search   = $request->search['value'];
        $sort     = $request->order;
        $column   = $sort[0]['column'];
        $order    = $sort[0]['dir'] == 'asc' ? "ASC" : "DESC" ;

        $pages = Milestone::where('id','>',0);
        if ($search != '') 
        {
            $pages->where('year', 'LIKE', '%'.$search.'%')->orWhere('milestone', 'LIKE', '%'.$search.'%');
        }

        $total  = $pages->count();

        $result['data'] = $pages->take($request->length)->skip($request->start)->get();
        //dd($result['data']);
        $result['recordsTotal'] = $total;
        $result['recordsFiltered'] =  $total;

        echo json_encode($result);
    }

    public function add()
    {
        return view('pages::milestone.add');
    }

    public function store(Request $request)
    {
        $industry = new Milestone;
        $industry->year = $request->year;
        $industry->milestone = $request->milestone;
        $industry->save();

        Session::flash('message', 'Entry added successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/milestones');

    }

    public function edit($id)
    {
        $page = Milestone::find($id);
        return view('pages::milestone.edit',compact('page'));
    }

    public function update(Request $request)
    {
        $industry = Milestone::find($request->id);
        $industry->year = $request->year;
        $industry->milestone = $request->milestone;
        $industry->save();

        Session::flash('message', 'Entry updated successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/milestones');

    }

    public function delete($id)
    {
        $page = Milestone::find($id);
        $page->delete();

        Session::flash('message', 'Entry deleted successfully' ); 
        Session::flash('alert-class', 'alert-success'); 

        return redirect('admin/milestones');
    }
}

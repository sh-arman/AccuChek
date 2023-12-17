<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Template;
use Illuminate\Http\Request;

class TemplateController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index( )
    {
        $datas = Template::all(['id','manufacture','product','detail','status']);
        return view('admin.template')->with('datas',$datas);
    }

    public function store(Request $req)
    {
        $req->validate([
            'manufacture' => 'required|max:255',
            'product' => 'required',
            'detail' => 'required',
        ]);
        Template::insert([
            'manufacture' => $req->manufacture,
            'product' => $req->product,
            'detail' => $req->detail,
            'status' => $req->status,
            'created_at' => Carbon::now(),
        ]);
        return back()->with('success','Template Saved .');
    }



    public function update(Request $req, $id)
    {
        $req->validate([
            'manufacture' => 'required|max:255',
            'product' => 'required',
            'detail' => 'required',
        ]);
        $template = Template::findOrFail($id);
        $template->update([
            'manufacture' => $req->manufacture,
            'product' => $req->product,
            'detail' => $req->detail,
            'status' => $req->status,
            'updated_at' => Carbon::now(),
        ]);
        return back()->with('success','Template Updated .');
    }


    public function delete($id)
    {
        Template::find($id)->delete();
        return back()->with('success','Template Deleted .');
    }
}


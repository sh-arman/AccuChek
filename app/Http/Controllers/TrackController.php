<?php

namespace App\Http\Controllers;

use App\Models\Track;

class TrackController extends Controller
{
    public function index()
    {
        $tracks = Track::latest()->get();
        return view('admin.track')->with('tracks',$tracks);
    }


    public function s()
    {
        return view('admin.support');
    }


    public function delete()
    {
        Track::truncate();
        return back()->with('success','All Track Deleted .');
    }
}

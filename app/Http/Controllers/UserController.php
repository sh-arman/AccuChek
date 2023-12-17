<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        # code...
        $users = User::whereNotNull('role')->get();
        return view('admin.users')->with('users',$users);
    }



    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        if($request->password) {
            $user->update([
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'updated_at' => Carbon::now(),
            ]);
        } else {
            $user->update([
                'phone_number' => $request->phone_number,
                'email' => $request->email,
                'updated_at' => Carbon::now(),
            ]);
        }

        Session::flash('success', 'Profile Updated Successfully');
        return redirect()->back();
    }



    public function delete($id)
    {
        $users = User::findOrFail($id);
        $users->tracks->truncate();
        $users->activision->truncate();
        $users->delete();
        Session::flash('success', 'Account Deleted!');
        return redirect()->back();
    }
}

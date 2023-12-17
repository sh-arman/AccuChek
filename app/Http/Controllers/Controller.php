<?php

namespace App\Http\Controllers;

use SoapClient;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Track;
use App\Models\Activation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    // public function login()
    // {
    //     # code...
    //     // $users = User::whereNotNull('role')->get();
    //     return view('admin.login');
    // }


    // public function login_submit(Request $req)
    // {
    //     $phoneNo = $req->phone_number;

    //     if (is_numeric($phoneNo)) {
    //         if (strlen($phoneNo) == 11) {
    //             $startDigits = substr($phoneNo, 0, 3);
    //             if ($startDigits == '017' || $startDigits == '016' || $startDigits == '015' || $startDigits == '019' || $startDigits == '018' || $startDigits == '013' || $startDigits == '014') {
    //                 // return $phoneNo;
    //                 if (!$user = User::where('phone_number', $phoneNo)->first()) {
    //                     return back()->with('error', 'User Not Faund .');
    //                 }
    //                 session([
    //                     'userId'  => $user->id,
    //                     'phoneNo' => $phoneNo,
    //                 ]);
    //                 $userId = $user->id;

    //                 if ($userId == null) $userId = session('userId');
    //                 $user = User::find($userId);

    //                 $activation = Activation::create([
    //                     'user_id' => $user->id,
    //                     'otp' => $this->generateOTP()
    //                 ]);

    //                 $message = "Shaheen Login OTP: " . " " . $activation->otp;


    //                 try {
    //                     $soapClient = new SoapClient("https://user.mobireach.com.bd/index.php?r=sms/service");
    //                     $soapClient->SendTextMessage('panacealive', 'Panacearocks@2022', 'MAXPRO', $req->phone_number, $message);

    //                     return view('admin.otp')->with('success', 'OTP Send .');
    //                 } catch (\Illuminate\Database\QueryException $e) {
    //                     Log::info("Shaheen login OTP :" . $e->getMessage());
    //                 }
    //                 return back()->with('error', 'User Not Faund .');
    //             } else {
    //                 return back()->with('error', 'Phone Number not Valid.');
    //             }
    //         }
    //     } else {
    //         return back()->with('error', 'Phone Number not Valid.');
    //     }
    // }


    // public function login_confirm(Request $req)
    // {
    //     # code...
    //     // return $req->all();

    //     if (strlen($req->otp) == 4) {
    //         $user = User::find(session('userId'));
    //         $otp = strtoupper($req->otp);

    //         $activation = Activation::where('user_id', $user->id)
    //             ->where('otp', $otp)
    //             ->where('completed', 0)
    //             ->first();
    //         if ($activation === null) {
    //             return false;
    //         }
    //         $activation->fill([
    //             'completed'    => 1,
    //             'updated_at' => Carbon::now(),
    //         ]);
    //         $activation->save();

    //         // $phoneNo = session('phoneNo');

    //         // $credentials = $req->only('phone_number', $phoneNo);
    //         // if (Auth::guard()->attempt($credentials)) {

    //             // Authentication passed...
    //             Track::create([
    //                 'user_id' => Auth::user()->id,
    //                 'action' => 1 // login
    //             ]);
    //             // return redirect()->intended('dashboard');
    //             return view('admin.dashboard');
    //         //  }
    //         //  return view('admin.login');


    //         // return true;
    //     } else {
    //         return back()->with('error', 'Phone Number not Valid.');
    //     }
    // }




    // private function generateOTP()
    // {
    //     $an = "0123456789";
    //     $su = strlen($an) - 1;
    //     $otp = substr($an, rand(0, $su), 1) .
    //         substr($an, rand(0, $su), 1) .
    //         substr($an, rand(0, $su), 1) .
    //         substr($an, rand(0, $su), 1);
    //     return $otp;
    // }

    // protected function guard()
    // {
    //     return Auth::guard();
    // }


    function custom_login(Request $request)
    {
        $request->validate([
            'phone_number' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('phone_number', 'password');
        if (Auth::attempt($credentials)) {
            Track::create([
                'user_id' => Auth::user()->id,
                'action' => 1 // login
            ]);
            return redirect('admin/dashboard')->withSuccess('Signed in Success '. Auth::user()->name);
        }

        return redirect("login")->with('error', 'Phone Number not Valid.');
    }


        // for register
        protected function validator(array $data)
        {
            return Validator::make($data, [
                'name' => 'required|string|max:100',
                'phone_number' => 'required|numeric|min:11|unique:users',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:4',
                'role' => 'required',
            ]);
        }


        public function custom_register(Request $request)
        {
            // return $request->all();
            try {
                return User::create([
                    'name' => $request->name,
                    'phone_number' => $request->phone_number,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'role' => $request->role,
                ]);
            } catch ( \Illuminate\Database\QueryException $e ) {
                Log::info("User Register Failed:". $e->getMessage());
                Session::flash('success', 'User Register Failed');
                return redirect()->back();
            }
        }

}

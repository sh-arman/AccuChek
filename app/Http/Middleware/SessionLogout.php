<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SessionLogout
{

    // protected $session;
    // protected $timeout = 1000; //Session Expire time in seconds

    // public function __construct($session){
    //     $this->session = $session;
    // }

    public function handle($request, Closure $next)
    {

        // $minutesBeforeSessionExpire=30;
        // if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > ($minutesBeforeSessionExpire*60))) {
        //     session_unset();     // unset $_SESSION
        //     session_destroy();   // destroy session data
        //     Session::flush();
        //     Auth::logout();
        //     session()->flash('success', 'You have been inactive for more than 30 minutes. Please login again');
        //     return redirect()->to('/');
        // }
        // $_SESSION['LAST_ACTIVITY'] = time(); // update last activity

        // $sess = Session::get('timestamp');
        // if ($sess) {
        //     if ((int)$sess + 60 < time()) {

        //         $user = User::findById(Session::get('id'));
        //         // User::create([
        //         //         'id' => Auth::user()->id,
        //         //         'logout' => Carbon::now()
        //         // ]);
        //         Session::flush();
        //         Auth::logout();
        //         session()->flash('success', 'You have been inactive for more than 30 minutes. Please login again');
        //         return redirect()->to('/');
        //     } else {
        //         Session::put('timestamp', time());

        //     }
        // }


        return $next($request);
    }
}

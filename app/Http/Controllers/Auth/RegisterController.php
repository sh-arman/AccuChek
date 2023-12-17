<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |--------------------------------------------------------------------------
    |   Author: Shajedul Hasan Arman - armanhassan504@gmail.com
    |--------------------------------------------------------------------------
    |   Laravel Framework 9.17.0
    |   Composer version 2.3.7 2022-06-06
    |   PHP 8.1.4
    |   Auth Custom - Bootstrap - 5 [ vendor->laravel->ui->auth-bakend ]
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('guest');
    //     // $this->middleware('admin');
    // }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
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

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        try {
            return User::create([
                'name' => $data['name'],
                'phone_number' => $data['phone_number'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => $data['role'],
            ]);
        } catch ( \Illuminate\Database\QueryException $e ) {
            Log::info("User Register Failed:". $e->getMessage());
            Session::flash('success', 'User Register Failed');
            return redirect()->back();
        }

    }
}

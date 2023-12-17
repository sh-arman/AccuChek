<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    // ];

    public function tracks()
    {
        return $this->hasMany(Track::class);
    }


    public function activision()
    {
        return $this->belongsTo(Activation::class);
    }


    public static function IsValidPhoneNo($phoneNo)
    {
        if ( is_numeric($phoneNo) ) {
            if (strlen($phoneNo) == 11)
            {
                $startDigits = substr($phoneNo , 0 , 3);
                if (   $startDigits=='013' 
                    || $startDigits=='014' 
                    || $startDigits=='015' 
                    || $startDigits=='016' 
                    || $startDigits=='017' 
                    || $startDigits=='018' 
                    || $startDigits=='019') {
                    return $phoneNo;
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }


    // public static function IsValidPhoneNo($phoneNo)
    // {
    //     if ( is_numeric($phoneNo) ) {
    //         if (strlen($phoneNo) > 11)
    //         {
    //             $phoneNo = substr($phoneNo , -11);
    //         }
    //         else if (strlen($phoneNo) < 11)
    //         {
    //             return false;
    //         }
    //         else if (strlen($phoneNo) == 11)
    //         {
    //             $startDigits = substr($phoneNo , 0 , 3);
    //             if ($startDigits=='017' || $startDigits=='016' || $startDigits=='015' || $startDigits=='019' || $startDigits=='018' || $startDigits=='013' || $startDigits=='014') {
    //                 return $phoneNo;
    //             } else {
    //                 return false;
    //             }
    //         }
    //     } else {
    //         return false;
    //     }
    // }
}

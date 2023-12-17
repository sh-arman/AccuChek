<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Activation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'otp',
        'completed',
    ];


    public function users()
    {
        return $this->hasMany(User::class);
    }


    public static function complete($user, $otp)
    {
        $activation = Activation::where('user_id', $user->id)
            ->where('otp', $otp)
            ->where('completed', 0)
            ->first();
        if ($activation === null) {
            return false;
        }
        $activation->fill([
            'completed'    => 1,
            'updated_at' => Carbon::now(),
        ]);
        $activation->save();
        return true;
    }


}

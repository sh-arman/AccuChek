<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    use HasFactory;

    protected $fillable = [
        'phone_number',
        'code',
        'source',
        'location',
        'remarks',
    ];

    // protected $casts = [
    //     'created_at' => 'date:d-m-Y'
    // ];
    protected $dates = ['expired_at'];




    public function code()
    {
        return $this->belongsTo(Code::class);
    }

}

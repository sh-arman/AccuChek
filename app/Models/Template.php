<?php

namespace App\Models;

use App\Models\Code;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Template extends Model
{
    use HasFactory;

    protected $fillable = [
        'manufacture',
        'product',
        'detail',
        'status'
    ];


    public function codes()
    {
        return $this->hasMany(Code::class);
    }
}

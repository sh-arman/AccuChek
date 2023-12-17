<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Template;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Code extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'status',
    ];


    public function template()
    {
        return $this->belongsTo(Template::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

}

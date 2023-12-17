<?php

namespace App\Models;

use App\Models\Code;
use App\Models\Template;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $dates = [
        'manufacture_date',
        'expiry_date'
    ];

    protected $fillable = [
        'template_id',
        'manufacture_date',
        'expiry_date',
        'quantity',
        'batch_number',
        'file',
        'destination',
        'status',
    ];

    public function codes()
    {
        return $this->hasMany(Code::class);
    }

    public function template()
    {
        return $this->belongsTo(Template::class);
    }
}

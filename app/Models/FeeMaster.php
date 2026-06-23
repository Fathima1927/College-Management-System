<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeMaster extends Model
{
    protected $fillable = [
        'department',
        'category',
        'fee_name',
        'amount',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeePayment extends Model
{
    protected $fillable = [
        'student_name',
        'fee_name',
        'amount',
        'payment_mode',
        'status',
        'payment_date',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeReceipt extends Model
{
    protected $fillable = [
        'receipt_number',
        'student_name',
        'fee_name',
        'amount',
        'payment_date',
    ];
}
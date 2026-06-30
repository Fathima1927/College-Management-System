<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'college_name',
        'college_logo',
        'college_address',
        'college_phone',
        'college_email',
        'report_header',
        'report_footer',
    ];
}
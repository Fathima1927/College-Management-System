<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'employee_code',
        'employee_name',
        'photo',
        'address',
        'designation',
        'category',
        'pf_no',
        'esi_no',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Helper method to get photo URL
    public function getPhotoUrlAttribute()
    {
        if ($this->photo) {
            return asset('uploads/employees/' . $this->photo);
        }
        return asset('images/default-avatar.png');
    }

    // Scope for search
    public function scopeSearch($query, $search)
    {
        return $query->where('employee_name', 'LIKE', "%{$search}%")
                     ->orWhere('employee_code', 'LIKE', "%{$search}%")
                     ->orWhere('designation', 'LIKE', "%{$search}%")
                     ->orWhere('category', 'LIKE', "%{$search}%");
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_code',
        'subject_name',
        'department_id',
        'course_id',
    ];

    // Relationships
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Scope for search
    public function scopeSearch($query, $search)
    {
        return $query->where('subject_code', 'LIKE', "%{$search}%")
                     ->orWhere('subject_name', 'LIKE', "%{$search}%")
                     ->orWhereHas('department', function($q) use ($search) {
                         $q->where('department_name', 'LIKE', "%{$search}%");
                     })
                     ->orWhereHas('course', function($q) use ($search) {
                         $q->where('course_name', 'LIKE', "%{$search}%");
                     });
    }
}
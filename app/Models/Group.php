<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'course_id',
        'name',
        'start_date',
        'end_date',
        'start_time',
        'end_time',
        'created_at',
        'updated_at',
    ];


    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function enrollment()
    {
        return $this->hasMany(Enroll::class);
    }

     public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments')
            ->wherePivot('role', 'student')
            ->withPivot('status', 'grade', 'enrolled_at', 'completed_at');
    }

    public function teachers()
    {
        return $this->belongsToMany(User::class, 'enrollments')
            ->wherePivot('role', 'teacher');
    }
}

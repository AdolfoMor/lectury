<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CourseCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'slug',
        'description',
        'created_at',
        'updated_at',
    ];


    public function course()
    {
        return $this->hasMany(Course::class, 'category_id');
    }
}

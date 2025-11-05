<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'category_id',
        'created_by',
        'name',
        'description',
        'modality',
        'type',
        'price',
        'start_date',
        'end_date',
        'status',
        'created_at',
        'updated_at',
    ];

    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'category_id');
    }

    public function group()
    {
        return $this->hasMany(Group::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }


}

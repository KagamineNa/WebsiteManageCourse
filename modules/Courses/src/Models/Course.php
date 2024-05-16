<?php

namespace Modules\Courses\src\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Categories\src\Models\Category;

class Course extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'detail',
        'teacher_id',
        'thumbnail',
        'price',
        'sale_price',
        'code',
        'durations',
        'is_document',
        'supports',
        'status',
        // Add more fields here as needed
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'courses_categories');
    }

    // Define any relationships or additional methods here
}
<?php

namespace Modules\Courses\src\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Categories\src\Models\Category;
use Modules\Teacher\src\Models\Teacher;
use Modules\Lessons\src\Models\Lesson;
use App\Models\Scopes\ActiveScope;

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

    protected $with = ['teacher'];

    protected static function booted(): void
    {
        static::addGlobalScope(new ActiveScope);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'courses_categories');
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id', 'id');
    }

    public function lessons()
    {
        return $this->hasMany(Lesson::class, 'course_id', 'id');
    }

}
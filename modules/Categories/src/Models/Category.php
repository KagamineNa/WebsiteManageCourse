<?php

namespace Modules\Categories\src\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Courses\src\Models\Course;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'parent_id',
    ];

    // Define any relationships or additional methods here
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function subCategories()
    {
        return $this->children()->with('subCategories');
    }

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'courses_categories');
    }
}
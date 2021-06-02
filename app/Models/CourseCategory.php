<?php

namespace App\Models;

use App\Models\Model;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class CourseCategory extends Model
{
    use HasFactory;

    public function courses()
    {
        return $this->hasMany(Course::class, 'course_category_id', 'id');
    }

    public function getIsDeletableAttribute()
    {
        return $this->courses()->count() == 0;
    }

}

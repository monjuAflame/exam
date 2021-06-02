<?php

namespace App\Models;

use App\Models\Model;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    use HasFactory, SoftDeletes;

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'pivot_courses_topics',  'topic_id', 'course_id');
    }
}

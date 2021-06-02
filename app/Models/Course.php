<?php

namespace App\Models;

use Exception;
use App\Models\Exam;
use App\Models\Batch;
use App\Models\Sheet;
use App\Models\Model;
use App\Models\Topic;
use App\Models\Question;
use App\Models\QuestionSet;
use App\Models\CourseCategory;
use App\Models\CourseResource;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Course extends Model
{
    use HasFactory, SoftDeletes;

    public const ADMISSION_TYPE_ADMISSION = 'admission';
    public const ADMISSION_TYPE_MONTHLY = 'monthly';

    public function courseCategory()
    {
        return $this->belongsTo(CourseCategory::class, 'course_category_id');
    }

    public function topics()
    {
        return $this->belongsToMany(Topic::class, 'pivot_courses_topics', 'course_id', 'topic_id');
    }

    public function batches()
    {
        return $this->hasMany(Batch::class, 'course_id', 'id');
    }

    public function sheets()
    {
        return $this->hasMany(Sheet::class, 'course_id', 'id');
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'course_id');
    }

    public function questionSets()
    {
        return $this->hasMany(QuestionSet::class, 'course_id');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class, 'course_id');
    }

    public function enrolledUsers()
    {
        return $this->belongsToMany(User::class, 'enrolments', 'course_id', 'user_id')
            ->withTimestamps()
            ->withPivot(['admission_type', 'session', 'discount', 'batch_id']);
    }

    public function resources()
    {
        return $this->hasMany(CourseResource::class, 'course_id', 'id');
    }

    public function enrolments()
    {
        return $this->hasMany(Enrolment::class, 'course_id');
    }

    public static function createNew($data)
    {
        try {
            return Course::create([
                'name' => $data->name,
                'code' => isset($data->code) ? $data->code : null,
                'fee' => $data->fee,
                'course_category_id' => $data->course_category_id,
                'duration_in_weeks' => isset($data->duration_in_weeks) ? $data->duration_in_weeks : null,
                'total_class' => isset($data->total_class) ? $data->total_class : null,
                'total_exam' => isset($data->total_exam) ? $data->total_exam : null,
            ]);

        } catch (Exception $e) {
            logger($e->getMessage());
            return null;
        }
    }

    public function getIsDeletableAttribute()
    {
        return $this->enrolments()->count() == 0 && $this->batches()->count() == 0;
    }

}

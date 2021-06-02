<?php

namespace App\Models;

use Exception;
use App\Models\User;
use App\Models\Model;
use App\Models\Course;
use App\Models\Enrolment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Batch extends Model
{
    use HasFactory, SoftDeletes;


    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function exams()
    {
        // loop $batch->exams as $exam
        //      $exam->schedule->start_date_time, 
        //      $exam->schedule->user_id
        //      $exam->schedule->created_at

        return $this->belongsToMany(Exam::class, 'pivot_exam_schedule', 'batch_id', 'exam_id')
                    ->withTimestamps()
                    ->withPivot(['start_date_time', 'user_id'])
                    ->as('schedule');

    }

    public function enrolledUsers()
    {
        return $this->belongsToMany(User::class, 'enrolments', 'batch_id', 'user_id')
            ->withTimestamps()
            ->withPivot(['admission_type', 'session', 'discount', 'course_id']);        
    }

    public function enrolments()
    {
        return $this->hasMany(Enrolment::class, 'batch_id');
    }

    public static function createNew($data)
    {
        try {
            return Batch::create([
                'name' => $data->name,
                'course_id' => $data->course_id,
                'id_prefix' => $data->id_prefix,
                'days' => $data->days != null ? json_encode(explode(',', $data->days)) : null,
                'start_time' => $data->start_time != null ? date('H:i:s', strtotime($data->start_time)) : null,
                'end_time' => $data->end_time != null ? date('H:i:s', strtotime($data->end_time)) : null,
                'start_date' => null,
            ]);

        } catch (Exception $e) {
            logger($e->getMessage());
            return null;
        }
    }

    public function getFormattedDaysAttribute()
    {
        return $this->days != null ? implode('-', json_decode($this->days)) : 'N/A';
    }

    public function getFormattedTimeAttribute()
    {
        if ($this->start_time == null || $this->end_time == null) {
            return 'N/A';
        }
        return date('h:i A', strtotime($this->start_time)) . ' - ' . date('h:i A', strtotime($this->end_time));
    }

    public function getIsDeletableAttribute()
    {
        return $this->enrolments()->count() == 0;
    }

}

<?php

namespace App\Models;

use App\Models\Batch;
use App\Models\Model;
use App\Models\Course;
use App\Models\Payment;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enrolment extends Model
{
    use HasFactory;

    public function payments()
    {
        return $this->hasMany(Payment::class, 'enrolment_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class, 'batch_id');
    }

}

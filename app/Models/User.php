<?php

namespace App\Models;

use Exception;
use App\Models\DailyExpense;
use App\Models\Sheet;
use App\Models\Course;
use App\Models\Payment;
use App\Models\Enrolment;
use App\Models\CourseResource;
use App\Models\StudentProfile;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles, HasApiTokens, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'email',
        'avatar',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function studentProfile()
    {
        return $this->hasOne(StudentProfile::class, 'user_id', 'id');
    }

    public function enrolledCourses()
    {
        return $this->belongsToMany(Course::class, 'enrolments', 'user_id', 'course_id')
            ->withTimestamps()
            ->withPivot(['id', 'admission_type', 'session', 'discount', 'batch_id',]);
    }

    public function enrolledBatches()
    {
        return $this->belongsToMany(Batch::class, 'enrolments', 'user_id', 'batch_id')
            ->withTimestamps()
            ->withPivot(['admission_type', 'session', 'discount', 'course_id']);
    }

    public function resources()
    {        
        return $this->belongsToMany(CourseResource::class, 'pivot_students_resources', 'user_id', 'course_resource_id');
    }

    public function sheets()
    {        
        return $this->belongsToMany(Sheet::class, 'pivot_user_sheet', 'user_id', 'sheet_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id');
    }

    public function dailyExpense()
    {
        return $this->hasMany(DailyExpense::class, 'user_id');
    }

    // Payments verified/made by this Admin/Moderator
    public function receivedPayments()
    {
        return $this->hasMany(Payment::class, 'receiver');
    }

    public static function createNew($data)
    {
        try {
            return User::create([
                'first_name' => $data->first_name,
                'last_name' => $data->last_name,
                'email' => $data->email,
                'phone' => $data->phone,
                'password' => Hash::make($data->password),
            ]);
        } catch (Exception $e) {
            logger($e->getMessage());
            return null;
        }

    }

    public function enrolments()
    {
        return $this->hasMany(Enrolment::class, 'user_id');
    }

    public function getEnrolledCoursesNamesAttribute()
    {
        return $this->enrolledCourses()->pluck('name')->toArray();
    }

    public function getEnrolledBatchesNamesAttribute()
    {
        return $this->enrolledBatches()->pluck('name')->toArray();
    }

    public function attachSheets(array $sheet_ids = [])
    {
        $this->sheets()->attach($sheet_ids, ['created_at' => now(), 'updated_at' => now()]);        
    }

    public function assignStudentRole()
    {
        $student_role = Role::where('name', 'student')->first() ?? Role::create(['name' => 'student']);
        $this->assignRole($student_role);
    }


    public function answer()
    {
        return $this->hasMany(Answer::class, 'user_id');
    }
}

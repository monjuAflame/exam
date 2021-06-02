<?php

namespace App\Models;

use Exception;
use App\Models\User;
use App\Models\Model;
use App\Models\Enrolment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;
    
    public const METHOD_CASH = "cash";
    public const METHOD_BKASH = "bkash";

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Admin/moderator who verified/made this Payment    
    public function receivedUser()
    {
        return $this->belongsTo(User::class, 'receiver');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('confirmed', 1);
    }

    public static function getTotalPaidAmount(int $enrolment_id)
    {
        return static::where('enrolment_id', $enrolment_id)
                        ->confirmed()->sum('amount');
    }

    public function enrolment()
    {
        return $this->belongsTo(Enrolment::class, 'enrolment_id');
    }

    public static function createNew($data, $enrolment_id, $student_user_id)
    {
        try {
            return static::create([
                'amount' => $data->amount,
                'method' => 'cash',
                'confirmed' => auth()->user()->hasRole('admin'),
                'data' => json_encode($data->data),
                'user_id' => $student_user_id,
                'receiver' => auth()->user()->id,
                'enrolment_id' => $enrolment_id,
            ]);
        } catch (Exception $e) {
            logger($e->getMessage());
            return null;
        }
    }

}

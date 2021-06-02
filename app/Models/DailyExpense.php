<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Model;
use App\Models\Expense;
use App\Models\User;


class DailyExpense extends Model
{
    use HasFactory;

    public function expense()
    {
        return $this->belongsTo(Expense::class, 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public static function createNew($data, $expense_id, $user_id, $date)
    {
        try {
            return DailyExpense::create([
                'expense_id' => $expense_id,
                'user_id' => $user_id,
                'date' => $date,
                'amount' => $data->amount,
                'description' => $data->description,
            ]);

        } catch (Exception $e) {
            logger($e->getMessage());
            return null;
        }
    }
}

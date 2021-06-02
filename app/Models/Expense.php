<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Model;
use App\Models\DailyExpense;

class Expense extends Model
{
    use HasFactory;

    public function dailyExpense()
    {
        return $this->hasMany(DailyExpense::class, 'expense_id', 'id');
    }


}

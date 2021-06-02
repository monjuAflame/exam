<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DailyExpense;
use App\Models\Expense;
use Auth;
use Carbon\Carbon;
class ExpenseController extends Controller
{
    public function index(){
        return view('admin.expense.index');
    }

    public function create(){
        $dailyExpenses = DailyExpense::with('user')->get();
        return view('admin.expense.create', compact(['dailyExpenses']));
    }

    
    public function store(Request $request)
    {
        // dd($request->all());
        $existsExpenseDate = $this->ExistsExpenseDate($request->date);
        $userId = Auth::user()->id;

        if ($existsExpenseDate==false) {
            $expense = Expense::create([ 'date'=> $request->date,'total_expense'=>$request->amount]);
            $dailyExpense = DailyExpense::createNew($request, $expense->id, $userId, Carbon::now());
        } else {
            $expenseId = $this->ExpenseId($request->date);
            $dailyExpense = DailyExpense::createNew($request, $expenseId, $userId, Carbon::now());

            $totalExpense = DailyExpense::where('expense_id',$dailyExpense->expense_id)->sum('amount');
            $updateExpense = Expense::find($dailyExpense->expense_id);
            $updateExpense->date = $updateExpense->date;
            $updateExpense->total_expense = $totalExpense;
            $updateExpense->save();

        }
        

        if ($dailyExpense instanceof DailyExpense) {
            return back()->with('message', 'Expense created successfully!');
        } else {
            return back()->with('message', 'Something went wrong!')->withInput();
        }

    }
    public function ExistsExpenseDate($date)
    {
        $existsExpense = Expense::where(function($query) use ($date){
                           $query->where('date', 'LIKE', "%$date%");
                         })
                       ->first();
        if (empty($existsExpense)) {
            return false;
        } else {
            return true;
        }
    }
    public function ExpenseId($date)
    {
        $expenseId = Expense::where(function($query) use ($date){
                                $query->where('date', 'LIKE', "%$date%");
                               })
                               ->first();
        return $expenseId->id;
    }

    public function edit($id)
    {
        $dailyExpense = DailyExpense::find($id);
        return view('admin.expense.edit', compact(['dailyExpense']));
    }

    public function update(Request $request, $id)
    {
            
            $dailyExpense = DailyExpense::find($id);
            $dailyExpense->expense_id = $dailyExpense->expense_id;
            $dailyExpense->user_id = $dailyExpense->user_id;
            $dailyExpense->date = Carbon::now();
            $dailyExpense->description = $request->description;
            $dailyExpense->amount = $request->amount;
            $dailyExpense->save();

            $totalExpense = DailyExpense::where('expense_id',$dailyExpense->expense_id)->sum('amount');
            $updateExpense = Expense::find($dailyExpense->expense_id);
            $updateExpense->date = $updateExpense->date;
            $updateExpense->total_expense = $totalExpense;
            if ($updateExpense->save()) {
                return back()->with('message', 'Expense Updted successfully!');
            }
            return back()->with('message', 'Ops! Something went wrong.');    
    }

    public function destroy($id)
    {
        
        $dailyExpense = DailyExpense::findOrFail($id);
        $dailyExpense->delete();
        
        $totalExpense = DailyExpense::where('expense_id',$dailyExpense->expense_id)->sum('amount');
        $updateExpense = Expense::find($dailyExpense->expense_id);
        $updateExpense->date = $updateExpense->date;
        $updateExpense->total_expense = $totalExpense;
        if ($updateExpense->save()) {
            logger('delete');
    		return back()->with('message', 'Expense deleted successfully!');
        }
        return back()->with('message', 'Ops! Something went wrong.');    
    }
}

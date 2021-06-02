<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Expense;

class ReportConteroller extends Controller
{
    public function index(){
        return view('admin.report.income_satement');
    }

    public function incomeStatement(Request $request)
    {

        if ($request->ajax()) {
            $form = $request->form;
            $to = $request->to;

            $incomes = $this->income()
                    ->select("users.first_name",
                             "users.last_name",
                             "student_profiles.student_id",
                             "courses.name as course",
                             "batches.name as batch",
                             "payments.created_at",
                             "payments.amount")
                    ->whereDate('payments.created_at','>=',$form)
                    ->whereDate('payments.created_at','<=',$to)
                    ->orderBy('student_profiles.student_id')
                    ->get();
            $total_income = $this->income()
                        ->whereDate('payments.created_at','>=',$form)
                        ->whereDate('payments.created_at','<=',$to)
                        ->sum('amount');
            $expenses = Expense::whereDate('created_at','>=',$form)
                        ->whereDate('created_at','<=',$to)
                        ->get();
            $total_expense = Expense::whereDate('created_at','>=',$form)
                                    ->whereDate('created_at','<=',$to)
                                    ->sum('total_expense');
            $net_profit = $total_income-$total_expense;
            
            return view('admin.report.list.income_statement',compact(['incomes','expenses','total_expense','total_income','net_profit','form','to']));
        }

    }

    public function income()
    {
      return Payment::join('users','users.id','=','payments.user_id')
                    ->join('enrolments','enrolments.id','=','payments.enrolment_id')
                    ->join('courses','courses.id','=','enrolments.course_id')
                    ->join('batches','batches.id','=','enrolments.batch_id')
                    ->join('student_profiles','student_profiles.user_id','=','users.id');
                          
    }
}

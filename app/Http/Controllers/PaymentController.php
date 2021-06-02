<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Enrolment;
use Illuminate\Http\Request;
use App\Traits\RedirectPages;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
	use RedirectPages;

    public function index()
    {
		$payments = Payment::with([
			'enrolment' => function($query) {
				$query->with('course');
			},
			'user' => function($query) {
				$query->withTrashed()->with([
					'studentProfile' => function($query) {
						$query->withTrashed();
					},
				]);
			},
		])->latest()->get();
       	return view('admin.payment.index', compact([
			   'payments'
		   ]));
    }
    
    public function search()
    {
       return view('admin.payment.search');
    }
    
    public function create()
    {
       return view('admin.payment.create');
    }

	public function store(Request $request, $enrolment)
    {
        $enrolment = DB::table('enrolments')->where('id', $enrolment)->first();

		$payment_section = 'payment-section';

		if ($enrolment == null) {
			return $this->redirectTo(url()->previous(), $payment_section, [
				'payment_message' => 'No enrolment was found!',
			]);
         }

         $discount = (int) $request->has('discount') ? $request->discount : 0;
         if ($discount > 0) {
			$enrolment->discount = $discount;
            DB::update('update enrolments set discount = ? where id = ?', [$discount, $enrolment->id]);
         }
         
         $paid_amount = (int) $request->paid;

         if ($paid_amount < 1) {
			return $this->redirectTo(url()->previous(), $payment_section, [
				'payment_message' => $discount > 0 ? 'Discount updated!' : 'Invalid request!',
			]);
         }

         $data = ['remarks' => $request->remarks];
         $request->merge([
            'data' => $data,
            'amount' => $paid_amount,
         ]);

         $payment = Payment::createNew($request, $enrolment->id, $enrolment->user_id);

        if ($payment == null) {
			return $this->redirectTo(url()->previous(), $payment_section, [
				'payment_message' => 'Payment could not be saved!',
			]);
		}

		return $this->redirectTo(url()->previous(), $payment_section, [
				'payment_message' => 'Payment received successfully!',
			]);

   	}

	   public function invoice(Payment $payment)
	   {
		  $invoice = $invoice = Payment::with([
											'enrolment' => function($query) {
												$query->with('course');
												$query->with('batch');
											},
											'user' => function($query) {
												$query->with('studentProfile');
											}
										])->where('id',$payment->id)->latest()->first();
			$receiver =  Payment::with('receivedUser')->first();
		  return view('admin.payment.invoice.invoice', compact(['payment','invoice','receiver']));
	   }

   public function fullInvoice($user_id)
   {	
	    $payments = Payment::where('user_id',$user_id)->get();
		$invoice = Enrolment::with([
							'course',
							'batch',
							'user' => function($query) {
								$query->with('studentProfile');
							}
						])->where("user_id",$user_id)->latest()->first();
		$receiver =  Payment::with('receivedUser')->first();
        return view('admin.payment.invoice.fullinvoice', compact(['payments','invoice','receiver']));
   }
   

	public function confirm(Payment $payment)
	{
		$payment_section = 'payment-section';
		$messages = [];
		if ($payment->confirmed) {
			$messages = [
				'payment_message' => 'Payment is confirmed already!',
			];
		} else {
			$payment->confirmed = true;
			$payment->receiver = auth()->user()->id;
			if ($payment->save()) {
				$messages = [
					'payment_message' => 'Payment is confirmed!',
				];
			} else {
				$messages = [
					'payment_message' => 'Sorry! Could not confirm the payment.',
				];
			}
		}
		return $this->redirectTo(url()->previous(), $payment_section, $messages);

		
	}

}

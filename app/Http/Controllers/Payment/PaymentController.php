<?php

namespace App\Http\Controllers\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Members\Members;
use App\Models\Payment\Payment;

class PaymentController extends Controller
{
    public function newPayment() {
    	$members    = new Members;
    	$allMembers = $members->all();
    	return view('auth.payment.new_payment', ['data' => $allMembers]);
    }

    public function addPayment(Request $request) {
    	$request->validate([
    		'user_id' => 'required|numeric',
            'msg'  => 'required',
    		'amount'  => 'required'
    	]);

    	$payment = new Payment;
    	$payment->userId = $request->input('user_id');
        $payment->msg    = $request->input('msg');
    	$payment->amount = $request->input('amount');

    	if ($payment->save())
    		return redirect()->back()->with('msg', 'Request has been created successfully');
    	else
    		return redirect()->back()->with('msg', 'Something wrong while creating');
    }

    public function allPayments() {
    	$payment = new Payment;

        $all_payments = $payment->all();
        return view('auth.payment.all_payments', ['all_payments' => $all_payments]);
    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Razorpay\Api\Api;
use App\Models\Payment;
use Session;
use Redirect;
use Auth;

class PaymentController extends Controller
{
    public function create()
    {        
        return view('professional');
    }
	
	public function payment(Request $request)
    {
		
		$user = auth()->user();
		//Check User Payment
		if (Payment::where('user_id', $user->id)->exists()) {
			return back()->with('error','Your payment is already done.');
		}
        $input = $request->all();
        $api = new Api(config('services.rozarpay.public_key'), config('services.rozarpay.private_key'));
        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        if(count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id'])->capture(array('amount'=>$payment['amount']));
            } catch (\Exception $e) {
                return  $e->getMessage();
                \Session::put('error',$e->getMessage());
                return redirect()->back();
            }
        }
        
		$payInfo = [
			   'payment_id' => $input['razorpay_payment_id'],
			   'user_id' => Auth::id(),
			   'amount' => $payment['amount'],
			   'created_at' => date('Y-m-d H:i:s'),
			];
		Payment::insertGetId($payInfo);
		
        \Session::put('success', 'Payment successful');
        return redirect()->back();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\User;
Use App\Models\CheckSubscription;
use Stripe;
use Session;
use Exception;
use Auth;

class SubscriptionController extends Controller
{
     public function index()
    {
        return view('subscription.create');
    }
	
	public function companyCreate()
    {
        return view('subscription.create');
    }
	public function companyPost()
    {  
		if($type = auth()->user()->user_type == 'company'){
			return view('subscription.company');
		}
		else if($type = auth()->user()->user_type == 'user'){
			return view('subscription.create');
		}
		else {
			return abort(403, 'Unauthorized action.');
		}
    }
	public function orderPost(Request $request)
    {	
			
            $user = auth()->user();
			//Check User Payment
			if (CheckSubscription::where('user_id', $user->id)->where('stripe_status','=','active')->exists()) {
				return back()->with('error','Your payment is already done.');
			}
			
            $input = $request->all();
            $token =  $request->stripeToken;
            $paymentMethod = $request->paymentMethod;
            try {

                Stripe\Stripe::setApiKey(config('services.stripe.private_key'));
                
                if (is_null($user->stripe_id)) {
                    $stripeCustomer = $user->createAsStripeCustomer();
                }

                \Stripe\Customer::createSource(
                    $user->stripe_id,
                    ['source' => $token]
                );

                $user->newSubscription('test','price_1KbIrbSE3DSWbsl9DheATIHd')
                    ->create($paymentMethod, [
                    'email' => $user->email,
                ]);

                return back()->with('success','Subscription is completed.');
            } catch (Exception $e) {
                return back()->with('success',$e->getMessage());
            }
            
    }
    public function orderCompany(Request $request)
    {	
            $user = auth()->user();
			//Check User Payment
			if (CheckSubscription::where('user_id', $user->id)->where('stripe_status','=','active')->exists()) {
				return back()->with('error','Your payment is already done.');
			}
			
            $input = $request->all();
            $token =  $request->stripeToken;
            $paymentMethod = $request->paymentMethod;
            try {

                Stripe\Stripe::setApiKey(config('services.stripe.private_key'));
                
                if (is_null($user->stripe_id)) {
                    $stripeCustomer = $user->createAsStripeCustomer();
                }

                \Stripe\Customer::createSource(
                    $user->stripe_id,
                    ['source' => $token]
                );
				/*
					Price Source code for testing purpose with 1 rupees
					price_1KdSxFSE3DSWbsl9hOvH0V3D
					
					Test mode price source code for testing API
					price_1KbIsASE3DSWbsl9M2etRYsO
					
					Live Mode price source code for original payment
					price_1Kd7KMSE3DSWbsl9Wuwi2uhe
				*/ 
                $user->newSubscription('test','price_1KdSxFSE3DSWbsl9hOvH0V3D')
                    ->create($paymentMethod, [
                    'email' => $user->email,
                ]);

                return back()->with('success','Company subscription is completed.');
            } catch (Exception $e) {
                return back()->with('success',$e->getMessage());
            }
            
    }
}

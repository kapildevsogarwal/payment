<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Validator;

class StorePurchaseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
		//echo "<pre>";print_r($input);die;
        //$request = request();
		$return =  [
              'invoice_no' => ['required', 'string', 'max:100'],
              'party_id' => ['required'],
			  'net_amount' => ['required'],
			  'total_amount' => ['required'],
           ];
		return $return;
    }
}

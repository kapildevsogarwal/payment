<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Validator;

class StorePartyRequest extends FormRequest
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
		$input = $this->request->all();
        $request = request();
		
		return [
              'name' => ['required', 'string', 'max:100'],
              'address' => ['required', 'string', 'max:255'],
              'email' => ['required', 'email', 'string', 'max:100'],
              'gst_number' => ['required', 'string', 'max:255'],
			  'account_number' => ['required', 'string', 'max:255'],
			  'ifsc_code' => ['required', 'string', 'max:255'],
           
           ];
        }
}

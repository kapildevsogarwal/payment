<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePartyEditRequest extends FormRequest
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
		$input = $this->request->all();//echo print_r($input);die;
        $request = request();
		
		return [
		  'name' => ['required', 'string', 'max:255'],
		  'email' => ['required', 'string', 'email', 'max:255', Rule::unique('party_info')->ignore($input['id'])],
		  'address' => ['required', 'string', 'max:255'],
		  'gst_number' => ['required', 'string', 'max:255']
	   ];
      
    }
}

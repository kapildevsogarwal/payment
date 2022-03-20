<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfessionalProfileRequest extends FormRequest
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
            return [
              'first_name' => ['required', 'string', 'max:255'],
              'last_name' => ['required', 'string', 'max:255'],
              'father_name' => ['required', 'string', 'max:255'],
			  'mother_name' => ['required', 'string', 'max:255'],
              'address' => ['required', 'string', 'max:255'],
              'district' => ['required', 'string', 'max:255'],
              'state' => ['required', 'string', 'max:255'],
              'zip' => ['required', 'string', 'max:255'],
			  'type' => ['required', 'string', 'max:255'],
			  'description' => ['required', 'string', 'max:255'],
			  'experience' => ['nullable', 'string', 'max:255'],
           ];
    }
}

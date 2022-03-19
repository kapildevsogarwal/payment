<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreUserEditRequest extends FormRequest
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
        //echo "<pre>";print_r($input);die;
        if($input['user-type']=='user'){
            if ($request->hasFile('user_photo')) {
                return [ 'user_photo' => ['required','mimes:png,jpg,jpeg,bmp,gif','max:8192']];
            }

            if ($request->hasFile('aadhar_card')) {
                return [ 'aadhar_card' => ['required','mimes:png,jpg,jpeg,bmp,gif','max:8192']];
            }

            if ($request->hasFile('aadhar_card_back')) {
                return [ 'aadhar_card_back' => ['required','mimes:png,jpg,jpeg,bmp,gif','max:8192']];
            }


            return [
              'name' => ['required', 'string', 'max:255'],
              'first_name' => ['required', 'string', 'max:255'],
              'last_name' => ['required', 'string', 'max:255'],
              //'company_email' => ['required', 'string', 'email', 'max:255'],
              //'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($input['user_id'])],
              'dob' => ['required'],
             // 'password' => ['required', 'string', 'min:8', 'confirmed'],
              'address' => ['required', 'string', 'max:255'],
             // 'gst' => ['required', 'string', 'max:255'],
              'district' => ['required', 'string', 'max:255'],
              'state' => ['required', 'string', 'max:255'],
              'zipcode' => ['required', 'string', 'max:255'],
              //'type' => ['required', 'string', 'max:255'],
              'catalog_first' => ['nullable','mimes:png,jpg,jpeg,bmp,gif','max:8192'],
              'catalog_second' => ['nullable','mimes:png,jpg,jpeg,bmp,gif','max:8192'],
              'catalog_third' => ['nullable','mimes:png,jpg,jpeg,bmp,gif','max:8192'],
              'catalog_four' => ['nullable','mimes:png,jpg,jpeg,bmp,gif','max:8192'],
              'catalog_five' => ['nullable','mimes:png,jpg,jpeg,bmp,gif','max:8192'],
           ];
        }
    }
}

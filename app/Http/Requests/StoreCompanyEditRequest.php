<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCompanyEditRequest extends FormRequest
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
       // echo "<pre>";print_r($input);die;
            if ($request->hasFile('catalog_first')) {
                return [ 'catalog_first' => ['required','mimes:png,jpg,jpeg,bmp,gif,pdf','max:8192']];
            }

            if ($request->hasFile('catalog_second')) {
                return [ 'catalog_second' => ['required','mimes:png,jpg,jpeg,bmp,gif,pdf','max:8192']];
            }

            if ($request->hasFile('catalog_third')) {
                return [ 'catalog_third' => ['required','mimes:png,jpg,jpeg,bmp,gif,pdf','max:8192']];
            }

            if ($request->hasFile('catalog_four')) {
                return [ 'catalog_four' => ['required','mimes:png,jpg,jpeg,bmp,gif,pdf','max:8192']];
            }

            if ($request->hasFile('catalog_five')) {
                return [ 'catalog_five' => ['required','mimes:png,jpg,jpeg,bmp,gif,pdf','max:8192']];
            }


            return [
              'name' => ['required', 'string', 'max:255'],
              'address' => ['required', 'string', 'max:255'],
              'type' => ['required', 'string', 'max:255'],
              'gst' => ['required', 'string', 'max:255'],
              'district' => ['required', 'string', 'max:255'],
              'state' => ['required', 'string', 'max:255'],
              'zip' => ['required', 'string', 'max:255'],
              'catalog_first' => ['nullable','mimes:png,jpg,jpeg,bmp,gif','max:8192'],
              'catalog_second' => ['nullable','mimes:png,jpg,jpeg,bmp,gif','max:8192'],
              'catalog_third' => ['nullable','mimes:png,jpg,jpeg,bmp,gif','max:8192'],
              'catalog_four' => ['nullable','mimes:png,jpg,jpeg,bmp,gif','max:8192'],
              'catalog_five' => ['nullable','mimes:png,jpg,jpeg,bmp,gif','max:8192'],
           ];
        }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
	 protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    { 
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
			'lastname' => ['required', 'string', 'max:255'],
			'firstname' => ['required', 'string', 'max:255'],
			'district' => ['required', 'string', 'max:255'],
			'state' => ['required', 'string', 'max:255'],
			'zipcode' => ['required', 'string', 'max:255'],
			'dob' => ['required', 'date_format:Y-m-d'],
			'experience' => ['required', 'string', 'max:255'],
			'total_experience' => ['required', 'string', 'max:255'],
			'user_photo' => ['required','mimes:png,jpg,jpeg,bmp,gif','max:8192'],
			'address' => ['required', 'string', 'max:255'],
			'aadhar_card' => ['required','mimes:png,jpg,jpeg,bmp,gif,pdf','max:8192'],
			'aadhar_card_back' => ['required','mimes:png,jpg,jpeg,bmp,gif,pdf','max:8192'],
			'mother_name' => ['required', 'string', 'max:255'],
			'father_name' => ['required', 'string', 'max:255'],
			'tenth_board_name' => ['nullable','string', 'max:255'],
			'tenth_year_name' => ['nullable', 'integer',  'max:'.(date('Y'))],
			'tenth_percentage' => ['nullable', 'numeric', 'between:1,99.99'],
			'twelth_board_name' => ['nullable', 'string', 'max:255'],
			'twelth_year_name' => ['nullable','integer', 'max:'.(date('Y'))],
			'twelth_percentage' => ['nullable','numeric', 'between:1,99.99'],
			'degree_diploma' => ['nullable','string', 'max:255'],
			'degree_diploma_year' => ['nullable','integer', 'max:'.(date('Y'))],
			'degree_diploma_percentage' => ['nullable','numeric','between:1,99.99'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $request = request();
        $user =  User::create([
			'user_type' => 'user',
            'name' => $data['name'],
			'email' => $data['email'],
			'last_name' => $data['lastname'],
			'first_name' => $data['firstname'],
			'state' => $data['state'],
			'district' => $data['district'],
			'zipcode' => $data['zipcode'],
			'dob' => $data['dob'],
			'experience' => $data['experience'],
			'total_experience' => $data['total_experience'],
			//'user_photo' => $data['user_photo'],
			'address' => $data['address'],
            //'aadhar_card' => $data['aadhar_card'],
			//'aadhar_card_back' => $data['aadhar_card_back'],
			'father_name' => $data['father_name'],
			'mother_name' => $data['mother_name'],
			'tenth_board_name' => $data['tenth_board_name'],
			'tenth_year_name' => $data['tenth_year_name'],
			'tenth_percentage' => $data['tenth_percentage'],
			'twelth_board_name' => $data['twelth_board_name'],
			'twelth_year_name' => $data['twelth_year_name'],
			'twelth_percentage' => $data['twelth_percentage'],
			'degree_diploma' => $data['degree_diploma'],
			'degree_diploma_year' => $data['degree_diploma_year'],
			'degree_diploma_percentage' => $data['degree_diploma_percentage'],
            'password' => Hash::make($data['password']),
        ]);
		
		
		
		if ($request->hasFile('user_photo')) {
			$image = $request->file('user_photo');
			$name = time().'_avatar.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/documents/'.$user->id);
			$image->move($destinationPath, $name);
			$user->update(['user_photo'=>$name]);
		}
		
		if ($request->hasFile('aadhar_card')) {
			$image = $request->file('aadhar_card');
			$name = time().'_aadhar_front.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/documents/'.$user->id);
			$image->move($destinationPath, $name);
			$user->update(['aadhar_card'=>$name]);
		}
		
		if ($request->hasFile('aadhar_card_back')) {
			$image = $request->file('aadhar_card_back');
			$name = time().'_aadhar_card_back.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/documents/'.$user->id);
			$image->move($destinationPath, $name);
			$user->update(['aadhar_card_back'=>$name]);
			
		}
		return $user;
    }
}

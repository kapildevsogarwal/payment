<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\UserOrder;
use Auth;
use Session;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware(['auth'])->except('companyAdd','companySave');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$userlist = User::leftJoin('subscriptions', 'subscriptions.user_id', '=', 'users.id')->where('users.is_admin', '0')->where('users.user_type', 'user')->select(['users.id','users.name','users.first_name','users.last_name','users.dob','users.email','users.user_photo','users.address','users.aadhar_card','users.aadhar_card_back','users.father_name','users.mother_name','users.tenth_board_name','users.tenth_year_name','users.tenth_percentage','users.twelth_board_name','users.twelth_year_name','users.twelth_percentage','users.degree_diploma','users.degree_diploma_year','users.degree_diploma_percentage','subscriptions.stripe_status','subscriptions.created_at'])->orderby('users.id', 'desc')->paginate(20);
		
		$userObj = User::where('id', Auth::id())->first(['is_admin','user_type']);
		$adminFlag = $userObj->is_admin;
		$varUserType = $userObj->user_type;
		
		if($adminFlag==1){
			return view('home', compact('userlist'));
		}
		else if($userObj->user_type == 'company'){
			return view('subscription.company');
		}
		else if($userObj->user_type == 'user'){
			return view('subscription.create');
		}
		else{
			
		}
		
    }
	
	/**
     * Show the application list company.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function listCompany()
    {
			
		$companylist = Company::leftJoin('subscriptions', 'subscriptions.user_id', '=', 'company_info.user_id')->orderby('company_info.id', 'desc')->select(['company_info.id','company_info.name', 'company_info.user_id','company_info.email','company_info.address','company_info.type','company_info.catalog_first','company_info.catalog_second','company_info.catalog_third','company_info.catalog_four','company_info.catalog_five','subscriptions.stripe_status','subscriptions.created_at'])->paginate(20);	
		
		$isAdmin = User::where('id', Auth::id())->value('is_admin');
		if($isAdmin==1){
			return view('company.list', compact('companylist'));
		}
		else{
			return abort(403, 'Unauthorized action.');
		}
    }
	
	/**
     * Display the specified resource.
     *
     * @param  \SHR\DeliveryTicket  $deliveryTicket
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$userDetails = User::leftJoin('subscriptions', 'subscriptions.user_id', '=', 'users.id')->where('users.id',$id)->where('users.is_admin', '0')->where('users.user_type', 'user')->first(['users.id','users.name','users.first_name','users.last_name','users.dob','users.email','users.user_photo','users.address','users.aadhar_card','users.aadhar_card_back','users.father_name','users.mother_name','users.tenth_board_name','users.tenth_year_name','users.tenth_percentage','users.twelth_board_name','users.twelth_year_name','users.twelth_percentage','users.degree_diploma','users.degree_diploma_year','users.degree_diploma_percentage','subscriptions.stripe_status','subscriptions.created_at']);
        return view('home.details', compact('userDetails'));
    }
	
	/**
     * Display the specified resource.
     *
     * @param  \SHR\DeliveryTicket  $deliveryTicket
     * @return \Illuminate\Http\Response
     */
    public function showCompany($id)
    {
		$companyDetails = Company::leftJoin('subscriptions', 'subscriptions.user_id', '=', 'company_info.user_id')->orderby('company_info.id', 'desc')->where('company_info.id',$id)->first(['company_info.id','company_info.name', 'company_info.user_id','company_info.email','company_info.address','company_info.type','company_info.catalog_first','company_info.catalog_second','company_info.catalog_third','company_info.catalog_four','company_info.catalog_five','subscriptions.stripe_status','subscriptions.created_at']);
        return view('company.details', compact('companyDetails'));
    }
	
	public function companyAdd(){
		if(Auth::id() >0){
			return redirect('/home');
		}
		else{
			return view('company.create');
		}
	}
	
	public function companySave(Request $request){
		// Form validation
      $this->validate($request, [
          'name' => ['required', 'string', 'max:255'],
          'company_email' => ['required', 'string', 'email', 'max:255'],
		  'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
          'password' => ['required', 'string', 'min:8', 'confirmed'],
		  'address' => ['required', 'string', 'max:255'],
		  'type' => ['required', 'string', 'max:255'],
		  'catalog_first' => ['nullable','mimes:png,jpg,jpeg,bmp,gif','max:8192'],
		  'catalog_second' => ['nullable','mimes:png,jpg,jpeg,bmp,gif','max:8192'],
		  'catalog_third' => ['nullable','mimes:png,jpg,jpeg,bmp,gif','max:8192'],
		  'catalog_four' => ['nullable','mimes:png,jpg,jpeg,bmp,gif','max:8192'],
		  'catalog_five' => ['nullable','mimes:png,jpg,jpeg,bmp,gif','max:8192'],
       ]);
		
		$user =  User::create([
            'name' => $request->name,
			'email' =>  $request->email,
			'address' => $request->address,
			'user_type' => 'company',
            'password' => Hash::make($request->password),
        ]);
		
		$insertId = $user->id;
		$companyInfo = Company::create([
            'name' => $request->name,
			'email' => $request->company_email,
			'address' => $request->address,
			'type' => $request->type,
			'user_id'=>$insertId,
		]);
		Auth::attempt(['email' =>  $request->email, 'password' => $request->password]);
		
		if ($request->hasFile('catalog_first')) {
			$image = $request->file('catalog_first');
			$name = time().'first_company.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/documents/company/'.$companyInfo->id);
			$image->move($destinationPath, $name);
			$companyInfo->update(['catalog_first'=>$name]);
		}
		
		if ($request->hasFile('catalog_second')) {
			$image = $request->file('catalog_second');
			$name = time().'second_company.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/documents/company/'.$companyInfo->id);
			$image->move($destinationPath, $name);
			$companyInfo->update(['catalog_second'=>$name]);
		}
		
		if ($request->hasFile('catalog_third')) {
			$image = $request->file('catalog_third');
			$name = time().'third_company.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/documents/company/'.$companyInfo->id);
			$image->move($destinationPath, $name);
			$companyInfo->update(['catalog_third'=>$name]);
		}
		
		if ($request->hasFile('catalog_four')) {
			$image = $request->file('catalog_four');
			$name = time().'fourth_company.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/documents/company/'.$companyInfo->id);
			$image->move($destinationPath, $name);
			$companyInfo->update(['catalog_four'=>$name]);
		}
		
		if ($request->hasFile('catalog_five')) {
			$image = $request->file('catalog_five');
			$name = time().'fifth_company.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/documents/company/'.$companyInfo->id);
			$image->move($destinationPath, $name);
			$companyInfo->update(['catalog_five'=>$name]);
		}
		
		return redirect()->route('subscription.company.order.post')->with('success', 'Your information has been saved successfully!');
	}
	
}

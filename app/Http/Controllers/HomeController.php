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
		$userlist = User::leftJoin('subscriptions', 'subscriptions.user_id', '=', 'users.id')->where('users.is_admin', '0')->where('users.user_type', 'user')->orderby('users.id', 'desc')->paginate(20);
		
		$isAdmin = User::where('id', Auth::id())->value('is_admin');
		if($isAdmin==1){
			return view('home', compact('userlist'));
		}
		else{
			return view('subscription.create');
		}
    }
	
	/**
     * Show the application list company.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function listCompany()
    {
		$companylist = Company::orderby('id', 'desc')->paginate(20);
		
		$isAdmin = User::where('id', Auth::id())->value('is_admin');
		if($isAdmin==1){
			return view('company.list', compact('companylist'));
		}
		else{
			return view('payment');
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
		$userDetails = User::where('id',$id)->first();
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
		$companyDetails = Company::where('id',$id)->first();
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
          'email' => ['required', 'string', 'email', 'max:255'],
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
		
		$companyInfo = Company::create([
            'name' => $request->name,
			'email' => $request->email,
			'address' => $request->address,
			'type' => $request->type,
			'user_id' => $user->id,
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

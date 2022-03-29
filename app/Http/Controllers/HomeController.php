<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Company;
use App\Models\UserOrder;
use App\Models\Professional;
use App\Models\Payment;
use Auth;
use Session;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserEditRequest;
use App\Http\Requests\StoreCompanyEditRequest;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth'])->except('companyAdd','companySave');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
    	$userObj = User::where('id', Auth::id())->first(['is_admin','user_type','referal']);
    	$adminFlag = $userObj->is_admin;
		$varUserType = $userObj->user_type;
		$referal = $userObj->referal;
		
		$userlist = User::leftJoin('payments', 'payments.user_id', '=', 'users.id')
			->where('users.is_admin', '0')
			->where('users.user_type', 'user')
			->select(['users.id','users.name','users.first_name','users.last_name','users.dob','users.email','users.user_photo','users.address','users.aadhar_card','users.aadhar_card_back','users.father_name','users.mother_name','users.tenth_board_name','users.tenth_year_name','users.tenth_percentage','users.twelth_board_name','users.twelth_year_name','users.twelth_percentage','users.degree_diploma','users.degree_diploma_year','users.degree_diploma_percentage','payments.payment_id','payments.created_at as pay_time','users.district','users.experience','users.total_experience','users.user_type','users.referal'])->orderby('users.id', 'desc')->paginate(config('constant.table_pagination'));
		 
		$paymentId = User::leftJoin('payments', 'payments.user_id', '=', 'users.id')->where('users.id', Auth::id())->value('payments.payment_id');
			
		if($adminFlag==1){
			return view('home', compact('userlist','referal','paymentId'));
		}
		else if($userObj->user_type == 'company'){
			return view('subscription.company',compact('referal','paymentId'));
		}
		else if($userObj->user_type == 'user'){
			return view('subscription.create',compact('referal','paymentId'));
		}
		else if($userObj->user_type == 'professional'){
			return view('subscription.professional',compact('referal','paymentId'));
		}
		else{
			
		}
    }
	

	/** 
        * @param  \Illuminate\Http\Request  $request
        * Get search by companies data by compay name
        * @return \Illuminate\Http\Response
    */
    public function studentSearch(Request $request){
        if($request->ajax()){
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $userlist = User::leftJoin('payments', 'payments.user_id', '=', 'users.id')
			->where('users.is_admin', '0')
			->where('users.user_type', 'user')
			->where('name', 'like', '%'.$query.'%')
			->select(['users.id','users.name','users.first_name','users.last_name','users.dob','users.email','users.user_photo','users.address','users.aadhar_card','users.aadhar_card_back','users.father_name','users.mother_name','users.tenth_board_name','users.tenth_year_name','users.tenth_percentage','users.twelth_board_name','users.twelth_year_name','users.twelth_percentage','users.degree_diploma','users.degree_diploma_year','users.degree_diploma_percentage','payments.payment_id','payments.created_at as pay_time','users.district','users.experience','users.total_experience','users.user_type','users.referal'])->orderby('users.id', 'desc')->paginate(config('constant.table_pagination'));
            return view('student-data', compact('userlist'))->render();       
        }
    }
	/**
     * Show the application list company.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function listCompany(){
		
		$companylist = Company::leftJoin('payments', 'payments.user_id', '=', 'company_info.user_id')->orderby('company_info.id', 'desc')->select(['company_info.id','company_info.name', 'company_info.user_id','company_info.email','company_info.address','company_info.type','company_info.catalog_first','company_info.catalog_second','company_info.catalog_third','company_info.catalog_four','company_info.catalog_five','payments.payment_id','payments.created_at'])->paginate(20);	
		
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
		$userDetails = User::leftJoin('payments', 'payments.user_id', '=', 'users.id')->where('users.id',$id)->where('users.is_admin', '0')->where('users.user_type', 'user')->first(['users.id','users.name','users.first_name','users.last_name','users.dob','users.email','users.user_photo','users.address','users.aadhar_card','users.aadhar_card_back','users.father_name','users.mother_name','users.tenth_board_name','users.tenth_year_name','users.tenth_percentage','users.twelth_board_name','users.twelth_year_name','users.twelth_percentage','users.degree_diploma','users.degree_diploma_year','users.degree_diploma_percentage','payments.payment_id','payments.created_at','users.state','users.zipcode','users.district','users.experience','users.total_experience','users.referal']);
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
		$companyDetails = Company::leftJoin('payments', 'payments.user_id', '=', 'company_info.user_id')
			->leftjoin('users', 'users.id', '=', 'company_info.user_id')
			->orderby('company_info.id', 'desc')->where('company_info.id',$id)->first(['company_info.id','company_info.name', 'company_info.user_id','company_info.email','company_info.address','company_info.type','company_info.catalog_first','company_info.catalog_second','company_info.catalog_third','company_info.catalog_four','company_info.catalog_five','payments.payment_id','payments.created_at','company_info.gst','company_info.district','company_info.state','company_info.zip','users.referal']);

        return view('company.details', compact('companyDetails'));
    }


    public function editProfile($id)
    {
		if($id > 0){	
			$userObj = User::where('id', Auth::id())->first(['is_admin','user_type']);
			$adminFlag = $userObj->is_admin;
			if($adminFlag == 1 || Auth::id() == $id){
				$user = User::findOrFail($id);
				return view('home.edit-profile', compact('user'));
			}
			else{
				return abort(403, 'Unauthorized action.');
			}
		}
		else{
			return abort(403, 'Unauthorized action.');
		}
    }


    public function editCompany($id)
    {
		if($id > 0){
			$company = Company::where('id', $id)->first();
            $userId = $company->user_id;

			$userObj = User::where('id', Auth::id())->first(['is_admin','user_type']);
			$adminFlag = $userObj->is_admin;
			if($adminFlag == 1 || Auth::id()==$userId){
				//$company = Company::findOrFail($id);
				return view('company.edit', compact('company'));
			}
			else{
				return abort(403, 'Unauthorized action.');
			}
		}
		else{
			return abort(403, 'Unauthorized action.');
		}
    }
	
    public function companyUpdate(StoreCompanyEditRequest $request, $id){
    	
    	$userObj = User::where('id', Auth::id())->first(['is_admin','user_type']);
		$adminFlag = $userObj->is_admin;
    	$input = $request->all();
		
		$company = Company::find($id);
        $company->name = $input['name'];
        $company->address = $input['address'];        
        $company->zip = $input['zip'];
        $company->district = $input['district'];
        $company->state = $input['state'];
        $company->gst = $input['gst'];
        $company->type = $input['type'];
        $company->update();

        if ($request->hasFile('catalog_first')) {
        	if ($request->hasFile('catalog_first')) {
	        	$file_path =  public_path('/storage/documents/company/'.$company->id.'/'.$company->catalog_first);
	        	if(is_file($file_path) && \File::exists($file_path)){ 
	        		 unlink($file_path); 
	        	}
        	}

			$image = $request->file('catalog_first');
			$name = time().'_avatar.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/documents/company/'.$company->id);
			$image->move($destinationPath, $name);
			$company->update(['catalog_first'=>$name]);
		}

		if ($request->hasFile('catalog_second')) {
        	if ($request->hasFile('catalog_second')) {
	        	$file_path =  public_path('/storage/documents/company/'.$company->id.'/'.$company->catalog_second);
	        	if(is_file($file_path) && \File::exists($file_path)){
	        		 unlink($file_path); 
	        	}
        	}

			$image = $request->file('catalog_second');
			$name = time().'_avatar.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/documents/company/'.$company->id);
			$image->move($destinationPath, $name);
			$company->update(['catalog_second'=>$name]);
		}

		if ($request->hasFile('catalog_third')) {
        	if ($request->hasFile('catalog_third')) {
	        	$file_path =  public_path('/storage/documents/company/'.$company->id.'/'.$company->catalog_third);
	        	if(is_file($file_path) && \File::exists($file_path)){ 
	        		 unlink($file_path); 
	        	}
        	}

			$image = $request->file('catalog_third');
			$name = time().'_avatar.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/documents/company/'.$company->id);
			$image->move($destinationPath, $name);
			$company->update(['catalog_third'=>$name]);
		}

		if ($request->hasFile('catalog_four')) {
        	if ($request->hasFile('catalog_four')) {
	        	$file_path =  public_path('/storage/documents/company/'.$company->id.'/'.$company->catalog_four);
	        	if( is_file($file_path) && \File::exists($file_path)){ 
	        		 unlink($file_path); 
	        	}
        	}

			$image = $request->file('catalog_four');
			$name = time().'_avatar.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/documents/company/'.$company->id);
			$image->move($destinationPath, $name);
			$company->update(['catalog_four'=>$name]);
		}

		if ($request->hasFile('catalog_five')) {
        	if ($request->hasFile('catalog_five')) {
	        	$file_path =  public_path('/storage/documents/company/'.$company->id.'/'.$company->catalog_five);
	        	if(is_file($file_path) && \File::exists($file_path)){ 
	        		 unlink($file_path); 
	        	}
        	}

			$image = $request->file('catalog_five');
			$name = time().'_avatar.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/documents/company/'.$company->id);
			$image->move($destinationPath, $name);
			$company->update(['catalog_five'=>$name]);
		}
		if($adminFlag == 1){
       	 	return redirect('/company')->with('success', 'Your request has been update successfully');
       	}
       	else{
       		return redirect('/profile')->with('success', 'Your request has been update successfully');
       	}
    }


	public function companyAdd(){
		if(Auth::id() >0){
			return redirect('/home');
		}
		else{
			return view('company.create');
		}
	}
	
	public function profile(){ 
			$userType = User::where('id',Auth::id())->value('user_type');			
			if($userType == 'company'){
				$companyDetails = Company::leftJoin('payments', 'payments.user_id', '=', 'company_info.user_id')
				->leftJoin('users', 'users.id', '=', 'company_info.user_id')
				->orderby('company_info.id', 'desc')->where('users.id',Auth::id())->first(['company_info.id','company_info.name', 'company_info.user_id','company_info.email','company_info.address','company_info.type','company_info.catalog_first','company_info.catalog_second','company_info.catalog_third','company_info.catalog_four','company_info.catalog_five','payments.payment_id','payments.created_at','company_info.gst','company_info.district','company_info.state','company_info.zip','users.referal']);
				return view('company.details', compact('companyDetails'));
			}
			else if($userType == 'user'){
				$userDetails = User::leftJoin('payments', 'payments.user_id', '=', 'users.id')->where('users.id',Auth::id())->where('users.is_admin', '0')->where('users.user_type', 'user')->first(['users.id','users.name','users.first_name','users.last_name','users.dob','users.email','users.user_photo','users.address','users.aadhar_card','users.aadhar_card_back','users.father_name','users.mother_name','users.tenth_board_name','users.tenth_year_name','users.tenth_percentage','users.twelth_board_name','users.twelth_year_name','users.twelth_percentage','users.degree_diploma','users.degree_diploma_year','users.degree_diploma_percentage','payments.payment_id','payments.created_at','users.state','users.zipcode','users.referal','district','experience','total_experience']);
				return view('home.details', compact('userDetails'));
			}
			else if($userType == 'professional'){
				$Details = Professional::leftJoin('payments', 'payments.user_id', '=', 'professional.user_id')
				->leftJoin('users', 'users.id', '=', 'professional.user_id')
				->orderby('professional.id', 'desc')->where('users.id',Auth::id())->first(['professional.id','professional.first_name','professional.last_name','professional.father_name','professional.mother_name','professional.address', 'professional.user_id','professional.address','professional.type','professional.description','professional.experience','payments.payment_id','payments.created_at','professional.district','professional.state','professional.zip','users.email','users.referal']);
				return view('professional.details', compact('Details'));

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
		  'gst' => ['required', 'string', 'max:255'],
		  'district' => ['required', 'string', 'max:255'],
		  'state' => ['required', 'string', 'max:255'],
		  'zip' => ['required', 'string', 'max:255'],
		  'type' => ['required', 'string', 'max:255'],
		  'catalog_first' => ['nullable','mimes:png,jpg,jpeg,bmp,gif','max:8192'],
		  'catalog_second' => ['nullable','mimes:png,jpg,jpeg,bmp,gif','max:8192'],
		  'catalog_third' => ['nullable','mimes:png,jpg,jpeg,bmp,gif','max:8192'],
		  'catalog_four' => ['nullable','mimes:png,jpg,jpeg,bmp,gif','max:8192'],
		  'catalog_five' => ['nullable','mimes:png,jpg,jpeg,bmp,gif','max:8192'],
       ]);
		
		$digitNumber = random_int(100000, 999999);
		$user =  User::create([
            'name' => $request->name,
			'email' =>  $request->email,
			'address' => $request->address,
			'user_type' => 'company',
            'password' => Hash::make($request->password),
            'referal' => $digitNumber,
        ]);
		
		$insertId = $user->id;
		$companyInfo = Company::create([
            'name' => $request->name,
			'email' => $request->company_email,
			'gst' => $request->gst,
			'address' => $request->address,
			'type' => $request->type,
			'district' => $request->district,
			'state' => $request->state,
			'zip' => $request->zip,
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
		
		return redirect('/payment')->with('success', 'Your information has been saved successfully!');	
		//return redirect()->route('subscription.company.order.post')->with('success', 'Your information has been saved successfully!');
	}

	public function setCustomDate($varDate){
	    if($varDate!=''){
	        $varDate = date('Y-m-d', strtotime($varDate));

	        return $varDate;
	    }
	    else{
	        $varDate = date('Y-m-d');
	    }
	}


	public function update(StoreUserEditRequest $request, $id){
		$input = $request->except(['password']);		
		$input['dob'] = $this->setCustomDate($input['dob']);
		
		$userObj = User::where('id', Auth::id())->first(['is_admin','user_type']);
		$adminFlag = $userObj->is_admin;



		$user = User::find($id);
        $user->name = $input['name'];
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];
        $user->dob = $input['dob'];
        //$user->user_photo = $input['user_photo'];
        $user->address = $input['address'];
        //$user->aadhar_card = $input['aadhar_card'];
        //$user->aadhar_card_back = $input['aadhar_card_back'];
        $user->father_name = $input['father_name'];
        $user->mother_name = $input['mother_name'];
        $user->tenth_board_name = $input['tenth_board_name'];
        $user->tenth_year_name = $input['tenth_year_name'];
        $user->tenth_percentage = $input['tenth_percentage'];
        $user->twelth_board_name = $input['twelth_board_name'];
        $user->twelth_year_name = $input['twelth_year_name'];
        $user->twelth_percentage = $input['twelth_percentage'];
        $user->degree_diploma = $input['degree_diploma'];
        $user->degree_diploma_year = $input['degree_diploma_year'];
        $user->degree_diploma_percentage = $input['degree_diploma_percentage'];
        $user->zipcode = $input['zipcode'];
        $user->district = $input['district'];
        $user->state = $input['state'];
        $user->experience = $input['experience'];
        $user->total_experience =$input['total_experience'];
        $user->update();


        if ($request->hasFile('user_photo')) {
        	if ($request->hasFile('user_photo')) {
	        	$file_path =  public_path('/storage/documents/'.$user->id.'/'.$user->user_photo);
	        	if(is_file($file_path) && \File::exists($file_path)){ 
	        		 unlink($file_path); 
	        	}
        	}

			$image = $request->file('user_photo');
			$name = time().'_avatar.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/documents/'.$user->id);
			$image->move($destinationPath, $name);
			$user->update(['user_photo'=>$name]);
		}
		
		if ($request->hasFile('aadhar_card')) {

			if ($request->hasFile('aadhar_card')) {
	        	$file_path =  public_path('/storage/documents/'.$user->id.'/'.$user->aadhar_card);
	        	if(is_file($file_path) && \File::exists($file_path)){ 
	        		 unlink($file_path); 
	        	}
        	}

			$image = $request->file('aadhar_card');
			$name = time().'_aadhar_front.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/documents/'.$user->id);
			$image->move($destinationPath, $name);
			$user->update(['aadhar_card'=>$name]);
		}
		
		if ($request->hasFile('aadhar_card_back')) {

			if ($request->hasFile('aadhar_card_back')) {
	        	$file_path =  public_path('/storage/documents/'.$user->id.'/'.$user->aadhar_card_back);
	        	if(is_file($file_path) && \File::exists($file_path)){ 
	        		 unlink($file_path); 
	        	}
        	}

			$image = $request->file('aadhar_card_back');
			$name = time().'_aadhar_card_back.'.$image->getClientOriginalExtension();
			$destinationPath = public_path('/storage/documents/'.$user->id);
			$image->move($destinationPath, $name);
			$user->update(['aadhar_card_back'=>$name]);
			
		}
		if($adminFlag == 1){
	        return redirect('/home')->with('success', 'Your request has been update successfully');
	    }
	    else{
	    	return redirect('/profile')->with('success', 'Your request has been update successfully');	
	    }
                
	}

	/**
     * Remove the specified resource from storage.
     *
     * @param  \ASPES\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        DB::beginTransaction();
        try {
            // to delete the docus sign related record
            $objDelete = User::where('id', '=', $id)->delete();
            DB::commit();
            return response()->json([
                'status' => 'success',
                'payload' => [
                    'message' => 'Your request has been completed successfully!',
                    'url' => route('home.listing')
                ]
            ], 200);
        }
        catch (\Exception $e) {
           // echo $e->getMessage();die;
            DB::rollback();
            return response()->json([
                'status' => 'failure',
                'payload' => [
                    'message' => 'Your request not completed!',
                    'url' => route('home.listing')
                ]
            ], 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \APP\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function companyDestory($id)
    {        
        DB::beginTransaction();
        try {
            // to delete the docus sign related record
            $objDelete = Company::where('id', '=', $id)->delete();
            DB::commit();
            return response()->json([
                'status' => 'success',
                'payload' => [
                    'message' => 'Your request has been completed successfully!',
                    'url' => route('company.list')
                ]
            ], 200);
        }
        catch (\Exception $e) {
           // echo $e->getMessage();die;
            DB::rollback();
            return response()->json([
                'status' => 'failure',
                'payload' => [
                    'message' => 'Your request not completed!',
                    'url' => route('company.list')
                ]
            ], 200);
        }
    }


	
}

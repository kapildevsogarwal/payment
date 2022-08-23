<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserEditRequest;
use App\Http\Requests\StoreCompanyEditRequest;


class UserController extends Controller
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
    	$users = User::orderby('id', 'desc')->paginate(config('constant.table_pagination'));
		  return view('users.index')->with('users', $users);
    }

	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function userlist()
    {   
    	$users = User::orderby('id', 'desc')->paginate(config('constant.table_pagination'));
		  return view('users.index')->with('users', $users);
    }
	
	/**
     * Display the specified resource.
     *
     * @param  \SHR\DeliveryTicket  $deliveryTicket
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
		$roletype = $user->roles()->pluck('name')->implode(' ');
        return view('users.details', compact('user','roletype'));
    }
	
	 /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create() {
    //Get all roles and pass it to the view
        $roles = Role::get();
        return view('users.create', ['roles'=>$roles]);
    }
	
	/**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request) {
    //Validate name, email and password fields
        $roles = $request['roles'];      
        $arrValidation = [
                'name'=>'required|max:120',
                'email'=>'required|email|unique:users',
				'address'=>'required|max:120',
                'password'=>'required|min:6|confirmed'
            ];
        
        $this->validate($request, $arrValidation);
		$request->password = Hash::make($request['password']);
        $user = User::create($request->only('email', 'name', 'password','address')); //Retrieving only the email and password data

        //Checking if a role was selected
        if (isset($roles)) {
			
            $role_r = Role::where('id', '=', $roles)->firstOrFail();            
            $user->assignRole($role_r); //Assigning role to user
        }

        //Redirect to the users.index view and display message
		
         return redirect()->route('users.index')->with('success', 'User, "'. $user->name.'" added successfully!');
    }
	
	
	 /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id) {
       // $auth_role = Auth::user()->roles[0]->name;

        $user = User::findOrFail($id); //Get user with specified id
        $roles = Role::get(); //Get all roles
          return view('users.edit', compact('user', 'roles')); 
		  
        /*if($auth_role == 'SuperAdmin' || $auth_role == 'Admin'){
            return view('users.edit', compact('user', 'roles')); //pass user and roles data to view
        }
        else{
            if(Auth::id() == $id){
                return view('users.edit', compact('user', 'roles', 'company','arrObjUserRC')); //pass user and roles data to view
            }
            return abort(401);
        }*/
    }
	
	
	public function update(Request $request, $id) { //echo "<pre>";print_r($request->all());die;  
        $user = User::findOrFail($id); //Get role specified by id
        //$auth_role = Auth::user()->roles[0]->id;
        //$userdata = Auth::user()->profile_image;
        // upload images in to public folder.
        if(!empty($request->image)){
            request()->validate([
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);    
            $imageName = time().'.'.request()->image->getClientOriginalExtension(); 
            request()->image->move(public_path('images/users'), $imageName);
        } 
        //Validate name, email and password fields
        // check if role id is company then business name mandatory
         
		$arrValidation = [
			'name'=>'required|max:120',
			'address'=>'required|max:120',
			'email'=>'required|email|unique:users,email,'.$id,
			'password'=>'confirmed'
		];
        

        $this->validate($request,  $arrValidation);
        $input = $request->only(['name', 'email','address',]); //Retreive the name, email and password fields

        if(!empty($request->password)){
           $input['password'] = $request->password;
        }

         $roles = $request['roles'];

        if(empty($roles)){
            $roles = $user->roles[0]->id;
        }
        
        $user->fill($input)->save();  

        if (isset($roles)) { 
            $user->roles()->sync($roles);  //If one or more role is selected associate user to roles          
        }        
        else {
            $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
        }

       
        return redirect()->route('users.index')
            ->with('success', 'User, "'. $user->name.'" updated successfully!');
    }
	
	/**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id) {
    //Find a user with a given id and delete
        $user = User::findOrFail($id); 
        $user->delete();

        return redirect()->route('users.index')
            ->with('success', 'User, "'. $user->name.'" deleted successfully!');
    }



	
}

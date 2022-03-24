<?php

namespace App\Http\Controllers;

use App\Models\Professional;
use App\Models\Company;
use App\Models\UserOrder;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UpdateProfessionalProfileRequest;
use Auth;
use Session;
use DB;
use Illuminate\Support\Facades\Hash;

class ProfessionalController extends Controller
{
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('create','store');
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 

            $userObj = User::where('id', Auth::id())->first(['is_admin','user_type','referal']);

            //print_r($userObj);die;
            $adminFlag = $userObj->is_admin;
            $referal = $userObj->referal;
            if($adminFlag == 1){

                $professionalList = Professional::leftJoin('payments', 'payments.user_id', '=', 'professional.user_id')
                    ->leftjoin('users', 'users.id', '=', 'professional.user_id')
                    ->orderby('professional.id', 'desc')->select(['professional.id','professional.first_name', 'professional.last_name','professional.father_name','professional.mother_name','professional.address','professional.district','professional.state','professional.zip','professional.type','professional.description','professional.experience','payments.payment_id','payments.created_at','users.referal'])->paginate(20);


                return view('professional.list',compact('professionalList'));
            }
            else{
                return view('subscription.professional',compact('referal'));
            }       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('professional.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){

        $this->validate($request, [
              'first_name' => ['required', 'string', 'max:255'],
              'last_name' => ['required', 'string', 'max:255'],
              'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
              'password' => ['required', 'string', 'min:8', 'confirmed'],
              'father_name' => ['required', 'string', 'max:255'],
              'mother_name' => ['required', 'string', 'max:255'],
              'address' => ['required', 'string', 'max:255'],
              'district' => ['required', 'string', 'max:255'],
              'state' => ['required', 'string', 'max:255'],
              'zip' => ['required', 'string', 'max:255'],
              'type' => ['required', 'string', 'max:255'],
              'description' => ['required', 'string', 'max:255'],
              'experience' => ['nullable', 'string', 'max:255'],
           ]);

        DB::beginTransaction();
        try {

            $digitNumber = random_int(100000, 999999);
            $user =  User::create([
                'name' => $request->first_name,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' =>  $request->email,
                'address' => $request->address,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'address' => $request->address,
                'zipcode' => $request->zip,
                'district' => $request->district,
                'state' => $request->state,
                'experience' => $request->experience,
                'user_type' => 'professional',
                'password' => Hash::make($request->password),
                'referal' => $digitNumber,
            ]);

            $insertId = $user->id;
            $professional = Professional::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'father_name' => $request->father_name,
                'mother_name' => $request->mother_name,
                'address' => $request->address,
                'district' => $request->district,
                'state' => $request->state,
                'zip' => $request->zip,
                'type' => $request->type,
                'user_id'=> $insertId,
                'description'=>$request->description,
                'experience'=>$request->experience,
            ]);
            DB::commit();

            Auth::attempt(['email' =>  $request->email, 'password' => $request->password]);
            return redirect('/professional')->with('success', 'Your request has been update successfully');
        }
        catch (\Exception $e) { 
             return redirect('/company')->with('error', 'Your request has been not been complete due to '.$e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
            $Details = Professional::leftJoin('payments', 'payments.user_id', '=', 'professional.user_id')
                ->leftJoin('users', 'users.id', '=', 'professional.user_id')
                ->where('professional.id',$id)
                ->orderby('professional.id', 'desc')->first(['professional.id','professional.first_name','professional.last_name','professional.father_name','professional.mother_name','professional.address', 'professional.user_id','professional.type','professional.description','professional.experience','payments.payment_id','payments.created_at','professional.district','professional.state','professional.zip','users.email','users.referal']);
            return view('professional.details', compact('Details'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
            $professionalObj = Professional::where('id', $id)->first();
            $userId = $professionalObj->user_id;
            $userObj = User::where('id', Auth::id())->first(['is_admin','user_type']);
            $adminFlag = $userObj->is_admin;
            if($adminFlag == 1 || Auth::id()==$userId){
                //$company = Company::findOrFail($id);
                return view('professional.edit', compact('professionalObj'));
            }
            else{
                return abort(403, 'Unauthorized action.');
            }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfessionalProfileRequest $request, $id)
    {
        if($id > 0){
            $input = $request->all();
            $professional = Professional::find($id);
            $professional->first_name = $input['first_name'];
            $professional->last_name = $input['last_name'];
            $professional->mother_name = $input['mother_name'];
            $professional->father_name = $input['father_name'];
            $professional->description = $input['description'];
            $professional->experience = $input['experience'];
            $professional->address = $input['address'];
            $professional->district = $input['district'];
            $professional->state = $input['state'];
            $professional->zip = $input['zip'];
            $professional->update();

            $userObj = User::where('id', Auth::id())->first(['is_admin','user_type']);
            $adminFlag = $userObj->is_admin;
            if($adminFlag == 1){
            return redirect('/professional')->with('success', 'Your request has been update successfully');
            }
            else{
                return redirect('/profile')->with('success', 'Your request has been update successfully');
            }

            
        }
        else{
            return abort(403, 'Unauthorized action.');
        }


        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            // to delete the docus sign related record
            $objDelete = Professional::where('id', '=', $id)->delete();
            DB::commit();
            return response()->json([
                'status' => 'success',
                'payload' => [
                    'message' => 'Your request has been completed successfully!',
                    'url' => route('professional.list')
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
                    'url' => route('professional.list')
                ]
            ], 200);
        }
    }
}

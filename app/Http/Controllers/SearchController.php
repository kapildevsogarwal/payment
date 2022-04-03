<?php

namespace App\Http\Controllers;

use App\Models\Professional;
use App\Models\Company;
use App\Models\UserOrder;
use App\Models\CompanyApproval;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UpdateProfessionalProfileRequest;
use Auth;
use Session;
use DB;
use Illuminate\Support\Facades\Hash;

class SearchController extends Controller
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
		return view('search.dashboard');            
    }


    /**
     * Display a listing of the professional search record.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchCompany()
    { 
        $companyList = Company::leftJoin('payments', 'payments.user_id', '=', 'company_info.user_id')
                    ->leftjoin('users', 'users.id', '=', 'company_info.user_id')
                    ->where('company_info.id','<','0')
                    ->orderby('company_info.id', 'desc')->select(['company_info.id','company_info.name', 'company_info.type','company_info.created_at'])->paginate(config('constant.table_pagination'));      
        return view('search.company-list', compact('companyList'));            
    }

    /**

    /**
     * Display a listing of the professional search record.
     *
     * @return \Illuminate\Http\Response
     */
    public function searchProfessional()
    { 
        $professionalList = Professional::leftJoin('payments', 'payments.user_id', '=', 'professional.user_id')
                    ->leftjoin('users', 'users.id', '=', 'professional.user_id')
                    ->where('professional.id','<','0')
                    ->orderby('professional.id', 'desc')->select(['professional.id','professional.first_name', 'professional.last_name','professional.father_name','professional.mother_name','professional.address','professional.district','professional.state','professional.zip','professional.type','professional.description','professional.experience','payments.payment_id','payments.created_at','users.referal'])->paginate(config('constant.table_pagination'));
                
        return view('search.list', compact('professionalList'));            
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('search.list');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //
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

            $objApproval = CompanyApproval::where('user_id', Auth::id())->where('company_id', $id);
            $status = 0;
            if($objApproval->count() > 0){
                $status = $objApproval->value('status');
            }
            return view('professional.details', compact('Details','status'));
        
    }

    /**
     * Display the specified professional detail.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showProfessional($id){
        $Details = Professional::leftJoin('payments', 'payments.user_id', '=', 'professional.user_id')
                ->leftJoin('users', 'users.id', '=', 'professional.user_id')
                ->where('professional.id',$id)
                ->orderby('professional.id', 'desc')->first(['professional.id','professional.first_name','professional.last_name','professional.father_name','professional.mother_name','professional.address', 'professional.user_id','professional.type','professional.description','professional.experience','payments.payment_id','payments.created_at','professional.district','professional.state','professional.zip','users.email','users.referal']);
            
            $objApproval = CompanyApproval::where('user_id', Auth::id())->where('company_id', $id);
            $status = 0;
            if($objApproval->count() >0){
                $status = $objApproval->value('status');
            }

        return view('search.preofessional-details', compact('Details','status'));
    }

    /**
     * Display the specified professional detail.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showCompany($id){
        $Details = Company::leftJoin('payments', 'payments.user_id', '=', 'company_info.user_id')
                ->leftJoin('users', 'users.id', '=', 'company_info.user_id')
                ->where('company_info.id',$id)
                ->orderby('company_info.id', 'desc')->first(['company_info.id','company_info.name','company_info.type', 'company_info.created_at','company_info.email','company_info.gst','company_info.district','company_info.zip','company_info.state','company_info.zip','company_info.address']);
            
            $objApproval = CompanyApproval::where('user_id', Auth::id())->where('company_id', $id);
            $status = 0;
            if($objApproval->count() >0){
                $status = $objApproval->value('status');
            }

        return view('search.company-details', compact('Details','status'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        
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
     * Request for admin the specified resource for company full detail.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function companyApproveRequest($id)
    { 
        DB::beginTransaction();
        try {
            // to delete the docus sign related record
            
            $varUserType = User::where('id', Auth::id())->value('user_type');
            $objApproval = CompanyApproval::where('user_id', Auth::id())->where('company_id', $id);
            if($objApproval->count() == 0){
                $approvalObj =  CompanyApproval::create([
                    'user_id' => Auth::id(),
                    'company_id' => $id,
                    'by_type' => $varUserType,
                    'status' => '0'
                ]);

                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'payload' => [
                        'message' => 'Your request has been sent for approval!',
                        'url' => route('professional.list')
                    ]
                ], 200);
            }
            else{
                $objStatus = $objApproval->value('status'); 
                $message = ($objStatus == 0)?'Your request already sent for approval!':'Your request is already approved.';              
                return response()->json([
                    'status' => 'failure',
                    'payload' => [
                        'message' => $message,
                    ]
                ], 200);    
            }
        }
        catch (\Exception $e) {
           // echo $e->getMessage();die;
            DB::rollback();
            return response()->json([
                'status' => 'failure',
                'payload' => [
                    'message' => 'Your request not completed!',
                ]
            ], 200);
        }
    }

    /**
     * Request for admin the specified resource for company full detail.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function companyApproveByAdmin(Request $request, $id)
    {   
        DB::beginTransaction();
        try {

            // to delete the docus sign related record
            $status = $request->approve;
            $company = CompanyApproval::find($id);
            $company->status = $status;
            $company->update();
            
            DB::commit();
            return response()->json([
                'status' => 'success',
                'payload' => [
                    'message' => 'Your request has been updated successfully!',
                ]
            ], 200);
        
        }
        catch (\Exception $e) {
            //echo $e->getMessage();die;
            DB::rollback();
            return response()->json([
                'status' => 'failure',
                'payload' => [
                    'message' => 'Your request not completed!',
                ]
            ], 200);
        }
    }
    

    /** 
        * @param  \Illuminate\Http\Request  $request
        * Get search by companies data by compay name
        * @return \Illuminate\Http\Response
    */
    public function professionalSearch(Request $request){
        if($request->ajax()){
            $getQuery = $request->get('query');
            $keyword = str_replace(" ", "%", $getQuery);
           /* $getlist = Professional::leftJoin('payments', 'payments.user_id', '=', 'professional.user_id')
                    ->leftjoin('users', 'users.id', '=', 'professional.user_id');
            if( $keyword!=''){
                $getlist->where(function($query) use ($keyword){
                    $query->where('professional.first_name', 'LIKE', '%'.$keyword.'%');
                    $query->orWhere('professional.last_name', 'LIKE', '%'.$keyword.'%');
                    //$query->orWhere('professional.father_name', 'LIKE', '%'.$keyword.'%');
                    //$query->orWhere('professional.mother_name', 'LIKE', '%'.$keyword.'%');
                    $query->orWhere('professional.address', 'LIKE', '%'.$keyword.'%');
                    $query->orWhere('professional.type', 'LIKE', '%'.$keyword.'%');
                     $query->orWhere('professional.experience', 'LIKE', '%'.$keyword.'%');
                });
            }

            $professionalList = $getlist->orderby('professional.id', 'desc')->select(['professional.id','professional.first_name', 'professional.last_name','professional.father_name','professional.mother_name','professional.address','professional.district','professional.state','professional.zip','professional.type','professional.description','professional.experience','payments.payment_id','payments.created_at','users.referal'])->paginate(config('constant.table_pagination'));
            return view('search.professional-data', compact('professionalList'))->render();*/
            $getlist = Company::leftJoin('payments', 'payments.user_id', '=', 'company_info.user_id')
                    ->leftjoin('users', 'users.id', '=', 'company_info.user_id');
            if( $keyword!=''){
                $getlist->where(function($query) use ($keyword){
                    $query->where('company_info.name', 'LIKE', '%'.$keyword.'%');
                    $query->orWhere('company_info.type', 'LIKE', '%'.$keyword.'%');
                });
            }

            $companyList = $getlist->orderby('company_info.id', 'desc')->select(['company_info.id','company_info.name', 'company_info.type','company_info.created_at','users.referal'])->paginate(config('constant.table_pagination'));
            return view('search.search-company-data', compact('companyList'))->render();       
        }
    }



}

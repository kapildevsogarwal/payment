<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Party;
use Auth;
use Session;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserEditRequest;
use App\Http\Requests\UpdatePartyEditRequest;
use App\Http\Requests\StorePartyRequest;


class PartyController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);//->except('companyAdd','companySave');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
		$partyList = Party::orderby('id', 'desc')->paginate(config('constant.table_pagination'));
		return view('party.index',compact('partyList'));
	}	
	
	public function create(){
		
		return view('party.create');
	}
	
	/**
     * Display the specified resource.
     *
     * @param  \SHR\DeliveryTicket  $deliveryTicket
     * @return \Illuminate\Http\Response
     */
    public function store(StorePartyRequest $request)
    {  
		$party = Party::create([
            'name' => $request->name,
			'email' => $request->email,
			'address' => $request->address,
			'gst_number' => $request->gst_number,
			'account_number' => $request->account_number,
			'ifsc_code' => $request->ifsc_code,
		]);
		
		 return redirect()->route('party.index')
            ->with('success', $party->name.' added successfully!');
		
    }
	
	/**
     * Display the specified resource.
     *
     * @param  \SHR\DeliveryTicket  $deliveryTicket
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$party = Party::where('id', $id)->first();
        return view('party.details', compact('party'));
    }
	
	
	/**
     * Display the specified resource.
     *
     * @param  \SHR\DeliveryTicket  $deliveryTicket
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		if($id > 0){
			$party = Party::where('id', $id)->first();			
			return view('party.edit', compact('party'));
		}
		else{
			return abort(403, 'Unauthorized action.');
		}
    }
	
	public function Update(UpdatePartyEditRequest $request, $id){
    	$input = $request->all();
		$party = Party::find($id);
        $party->name = $input['name'];
        $party->address = $input['address'];        
        $party->email = $input['email'];
        $party->gst_number = $input['gst_number'];
        $party->update();
		return redirect()->route('party.index')
						->with('success', 'Your request has been update successfully');
       	
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
            $objDelete = Party::where('id', '=', $id)->delete();
            DB::commit();
            return response()->json([
                'status' => 'success',
                'payload' => [
                    'message' => 'Your request has been completed successfully!',
                    'url' => route('party.index')
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
                    'url' => route('party.index')
                ]
            ], 200);
        }
    }
	
	
	/** 
        * @param  \Illuminate\Http\Request  $request
        * Get search by companies data by compay name
        * @return \Illuminate\Http\Response
    */
    public function studentSearch(Request $request){
        if($request->ajax()){
            $getQuery = $request->get('query');
            $keyword = str_replace(" ", "%", $getQuery);
            $getlist = User::leftJoin('payments', 'payments.user_id', '=', 'users.id')
			->where('users.is_admin', '0')
			->where('users.user_type', 'user');
			if( $keyword!=''){
				$getlist->where(function($query) use ($keyword){
					$query->where('users.name', 'LIKE', '%'.$keyword.'%');
					$query->orWhere('users.first_name', 'LIKE', '%'.$keyword.'%');
					$query->orWhere('users.last_name', 'LIKE', '%'.$keyword.'%');
					$query->orWhere('users.email', 'LIKE', '%'.$keyword.'%');
				});
			}
			$userlist = $getlist->select(['users.id','users.name','users.first_name','users.last_name','users.dob','users.email','users.user_photo','users.address','users.aadhar_card','users.aadhar_card_back','users.father_name','users.mother_name','users.tenth_board_name','users.tenth_year_name','users.tenth_percentage','users.twelth_board_name','users.twelth_year_name','users.twelth_percentage','users.degree_diploma','users.degree_diploma_year','users.degree_diploma_percentage','payments.payment_id','payments.created_at as pay_time','users.district','users.experience','users.total_experience','users.user_type','users.referal'])->orderby('users.id', 'desc')->paginate(config('constant.table_pagination'));
            return view('student-data', compact('userlist'))->render();       
        }
    }
	
	
}

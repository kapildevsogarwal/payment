<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Party;
use App\Models\Sale;
use App\Models\Purchase;
use Auth;
use Session;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserEditRequest;
use App\Http\Requests\UpdatePartyEditRequest;
use App\Http\Requests\StorePurchaseRequest;


class PurchaseController extends Controller
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
	 public function tests(){
		 echo "dasdssads";die;
	 }
    public function index()
    { 
		$purchases = Purchase::orderby('id', 'desc')->paginate(config('constant.table_pagination'));
		foreach($purchases as $purchase){
			$purchase->party_name = Party::where('id', $purchase->party_id)->value('name');
			$purchase->address = Party::where('id', $purchase->party_id)->value('address');
			$purchase->gst_number = Party::where('id', $purchase->party_id)->value('gst_number');
		}
		//$bills = Sale::orderby('id', 'desc')->paginate(config('constant.table_pagination'));
		return view('purchase.index',compact('purchases'));
	}	
	
	public function create(){
		$parties = Party::get();
		return view('purchase.create', compact('parties'));
	}
	
	
	/**
     * Display the specified resource.
     *
     * @param  \SHR\DeliveryTicket  $deliveryTicket
     * @return \Illuminate\Http\Response
     */
    public function store(StorePurchaseRequest $request)
    {  
		$purchase = Purchase::create([
            'invoice_no' => $request->invoice_no,
			'invoice_date' => $this->setCustomDate($request->invoice_date),
			'party_id' => $request->party_id,
			'net_amount' => $request->net_amount,			
			'igst_total' => $request->igst_total,			
			'ca_gst_total' => $request->ca_gst_total,			
			'sgst_total' => $request->sgst_total,
			'total_amount' => $request->total_amount,
		]);
		
		return redirect()->route('purchase.index')
            ->with('success', $purchase->invoice_no.' bill added successfully!');
		
    }
	
	/**
     * Display the specified resource.
     *
     * @param  \SHR\DeliveryTicket  $deliveryTicket
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$purchase = Purchase::where('id', $id)->first();
		$party = Party::where('id', $purchase->party_id)->first(['name','address','gst_number']);
		
        return view('purchase.details', compact('purchase','party'));
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
			return view('sales.edit', compact('party'));
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
		return redirect()->route('sales.index')
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
            $objDelete = Purchase::where('id', '=', $id)->delete();
            DB::commit();
            return response()->json([
                'status' => 'success',
                'payload' => [
                    'message' => 'Your request has been completed successfully!',
                    'url' => route('purchase.index')
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
                    'url' => route('purchase.index')
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
	
	public function setCustomDate($varDate){
		if($varDate!=''){
			$varDate = date('Y-m-d', strtotime($varDate));
			return $varDate;
		}
		else{
			$varDate = date('Y-s-d');
		}
	}
}

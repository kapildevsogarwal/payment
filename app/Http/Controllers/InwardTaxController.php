<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Party;
use App\Models\Purchase;
use Auth;
use Session;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserEditRequest;
use App\Http\Requests\UpdatePartyEditRequest;
use App\Http\Requests\StorePartyRequest;


class InwardTaxController extends Controller
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
		//return view('inward.index',compact('partyList'));
		return view('inward.inward-view',compact('partyList'));
	}	
	
	public function create(){
		
		return view('inward.create');
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
		
		 return redirect()->route('inward.index')
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
        return view('inward.details', compact('party'));
    }
	
	
    public function edit($id)
    {
		if($id > 0){
			$party = Party::where('id', $id)->first();			
			return view('inward.edit', compact('party'));
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
		return redirect()->route('inward.index')
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
                    'url' => route('inward.index')
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
                    'url' => route('inward.index')
                ]
            ], 200);
        }
    }
	
	
	public function getMonthPurchaseTotal(Request $request){
		$year = date('Y');
		$varGetMonth = $request->month;
		//$getArr = array('igst_overdue_total'=>'', 'ca_gst_overdue_total'=>'', 'sgst_overdue_total'=>'');
		$igstTotal = '0.00/-';
		$cgstTotal = '0.00/-';
		$sgstTotal = '0.00/-';
		
		// For Over all total for current year
		$objPurchaseTotalAll = Purchase::whereYear('invoice_date', '=', $year)
            ->whereMonth('invoice_date', '<=', $varGetMonth);
			  
		$igstTotalAll = ($objPurchaseTotalAll->sum('igst_total') > 0) ? sprintf("%0.2f/-", $objPurchaseTotalAll->sum('igst_total')):'0.00/-';
		$cgstTotalAll = ($objPurchaseTotalAll->sum('ca_gst_total') > 0) ? sprintf("%0.2f/-", $objPurchaseTotalAll->sum('ca_gst_total')):'0.00/-';
		$sgstTotalAll = ($objPurchaseTotalAll->sum('sgst_total') > 0) ?  sprintf("%0.2f/-", $objPurchaseTotalAll->sum('sgst_total')):'0.00/-';
		// For Over all total for current year
		if($varGetMonth!=''){
			$objPurchaseTotal = Purchase::whereYear('invoice_date', '=', $year)
              ->whereMonth('invoice_date', '=', $varGetMonth);
			$igstTotal = ($objPurchaseTotal->sum('igst_total') > 0) ? sprintf("%0.2f/-", $objPurchaseTotal->sum('igst_total')):'0.00/-';
			$cgstTotal = ($objPurchaseTotal->sum('ca_gst_total') > 0) ? sprintf("%0.2f/-", $objPurchaseTotal->sum('ca_gst_total')):'0.00/-';
			$sgstTotal = ($objPurchaseTotal->sum('sgst_total') > 0) ?  sprintf("%0.2f/-", $objPurchaseTotal->sum('sgst_total')):'0.00/-';
		}
		$getArr = array('purchase_igst_total' => $igstTotal, 'purchase_ca_gst_total' => $cgstTotal, 'purchase_sgst_total' => $sgstTotal, 'purchase_igst_total_all' => $igstTotalAll ,'purchase_gst_total_all'=> $cgstTotalAll, 'purchase_sgst_total_all' => $sgstTotalAll);

		return response()->json([
                'status' => 'success',
                'arr' => $getArr 
            ], 200);
	}
	
}

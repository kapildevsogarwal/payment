<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Party;
use App\Models\Purchase;
use App\Models\Sale;
use Auth;
use Session;
use DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUserEditRequest;
use App\Http\Requests\UpdatePartyEditRequest;
use App\Http\Requests\StorePartyRequest;


class OverviewTaxController extends Controller
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
		return view('overview.over-view',compact('partyList'));
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
	
	
	public function getMonthOverviewTotal(Request $request){
		$year = date('Y');
		$varGetMonth = $request->month;
		
		// For Over all total for current year
		$objPurchaseTotalAll = Purchase::whereYear('invoice_date', '=', $year)
            ->whereMonth('invoice_date', '<=', $varGetMonth);
			  
		$igstPurchaseTotalAll = ($objPurchaseTotalAll->sum('igst_total') > 0) ? $objPurchaseTotalAll->sum('igst_total'):'0.00';
		$cgstPurchaseTotalAll = ($objPurchaseTotalAll->sum('ca_gst_total') > 0) ? $objPurchaseTotalAll->sum('ca_gst_total'):'0.00';
		$sgstPurchseTotalAll = ($objPurchaseTotalAll->sum('sgst_total') > 0) ?  $objPurchaseTotalAll->sum('sgst_total'):'0.00';
		
		$objSaleTotalAll = Sale::whereYear('invoice_date', '=', $year)
            ->whereMonth('invoice_date', '<=', $varGetMonth);
		
		$igstSaleTotal = ($objSaleTotalAll->sum('igst_total') > 0) ? $objSaleTotalAll->sum('igst_total'):'0.00';
		$cgstSaleTotal = ($objSaleTotalAll->sum('ca_gst_total') > 0) ? $objSaleTotalAll->sum('ca_gst_total'):'0.00';
		$sgstSaleTotal = ($objSaleTotalAll->sum('sgst_total') > 0) ?  $objSaleTotalAll->sum('sgst_total'):'0.00';
		
		$varIGSTTotal =  sprintf("%0.2f/-", ($igstSaleTotal - $igstPurchaseTotalAll));
		$varCGSTTotal =  sprintf("%0.2f/-", ($cgstSaleTotal - $cgstPurchaseTotalAll));
		$varSGSTTotal =  sprintf("%0.2f/-", ($sgstSaleTotal - $sgstPurchseTotalAll));
		
		
		$getArr = array('overview_igst_total' => $varIGSTTotal, 'overview_ca_gst_total' => $varCGSTTotal, 'overview_sgst_total' => $varSGSTTotal);

		return response()->json([
                'status' => 'success',
                'arr' => $getArr 
            ], 200);
	}
	
}

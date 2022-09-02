{{-- resources/views/adminlte/user/dashboard.blade.php --}}

@extends('layouts.user')

@section('pageTitle', 'Purchase Detail Information')

@section('content')
<div class="row">
    <div class="col-xs-4 mb-2">
             
    </div>
    <div class="col-xs-8 mb-2">
       
            <a href="{{ route('purchase.create') }}" class="btn btn-primary pull-right"><i class="fa fa-pencil mr-1"></i>Add Purchase Bill</a>
        
    </div>
</div>
<div class="row">

    <div class="col-xs-12">

        @include('partials.flash-messages')

        <div class="box">
            <div class="box-header">
                <h3 class="box-title pull-left">Bill Detail: <strong>{{($purchase->invoice_no)?$purchase->invoice_no:''}}</strong></h3>
            </div>

            <div class="box-body table-responsive">
                <table class="table table-striped">
                    <tbody>
						<tr>
                            <td width="20%"><strong>Invoice Number</strong></td>
                            <td width="80%"  colspan="3">
								{{ $purchase->invoice_no }}
                            </td>
							
                        </tr>
						<tr>
                            <td width="20%"><strong>Invoice Date</strong></td>
                            <td width="80%"  colspan="3">
								{{ date(config('constant.date_format', strtotime($purchase->invoice_date))) }}
                            </td>
							
                        </tr>
                        <tr>
                            <td width="20%"><strong>Party Name</strong></td>
                            <td colspan="3">
								{{($party->name)?ucfirst($party->name):''}}
                            </td>
                        </tr>
                        <tr>
							<td width="20%"></td>
                            <td width="20%">
							  <strong> Party Address</strong> 
                            </td>
							<td width="60%" colspan="2">{{$party->address}}</td>
                        </tr>
						<tr>
                            <td width="20%"></td>
                            <td width="20%">
							  <strong> Party GST Number</strong> 
                            </td>
							<td width="60%" colspan="2"> {{$party->gst_number}}</td>
                        </tr>
                        <tr>
                            
							<td width="20%"><strong>Net Amount</strong></td>
                            <td colspan="3">
                               <b>{{$purchase->net_amount}}/-</b>
                            </td>
                        </tr>
						 <tr>
							<td width="20%"><strong>IGST</strong></td>
                            <td width="20%">{{ ($purchase->igst_total > 0)?$purchase->igst_total.'/-':'' }}</td>
							 <td width="20%"><strong>&nbsp;</strong></td>
							<td width="40%">&nbsp;</td>
                        </tr>
						<tr>
							<td width="20%"><strong>CAGST</strong></td>
                            <td width="20%">{{ ($purchase->ca_gst_total > 0)?$purchase->ca_gst_total.'/-':'' }}</td>
							 <td width="20%"><strong>&nbsp;</strong></td>
							<td width="40%">&nbsp;</td>
                        </tr>
						<tr>
							<td width="20%"><strong>SGST</strong></td>
                            <td width="20%">{{ ($purchase->sgst_total > 0)?$purchase->sgst_total.'/-':'' }}</td>
							 <td width="20%"><strong>&nbsp;</strong></td>
							<td width="40%">&nbsp;</td>
                        </tr>
						<tr>
						    <td width="20%"><strong>Total Amount</strong></td>
                            <td colspan="3">
                              <b> {{ ($purchase->total_amount > 0)?$purchase->total_amount.'/-':'' }}</b>
                            </td>
                        </tr>					
                    </tbody>
                </table>
                <div class="text-center">
                </div>
               

			</div>
		</div>
	</div>
</div>
@endsection


@section('header_css')
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('themes/adminlte/bower_components/jvectormap/jquery-jvectormap.css') }}">
@endsection

@section('footer_assets')

    <!-- Sparkline -->
    <script src="{{ asset('themes/adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap  -->
    <script src="{{ asset('themes/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('themes/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

    <!-- ChartJS -->
    <script src="{{ asset('themes/adminlte/bower_components/chart.js/Chart.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('themes/adminlte/dist/js/pages/dashboard2.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('themes/adminlte/dist/js/demo.js') }}"></script>

@endsection
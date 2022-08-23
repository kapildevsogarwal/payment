{{-- resources/views/adminlte/user/dashboard.blade.php --}}

@extends('layouts.user')

@section('pageTitle', 'Party Detail Information')

@section('content')
<div class="row">
    <div class="col-xs-4 mb-2">
             
    </div>
    <div class="col-xs-8 mb-2">
       
            <a href="{{ route('party.edit', [$party->id]) }}" class="btn btn-primary pull-right"><i class="fa fa-pencil mr-1"></i>Edit Party</a>
        
    </div>
</div>
<div class="row">

    <div class="col-xs-12">

        @include('partials.flash-messages')

        <div class="box">
            <div class="box-header">
                <h3 class="box-title pull-left">Party Detail: <strong>{{($party->name)?ucwords($party->name):''}}</strong></h3>
            </div>

            <div class="box-body table-responsive">
                <table class="table table-striped">
                    <tbody>
						<tr>
                            <td width="20%"><strong>Party Name</strong></td>
                            <td>
								{{($party->name)?ucfirst($party->name):''}}
                            </td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>Email</strong></td>
                            <td>
								{{($party->email)?ucfirst($party->email):''}}
                            </td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>Address</strong></td>
                            <td>
							   {{($party->address)?ucfirst($party->address):''}}
                            </td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>Gst Number</strong></td>
                            <td>
                               {{$party->gst_number}}
                            </td>
                        </tr>
						<tr>
						    <td width="20%"><strong>Account Number</strong></td>
                            <td>
                               {{$party->account_number}}
                            </td>
                        </tr>
						<tr>
						    <td width="20%"><strong>IFSC Code</strong></td>
                            <td>
                               {{$party->ifsc_code}}
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
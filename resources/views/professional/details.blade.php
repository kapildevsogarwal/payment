{{-- resources/views/adminlte/user/dashboard.blade.php --}}

@extends('layouts.user')

@section('pageTitle', 'Professional Detail Information')

@section('content')
<div class="row">
    <div class="col-xs-4 mb-2">
        @if(\Auth::user()->user_type == 'professional')
            <a href="{{ route('payment') }}" class="btn btn-primary pull-left">
                Get Subscription</a>
        @endif        
    </div>
    <div class="col-xs-8 mb-2">
        @if(\Auth::user()->user_type == 'professional')
            <a href="{{ route('professional.edit', [$Details->id]) }}" class="btn btn-primary pull-right"><i class="fa fa-pencil mr-1"></i>Edit Profile</a>
        @endif
    </div>
</div>
<div class="row">
    <div class="col-xs-12">
        @include('partials.flash-messages')
        <div class="box">
            <div class="box-header">
                <h3 class="box-title pull-left">Professional Detail Name: <strong>{{($Details->first_name)?ucwords($Details->first_name):''}}</strong></h3>
                <h3 class="box-title pull-right">Referal Code: <strong>{{ $Details->referal }}</strong></h3>
            </div>

            <div class="box-body table-responsive">
                <table class="table table-striped">
                    <tbody>
						<tr>
                            <td width="20%"><strong>First Name</strong></td>
                            <td>
								{{($Details->first_name)?ucfirst($Details->first_name):''}}
                            </td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>Last Name</strong></td>
                            <td>
                                {{($Details->last_name)?ucfirst($Details->last_name):''}}
                            </td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>Father Name</strong></td>
                            <td>
                                {{($Details->father_name)?ucfirst($Details->father_name):''}}
                            </td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>Mother Name</strong></td>
                            <td>
                                {{($Details->mother_name)?ucfirst($Details->mother_name):''}}
                            </td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>Email</strong></td>
                            <td>
								{{($Details->email)?ucfirst($Details->email):''}}
                            </td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>Address</strong></td>
                            <td>
							   {{($Details->address)?ucfirst($Details->address):''}}
                            </td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>Professional Type</strong></td>
                            <td>
                               {{$Details->type}}
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>District</strong></td>
                            <td>
                               {{$Details->district}}
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>State</strong></td>
                            <td>
                               {{$Details->state}}
                            </td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>Description</strong></td>
                            <td>
                               {{$Details->description}}
                            </td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>Experience</strong></td>
                            <td>
                               {{$Details->experience}}
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>Zipcode</strong></td>
                            <td>
                               {{$Details->zip}}
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>Payment Status</strong></td>
                            <td>
                               {{($Details->stripe_status == 'active')?'Active':'Inactive'}}
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>Payment Time</strong></td>
                            <td>
							{{ ($Details->created_at)?date('d M, Y h:i:sa', strtotime($Details->created_at)):'Not Done Yet' }}
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
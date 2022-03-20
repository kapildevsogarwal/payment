{{-- resources/views/adminlte/user/dashboard.blade.php --}}

@extends('layouts.user')

@section('pageTitle', 'Dashboard')

@section('content')
<div class="row">
    <div class="col-xs-4 mb-2">
        @if(\Auth::user()->user_type == 'user')
            <a href="{{ route('payment') }}" class="btn btn-primary pull-left">
               Get Subscription</a>
        @endif        
    </div>
    <div class="col-xs-8 mb-2">
        @if(\Auth::user()->user_type == 'user')
            <a href="{{ route('profile.user', [$userDetails->id]) }}" class="btn btn-primary pull-right"><i class="fa fa-pencil mr-1"></i>Edit Profile</a>
        @endif
    </div>
</div>
<div class="row">

    <div class="col-xs-12">

        @include('partials.flash-messages')

        <div class="box">
            <div class="box-header">
                <h3 class="box-title pull-left">User Detail: <strong>{{($userDetails->name)?ucwords($userDetails->name):''}}</strong></h3>
                <h3 class="box-title pull-right">Referal Code: <strong>{{ $userDetails->referal }}</strong></h3>
            </div>

            <div class="box-body table-responsive">
                <table class="table table-striped">
                    <tbody>
                        <tr>
                            <td width="20%"><strong>First Name</strong></td>
                            <td>
								{{($userDetails->first_name)?ucfirst($userDetails->first_name):''}}
                            </td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>Last Name</strong></td>
                            <td>
                              
							   {{($userDetails->last_name)?ucfirst($userDetails->last_name):''}}
                            </td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>E-mail</strong></td>
                            <td>
                               {{$userDetails->email}}
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>Experience</strong></td>
                            <td>
                               {{$userDetails->experience}}
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>Total Experience</strong></td>
                            <td>
                               {{$userDetails->total_experience}}
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>District</strong></td>
                            <td>
                               {{$userDetails->district}}
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>State</strong></td>
                            <td>
                               {{$userDetails->state}}
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>Zipcode</strong></td>
                            <td>
                               {{$userDetails->zipcode}}
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>Father Name</strong></td>
                            <td>
                              {{($userDetails->father_name)?ucfirst($userDetails->father_name):''}}
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>Mother Name</strong></td>
                            <td>
							  {{($userDetails->mother_name)?ucfirst($userDetails->mother_name):''}}
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>Address</strong></td>
                            <td>
                              {{$userDetails->address}}
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>Payment Status</strong></td>
                            <td>
								<strong>{{($userDetails->stripe_status == 'active')?'Active':'Inactive'}}</strong>
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>Payment Time</strong></td>
                            <td>
                              <strong>{{ ($userDetails->created_at)?date('d M, Y h:i:sa', strtotime($userDetails->created_at)):'Not Done Yet' }}</strong>
                            </td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>Photo</strong></td>
                            <td>
								<img src="<?php echo asset('storage/documents/'.$userDetails->id.'/'.$userDetails->user_photo)?>"  class="user-image" alt="User Image"  height="200px"></img>
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>Aadhar Card</strong></td>
                            <td>
								<img src="<?php echo asset('storage/documents/'.$userDetails->id.'/'.$userDetails->aadhar_card)?>"  class="user-image" alt="User Image"  height="200px"></img>
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>Aadhar Card Back Side</strong></td>
                            <td>
								<img src="<?php echo asset('storage/documents/'.$userDetails->id.'/'.$userDetails->aadhar_card_back)?>"  class="user-image" alt="User Image" height="200px"></img>
                            </td>
                        </tr>
						
						<tr>
                            <td width="20%"><strong>Tenth Board Name</strong></td>
                            <td>
							  {{($userDetails->tenth_board_name)?ucfirst($userDetails->tenth_board_name):'Not Mention'}}
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>Tenth Year Name</strong></td>
                            <td>
							  {{($userDetails->tenth_year_name)?$userDetails->tenth_year_name:'Not Mention'}}
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>Tenth Percentage%</strong></td>
                            <td>
							  {{($userDetails->tenth_percentage)?$userDetails->tenth_percentage.'%':'Not Mention'}}
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>Twelth Board Name</strong></td>
                            <td>
							  {{($userDetails->twelth_board_name)?ucfirst($userDetails->twelth_board_name):'Not Mention'}}
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>Twelth Year Name</strong></td>
                            <td>
							  {{($userDetails->twelth_year_name)?$userDetails->twelth_year_name:'Not Mention'}}
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>Twelth Percentage%</strong></td>
                            <td>
							  {{($userDetails->twelth_percentage)?$userDetails->twelth_percentage.'%':'Not Mention'}}
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>Degree Diploma</strong></td>
                            <td>
							  {{($userDetails->degree_diploma)?ucfirst($userDetails->degree_diploma):'Not Mention'}}
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>Degree Diploma Year</strong></td>
                            <td>
							  {{($userDetails->degree_diploma_year)?$userDetails->degree_diploma_year:'Not Mention'}}
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>Degree Diploma Percentage%</strong></td>
                            <td>
							  {{($userDetails->degree_diploma_percentage)?$userDetails->degree_diploma_percentage.'%':'Not Mention'}}
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
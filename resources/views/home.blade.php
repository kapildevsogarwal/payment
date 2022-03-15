{{-- resources/views/adminlte/user/dashboard.blade.php --}}

@extends('layouts.user')

@section('pageTitle', 'Dashboard')

@section('content')

<div class="row">
    <div class="col-xs-12">
        @include('partials.flash-messages')
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Student Listing</h3>
                <div class="box-tools"></div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped" id="business-list">
                    <thead>
                        <tr>
                            <th>Name</th>
							<th>First Name</th>
							<th>Last Name</th>
                            <th>Email</th>
							<th>Payment Status</th>
							<th>Payment Time</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
					@if(!empty($userlist) && !$userlist->isEmpty())
						@foreach ($userlist as $key => $user)
							<tr>
								<td>
									<a href="{{ route('home.show', [$user->id]) }}" title="View">
										{{ $user->name }}	
									</a>
								</td>
								<td>{{ $user->first_name }}	</td>
								<td>{{ $user->last_name }}	</td>
								<td>{{ $user->email }}	</td>
								<td>
									{{ ($user->stripe_status == 'active')?'Active':'Inactive' }}	
								</td>
								<td>
									{{ ($user->created_at)?date('d M, Y h:i:sa', strtotime($user->created_at)):'Not Done' }}</td>
								<td class="action-icons">
									<a href="{{ route('home.shsow', [$user->id]) }}" title="View Detail" class="btn btn-success action-tooltip">
										<i class="fa fa-eye"></i>
									</a>
									{{--<a href="" class="btn btn-info action-tooltip"  title="Files">
										<i class="fa fa-file-alt"></i>
									</a>
									<a href="javascript::void(0);" data-url="dddd" class="delete-company btn btn-danger action-tooltip" title="Delete">
										<i class="fa fa-trash"></i>
									</a>--}}
								</td>
							</tr>
						@endforeach
						@else
							<tr>
								<td colspan="6" align="center">
									No Record Found
								</td>
							</tr>
						@endif
						@if(!empty($userlist) && !$userlist->isEmpty())
							<tr>
								<td colspan="3" align="center">
									{!! $userlist->links() !!}
								</td>
							</tr>
						@endif
                    </tbody>
                </table>
                <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
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
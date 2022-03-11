{{-- resources/views/adminlte/user/dashboard.blade.php --}}

@extends('layouts.user')

@section('pageTitle', 'Dashboard')

@section('content')

<div class="row">
    <div class="col-xs-12">
        @include('partials.flash-messages')
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Company Listing</h3>
                <div class="box-tools"></div>
            </div>
            <div class="box-body table-responsive">
                <table class="table table-striped" id="business-list">
                    <thead>
                        <tr>
                            <th>Name</th>
							<th>Email</th>
							<th>Address</th>
                            <th>Type</th>
							<th>Payment Status</th>
							<th>Payment Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
					@if($companylist->count() > 0)
						@foreach ($companylist as $key => $company)
							<tr>
								<td>
									<a href="{{ route('company.details', [$company->id]) }}" title="View">
										{{ $company->name }}	
									</a>
								</td>
								<td>{{ $company->email }}	</td>
								<td>{{ $company->address }}	</td>
								<td>{{ $company->type }}	{{$company->stripe_status}}</td>
								<td>{{ ($company->stripe_status == 'active')?'Active':'Inactive' }}	</td>
								<td>{{ ($company->created_at)?date('d M, Y h:i:sa', strtotime($company->created_at)):'' }}	</td>
								<td class="action-icons">
									<a href="{{ route('company.details', [$company->id]) }}" title="View Detail" class="btn btn-success action-tooltip">
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
						@if($companylist->count() > 0)
							<tr>
								<td colspan="3" align="center">
									{!! $companylist->links() !!}
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
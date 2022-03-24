{{-- resources/views/adminlte/user/dashboard.blade.php --}}

@extends('layouts.user')

@section('pageTitle', 'Student')

@section('content')
<div class="row">
    <div class="col-xs-4 mb-2">
        <input type="text" class="form-control" id="serach" name="serach" placeholder="Search Company">               
    </div>
    <div class="col-xs-8 mb-2">
       
    </div>
</div>
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
                                    {{($user->payment_id != '')?'Active':'Inactive'}}
								</td>
								<td>
									{{ ($user->pay_time)?date('d M, Y h:i:sa', strtotime($user->pay_time)):'Not Done' }}</td>
								<td class="action-icons">
									<a href="{{ route('home.show', [$user->id]) }}" title="View Detail" class="btn btn-success action-tooltip">
										<i class="fa fa-eye"></i>
									</a>
									<a href="{{ route('profile.user', [$user->id]) }}" title="Edit" class="btn btn-success action-tooltip">
                                                <i class="fa fa-pencil"></i>
                                    </a>
                                     <a href="javascript::void(0);" data-url="{{ route('home.destroy', [$user->id]) }}" class="delete-delivery-note btn btn-danger action-tooltip" title="Delete">
                                                <i class="fa fa-trash"></i>
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
    <script>
    	function showSA(obj) {
		    swal.fire({
		        type: obj.type,
		        title: obj.message
		    }).then(function(result) {

				if(typeof obj.urlTarget != 'undefined') {
					window.open(obj.url, obj.urlTarget);
				} else if(typeof obj.url != 'undefined') {
					window.location.href = obj.url;
				}
				
		    });
		}


        $(document).ready(function(){
            
            // Delete delivery ticket
            $('body').on('click', '.delete-delivery-note', function(e){
                e.preventDefault();
                console.log($(this).data('url'));

                var dataUrl = $(this).data('url');

                // Remove delivery ticket
                swal.fire({
                    title: 'Permanently delete this User?',
                    text: "This cannot be undone!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#00a65a',
                    cancelButtonColor: '#dd4b39',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Never mind'
                }).then(function(result) {
                    if (result.value) {
                        $.ajax({
                            type: 'DELETE',
                            url: dataUrl,
                            dataType: 'json',
                            data: {
                            },
                            beforeSend: function(){
                                //$('.full-page-loader').show();
                            },
                            error: function(response, status, xhr) {
                            },
                            success: function(response, status, xhr, $form) {

                               // $('.full-page-loader').hide();

                                if(response.status == 'failure') {
                                    showSA({
                                        type: 'error',
                                        message: response.payload.message,
                                    })

                                } else {
                                    showSA({
                                        type: 'success',
                                        message: response.payload.message,
                                        url: response.payload.url
                                    })
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
{{-- resources/views/adminlte/user/dashboard.blade.php --}}

@extends('layouts.user')

@section('pageTitle', 'Company Detail Information')

@section('content')

<div class="row">

    <div class="col-xs-12">

        @include('partials.flash-messages')

        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Company Detail: <strong>{{($companyDetails->name)?ucwords($companyDetails->name):''}}</strong></h3>
            </div>

            <div class="box-body table-responsive">
                <table class="table table-striped">
                    <tbody>
						<tr>
                            <td width="20%"><strong>Name</strong></td>
                            <td>
								{{($companyDetails->name)?ucfirst($companyDetails->name):''}}
                            </td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>Email</strong></td>
                            <td>
								{{($companyDetails->email)?ucfirst($companyDetails->email):''}}
                            </td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>Address</strong></td>
                            <td>
							   {{($companyDetails->address)?ucfirst($companyDetails->address):''}}
                            </td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>Type</strong></td>
                            <td>
                               {{$companyDetails->type}}
                            </td>
                        </tr>
						
                        <tr>
                            <td width="20%"><strong>Company Catalog First</strong></td>
                            <td>
							@php 
							$file = public_path('storage/documents/company/'.$companyDetails->id.'/'.$companyDetails->catalog_first)  @endphp
								@if (File::exists($file))
								<img src="<?php echo asset('storage/documents/company/'.$companyDetails->id.'/'.$companyDetails->catalog_first)?>" width="150px"  class="user-image" alt="User Image"></img>
								@endif
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>Company Catalog Second</strong></td>
                            <td>
							@php 
							$file = public_path('storage/documents/company/'.$companyDetails->id.'/'.$companyDetails->catalog_second)  @endphp
								@if (File::exists($file))
								<img src="<?php echo asset('storage/documents/company/'.$companyDetails->id.'/'.$companyDetails->catalog_second)?>" width="150px"  class="user-image" alt="User Image"></img>
								@endif
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>Company Catalog Third</strong></td>
                            <td>
							@php 
							$file = public_path('storage/documents/company/'.$companyDetails->id.'/'.$companyDetails->catalog_third)  @endphp
								@if (File::exists($file))
								<img src="<?php echo asset('storage/documents/company/'.$companyDetails->id.'/'.$companyDetails->catalog_third)?>"  width="150px"  class="user-image" alt="User Image"></img>
								@endif
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>Company Catalog Four</strong></td>
                            <td>
							@php 
							$file = public_path('storage/documents/company/'.$companyDetails->id.'/'.$companyDetails->catalog_four)  @endphp
								@if (File::exists($file))
								<img src="<?php echo asset('storage/documents/company/'.$companyDetails->id.'/'.$companyDetails->catalog_four)?>" width="150px"  class="user-image" alt="User Image"></img>
								@endif
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>Company Catalog Five</strong></td>
                            <td>
							@php 
							$file = public_path('storage/documents/company/'.$companyDetails->id.'/'.$companyDetails->catalog_five)  @endphp
								@if (File::exists($file))
								<img src="<?php echo asset('storage/documents/company/'.$companyDetails->id.'/'.$companyDetails->catalog_five)?>" width="150px"  class="user-image" alt="User Image"></img>
								@endif
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
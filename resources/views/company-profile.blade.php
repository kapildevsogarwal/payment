<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aspes Employment Registration</title>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
     <style>
        .alert.parsley {
            margin-top: 5px;
            margin-bottom: 0px;
            padding: 10px 15px 10px 15px;
        }
        .check .alert {
            margin-top: 20px;
        }
        .credit-card-box .panel-title {
            display: inline;
            font-weight: bold;
        }
        .credit-card-box .display-td {
            display: table-cell;
            vertical-align: middle;
            width: 100%;
        }
        .credit-card-box .display-tr {
            display: table-row;
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    
</head>
<body id="app-layout">
<nav class="navbar navbar-inverse ">
  <div class="container-fluid">
    <div class="navbar-header">
      <a href="{{ route('logout') }}" class="navbar-brand">
        Logout
      </a>
    </div>  
  </div>
</nav>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <h1 class="text-primary text-center">
          <strong>Profile Detail</strong>
        </h1>
    </div>
</div>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <div class="panel panel-default credit-card-box">
		<div class="panel-heading bg-light clearfix">
			<div class="pull-left">User Detail: <strong>{{($companyDetails->name)?ucwords($companyDetails->name):''}}</strong></div>
			<div class="pull-right font-weight-bold"><a href="{{ url('/home') }}"><strong>Payment<strong></a></div>
		</div>
        
        <div class="panel-body">
            <div class="col-md-12">
              <div class="box">
           
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
                            <td width="20%"><strong>Company GST Number</strong></td>
                            <td>
                               {{$companyDetails->gst}}
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>Payment Status</strong></td>
                            <td>
                               {{($companyDetails->stripe_status == 'active')?'Active':'Inactive'}}
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>Payment Time</strong></td>
                            <td>
							{{ ($companyDetails->created_at)?date('d M, Y h:i:sa', strtotime($companyDetails->created_at)):'Not Done Yet' }}
                            </td>
                        </tr>
                        <tr>
                            <td width="20%"><strong>Company Catalog First</strong></td>
                            <td>
							@if($companyDetails->catalog_first)
								@php 
									$file = public_path('storage/documents/company/'.$companyDetails->id.'/'.$companyDetails->catalog_first);  
								@endphp
								@if (File::exists($file))
									<img src="<?php echo asset('storage/documents/company/'.$companyDetails->id.'/'.$companyDetails->catalog_first)?>" width="150px"  class="user-image" alt="User Image"></img>
								@endif
							@else
								<span>Not Define</span>
							@endif
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>Company Catalog Second</strong></td>
                            <td>
							@if($companyDetails->catalog_second)
								@php 
									$file = public_path('storage/documents/company/'.$companyDetails->id.'/'.$companyDetails->catalog_second);  
								@endphp
								@if (File::exists($file))
									<img src="<?php echo asset('storage/documents/company/'.$companyDetails->id.'/'.$companyDetails->catalog_second)?>" width="150px"  class="user-image" alt="User Image"></img>
								@endif
							@else
								<span>Not Define</span>
							@endif
                            </td>

                        </tr>
						<tr>
                            <td width="20%"><strong>Company Catalog Third</strong></td>
                            <td>
							@if($companyDetails->catalog_third)
								@php 
									$file = public_path('storage/documents/company/'.$companyDetails->id.'/'.$companyDetails->catalog_third);  
								@endphp
								@if (File::exists($file))
									<img src="<?php echo asset('storage/documents/company/'.$companyDetails->id.'/'.$companyDetails->catalog_third)?>"  width="150px"  class="user-image" alt="User Image"></img>
								@endif
							@else
								<span>Not Define</span>
							@endif
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>Company Catalog Four</strong></td>
                            <td>
							@if($companyDetails->catalog_four)
								@php 
									$file = public_path('storage/documents/company/'.$companyDetails->id.'/'.$companyDetails->catalog_four);  
								@endphp
								@if (File::exists($file))
									<img src="<?php echo asset('storage/documents/company/'.$companyDetails->id.'/'.$companyDetails->catalog_four)?>" width="150px"  class="user-image" alt="User Image"></img>
								@endif
							@else
								<span>Not Define</span>
							@endif
                            </td>
                        </tr>
						<tr>
                            <td width="20%"><strong>Company Catalog Five</strong></td>
                            <td>
							@if($companyDetails->catalog_five)
								@php 
									$file = public_path('storage/documents/company/'.$companyDetails->id.'/'.$companyDetails->catalog_five);
								@endphp
								@if (File::exists($file))
									<img src="<?php echo asset('storage/documents/company/'.$companyDetails->id.'/'.$companyDetails->catalog_five)?>" width="150px"  class="user-image" alt="User Image"></img>
								@endif
							@else
								<span>Not Define</span>
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
    </div>
    
  </div>
</div>
    
    <script>
        window.ParsleyConfig = {
            errorsWrapper: '<div></div>',
            errorTemplate: '<div class="alert alert-danger parsley" role="alert"></div>',
            errorClass: 'has-error',
            successClass: 'has-success'
        };
    </script>
    
    <script src="//parsleyjs.org/dist/parsley.js"></script>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>
    <script>
        Stripe.setPublishableKey("{{ config('services.stripe.public_key') }}");
        jQuery(function($) {
            $('#payment-form').submit(function(event) {
                var $form = $(this);
                $form.parsley().subscribe('parsley:form:validate', function(formInstance) {
                    formInstance.submitEvent.preventDefault();
                    alert();
                    return false;
                });
                $form.find('#submitBtn').prop('disabled', true);
                Stripe.card.createToken($form, stripeResponseHandler);
                return false;
            });
        });
        function stripeResponseHandler(status, response) {
            var $form = $('#payment-form');
            if (response.error) {
                $form.find('.payment-errors').text(response.error.message);
                $form.find('.payment-errors').addClass('alert alert-danger');
                $form.find('#submitBtn').prop('disabled', false);
                $('#submitBtn').button('reset');
            } else {
                var token = response.id;
                $form.append($('<input type="hidden" name="stripeToken" />').val(token));
                $form.get(0).submit();
            }
        };
    </script>
</body>
</html>
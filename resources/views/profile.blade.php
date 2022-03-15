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
			<div class="pull-left">User Detail: <strong>{{($userDetails->name)?ucwords($userDetails->name):''}}</strong></div>
			<div class="pull-right font-weight-bold"><a href="{{ url('/home') }}"><strong>Payment<strong></a></div>
		</div>
        
        <div class="panel-body">
            <div class="col-md-12">
              <div class="box">
           
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
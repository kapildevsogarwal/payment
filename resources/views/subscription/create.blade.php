<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aspes Professional Registration</title>

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
          <strong>Aspes Employement charges</strong>
        </h1>
    </div>
</div>
<div class="row">
  <div class="col-md-6 col-md-offset-3">
    <div class="panel panel-default credit-card-box">
       <div class="panel-heading bg-light clearfix">
			<div class="pull-left"><strong>Please do your payment</strong></div>
			<div class="pull-right font-weight-bold"><a href="{{ route('profile') }}">View Profile</a></div>
		</div>
        <div class="panel-body">
            <div class="col-md-12">
             
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                  <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                </div>
				@php Session::forget('success'); @endphp
                @endif
				@if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                  <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                </div>
				@php Session::forget('error'); @endphp
                @endif
                <div class="form-group" id="product-group">
                    <div class="alert alert-info alert-block">
                        
                        <strong>Referal Code: {{$referal}}</strong>
                    </div>
                </div>
                <div class="form-group" id="product-group">
                    <div class="alert alert-info alert-block">
						
                        <strong>&#8377;100 Inr Charges</strong>
					</div>
                </div>
				 <div class="row">
                    <div class="col-md-12">
                        <span class="payment-errors" style="color: red;margin-top:10px;"></span>
                    </div>
                  </div>
                
                <div class="row">
				 
                   <div class="col-md-6">
						<div class="form-group">
							<label class="checkbox mb-0 ">
								<input type="checkbox" id="agree" name="agree" value="yes" />I Agree to the
					&nbsp;<a href="#" target="_blank" data-toggle="modal" data-target="#terms">terms and conditions</a>.&nbsp;
					<span></span></label>
							<div class="modal fade" id="terms" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title">Terms &amp; Conditions</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<i aria-hidden="true" class="ki ki-close"></i>
											</button>
										</div>
										<div class="modal-body">
											<p style="font-size: 10px;">This application is a communiction plateform where saver/ supplier/ upholder can find better option.</p>
											<p style="font-size: 10px;">Your permission is needed to upload your personal & contact details on the portal through this plateform..</p>
											<p style="font-size: 10px;">Your permission is needed to forward your data according to the need and job capability/business premises by the company .</p>
											<p style="font-size: 10px;">Company doesn't provide any job gurantee while your job depends when your skill and behaviour.</p>
											<p style="font-size: 10px;">Your fees will not be refunded as its company's service charge and no legal charges available for this.</p>
											<p style="font-size: 10px;">Your permission is needed to inform you by call, sms or e-mail by the company.</p>
											<p style="font-size: 10px;">This is a market plateform where buyer and supplier can behave according to their need.</p>
											<p style="font-size: 10px;">Our company wants only your communication charges.</p>
											<p style="font-size: 10px;">We will try to provide your best products and services.</p>
											<p style="font-size: 10px;">There is no boundation of the company where to buy products and services i.e. its your own right.</p>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-primary" data-dismiss="modal">Okay</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group ">
							<form action="{{ route('payment') }}" method="POST" >
								@csrf
								<script src="//checkout.razorpay.com/v1/checkout.js"
										data-key="{{ config('services.rozarpay.public_key') }}"
										data-amount="10000"
										data-buttontext="Pay 100 INR"
										data-name="aspes.com"
										data-description="Student Charges"
										data-image="https://aspes.in/images/logo.png"
										data-prefill.name="name"
										data-prefill.email="email"
										data-theme.color="#ff7529">
								</script>
							</form>  
						</div>
					</div>
                </div>
			
            </div>
        </div>
    </div>
    
  </div>
</div>

<script>
	jQuery(function($) {
		$(".razorpay-payment-button").addClass("form-control");
		
		$('.razorpay-payment-button').attr('disabled', true);
		
		$('.razorpay-payment-button').click(function() {
			//$(this).attr('disabled', true);
		});
		
		$('#agree').change(function() {
			if(this.checked) {
				$('.razorpay-payment-button').attr('disabled', false);
			}
			else{
				$('.razorpay-payment-button').attr('disabled', true);
			}
			 
		});
	});
     
</script>
</body>
</html>
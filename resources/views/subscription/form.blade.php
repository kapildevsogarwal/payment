<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Aspes Business Registration</title>

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
          <strong>Aspes  Business Charges</strong>
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
				<form action="{{route('payment_process')}}" id="stripe" method="post">
					<input id="card-holder-name" type="text">
					
					<!-- Stripe Elements Placeholder -->
					<div id="card-element"></div>
					<input name="pmethod" type="hidden" id="pmethod" value="" />
					<button id="card-button">
						Process Payment
					</button>
				</form>
            </div>
        </div>
    </div>
    
  </div>
</div>
  
    <script type="text/javascript" src="https://js.stripe.com/v3/"></script>
    <script>
	
     const stripe = Stripe("{{ config('services.stripe.public_key') }}");
    const elements = stripe.elements();
    const cardElement = elements.create('card');
    cardElement.mount('#card-element');
    const cardHolderName = document.getElementById('card-holder-name');
    const form = document.getElementById('stripe');
    form.addEventListener('submit', async (e) => {
        e.preventDefault();
        const { paymentMethod, error } = await stripe.createPaymentMethod(
            'card', cardElement, {
                billing_details: { name: cardHolderName.value }
            }
        );
        if (error) {
            // Display "error.message" to the user...
        } else {
            console.log('Card verified successfully');
            console.log(paymentMethod.id);
            document.getElementById('pmethod').setAttribute('value', paymentMethod.id);
            form.submit();
        }
    });
</script>
</body>
</html>
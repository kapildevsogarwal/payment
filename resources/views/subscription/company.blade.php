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
              {!! Form::open(['url' => route('order.company'), 'data-parsley-validate', 'id' => 'payment-form']) !!}
                @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                  <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                </div>
                @endif
				@if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                  <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{{ $message }}</strong>
                </div>
                @endif
                <div class="form-group" id="product-group">
                    <div class="alert alert-info alert-block">
						
                        <strong>&#8377;999 Inr Charges</strong>
					</div>
                </div>
				 <div class="row">
                    <div class="col-md-12">
                        <span class="payment-errors" style="color: red;margin-top:10px;"></span>
                    </div>
                  </div>
                <div class="form-group" id="cc-group">
                    {!! Form::label(null, 'Credit/Debit card number:') !!}
                    {!! Form::text(null, null, [
                        'class'                         => 'form-control',
                        'required'                      => 'required',
                        'data-stripe'                   => 'number',
                        'data-parsley-type'             => 'number',
                        'maxlength'                     => '16',
                        'data-parsley-trigger'          => 'change focusout',
                        'data-parsley-class-handler'    => '#cc-group'
                        ]) !!}
                </div>
                <div class="form-group" id="ccv-group">
                    {!! Form::label(null, 'CVC (3 or 4 digit number):') !!}
                    {!! Form::text(null, null, [
                        'class'                         => 'form-control',
                        'required'                      => 'required',
                        'data-stripe'                   => 'cvc',
                        'data-parsley-type'             => 'number',
                        'data-parsley-trigger'          => 'change focusout',
                        'maxlength'                     => '4',
                        'data-parsley-class-handler'    => '#ccv-group'
                        ]) !!}
                </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group" id="exp-m-group">
                        {!! Form::label(null, 'Ex. Month') !!}
                        {!! Form::selectMonth(null, null, [
                            'class'                 => 'form-control',
                            'required'              => 'required',
                            'data-stripe'           => 'exp-month'
                        ], '%m') !!}
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group" id="exp-y-group">
                        {!! Form::label(null, 'Ex. Year') !!}
                        {!! Form::selectYear(null, date('Y'), date('Y') + 10, null, [
                            'class'             => 'form-control',
                            'required'          => 'required',
                            'data-stripe'       => 'exp-year'
                            ]) !!}
                    </div>
                  </div>
                </div>
                  <div class="form-group">
                      {!! Form::submit('Place order!', ['class' => 'btn btn-lg btn-block btn-primary btn-order', 'id' => 'submitBtn', 'style' => 'margin-bottom: 10px;']) !!}
                  </div>
                 
              {!! Form::close() !!}
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
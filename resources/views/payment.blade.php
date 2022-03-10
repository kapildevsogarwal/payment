@extends('layouts.app')

@section('content')
<div class="page-loader page-loader-logo" style="display: flex;justify-content: center;">
	
	<div class="spinner spinner-primary"></div>
</div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Do Your payment</div>

                <div class="card-body">
                    

                   <form method="post" id="order_payment_form" class="forml">
                       <input type="hidden" name="userid" id="userid" value="{{Auth::id()}}" />
						 <div class="form-group row">
							<label for="name" class="col-md-4 col-form-label text-md-right"></label>
                            <div class="col-md-6">
								<span class="error text-danger display-error font-weight-bold"></span>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Card Number*</label>
                            <div class="col-md-6">
                                <div id="card-element" class="form-control form-control-lg form-control-solid"></div>
								<span class="error text-danger card-number"></span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Card Expiry*</label>
                            <div class="col-md-6">
                                <div id="card-expiry" class="form-control form-control-lg form-control-solid"></div>
								<span class="error text-danger card-validity"></span>
                            </div>
                        </div>
						<div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Card CVC/CVV*</label>
                            <div class="col-md-6">
                                <div id="card-cvv" class="form-control form-control-lg form-control-solid"></div>
								<span class="error text-danger cvv-number"></span>
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" class="btn btn-primary" id="save_subscription_payment">
                                    Pay
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script type="text/JavaScript" src="//cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.js"></script>
<script src="https://js.stripe.com/v3/"></script>
<script>
		$( document ).ready(function() {
			$('.page-loader').hide();
			let form = $('#order_payment_form');
			let elementStyles = {
                base: {
                    color: '#333',
                    lineHeight: '16px',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSize: '14px',
                    fontSmoothing: 'antialiased',
                    ':focus': {
                      color: '#333',
                    },
                    '::placeholder': {
                        color: '#808080',
                    },
                    ':focus::placeholder': {
                        color: '#808080',
                    },
                },
                invalid: {
                    color: '#333',
                    ':focus': {
                        color: '#333',
                    },
                    '::placeholder': {
                        color: '#808080',
                    },
                },
            };
			
			let elementClasses = {
				focus: 'focus',
				empty: 'empty',
				invalid: 'invalid',
			};
			
			let stripe = Stripe("{{ config('services.stripe.public_key') }}");
			let elements = stripe.elements();
			let card = elements.create('cardNumber', {
				style: elementStyles,
				classes: elementClasses,
			});

			let expiry = elements.create('cardExpiry', {
				style: elementStyles,
				classes: elementClasses,
			});

			let cvv = elements.create('cardCvc', {
				style: elementStyles,
				classes: elementClasses,
			});

			card.mount('#card-element');
			expiry.mount('#card-expiry');
			cvv.mount('#card-cvv');
			
			let errorContainer = $('.card-number');
			card.on('change', (e) => {
				if (e.error) {
					 errorContainer.text(e.error.message).css({'color' : 'red', 'font-size' : '14px'});
				} else {
					errorContainer.text('');
				}
			});
			
			let errorContainerValidity = $('.card-validity');
			expiry.on('change', (e) => {
				if (e.error) {
					errorContainerValidity.text(e.error.message).css({'color' : 'red', 'font-size' : '14px'});
				} else {
					errorContainerValidity.text('');
				}
			});
			let errorContainerCvv = $('.cvv-number');
			cvv.on('change', (e) => {
				if (e.error) {
					errorContainerCvv.text(e.error.message).css({'color' : 'red', 'font-size' : '14px'});
				} else {
					errorContainerCvv.text('');
				}
			});
			
			$('#save_subscription_payment').on('click', (e) => {
				e.preventDefault();
				/*let ownerInfo = {
					owner: {
						name: $('#'+prefix+'_name_on_card', form).val()
					}
				};
				*/
				let errorContainers = $('.display-error');
				stripe.createSource(card).then(res => {
					//console.log(res.error);
					//stripe.createSource(card, ownerInfo).then(res => {
					if (res.error) {
						//errorContainers.text(res.error.message).css({'color' : 'red', 'font-size' : '14px'});
					} 
					else {
						errorContainers.text('');						
						$.ajax({
							type: 'post',
							url: '{{ route("cart.make-payment") }}',
							dataType: 'json',
							data: {
								source:res.source.id,
								userid:$('#userid').val(),
								"_token": "{{ csrf_token() }}",
							},
							beforeSend: function(){
								$('.page-loader').show();
							},
							error: function(response, status, xhr) {
								$('.page-loader').hide();
								console.log('with in error');
								console.log(response.responseJSON.payload.message);
								showSA({
									type: 'error',
									message: response.responseJSON.payload.message,
								});
							},
							success: function(response, status, xhr, $form) {
								$('.page-loader').hide();
								console.log('YES');
								showSA({
									type: 'success',
									message: response.payload.message,
									url: response.payload.url
								});
							}
						});
					}
				});
			});
		});
</script>
@endsection
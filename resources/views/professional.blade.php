
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel - Razorpay Payment Gateway Integration Example - CodeCheef</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"  crossorigin="anonymous">
</head>
<body>
    <div id="app">
	<nav class="navbar navbar-inverse ">
		<div class="container-fluid">
			<div class="navbar-header">
				<a href="{{ route('logout') }}" class="navbar-brand">
					Logout
				</a>
			</div>  
		</div>
	</nav>
        <main class="py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 offset-3 col-md-offset-6">
                        @if(Session::has('error'))
                            <div class="alert alert-danger alert-dismissible fade in" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Error!</strong>  {{session('error')}}
                            </div>
                        @endif
						
						@if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade {{ Session::has('success') ? 'show' : 'in' }}" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <strong>Success!</strong>  {{session('success')}}
								@php Session::forget('success'); @endphp
                            </div>
                        @endif
  
                        <div class="card card-default">
                            <div class="card-header">
                                Aspes payment
                            </div>
							<div class="card-header">
                               <strong>&#8377;500 Inr Charges</strong>
                            </div>
                            <div class="card-body text-center">
                                <form action="{{ route('payment') }}" method="POST" >
                                    @csrf
                                    <script src="//checkout.razorpay.com/v1/checkout.js"
                                            data-key="{{ config('services.rozarpay.public_key') }}"
                                            data-amount="100"
                                            data-buttontext="Pay 500 INR"
                                            data-name="ItSolutionStuff.com"
                                            data-description="Rozerpay"
                                            data-image="https://www.itsolutionstuff.com/frontTheme/images/logo.png"
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
        </main>
    </div>
</body>
</html>

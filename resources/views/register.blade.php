@extends('layouts.app')

@section('content')
<style>
.row > * {
    flex-shrink: 0;
    width: 100%;
    max-width: 100%;
    padding-right: calc(var(--bs-gutter-x) * .5);
    padding-left: calc(var(--bs-gutter-x) * .5);
    margin-top: var(--bs-gutter-y);
}

</style>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><h2>{{ __('Register') }}</h2></div>
			 @if ($errors->any)
				@foreach ($errors->all() as $error)
					<div class="alert alert-danger" role="alert">
					  {{$error}}
					</div>
				 @endforeach
			 @endif

                <div class="card-body">
                    <form class="row g-3" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
					  @csrf
						<div class="col-md-6" style="padding-bottom: 15px;">
							<label for="name" class="form-label" style="font-weight:800;">Username</label>
							<input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
							 @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
						</div>
						<div class="col-md-6" style="padding-bottom: 15px;">
							<label for="lastname" class="form-label" style="font-weight:800;">Last Name</label>
							<input id="lastname" type="text" class="form-control @error('lastname') is-invalid @enderror" name="lastname" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>
							 @error('lastname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
						</div>
						
						<div class="col-md-6" style="padding-bottom: 15px;">
							<label for="firstname" class="form-label" style="font-weight:800;">First Name</label>
							<input id="firstname" type="text" class="form-control @error('name') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>
							 @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
						</div>
						<div class="col-md-6" style="padding-bottom: 15px;">
							<label for="email" class="form-label" style="font-weight:800;">E-mail Address</label>
							<input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
							 @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
						</div>
						<div class="col-md-6" style="padding-bottom: 15px;">
							<label for="password" class="form-label" style="font-weight:800;">Password</label>
							<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus>
							 @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
						</div>
						<div class="col-md-6" style="padding-bottom: 15px;">
							<label for="dob" class="form-label" style="font-weight:800;">Date Of Birth</label>
							<input id="dob" type="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" required autocomplete="dob" autofocus>
							 @error('dob')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
						</div>
						<div class="col-md-6" style="padding-bottom: 15px;">
							<label for="password-confirm" class="form-label" style="font-weight:800;">Confirm Password</label>
							<input id="password-confirm" type="password" class="form-control " name="password_confirmation" value="{{ old('password-confirm') }}" required autocomplete="password" >
							
						</div>
						<div class="col-md-6" style="padding-bottom: 15px;">
							<label for="user_photo" class="form-label" style="font-weight:800;">Upload Photo</label>
							<input name="user_photo" class="form-control-file" id="user_photo" type="file" required>
							 @error('user_photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
						</div>
						<div class="col-md-6" style="padding-bottom: 15px;">
							<label for="address" class="form-label" style="font-weight:800;">Address</label>
							<input id="address" type="text" class="form-control " name="address" value="{{ old('address') }}" required >
							@error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
						</div>
						<div class="col-md-6" style="padding-bottom: 15px;">
							<label for="aadhar_card" class="form-label" style="font-weight:800;">Upload aadharcard upper side</label>
							<input class="form-control-file" id="aadhar_card" name="aadhar_card" type="file" >
						</div>
						<div class="col-md-6" style="padding-bottom: 15px;">
							<label for="mother_name" class="form-label" style="font-weight:800;">Mother Name</label>
							<input id="mother_name" type="text" class="form-control" name="mother_name" value="{{ old('mother_name') }}" required  >
							@error('mother_name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
                             @enderror
						</div>
						<div class="col-md-6" style="padding-bottom: 15px;">
							<label for="aadhar_card_back" class="form-label" style="font-weight:800;">Upload aadharcard back side</label>
							<input class="form-control-file" name="aadhar_card_back" id="aadhar_card_back" type="file" >
						</div>
						<div class="col-md-6" style="padding-bottom: 15px;">
							<label for="father_name" class="form-label" style="font-weight:800;">Father Name</label>
							<input id="father_name" type="text" name="father_name" class="form-control "  value="{{ old('mother_name') }}" required  >
							@error('father_name')
								<span class="invalid-feedback" role="alert">
									<strong>{{ $message }}</strong>
								</span>
                             @enderror
						</div>
						<div class="col-md-6" style="padding-bottom: 15px;">
							&nbsp;
						</div>
						<div class="col-md-4" style="padding-bottom: 15px;">
							<label for="tenth_board_name" class="form-label" style="font-weight:800;">10th Board Name</label>
							<input id="tenth_board_name" type="text" name="tenth_board_name" class="form-control "  value="{{ old('tenth_board_name') }}"   >
							
						</div>
						<div class="col-md-4" style="padding-bottom: 15px;">
							<label for="tenth_year_name" class="form-label" style="font-weight:800;">10th Passing Year</label>
							<input id="tenth_year_name" type="text" name="tenth_year_name" class="form-control "  value="{{ old('tenth_year_name') }}"   >
							
						</div>
						<div class="col-md-4" style="padding-bottom: 15px;">
							<label for="tenth_percentage" class="form-label" style="font-weight:800;">10th Percentage %</label>
							<input id="tenth_percentage" type="text" name="tenth_percentage" class="form-control allow_decimal"  value="{{ old('tenth_percentage') }}"   >
						</div>
						<div class="col-md-4" style="padding-bottom: 15px;">
							<label for="twelth_board_name" class="form-label" style="font-weight:800;">12th Board Name</label>
							<input id="twelth_board_name" type="text" name="twelth_board_name" class="form-control "  value="{{ old('twelth_board_name') }}"   >
							
						</div>
						<div class="col-md-4" style="padding-bottom: 15px;">
							<label for="twelth_year_name" class="form-label" style="font-weight:800;">12th Passing Year</label>
							<input id="twelth_year_name" type="text" name="twelth_year_name" class="form-control "  value="{{ old('twelth_year_name') }}"   >
							
						</div>
						<div class="col-md-4" style="padding-bottom: 15px;">
							<label for="twelth_percentage" class="form-label" style="font-weight:800;">12th Percentage %</label>
							<input id="twelth_percentage" type="text" name="twelth_percentage" class="form-control allow_decimal"  value="{{ old('twelth_percentage') }}"   >
						</div>
						<div class="col-md-4" style="padding-bottom: 15px;">
							<label for="degree_diploma" class="form-label" style="font-weight:800;">Degree, Diplomas</label>
							<input id="degree_diploma" type="text" name="degree_diploma" class="form-control "  value="{{ old('degree_diploma') }}"   >
							
						</div>
						<div class="col-md-4" style="padding-bottom: 15px;">
							<label for="degree_diploma_year" class="form-label" style="font-weight:800;">Passing Year</label>
							<input id="degree_diploma_year" type="text" name="degree_diploma_year" class="form-control "  value="{{ old('degree_diploma_year') }}"   >
						</div>
						<div class="col-md-4" style="padding-bottom: 15px;">
							<label for="degree_diploma_percentage" class="form-label" style="font-weight:800;">Percentage %</label>
							<input id="degree_diploma_percentage" type="text" name="degree_diploma_percentage" class="form-control allow_decimal"  value="{{ old('degree_diploma_percentage') }}"   >
						</div>
						<div class="col-md-6 offset-md-5">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                        </div>
					</form>
					{{--<form method="POST" action="{{ route('register') }}">
                        @csrf
					
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>--}}
                </div>
            </div>
        </div>
    </div>
</div>
<script>
	(function($) {
		$.fn.inputFilter = function(inputFilter) {
			return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
				if (inputFilter(this.value)) {
					this.oldValue = this.value;
					this.oldSelectionStart = this.selectionStart;
					this.oldSelectionEnd = this.selectionEnd;
				}
				else if (this.hasOwnProperty("oldValue")) {
					this.value = this.oldValue;
					this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
				}
				else {
					this.value = "";
				}
			});
		};
	}(jQuery));

	// Allow numeric only
	$(".allow_numeric_only").inputFilter(function(value) {
		 return /^\d*$/.test(value);
	});

	// allow decimal only
	$(".allow_decimal").inputFilter(function(value) {
	   return /^-?\d*[.]?\d*$/.test(value);
	});
</script>
@endsection

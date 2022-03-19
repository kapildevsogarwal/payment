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
							<label for="district" class="form-label" style="font-weight:800;">District</label>
							<input id="district" type="text" class="form-control @error('district') is-invalid @enderror" name="district" value="{{ old('district') }}" required autocomplete="district" autofocus>
							 @error('district')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
							
						</div>
						<div class="col-md-6" style="padding-bottom: 15px;">
							<label for="state" class="form-label" style="font-weight:800;">State</label>
							<select id="state" name="state" class="form-control">
								<option value="Andaman and Nicobar Islandsform-control">Andaman and Nicobar Islandsform-control</option>
								<option value="Andhra Pradesh">Andhra Pradesh</option>
								<option value="Arunachal Pradesh">Arunachal Pradesh</option>
								<option value="Assam">Assam</option>
								<option value="Bihar">Bihar</option>
								<option value="Chandigarh">Chandigarh</option>
								<option value="Chhattisgarh">Chhattisgarh</option>
								<option value="Dadra and Nagar Haveli">Dadra and Nagar Haveli</option>
								<option value="Daman and Diu">Daman and Diu</option>
								<option value="Delhi">Delhi</option>
								<option value="Goa">Goa</option>
								<option value="Gujarat">Gujarat</option>
								<option value="Haryana">Haryana</option>
								<option value="Himachal Pradesh">Himachal Pradesh</option>
								<option value="Jammu and Kashmir">Jammu and Kashmir</option>
								<option value="Jharkhand">Jharkhand</option>
								<option value="Karnataka">Karnataka</option>
								<option value="Kerala">Kerala</option>
								<option value="Ladakh">Ladakh</option>
								<option value="Lakshadweep">Lakshadweep</option>
								<option value="Madhya Pradesh">Madhya Pradesh</option>
								<option value="Maharashtra">Maharashtra</option>
								<option value="Manipur">Manipur</option>
								<option value="Meghalaya">Meghalaya</option>
								<option value="Mizoram">Mizoram</option>
								<option value="Nagaland">Nagaland</option>
								<option value="Odisha">Odisha</option>
								<option value="Puducherry">Puducherry</option>
								<option value="Punjab">Punjab</option>
								<option value="Rajasthan">Rajasthan</option>
								<option value="Sikkim">Sikkim</option>
								<option value="Tamil Nadu">Tamil Nadu</option>
								<option value="Telangana">Telangana</option>
								<option value="Tripura">Tripura</option>
								<option value="Uttar Pradesh">Uttar Pradesh</option>
								<option value="Uttarakhand">Uttarakhand</option>
								<option value="West Bengal">West Bengal</option>
							</select>
							
							
							
						</div>
						<div class="col-md-6" style="padding-bottom: 15px;">
							<label for="zipcode" class="form-label" style="font-weight:800;">Zipcode</label>
							<input id="zipcode" type="zipcode" class="form-control @error('zipcode') is-invalid @enderror" name="zipcode" value="{{ old('zipcode') }}" required autocomplete="zipcode" autofocus>
							 @error('zipcode')
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
							<label for="experience" class="form-label" style="font-weight:800;">Experience</label>
							<input id="experience" type="experience" class="form-control @error('experience') is-invalid @enderror" name="experience" value="{{ old('experience') }}" required autocomplete="experience" autofocus>
							 @error('experience')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                             @enderror
						</div>
						<div class="col-md-6" style="padding-bottom: 15px;">
							<label for="total_experience" class="form-label" style="font-weight:800;">Total Experience</label>
							<input id="total_experience" type="total_experience" class="form-control @error('total_experience') is-invalid @enderror" name="total_experience" value="{{ old('total_experience') }}" required autocomplete="total_experience" autofocus>
							 @error('total_experience')
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
							<label for="mother_name" class="form-label" style="font-weight:800;">Mother Name</label>
							<input id="mother_name" type="text" class="form-control" name="mother_name" value="{{ old('mother_name') }}" required  >
							@error('mother_name')
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
							<label for="father_name" class="form-label" style="font-weight:800;">Father Name</label>
							<input id="father_name" type="text" name="father_name" class="form-control "  value="{{ old('father_name') }}" required  >
							@error('father_name')
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

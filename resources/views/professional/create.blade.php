@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Professional Information</div>
				@if(session()->has('success'))
					<div class="alert alert-success alert-dismissible fade show">
						<strong>Success!</strong>  {{ session()->get('success') }}
					</div>
				@endif
				@if ($errors->any())
				<div class = "alert alert-danger">
					<ul>
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
					</ul>
				</div>
				@endif
                <div class="card-body">
					<form method="POST" action="{{ route('professional.store') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">First name</label>
                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name" autofocus>

                                @error('first_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
						<div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">Last name</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="mother_name" class="col-md-4 col-form-label text-md-right">Mother name</label>

                            <div class="col-md-6">
                                <input id="mother_name" type="text" class="form-control @error('mother_name') is-invalid @enderror" name="mother_name" value="{{ old('mother_name') }}" required autocomplete="mother_name">

                                @error('mother_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="father_name" class="col-md-4 col-form-label text-md-right">Father name</label>

                            <div class="col-md-6">
                                <input id="father_name" type="text" class="form-control @error('father_name') is-invalid @enderror" name="father_name" value="{{ old('father_name') }}" required autocomplete="father_name">

                                @error('father_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">Address</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address">

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="district" class="col-md-4 col-form-label text-md-right">District</label>
                            <div class="col-md-6">
                                <input id="district" type="text" class="form-control @error('district') is-invalid @enderror" name="district" value="{{ old('district') }}" required autocomplete="district">

                                @error('district')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">State</label>

                            <div class="col-md-6">
                                <select id="state" name="state" class="form-control">
									<option value="Andaman and Nicobar Islands">Andaman and Nicobar Islands</option>
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
                        </div>
                        <div class="form-group row">
                            <label for="zip" class="col-md-4 col-form-label text-md-right">Zipcode</label>
                            <div class="col-md-6">
                                <input id="zip" type="text" class="form-control @error('zip') is-invalid @enderror" name="zip" value="{{ old('zip') }}" required autocomplete="off">

                                @error('zip')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">Professional Type</label>
                            <div class="col-md-6">
                                <select id="type" name="type" class="form-control">
                                	<option value="">Select Professional Type</option>
									<option value="ca"  @if (old('type') === 'ca') selected @endif>CA</option>
									<option value="doctor" @if (old('type') === 'doctor') selected @endif>Doctor</option>
									<option value="engineer" @if (old('type') === 'engineer') selected @endif>Engineer</option>
									<option value="teacher" @if (old('type') === 'teacher') selected @endif>Teacher</option>
									<option value="coach" @if (old('type') === 'coach') selected @endif>Coach</option>
									<option value="trainer" @if (old('type') === 'trainer') selected @endif>Trainer</option>
									<option value="councaltant" @if (old('type') === 'councaltant') selected @endif>Councaltant</option>
									<option value="advocate" @if (old('type') === 'advocate') selected @endif>Advodate</option>
								</select>
                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">Description</label>
                            <div class="col-md-6">
                            	<textarea id="description" rows="4" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Professional Description">{{old('description')}}</textarea>
                       
                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="experience" class="col-md-4 col-form-label text-md-right">Experience if any</label>
                            <div class="col-md-6">
                                <textarea id="experience" rows="4" name="experience" class="form-control @error('experience') is-invalid @enderror" placeholder="Experience detail"></textarea>
                                @error('experience')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
						<div class="card">
							<div class="card-body">
								<h5 class="card-title">Login Information</h5>
								<div class="form-group row">
									<label for="name" class="col-md-4 col-form-label text-md-right">Email</label>
									<div class="col-md-6">
										<input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
										@error('email')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
								</div>
								<div class="form-group row">
									<label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
									<div class="col-md-6">
										<input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" required autocomplete="password" autofocus>
										@error('password')
											<span class="invalid-feedback" role="alert">
												<strong>{{ $message }}</strong>
											</span>
										@enderror
									</div>
									
								</div>
								<div class="form-group row">
									<label for="name" class="col-md-4 col-form-label text-md-right">Confirm Password</label>
									<div class="col-md-6">
										<input id="password-confirm" type="password" class="form-control " name="password_confirmation" value="{{ old('password-confirm') }}" required autocomplete="password" >
										
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
						</div>
						<div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-6">
                                <button type="submit" class="btn btn-primary float-right">
                                    Save Inforamtion
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

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Company Information</div>
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
                    <form method="POST" action="{{ route('company.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Company Full Name</label>

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
                            <label for="address" class="col-md-4 col-form-label text-md-right">Company Address</label>

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
                            <label for="email" class="col-md-4 col-form-label text-md-right">Company Email</label>

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
                            <label for="type" class="col-md-4 col-form-label text-md-right">Company Type</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}" required autocomplete="type">

                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="catalog_first" class="col-md-4 col-form-label text-md-right">Product Catalog 1</label>

                            <div class="col-md-6">
                                <input class="form-control-file" id="catalog_first" name="catalog_first"  type="file">

                            </div>
                        </div>
						<div class="form-group row">
                            <label for="catalog_second" class="col-md-4 col-form-label text-md-right">Product Catalog 2</label>

                            <div class="col-md-6">
                                <input class="form-control-file" id="catalog_second" name="catalog_second"  type="file">

                            </div>
                        </div>
						<div class="form-group row">
                            <label for="catalog_third" class="col-md-4 col-form-label text-md-right">Product Catalog 3</label>

                            <div class="col-md-6">
                                <input class="form-control-file" id="catalog_third" name="catalog_third" type="file">

                            </div>
                        </div>
						<div class="form-group row">
                            <label for="catalog_four" class="col-md-4 col-form-label text-md-right">Product Catalog 4</label>

                            <div class="col-md-6">
                                <input class="form-control-file" id="catalog_four" name="catalog_four" type="file">

                            </div>
                        </div>
						<div class="form-group row">
                            <label for="catalog_five" class="col-md-4 col-form-label text-md-right">Product Catalog 5</label>

                            <div class="col-md-6">
                                <input class="form-control-file" id="catalog_five" name="catalog_five"  type="file">

                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Save
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

{{-- resources/views/adminlte/user/dashboard.blade.php --}}

@extends('layouts.user')

@section('pageTitle', 'Dashboard')

@section('content')

<div class="row">
    <div class="col-md-12">
		 @include('partials.flash-messages')
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit User: {{ ($company->name!='')?ucfirst($company->name):'' }}</h3>
            </div>

            {{ Form::model($company, array('route' => array('company.update', $company->id), 'method' => 'PUT', 'class' => 'form-horizontal', 'name' => 'edit_form', 'enctype' => 'multipart/form-data')) }}
                <input type="hidden" value="{{$company->id}}" name="company_id" />
                <div class="box-body">
                    <div class="form-group @error('name') has-error @enderror">
                        <label for="name" class="col-sm-2 control-label">Company Name </label>
                        <div class="col-sm-10">
                            {{ Form::text('name', (old('name')!='')?old('name'):$company->name, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Company Name']) }}
                            @error('name')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('address') has-error @enderror">
                        <label for="address" class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-10">
                            {{ Form::text('address', (old('address')!='')?old('address'):$company->address, ['class' => 'form-control', 'id' => 'address', 'placeholder' => 'Address']) }}
                            @error('address')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('type') has-error @enderror">
                        <label for="type" class="col-sm-2 control-label">Company Type</label>
                        <div class="col-sm-10">
                            {{ Form::text('type', (old('type')!='')?old('type'):$company->type, ['class' => 'form-control', 'id' => 'type', 'placeholder' => 'Company Type']) }}
                            @error('type')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('gst') has-error @enderror">
                        <label for="gst" class="col-sm-2 control-label">GST</label>
                        <div class="col-sm-10">
                            {{ Form::text('gst', (old('gst')!='')?old('gst'):$company->gst, ['class' => 'form-control', 'id' => 'gst', 'placeholder' => 'GST Number']) }}
                            @error('gst')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('district') has-error @enderror">
                        <label for="district" class="col-sm-2 control-label">District</label>
                        <div class="col-sm-10">
                            {{ Form::text('district', (old('district')!='')?old('district'):$company->district, ['class' => 'form-control', 'id' => 'district', 'placeholder' => 'District']) }}
                            @error('district')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                     <div class="form-group @error('zip') has-error @enderror">
                        <label for="zip" class="col-sm-2 control-label">Zipcode</label>
                        <div class="col-sm-10">
                            {{ Form::text('zip', (old('zip')!='')?old('zip'):$company->zip, ['class' => 'form-control', 'id' => 'zip', 'placeholder' => 'Zipcode']) }}
                            @error('zip')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                   {{-- <div class="form-group @error('email') has-error @enderror">
                        <label for="email" class="col-sm-2 control-label">E-mail Address</label>
                        <div class="col-sm-10">
                            {{ Form::email('email', (old('email')!='')?old('email'):$company->email, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']) }}
                            @error('email')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>--}}
                     
                    <div class="form-group @error('state') has-error @enderror">
                        <label for="state" class="col-sm-2 control-label">State</label>
                        <div class="col-sm-10">
                            {{ Form::select('state',  ['Andaman and Nicobar Islands'=>'Andaman and Nicobar Islands', 'Andhra Pradesh'=>'Andhra Pradesh','Arunachal Pradesh'=>'Arunachal Pradesh','Assam'=>'Assam','Bihar'=>'Bihar','Chandigarh'=>'Chandigarh','Chhattisgarh'=>'Chhattisgarh','Dadra and Nagar Haveli'=>'Dadra and Nagar Haveli','Daman and Diu'=>'Daman and Diu','Delhi'=>'Delhi','Goa'=>'Goa','Gujarat'=>'Gujarat','Haryana'=>'Haryana','Himachal Pradesh'=>'Himachal Pradesh','Jammu and Kashmir'=>'Jammu and Kashmir','Jharkhand'=>'Jharkhand','Karnataka'=>'Karnataka','Kerala'=>'Kerala','Ladakh'=>'Ladakh','Lakshadweep'=>'Lakshadweep','Madhya Pradesh'=>'Madhya Pradesh','Maharashtra'=>'Maharashtra','Manipur'=>'Manipur','Meghalaya'=>'Meghalaya','Mizoram'=>'Mizoram','Nagaland'=>'Nagaland','Odisha'=>'Odisha','Puducherry'=>'Puducherry','Punjab'=>'Punjab','Rajasthan'=>'Rajasthan','Sikkim'=>'Sikkim','Tamil Nadu'=>'Tamil Nadu','Telangana'=>'Telangana','Tripura'=>'Tripura','Uttar Pradesh'=>'Uttar Pradesh','Uttarakhand'=>'Uttarakhand','West Bengal'=>'West Bengal'], old('state')!='' ? old('state') : ($company->state), ['class' => 'form-control ', 'id' => 'state', 'placeholder' => 'State', 'autocomplete' => 'off']) }}
                            @error('state')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('catalog_first') has-error @enderror">
                        <label for="catalog_first" class="col-sm-2 control-label">Catalog First</label>
                        <div class="col-sm-10">
                            {{ Form::file('catalog_first', old('catalog_first'), ['class' => 'form-control', 'id' => 'catalog_first', 'placeholder' => 'Catalog First']) }}
                            <p class="help-block">File type: JPEG, BMP, PNG, PDF.</p>
                            @error('catalog_first')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('catalog_second') has-error @enderror">
                        <label for="catalog_second" class="col-sm-2 control-label">Catalog Second</label>
                        <div class="col-sm-10">
                            {{ Form::file('catalog_second', old('catalog_second'), ['class' => 'form-control', 'id' => 'catalog_second', 'placeholder' => 'Catalog Second']) }}
                            <p class="help-block">File type: JPEG, BMP, PNG, PDF.</p>
                            @error('catalog_second')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('catalog_third') has-error @enderror">
                        <label for="catalog_third" class="col-sm-2 control-label">Catalog Third</label>
                        <div class="col-sm-10">
                            {{ Form::file('catalog_third', old('catalog_third'), ['class' => 'form-control', 'id' => 'catalog_third', 'placeholder' => 'Catalog Third']) }}
                            <p class="help-block">File type: JPEG, BMP, PNG, PDF.</p>
                            @error('catalog_third')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('catalog_four') has-error @enderror">
                        <label for="catalog_four" class="col-sm-2 control-label">Catalog Four</label>
                        <div class="col-sm-10">
                            {{ Form::file('catalog_four', old('catalog_four'), ['class' => 'form-control', 'id' => 'catalog_four', 'placeholder' => 'Catalog Four']) }}
                            <p class="help-block">File type: JPEG, BMP, PNG, PDF.</p>
                            @error('catalog_four')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('catalog_five') has-error @enderror">
                        <label for="catalog_five" class="col-sm-2 control-label">Catalog Five</label>
                        <div class="col-sm-10">
                            {{ Form::file('catalog_five', old('catalog_five'), ['class' => 'form-control', 'id' => 'catalog_five', 'placeholder' => 'Catalog Five']) }}
                            <p class="help-block">File type: JPEG, BMP, PNG, PDF.</p>
                            @error('catalog_five')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                </div>

                <div class="box-footer">
                    <a href="{{ url('\company') }}" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                </div>

            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection


@section('header_css')
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('themes/adminlte/bower_components/jvectormap/jquery-jvectormap.css') }}">
@endsection

@section('footer_assets')

    <!-- Sparkline -->
    <script src="{{ asset('themes/adminlte/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap  -->
    <script src="{{ asset('themes/adminlte/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('themes/adminlte/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>

    <!-- ChartJS -->
    <script src="{{ asset('themes/adminlte/bower_components/chart.js/Chart.js') }}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('themes/adminlte/dist/js/pages/dashboard2.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('themes/adminlte/dist/js/demo.js') }}"></script>
<script>
    $(document).ready(function(){
        $(".date_validate" ).datepicker({
            dateFormat: 'dd M, yy',
            //minDate: 0,
            changeMonth: true,
            changeYear: true
        });

    });
</script>
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
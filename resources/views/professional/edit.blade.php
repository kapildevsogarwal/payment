{{-- resources/views/adminlte/user/dashboard.blade.php --}}

@extends('layouts.user')

@section('pageTitle', 'Dashboard')

@section('content')

<div class="row">
    <div class="col-md-12">
        @if($errors->any())
            {!! implode('', $errors->all('<div>:message</div>')) !!}
        @endif
		 @include('partials.flash-messages')
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit User: {{ ($professionalObj->first_name!='')?ucfirst($professionalObj->first_name):'' }}</h3>
            </div>

            {{ Form::model($professionalObj, array('route' => array('professional.update', $professionalObj->id), 'method' => 'PUT', 'class' => 'form-horizontal', 'name' => 'edit_form', 'enctype' => 'multipart/form-data')) }}
                <input type="hidden" value="{{$professionalObj->id}}" name="professional_id" />
                <div class="box-body">
                    <div class="form-group @error('first_name') has-error @enderror">
                        <label for="first_name" class="col-sm-2 control-label">First Name </label>
                        <div class="col-sm-10">
                            {{ Form::text('first_name', (old('first_name')!='')?old('first_name'):$professionalObj->first_name, ['class' => 'form-control', 'id' => 'first_name', 'placeholder' => 'First Name']) }}
                            @error('name')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('last_name') has-error @enderror">
                        <label for="last_name" class="col-sm-2 control-label">Last Name </label>
                        <div class="col-sm-10">
                            {{ Form::text('last_name', (old('last_name')!='')?old('last_name'):$professionalObj->last_name, ['class' => 'form-control', 'id' => 'last_name', 'placeholder' => 'Last Name']) }}
                            @error('last_name')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('mother_name') has-error @enderror">
                        <label for="mother_name" class="col-sm-2 control-label">Mother Name </label>
                        <div class="col-sm-10">
                            {{ Form::text('mother_name', (old('mother_name')!='')?old('mother_name'):$professionalObj->mother_name, ['class' => 'form-control', 'id' => 'mother_name', 'placeholder' => 'Mother Name']) }}
                            @error('mother_name')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                     <div class="form-group @error('father_name') has-error @enderror">
                        <label for="father_name" class="col-sm-2 control-label">Father Name </label>
                        <div class="col-sm-10">
                            {{ Form::text('father_name', (old('father_name')!='')?old('father_name'):$professionalObj->father_name, ['class' => 'form-control', 'id' => 'father_name', 'placeholder' => 'Father Name']) }}
                            @error('father_name')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('type') has-error @enderror">
                        <label for="zip" class="col-sm-2 control-label">Professional Type</label>
                        <div class="col-sm-10">
                            {{ Form::select('type',  ['ca'=>'CA', 'doctor'=>'Doctor','engineer'=>'Engineer','teacher'=>'Teacher','coach'=>'Coach','trainer'=>'Trainer','councaltant'=>'Councaltant','advocate'=>'Advocate'], old('type')!='' ? old('type') : ($professionalObj->type), ['class' => 'form-control ', 'id' => 'type', 'placeholder' => 'Professional Type', 'autocomplete' => 'off']) }}
                            @error('type')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('description') has-error @enderror">
                        <label for="description" class="col-sm-2 control-label">Description</label>
                        <div class="col-sm-10">
                            {{ Form::text('description', (old('description')!='')?old('description'):$professionalObj->description, ['class' => 'form-control', 'id' => 'description', 'placeholder' => 'Description']) }}
                            @error('description')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('experience') has-error @enderror">
                        <label for="experience" class="col-sm-2 control-label">Experience</label>
                        <div class="col-sm-10">
                            {{ Form::text('experience', (old('experience')!='')?old('experience'):$professionalObj->experience, ['class' => 'form-control', 'id' => 'experience', 'placeholder' => 'Experience']) }}
                            @error('experience')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('address') has-error @enderror">
                        <label for="address" class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-10">
                            {{ Form::text('address', (old('address')!='')?old('address'):$professionalObj->address, ['class' => 'form-control', 'id' => 'address', 'placeholder' => 'Address']) }}
                            @error('address')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('district') has-error @enderror">
                        <label for="district" class="col-sm-2 control-label">District</label>
                        <div class="col-sm-10">
                            {{ Form::text('district', (old('district')!='')?old('district'):$professionalObj->district, ['class' => 'form-control', 'id' => 'district', 'placeholder' => 'District']) }}
                            @error('district')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('state') has-error @enderror">
                        <label for="district" class="col-sm-2 control-label">State</label>
                        <div class="col-sm-10">
                            {{ Form::select('state',  ['Andaman and Nicobar Islands'=>'Andaman and Nicobar Islands', 'Andhra Pradesh'=>'Andhra Pradesh','Arunachal Pradesh'=>'Arunachal Pradesh','Assam'=>'Assam','Bihar'=>'Bihar','Chandigarh'=>'Chandigarh','Chhattisgarh'=>'Chhattisgarh','Dadra and Nagar Haveli'=>'Dadra and Nagar Haveli','Daman and Diu'=>'Daman and Diu','Delhi'=>'Delhi','Goa'=>'Goa','Gujarat'=>'Gujarat','Haryana'=>'Haryana','Himachal Pradesh'=>'Himachal Pradesh','Jammu and Kashmir'=>'Jammu and Kashmir','Jharkhand'=>'Jharkhand','Karnataka'=>'Karnataka','Kerala'=>'Kerala','Ladakh'=>'Ladakh','Lakshadweep'=>'Lakshadweep','Madhya Pradesh'=>'Madhya Pradesh','Maharashtra'=>'Maharashtra','Manipur'=>'Manipur','Meghalaya'=>'Meghalaya','Mizoram'=>'Mizoram','Nagaland'=>'Nagaland','Odisha'=>'Odisha','Puducherry'=>'Puducherry','Punjab'=>'Punjab','Rajasthan'=>'Rajasthan','Sikkim'=>'Sikkim','Tamil Nadu'=>'Tamil Nadu','Telangana'=>'Telangana','Tripura'=>'Tripura','Uttar Pradesh'=>'Uttar Pradesh','Uttarakhand'=>'Uttarakhand','West Bengal'=>'West Bengal'], old('state')!='' ? old('state') : ($professionalObj->state), ['class' => 'form-control ', 'id' => 'state', 'placeholder' => 'State', 'autocomplete' => 'off']) }}
                            @error('state')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                     <div class="form-group @error('zip') has-error @enderror">
                        <label for="zip" class="col-sm-2 control-label">Zipcode</label>
                        <div class="col-sm-10">
                            {{ Form::text('zip', (old('zip')!='')?old('zip'):$professionalObj->zip, ['class' => 'form-control', 'id' => 'zip', 'placeholder' => 'Zipcode']) }}
                            @error('zip')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    
                </div>

                <div class="box-footer">
                    <a href="{{ url('profile') }}" class="btn btn-default">Cancel</a>
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
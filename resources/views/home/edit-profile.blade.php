{{-- resources/views/adminlte/user/dashboard.blade.php --}}

@extends('layouts.user')

@section('pageTitle', 'Dashboard')

@section('content')

<div class="row">
    <div class="col-md-12">
		 @include('partials.flash-messages')
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit User: {{ ($user->name!='')?ucfirst($user->name):'' }}</h3>
            </div>

            {{ Form::model($user, array('route' => array('home.update', $user->id), 'method' => 'PUT', 'class' => 'form-horizontal', 'name' => 'add_form', 'enctype' => 'multipart/form-data')) }}
                <input type="hidden" value="{{$user->user_type}}" name="user-type" />
                <input type="hidden" value="{{$user->id}}" name="user_id" />
                <div class="box-body">

                    <div class="form-group @error('name') has-error @enderror">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            {{ Form::text('name', (old('name')!='')?old('name'):$user->name, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Name']) }}
                            @error('name')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('first_name') has-error @enderror">
                        <label for="name" class="col-sm-2 control-label">First name</label>
                        <div class="col-sm-10">
                            {{ Form::text('first_name', (old('first_name')!='')?old('first_name'):$user->first_name, ['class' => 'form-control', 'id' => 'first_name', 'placeholder' => 'First Name']) }}
                            @error('first_name')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('last_name') has-error @enderror">
                        <label for="name" class="col-sm-2 control-label">Last name</label>
                        <div class="col-sm-10">
                            {{ Form::text('last_name', (old('last_name')!='')?old('last_name'):$user->last_name, ['class' => 'form-control', 'id' => 'last_name', 'placeholder' => 'Last Name']) }}
                            @error('last_name')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                   {{-- <div class="form-group @error('email') has-error @enderror">
                        <label for="email" class="col-sm-2 control-label">E-mail Address</label>
                        <div class="col-sm-10">
                            {{ Form::email('email', (old('email')!='')?old('email'):$user->email, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']) }}
                            @error('email')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>--}}
                     <div class="form-group @error('district') has-error @enderror">
                        <label for="district" class="col-sm-2 control-label">District</label>
                        <div class="col-sm-10">
                            {{ Form::text('district', (old('district')!='')?old('district'):$user->district, ['class' => 'form-control', 'id' => 'district', 'placeholder' => 'District']) }}
                            @error('district')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('state') has-error @enderror">
                        <label for="state" class="col-sm-2 control-label">State</label>
                        <div class="col-sm-10">
                            {{ Form::select('state',  ['Andaman and Nicobar Islandsform-control'=>'Andaman and Nicobar Islandsform-control', 'Andhra Pradesh'=>'Andhra Pradesh','Arunachal Pradesh'=>'Arunachal Pradesh','Assam'=>'Assam','Bihar'=>'Bihar','Chandigarh'=>'Chandigarh','Chhattisgarh'=>'Chhattisgarh','Dadra and Nagar Haveli'=>'Dadra and Nagar Haveli','Daman and Diu'=>'Daman and Diu','Delhi'=>'Delhi','Goa'=>'Goa','Gujarat'=>'Gujarat','Haryana'=>'Haryana','Himachal Pradesh'=>'Himachal Pradesh','Jammu and Kashmir'=>'Jammu and Kashmir','Jharkhand'=>'Jharkhand','Karnataka'=>'Karnataka','Kerala'=>'Kerala','Ladakh'=>'Ladakh','Lakshadweep'=>'Lakshadweep','Madhya Pradesh'=>'Madhya Pradesh','Maharashtra'=>'Maharashtra','Manipur'=>'Manipur','Meghalaya'=>'Meghalaya','Mizoram'=>'Mizoram','Nagaland'=>'Nagaland','Odisha'=>'Odisha','Puducherry'=>'Puducherry','Punjab'=>'Punjab','Rajasthan'=>'Rajasthan','Sikkim'=>'Sikkim','Tamil Nadu'=>'Tamil Nadu','Telangana'=>'Telangana','Tripura'=>'Tripura','Uttar Pradesh'=>'Uttar Pradesh','Uttarakhand'=>'Uttarakhand','West Bengal'=>'West Bengal'], old('state')!='' ? old('state') : ($user->state), ['class' => 'form-control ', 'id' => 'state', 'placeholder' => 'State', 'autocomplete' => 'off']) }}
                            @error('state')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('zipcode') has-error @enderror">
                        <label for="zipcode" class="col-sm-2 control-label">Zipcode</label>
                        <div class="col-sm-10">
                            {{ Form::text('zipcode', (old('zipcode')!='')?old('zipcode'):$user->zipcode, ['class' => 'form-control', 'id' => 'zipcode', 'placeholder' => 'Zipcode']) }}
                            @error('zipcode')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('address') has-error @enderror">
                        <label for="address" class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-10">
                            {{ Form::text('address', (old('address')!='')?old('address'):$user->address, ['class' => 'form-control', 'id' => 'address', 'placeholder' => 'Address']) }}
                            @error('address')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('experience') has-error @enderror">
                        <label for="experience" class="col-sm-2 control-label">Experience</label>
                        <div class="col-sm-10">

                             {{ Form::textarea('experience', (old('experience')!='')?old('experience'):$user->experience, ['class' => 'form-control', 'rows' => '4', 'id' => 'experience', 'placeholder' => 'Share your working experience']) }}

                            @error('experience')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('total_experience') has-error @enderror">
                        <label for="total_experience" class="col-sm-2 control-label">Total Experience</label>
                        <div class="col-sm-10">
                            {{ Form::text('total_experience', (old('total_experience')!='')?old('total_experience'):$user->total_experience, ['class' => 'form-control', 'id' => 'total_experience', 'placeholder' => 'Total Experience In Years']) }}
                            @error('total_experience')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('dob') has-error @enderror">
                        <label for="dob" class="col-sm-2 control-label">Date Of Birth</label>
                        <div class="col-sm-10">
                            {{ Form::text('dob', (old('dob')!='')?old('dob'):date('d M, Y', strtotime($user->dob)), ['class' => 'form-control date_validate', 'id' => 'dob', 'placeholder' => 'Date of birth']) }}
                            @error('dob')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('user_photo') has-error @enderror">
                            <label for="file" class="col-sm-2 control-label">User Photo</label>
                            <div class="col-sm-10">
                                {{ Form::file('user_photo', old('user_photo'), ['class' => 'form-control', 'id' => 'user_photo', 'placeholder' => 'User Photo']) }}
                                <p class="help-block">File type: JPEG, BMP, PNG, PDF.</p>
                                @error('user_photo')
                                    <span class="help-block" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                    </div>
                    <div class="form-group @error('mother_name') has-error @enderror">
                        <label for="mother_name" class="col-sm-2 control-label">Mother Name</label>
                        <div class="col-sm-10">
                            {{ Form::text('mother_name', (old('mother_name')!='')?old('mother_name'):$user->mother_name, ['class' => 'form-control', 'id' => 'experience', 'placeholder' => 'Experience']) }}
                            @error('mother_name')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('father_name') has-error @enderror">
                        <label for="father_name" class="col-sm-2 control-label">Father Name</label>
                        <div class="col-sm-10">
                            {{ Form::text('father_name', (old('father_name')!='')?old('father_name'):$user->father_name, ['class' => 'form-control', 'id' => 'father_name', 'placeholder' => 'Father Name']) }}
                            @error('father_name')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                     <div class="form-group @error('aadhar_card') has-error @enderror">
                            <label for="aadhar_card" class="col-sm-2 control-label">Aadhar Card Photo</label>
                            <div class="col-sm-10">
                                {{ Form::file('aadhar_card', old('aadhar_card'), ['class' => 'form-control', 'id' => 'aadhar_card', 'placeholder' => 'Aadhar Card Photo']) }}
                                <p class="help-block">File type: JPEG, BMP, PNG, PDF.</p>
                                @error('aadhar_card')
                                    <span class="help-block" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                    </div>
                    <div class="form-group @error('aadhar_card_back') has-error @enderror">
                            <label for="aadhar_card_back" class="col-sm-2 control-label">Aadhar Card Back Photo</label>
                            <div class="col-sm-10">
                                {{ Form::file('aadhar_card_back', old('aadhar_card_back'), ['class' => 'form-control', 'id' => 'aadhar_card_back', 'placeholder' => 'Aadhar Card Back Photo']) }}
                                <p class="help-block">File type: JPEG, BMP, PNG, PDF.</p>
                                @error('aadhar_card_back')
                                    <span class="help-block" role="alert">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                    </div>
                    <div class="form-group @error('tenth_board_name') has-error @enderror">
                        <label for="tenth_board_name" class="col-sm-2 control-label">Tenth Board Name</label>
                        <div class="col-sm-10">
                            {{ Form::text('tenth_board_name', (old('tenth_board_name')!='')?old('tenth_board_name'):$user->tenth_board_name, ['class' => 'form-control', 'id' => 'tenth_board_name', 'placeholder' => 'Tenth Board Name']) }}
                            @error('tenth_board_name')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('tenth_year_name') has-error @enderror">
                        <label for="tenth_year_name" class="col-sm-2 control-label">10th Passing Year</label>
                        <div class="col-sm-10">
                            {{ Form::text('tenth_year_name', (old('tenth_year_name')!='')?old('tenth_year_name'):$user->tenth_year_name, ['class' => 'form-control', 'id' => 'tenth_year_name', 'placeholder' => 'Tenth Year Name']) }}
                            @error('tenth_year_name')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('tenth_percentage') has-error @enderror">
                        <label for="tenth_percentage" class="col-sm-2 control-label">Tenth Percentage %</label>
                        <div class="col-sm-10">
                            {{ Form::text('tenth_percentage', (old('tenth_percentage')!='')?old('tenth_percentage'):$user->tenth_percentage, ['class' => 'form-control', 'id' => 'tenth_percentage', 'placeholder' => 'Tenth Percentage']) }}
                            @error('tenth_percentage')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('twelth_board_name') has-error @enderror">
                        <label for="twelth_board_name" class="col-sm-2 control-label">12th Board Name</label>
                        <div class="col-sm-10">
                            {{ Form::text('twelth_board_name', (old('twelth_board_name')!='')?old('twelth_board_name'):$user->twelth_board_name, ['class' => 'form-control', 'id' => 'twelth_board_name', 'placeholder' => 'Twelth  Board Name']) }}
                            @error('twelth_board_name')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('twelth_year_name') has-error @enderror">
                        <label for="twelth_year_name" class="col-sm-2 control-label">12th Passing Year</label>
                        <div class="col-sm-10">
                            {{ Form::text('twelth_year_name', (old('twelth_year_name')!='')?old('twelth_year_name'):$user->twelth_year_name, ['class' => 'form-control', 'id' => 'twelth_year_name', 'placeholder' => 'Twelth Year Name']) }}
                            @error('twelth_year_name')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('twelth_percentage') has-error @enderror">
                        <label for="twelth_percentage" class="col-sm-2 control-label">12th Percentage %</label>
                        <div class="col-sm-10">
                            {{ Form::text('twelth_percentage', (old('twelth_percentage')!='')?old('twelth_percentage'):$user->twelth_percentage, ['class' => 'form-control', 'id' => 'twelth_percentage', 'placeholder' => 'Twelth Percentage']) }}
                            @error('twelth_percentage')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('degree_diploma') has-error @enderror">
                        <label for="degree_diploma" class="col-sm-2 control-label">Degree Diploma</label>
                        <div class="col-sm-10">
                            {{ Form::text('degree_diploma', (old('degree_diploma')!='')?old('degree_diploma'):$user->degree_diploma, ['class' => 'form-control', 'id' => 'degree_diploma', 'placeholder' => 'Degree Diploma']) }}
                            @error('degree_diploma')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('degree_diploma_year') has-error @enderror">
                        <label for="degree_diploma_year" class="col-sm-2 control-label">Degree Diploma Year</label>
                        <div class="col-sm-10">
                            {{ Form::text('degree_diploma_year', (old('degree_diploma_year')!='')?old('degree_diploma_year'):$user->degree_diploma_year, ['class' => 'form-control', 'id' => 'degree_diploma_year', 'placeholder' => 'degree_diploma_year']) }}
                            @error('degree_diploma_year')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group @error('degree_diploma_percentage') has-error @enderror">
                        <label for="degree_diploma_percentage" class="col-sm-2 control-label">Degree Diploma %</label>
                        <div class="col-sm-10">
                            {{ Form::text('degree_diploma_percentage', (old('degree_diploma_percentage')!='')?old('degree_diploma_percentage'):$user->degree_diploma_percentage, ['class' => 'form-control', 'id' => 'degree_diploma_year', 'placeholder' => 'degree_diploma_percentage']) }}
                            @error('degree_diploma_percentage')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="box-footer">
                    <a href="{{ url('\home') }}" class="btn btn-default">Cancel</a>
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
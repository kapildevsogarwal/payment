{{-- resources/views/adminlte/roles/create.blade.php --}}
@extends('layouts.user')

@section('pageTitle', 'Create Party')

@section('content')

@can('List Party')
    <div class="row">
        <div class="col-xs-12 mb-2">
            <a href="{{ route('party.index') }}" class="btn btn-primary pull-right"><i class="fa fa-list mr-1"></i>List Party</a>
        </div>
    </div>
@endcan

<div class="row">
    <div class="col-md-12">  
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Create Party</h3>
            </div>
            
            {{ Form::open(['route' => 'party.store', 'class' => 'form-horizontal', 'name' => 'add_form']) }}
                <div class="box-body">

                    <div class="form-group @error('name') has-error @enderror">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            {{ Form::text('name', old('name'), ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Name']) }}
                            @error('name')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group @error('email') has-error @enderror">
                        <label for="email" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            {{ Form::text('email', old('email'), ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']) }}
                            @error('email')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
					<div class="form-group @error('address') has-error @enderror">
                        <label for="address" class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-10">
                            {{ Form::text('address', old('address'), ['class' => 'form-control', 'id' => 'address', 'placeholder' => 'Address']) }}
                            @error('address')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
					<div class="form-group @error('gst_number') has-error @enderror">
                        <label for="gst_number" class="col-sm-2 control-label">GST Number</label>
                        <div class="col-sm-10">
                            {{ Form::text('gst_number', old('gst_number'), ['class' => 'form-control', 'id' => 'gst_number', 'placeholder' => 'GST Number']) }}
                            @error('gst_number')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                </div>
                
                <div class="box-footer">
                    <a href="{{ route('party.index') }}" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                </div>
                
            {{ Form::close() }}
        </div>
    </div>
</div>


{{-- <div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-key'></i> Add Role</h1>
    <hr>

    {{ Form::open(array('url' => 'roles')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', null, array('class' => 'form-control')) }}
    </div>

    <h5><b>Assign Permissions</b></h5>

    <div class='form-group'>
        @foreach ($permissions as $permission)
            {{ Form::checkbox('permissions[]',  $permission->id ) }}
            {{ Form::label($permission->name, ucfirst($permission->name)) }}<br>
        @endforeach
    </div>

    {{ Form::submit('Add', array('class' => 'btn btn-primary')) }}

    {{ Form::close() }}

</div> --}}

@endsection


@section('footer_assets')
    <script>
        $(document).ready(function(){

            $('form[name=add_form]').submit(function(){
                $('.full-page-loader').show();
            });
        });
    </script>
    
@endsection
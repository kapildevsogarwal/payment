{{-- resources/views/adminlte/users/create.blade.php --}}
@extends('layouts.user')

@section('pageTitle', 'Create User')

@section('content')


    <div class="row">
        <div class="col-xs-12 mb-2">
            <a href="{{ route('users.index') }}" class="btn btn-primary pull-right"><i class="fa fa-list mr-1"></i>List Users</a>
        </div>
    </div>


<div class="row">
    <div class="col-md-12">  
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Create User</h3>
            </div>
            
            {{ Form::open(['route' => 'users.store', 'class' => 'form-horizontal', 'name' => 'add_form']) }}
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
                            {{ Form::email('email', old('email'), ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']) }}
                            @error('email')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <!-- <div class="form-group @error('roles') has-error @enderror">
                        <label for="roles" class="col-sm-2 control-label">Roles</label>
                        <div class="col-sm-10">

                            @foreach ($roles as $role)
                                <div class="checkbox">
                                    <label>{{ Form::checkbox('roles[]',  $role->id ) }} {{ ucfirst($role->name) }}</label>
                                </div>
                            @endforeach

                            @error('roles')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div> -->

                    <div class="form-group @error('roles') has-error @enderror">
                        <label for="roles" class="col-sm-2 control-label">Roles</label>
                        <div class="col-sm-10">
                        <input type="hidden" value="4" id="rolval" name="roles" class="hidroles">
                            <select name="roles" form="carform" class="form-control role">
                                @foreach ($roles as $role)
                                    @if(old('roles')!='')
                                        <option value="{{ $role->id }}" @if($role->id == old('roles')) selected @endif >{{ $role->name }}</option>
                                    @else
                                        <option value="{{ $role->id }}" @if($role->id == 4) selected @endif >{{ $role->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('roles')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                  

                    <div class="form-group @error('password') has-error @enderror">
                        <label for="password" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="password" class="form-control" id="password" placeholder="Password" value="{{ old('password') }}">
                            @error('password')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group @error('password_confirmation') has-error @enderror">
                        <label for="password_confirmation" class="col-sm-2 control-label">Confirm Password</label>
                        <div class="col-sm-10">
                            <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Password Confirmation" value="{{ old('password_confirmation') }}">
                            @error('password_confirmation')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                </div>
                
                <div class="box-footer">
                    <a href="{{ route('users.index') }}" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                </div>
                
            {{ Form::close() }}
        </div>
    </div>
</div>


{{-- <div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-user-plus'></i> Add User</h1>
    <hr>

    {{ Form::open(array('url' => 'users')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', '', array('class' => 'form-control')) }}
    </div>

    <div class="form-group">
        {{ Form::label('email', 'Email') }}
        {{ Form::email('email', '', array('class' => 'form-control')) }}
    </div>

    <div class='form-group'>
        @foreach ($roles as $role)
            {{ Form::checkbox('roles[]',  $role->id ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>

        @endforeach
    </div>

    <div class="form-group">
        {{ Form::label('password', 'Password') }}<br>
        {{ Form::password('password', array('class' => 'form-control')) }}

    </div>

    <div class="form-group">
        {{ Form::label('password', 'Confirm Password') }}<br>
        {{ Form::password('password_confirmation', array('class' => 'form-control')) }}

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

            $("select.role").change(function(){
                var selectedrole = $(this).children("option:selected").val();
                $("#rolval").val(selectedrole);
                if(selectedrole != 4){
                    $(".company").hide();
                }else{
                    $(".company").show();
                }
            });

            $("select.company").change(function(){
                var selectedcompany = $(this).children("option:selected").val();
                $("#compval").val(selectedcompany);
            });
        });
    </script>
    
@endsection
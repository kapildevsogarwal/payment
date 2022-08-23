{{-- resources/views/adminlte/users/create.blade.php --}}
@extends('layouts.user')

@section('pageTitle', 'Edit User')

@section('breadcrumb')
    <li class="active"><a href = "{{ route('users.index') }}">Users</a></li>
    <li class="active">{{ $user->name }}</li>
@endsection

@section('content')


    @can('List User')
        <div class="row">
            <div class="col-xs-12 mb-2">
                &nbsp;
            </div>
        </div>
    @endcan




<div class="row">
    <div class="col-md-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit User: {{ $user->name }}</h3>
            </div>

            {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT', 'class' => 'form-horizontal', 'name' => 'add_form', 'enctype' => 'multipart/form-data')) }}
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
				<div class="form-group @error('address') has-error @enderror">
                        <label for="address" class="col-sm-2 control-label">Address</label>
                        <div class="col-sm-10">
                            {{ Form::text('address', old('address'), ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Address']) }}
                            @error('address')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group @error('roles') has-error @enderror">
                        <label for="roles" class="col-sm-2 control-label">Roles</label>
                        <div class="col-sm-10">
                       
                        <input type="hidden" value="{{$user->roles()->pluck('id')->implode(' ')}}" id="rolval" name="roles" class="hidroles">
                            <select name="roles" form="carform" class="form-control role">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" @if($user->roles()->pluck('id')->implode(' ') == $role->id ) selected @endif >{{ $role->name }}</option>
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
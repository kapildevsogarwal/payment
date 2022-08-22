{{-- resources/views/adminlte/permissions/edit.blade.php --}}
@extends('layouts.user')

@section('pageTitle', 'Edit Permission')

@section('content')

@can('List Permission')
<div class="row">
    <div class="col-xs-12 mb-2">
        <a href="{{ route('permissions.index') }}" class="btn btn-primary pull-right"><i class="fa fa-list mr-1"></i>List Permissions</a>
    </div>
</div>
@endcan

<div class="row">
    <div class="col-md-12">  
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Edit Permission: {{$permission->name}}</h3>
            </div>
            
            {{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT', 'class' => 'form-horizontal', 'name' => 'add_form')) }}

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

                    {{-- @if(!$roles->isEmpty())
                        <!-- If no roles exist yet -->
                        <div class="form-group @error('roles') has-error @enderror">
                            <label for="name" class="col-sm-2 control-label">Assign Permission to Roles</label>
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
                        </div>
                    @endif --}}
                    
                </div>
                
                <div class="box-footer">
                    <a href="{{ route('permissions.index') }}" class="btn btn-default">Cancel</a>
                    <button type="submit" class="btn btn-primary pull-right">Submit</button>
                </div>
                
            {{ Form::close() }}
        </div>
    </div>
</div>


{{-- <div class='col-lg-4 col-lg-offset-4'>

    <h1><i class='fa fa-key'></i> Edit {{$permission->name}}</h1>
    <br>
    {{ Form::model($permission, array('route' => array('permissions.update', $permission->id), 'method' => 'PUT')) }}
    {{-- Form model binding to automatically populate our fields with permission data --}}

    {{-- <div class="form-group">
            {{ Form::label('name', 'Permission Name') }}
            {{ Form::text('name', null, array('class' => 'form-control')) }}
        </div>
        <br>
        {{ Form::submit('Edit', array('class' => 'btn btn-primary')) }}
    
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
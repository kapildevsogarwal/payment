{{-- resources/views/adminlte/roles/create.blade.php --}}
@extends('layouts.user')

@section('pageTitle', 'Create Role')

@section('content')

@can('List Role')
    <div class="row">
        <div class="col-xs-12 mb-2">
            <a href="{{ route('roles.index') }}" class="btn btn-primary pull-right"><i class="fa fa-list mr-1"></i>List Roles</a>
        </div>
    </div>
@endcan

<div class="row">
    <div class="col-md-12">  
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Create Role</h3>
            </div>
            
            {{ Form::open(['route' => 'roles.store', 'class' => 'form-horizontal', 'name' => 'add_form']) }}
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

                    <div class="form-group @error('permissions') has-error @enderror">
                        <label for="name" class="col-sm-2 control-label">Assign Permissions</label>
                        <div class="col-sm-10">

                            @foreach ($permissions as $permission)
                                <div class="checkbox">
                                    <label>{{ Form::checkbox('permissions[]',  $permission->id ) }} {{ ucfirst($permission->name) }}</label>
                                </div>
                            @endforeach

                            @error('permissions')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                </div>
                
                <div class="box-footer">
                    <a href="{{ route('roles.index') }}" class="btn btn-default">Cancel</a>
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
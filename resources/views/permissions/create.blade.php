{{-- resources/views/adminlte/permissions/create.blade.php --}}
@extends('layouts.user')

@section('pageTitle', 'Create Permission')

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
                <h3 class="box-title">Create Permission</h3>
            </div>
            
            {{ Form::open(['route' => 'permissions.store', 'class' => 'form-horizontal', 'name' => 'add_form']) }}
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

                    @if(!$roles->isEmpty())
                        {{-- If no roles exist yet --}}
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
                    @endif
                    
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

    <h1><i class='fa fa-key'></i> Add Permission</h1>
    <br>

    {{ Form::open(array('url' => 'permissions')) }}

    <div class="form-group">
        {{ Form::label('name', 'Name') }}
        {{ Form::text('name', '', array('class' => 'form-control')) }}
    </div><br>
    @if(!$roles->isEmpty()) //If no roles exist yet
        <h4>Assign Permission to Roles</h4>

        @foreach ($roles as $role) 
            {{ Form::checkbox('roles[]',  $role->id ) }}
            {{ Form::label($role->name, ucfirst($role->name)) }}<br>

        @endforeach
    @endif
    <br>
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
{{-- resources/views/adminlte/roles/create.blade.php --}}
@extends('layouts.user')

@section('pageTitle', 'Edit Party')

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
                <h3 class="box-title">Edit Party</h3>
            </div>
			  {{ Form::model($party, ['route' => ['party.update', $party->id], 'method'=>'PATCH', 'class' => 'form-horizontal' , 'id'=>'update_form' , 'name' => 'update_form']) }}
			   <input type="hidden" value="{{$party->id}}" name="id" class="hidroles">

                <div class="box-body">

                    <div class="form-group @error('name') has-error @enderror">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            {{ Form::text('name', $party->name, ['class' => 'form-control', 'id' => 'name', 'placeholder' => 'Name']) }}
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
                            {{ Form::text('email', $party->email, ['class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email']) }}
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
                            {{ Form::text('address', $party->address, ['class' => 'form-control', 'id' => 'address', 'placeholder' => 'Address']) }}
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
                            {{ Form::text('gst_number', $party->gst_number, ['class' => 'form-control', 'id' => 'gst_number', 'placeholder' => 'GST Number']) }}
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
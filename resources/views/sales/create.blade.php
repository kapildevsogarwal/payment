{{-- resources/views/adminlte/roles/create.blade.php --}}
@extends('layouts.user')

@section('pageTitle', 'Create Bills')

@section('content')

@can('List Sales')
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
                <h3 class="box-title">Create Bills</h3>
            </div>
            
            {{ Form::open(['route' => 'sales.store', 'class' => 'form-horizontal', 'name' => 'add_form']) }}
				<input type="hidden" value="{{(old('party_id'))?old('party_id'):''}}" id="party_id" name="party_id" />
                <div class="box-body">
                    <div class="form-group @error('invoice_no') has-error @enderror">
                        <label for="invoice_no" class="col-sm-2 control-label">Invoice Number</label>
                        <div class="col-sm-10">
                            {{ Form::text('invoice_no', old('invoice_no'), ['class' => 'form-control', 'id' => 'invoice_no', 'placeholder' => 'Invoice Number']) }}
                            @error('invoice_no')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
					<div class="form-group @error('invoice_date') has-error @enderror">
						<label for="invoice_date" class="col-sm-2 control-label">Invoice  Date</label>
						<div class="col-sm-10">
							{{ Form::text('invoice_date', (old('invoice_date'))?old('invoice_date'):date( \Config::get('constant.date_format') ), ['class' => 'form-control invoice_date', 'id' => 'invoice_date', 'placeholder' => 'Invoice  Date', 'readonly'=>'true']) }}
							@error('invoice_date')
							<span class="help-block" role="alert">
								{{ $message }}
							</span>
							@enderror
						</div>
					</div>
					<div class="form-group {{ $errors->has('party_id') ? 'has-error' :'' }}">
						<label for="party_info" class="col-sm-2 control-label">Select Party</label>
					
						<div class="col-sm-10">
							<select name="party_info" form="party_info" class="form-control party" autocomplete="off" id="party_info">
								<option value="" >Select Party</option>
                                @foreach ($parties as $party)
                                    @if(old('party_id') != '')
                                        <option value="{{ $party->id }}" @if($party->id == old('party_id')) selected @endif >{{ ucfirst($party->name) }}</option>
                                    @else
                                        <option value="{{ $party->id }}" >{{ ucfirst($party->name) }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('party_id')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
						</div>
					</div>
					<div class="form-group ">
						<label for="party_id" class="col-sm-2 control-label"></label>
						<div class="col-sm-10">
							<div class="form-group">
								<div class="col-sm-4"><b>Party Name</b></div>
								<div class="col-sm-4"><b>Party Address</b></div>
								<div class="col-sm-4"><b>Party GST Number</b></div>
							</div>
							<div class="form-group">
								<div class="col-sm-4">
									{{ Form::text('party_name', (old('party_name'))?old('party_name'):'' , ['class' => 'form-control', 'readonly'=>'true', 'id' => 'party_name']) }}
								</div>
								<div class="col-sm-4">
									{{ Form::text('party_address', (old('party_address'))?old('party_address'):'' , ['class' => 'form-control', 'readonly'=>'true', 'id' => 'party_address']) }}
								</div>
								<div class="col-sm-4">
									{{ Form::text('party_gst_number', (old('party_gst_number'))?old('party_gst_number'):'' , ['class' => 'form-control', 'readonly'=>'true', 'id' => 'party_gst_number']) }}
								</div>
							</div>
						</div>
					</div>
					
					<div class="form-group @error('net_amount') has-error @enderror">
						<label for="net_amount" class="col-sm-2 control-label">Net Amount</label>
						<div class="col-sm-10">
							{{ Form::text('net_amount', (old('net_amount'))?old('net_amount'):'' , ['class' => 'form-control allow_decimal', 'id' => 'net_amount', 'placeholder' => 'Net Amount']) }}
							@error('net_amount')
							<span class="help-block" role="alert">
								{{ $message }}
							</span>
							@enderror
						</div>
					</div>
					
					<div class="form-group @error('igst_percent') has-error @enderror">
						<label for="igst_percent" class="col-sm-2 control-label">IGST</label>
						<div class="col-sm-4">
							{{ Form::text('igst_percent', old('igst_percent')!='' ? old('igst_percent') : '', ['class' => 'form-control  allow_decimal', 'id' => 'igst_percent', 'placeholder' => '%', 'autocomplete' => 'off', 'readonly'=>'true']) }}
						</div>
						<label for="igst_total" class="col-sm-1 control-label">IGST Total</label>
						<div class="col-sm-5">
							{{ Form::text('igst_total', old('igst_total')!='' ? old('igst_total') : '', ['class' => 'form-control ', 'id' => 'igst_total', 'placeholder' => '', 'autocomplete' => 'off', 'readonly'=>'true']) }}
						</div>
					</div>
					
					<div class="form-group @error('ca_gst_percent') has-error @enderror">
						<label for="ca_gst_percent" class="col-sm-2 control-label">CAGST</label>
						<div class="col-sm-4">
							{{ Form::text('ca_gst_percent', old('ca_gst_percent')!='' ? old('ca_gst_percent') : '', ['class' => 'form-control  allow_decimal', 'id' => 'ca_gst_percent', 'placeholder' => '%', 'autocomplete' => 'off', 'readonly'=>'true']) }}
						</div>
						<label for="ca_gst_total" class="col-sm-1 control-label">CAGST Total</label>
						<div class="col-sm-5">
							{{ Form::text('ca_gst_total', old('igst_total')!='' ? old('ca_gst_total') : '', ['class' => 'form-control ', 'id' => 'ca_gst_total', 'placeholder' => '', 'autocomplete' => 'off','readonly'=>'true']) }}
						</div>
					</div>
					
					<div class="form-group @error('sgst_percent') has-error @enderror">
						<label for="sgst_percent" class="col-sm-2 control-label">SGST</label>
						<div class="col-sm-4">
							{{ Form::text('sgst_percent', old('sgst_percent')!='' ? old('sgst_percent') : '', ['class' => 'form-control  allow_decimal', 'id' => 'sgst_percent', 'placeholder' => '%', 'autocomplete' => 'off', 'readonly'=>'true']) }}
						</div>
						<label for="sgst_total" class="col-sm-1 control-label">CAGST Total</label>
						<div class="col-sm-5">
							{{ Form::text('sgst_total', old('igst_total')!='' ? old('sgst_total') : '', ['class' => 'form-control ', 'id' => 'sgst_total', 'placeholder' => '', 'autocomplete' => 'off','readonly'=>'true']) }}
						</div>
					</div>
					 <div class="form-group @error('total_amount') has-error @enderror">
                        <label for="total_amount" class="col-sm-2 control-label">Total Amount</label>
                        <div class="col-sm-10">
                            {{ Form::text('total_amount', old('total_amount'), ['class' => 'form-control', 'id' => 'total_amount', 'placeholder' => 'Total Amount', 'readonly'=>'true']) }}
                            @error('total_amount')
                                <span class="help-block" role="alert">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    </div>
                   
                </div>
                
                <div class="box-footer">
                    <a href="{{ route('sales.index') }}" class="btn btn-default">Cancel</a>
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
    @include('sales._footer')
@endsection
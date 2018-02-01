@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@stop

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Add Inventory
	</div>
	<div class="panel-body">
		<form method="post" action="{{ route('inventory.store', $profile->id) }}" enctype="form-data/multipart">
			{{ csrf_field() }}
			<div class="form-group{{ $errors->has('inv_id') ? ' has-error' : '' }}">
				<input type="text" name="inv_id" class="form-control" placeholder="Inventory ID" value="IN001" readonly required>
				@if ($errors->has('inv_id'))
                    <span class="help-block">
                        <strong>{{ $errors->first('inv_id') }}</strong>
                    </span>
                @endif
            </div>
			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
				<input type="text" name="name" class="form-control" placeholder="Name" required autofocus>
				@if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
			<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
				<input type="text" name="price" class="form-control" placeholder="Unit Price" required>
				@if ($errors->has('price'))
                    <span class="help-block">
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('qty') ? ' has-error' : '' }}">
				<input type="text" name="qty" class="form-control" placeholder="Quantity" required>
				@if ($errors->has('qty'))
                    <span class="help-block">
                        <strong>{{ $errors->first('qty') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('vom') ? ' has-error' : '' }}">
            	<select name="vom" class="form-control" required>
            		<option disabled selected value="">Select VoM</option>
            		<option value="kg">kg</option>
            		<option value="grams">grams</option>
            		<option value="pc">pc</option>
            		<option value="ltr">ltr</option>
            	</select>
				@if ($errors->has('vom'))
                    <span class="help-block">
                        <strong>{{ $errors->first('vom') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('date_reorder') ? ' has-error' : '' }}">
				<input type="text" name="date_reorder" class="form-control" placeholder="Date Reordered" id="datepicker" required>
				@if ($errors->has('date_reorder'))
                    <span class="help-block">
                        <strong>{{ $errors->first('date_reorder') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('value') ? ' has-error' : '' }}">
				<input type="text" name="value" class="form-control" placeholder="Value" required>
				@if ($errors->has('value'))
                    <span class="help-block">
                        <strong>{{ $errors->first('value') }}</strong>
                    </span>
                @endif
            </div>
			<button type="submit" class="btn btn-default btn-sm">Add</button>
		</form>
	</div>
</div>
@stop

@section('scripts')
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
	$(document).ready(function() {
		$( "#datepicker" ).datepicker({dateFormat:'M-dd-yy'});
	});
</script>
@stop
@extends('layouts.app')

@section('style')
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
@stop

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Add Item
	</div>
	<div class="panel-body">
		<form method="post" action="{{ route('inventory.store', encrypt($user->id)) }}">
			{{ csrf_field() }}
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
            		<option disabled selected value="">Select Unit</option>
            		<option value="Kilograms">Kilograms</option>
            		<option value="Grams">Grams</option>
            		<option value="Pieces">Pieces</option>
            		<option value="Liters">Liters</option>
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
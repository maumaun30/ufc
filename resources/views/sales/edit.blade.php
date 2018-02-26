@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Edit Data
	</div>
	<div class="panel-body">
		<form method="post" action="{{ route('sales.update', [encrypt($user->id), $sale->id]) }}">
			{{ csrf_field() }}
			{{ method_field('patch') }}
			<div class="form-group{{ $errors->has('cx') ? ' has-error' : '' }}">
				<input type="text" name="cx" class="form-control input-sm" placeholder="Customer Name" value="{{ $sale->cx }}" required autofocus>
				@if ($errors->has('cx'))
                    <span class="help-block">
                        <strong>{{ $errors->first('cx') }}</strong>
                    </span>
                @endif
            </div>
             <div class="form-group{{ $errors->has('items') ? ' has-error' : '' }}">
				<input type="text" name="items" class="form-control input-sm" placeholder="Items" value="{{ $sale->items }}" required>
				@if ($errors->has('items'))
                    <span class="help-block">
                        <strong>{{ $errors->first('items') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
				<input type="text" name="price" class="form-control input-sm" placeholder="Total Price" value="{{ $sale->price }}" required>
				@if ($errors->has('price'))
                    <span class="help-block">
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
                @endif
            </div>
			<button type="submit" class="btn btn-default btn-sm">Update</button>
		</form>
	</div>
</div>
@stop
@extends('layouts.home')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Receipt
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<label>You ordered:</label>
			</div>
		</div>
		@foreach($cart->cartItems as $item)
			<div class="row">
				<div class="col-md-12">
		        	{{ $item->qty }} x {{ $item->item }} = {{ $item->price }}
				</div>
			</div>
    	@endforeach
		<div class="row">
			<div class="col-md-12">
				Total Price: {{ $total }}
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				Your order is now being processed! Please wait for a moment to be served.
			</div>
		</div>
		RATINGS<br>
		SHARE
	</div>
</div>
@stop
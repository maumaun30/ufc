@extends('layouts.home')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Receipt
	</div>
	<div class="panel-body">
		<div class="row">
			@foreach($cart->cartItems as $item)
	        	{{ $item->qty }} {{ $item->item }} {{ $item->price }}<br>
        	@endforeach
		</div>
		<div class="row">
			Total Price: {{ $total }}
		</div>
		RATINGS<br>
		SHARE
	</div>
</div>
@stop
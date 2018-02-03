@extends('layouts.home')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Cart
		<form action="{{ route('place.order', $cart->id) }}" method="post">
			{{ csrf_field() }}
			{{ method_field('patch') }}
			<button type="submit" class="btn btn-default">Place Order</button>
		</form>
		Total Price: {{ $total }}
	</div>
	<div class="panel-body">
		<div class="row">
			@foreach($cart->cartItems as $item)
        	<div class="col-md-4">
	        	<div class="panel panel-default">
	        		<div class="panel-heading">
	        			{{ $item->item }}
	        		</div>
	        		<div class="panel-body">
	        			Ulam Image<br>
	        			{{ $item->price }}<br>
	        		</div>
	        	</div>
        	</div>
        	@endforeach
		</div>		
	</div>
</div>
@stop
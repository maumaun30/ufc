@extends('layouts.home')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-12">
				Your Cart
				<div class="pull-right">
						<b>Table Number: {{ $cart->table_number }}</b>
				</div>	
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">				
				<form action="{{ route('place.order', $cart->id) }}" method="post">
					{{ csrf_field() }}
					{{ method_field('patch') }}
					<a href="{{ url()->previous() }}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i> Menu</a>
					<button type="submit" class="btn btn-success btn-sm pull-right"><i class="fa fa-check"></i> Place Order</button>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">	
				<div class="pull-right">
					Total Price: {{ $total }}		
				</div>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div class="row">
			@if($cart->cartItems->isEmpty())
				<div class="col-md-12 text-center">
					<b>You have no items in cart.</b>
				</div>
			@else
				@foreach($cart->cartItems as $item)
	        	<div class="col-md-2">
		        	<div class="panel panel-default">
		        		<div class="panel-heading text-center">
		        			{{ $item->item }} x {{ $item->qty }}
		        		</div>
		        		<div class="panel-body text-center">
		        			<div class="form-group">
			        			<img src="{{ asset($item->image) }}" class="img-rounded img-thumbnail" style="height: 150px;">
		        			</div>
		        			<div class="form-group">
			        			<label>Price:</label> {{ $item->price }}
		        			</div>
		        			<div class="form-group">
		        				<button class="btn btn-default btn-sm form-control input-sm">Edit Quantity</button>
		        			</div>
		        			<div class="form-group">
		        				<button class="btn btn-danger btn-sm form-control input-sm">Discard</button>
		        			</div>
		        		</div>
		        	</div>
	        	</div>
	        	@endforeach
			@endif
		</div>		
	</div>
</div>
@stop
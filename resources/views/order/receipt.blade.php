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
		<div class="row">
			<div class="col-md-12">
				<label>Leave a Feedback</label>
				<form action="{{ route('feedback.store', Auth::user()->id) }}" method="post">
					{{ csrf_field() }}
					<input type="hidden" name="cx" value="{{ $cart->cx }}">
					<div class="form-group">
						<textarea name="feedback" class="form-control input-sm"></textarea>
					</div>
					<div class="form-group">
						<button class="btn btn-default btn-sm pull-right">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12 text-center">
		<a href="{{ route('create.cart') }}" class="btn btn-default btn-sm">New Order</a>
	</div>
</div>
@stop
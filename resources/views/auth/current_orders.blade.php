@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Orders in Queue
	</div>
	<div class="panel-body">
		<div class="panel-group" id="accordion">
			@foreach($user->cartQueue->where('status', 1) as $cart)
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title">
							<a data-toggle="collapse" data-parent="#accordion" href="#collapse1">{{ $cart->cx }}  {{ $cart->cartItems->sum('price') }}</a>
						</h4>
					</div>
					<div id="collapse1" class="panel-collapse collapse in">
						<div class="panel-body">
							<ul>
								@foreach($cart->cartItems as $item)
									<li>{{ $item->qty }} {{ $item->item }} {{ $item->price }}</li>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
			@endforeach

		</div>
	</div>
</div>
@stop
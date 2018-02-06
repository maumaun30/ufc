@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Orders in Queue
	</div>
	<div class="panel-body">
		@foreach($user->cartQueue->where('status', 1) as $cart)
			<div class="panel-group" id="accordion{{ $cart->id }}">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-12">
								<a data-toggle="collapse" data-parent="#accordion{{ $cart->id }}" href="#collapse{{ $cart->id }}">{{ $cart->cx }}</a>
								<div class="pull-right">
									<label>Total Price:</label> {{ $cart->cartItems->sum('price') }}
									<div class="btn-group">
										<button class="btn btn-success btn-sm" title="Finish"><i class="fa fa-check"></i></button>
										<button class="btn btn-danger btn-sm" title="Discard"><i class="fa fa-times"></i></button>
									</div>
								</div>								
							</div>
						</div>
					</div>
					<div id="collapse{{ $cart->id }}" class="panel-collapse collapse in">
						<div class="panel-body">
							<ul>
								@foreach($cart->cartItems as $item)
									<li>
										{{ $item->qty }} x {{ $item->item }}, <label>Price:</label> {{ $item->price }}
										<div class="btn-group">
											<button class="btn btn-success btn-sm" title="Finish"><i class="fa fa-check"></i></button>
											<button class="btn btn-danger btn-sm" title="Discard"><i class="fa fa-times"></i></button>
										</div>
									</li>
								@endforeach
							</ul>
						</div>
					</div>
				</div>
			</div>
		@endforeach
	</div>
</div>
@stop
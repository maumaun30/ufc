@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Orders in Queue
	</div>
	<div class="panel-body">
		@foreach($user->cartQueue->where('status', '!=', 0) as $cart)
			<div class="panel-group" id="accordion{{ $cart->id }}">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-12">
								<button data-toggle="collapse" data-parent="#accordion{{ $cart->id }}" href="#collapse{{ $cart->id }}" class="btn btn-primary btn-sm">{{ $cart->cx }} <span class="caret"></span></button>
								<div class="pull-right">
									<form action="{{ route('finish.cart', [encrypt($user->id), $cart->id]) }}" method="post">
										{{ csrf_field() }}
										{{ method_field('patch') }}
										@if($cart->status == 2)
											<s>Cart Price: <b>{{ $cart->cartItems->sum('price') }}</b></s>
										@else
											Cart Price: <b>{ $cart->cartItems->sum('price') }}</b>
											<div class="btn-group">
												<button type="submit" class="btn btn-success btn-sm" title="Finish"><i class="fa fa-check"></i></button>
												<a href="#" class="btn btn-danger btn-sm cart-name-btn" title="Discard" data-toggle="modal" data-target="#discardCart" data-name="{{ $cart->cx }}" data-url="{{ route('discard.cart', [encrypt($user->id), $cart->id]) }}"><i class="fa fa-times"></i></a>
											</div>
										@endif
									</form>
								</div>								
							</div>
						</div>
					</div>
					<div id="collapse{{ $cart->id }}" class="panel-collapse collapse in">
						<div class="panel-body">
							<ul>
								@foreach($cart->cartItems as $item)
									@if($item->status == 0)
									@else
										<li>
											<form action="{{ route('finish.order', [encrypt($user->id), $item->id]) }}" method="post">
												{{ csrf_field() }}
												{{ method_field('patch') }}
												@if($item->status == 2)
													<s><b>{{ $item->qty }}</b> x <b>{{ $item->item }}</b>, Price: <b>{{ $item->price }}</b></s>
												@else
													<b>{{ $item->qty }}</b> x <b>{{ $item->item }}</b>, Price: <b>{{ $item->price }}</b>
													<div class="btn-group">
														<button type="submit" class="btn btn-success btn-sm" title="Finish"><i class="fa fa-check"></i></button>
														<a href="#" class="btn btn-danger btn-sm order-name-btn" title="Discard" data-toggle="modal" data-target="#discardOrder" data-name="{{ $item->item }}" data-url="{{ route('discard.order', [encrypt($user->id), $item->id]) }}"><i class="fa fa-times"></i></a>
													</div>
												@endif
											</form>
										</li>
									@endif
								@endforeach
							</ul>
						</div>
					</div>
				</div>
			</div>
		@endforeach
	</div>
</div>

<!-- Modal -->
<div id="discardOrder" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<p>Discard the item, <b class="order-name"></b>?</p>
			</div>
			<div class="modal-footer">
				<form method="post" action="" class="order-url">
					{{ csrf_field() }}
					{{ method_field('patch') }}
					<button type="submit" class="btn btn-danger btn-sm">Yes</button>
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">No</button>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="discardCart" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<p>Discard the cart of, <b class="cart-name"></b>?</p>
			</div>
			<div class="modal-footer">
				<form method="post" action="" class="cart-url">
					{{ csrf_field() }}
					{{ method_field('patch') }}
					<button type="submit" class="btn btn-danger btn-sm">Yes</button>
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">No</button>
				</form>
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

<script>
	$('.order-name-btn').on('click', function(){
		var orderName = $(this).data('name');
		var orderUrl = $(this).data('url');
		$('.order-name').text(orderName);
		$('.order-url').attr('action', orderUrl);
	});

	$('.cart-name-btn').on('click', function(){
		var cartName = $(this).data('name');
		var cartUrl = $(this).data('url');
		$('.cart-name').text(cartName);
		$('.cart-url').attr('action', cartUrl);
	});
</script>
@stop
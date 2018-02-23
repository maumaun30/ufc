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
				<form action="{{ route('place.order', encrypt($cart->id)) }}" method="post">
					{{ csrf_field() }}
					{{ method_field('patch') }}
					<a href="{{ route('order.index', encrypt($cart->id)) }}" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i> Menu</a>
					@if(!$cart->cartItems->isEmpty())
					<button type="submit" class="btn btn-success btn-sm pull-right"><i class="fa fa-check"></i> Place Order</button>
					@endif
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">	
				<div class="pull-right">
					Total Price: {{ $cart->cartItems->sum('price') }}		
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
		        				<form action="" method="post" id="editQtyForm{{ $item->id }}">
		        					{{ csrf_field() }}
		        					{{ method_field('patch') }}
		        					<input type="hidden" name="price" id="editQtyPrice{{ $item->id }}">
		        					<input type="hidden" name="old_qty" id="editOldQty{{ $item->id }}">
			        				<button type="button" class="btn btn-default btn-sm form-control input-sm edit-qty-btn" id="editQtyBtn{{ $item->id }}" data-id="{{ $item->id }}" data-url="{{ route('order.edit.qty', [encrypt($cart->id), $item->id]) }}" data-price="{{ $item->price }}" data-qty="{{ $item->qty }}"><i class="fa fa-edit"></i> Edit Quantity</button>
			        				<select class="form-control input-sm" id="editQtyInput{{ $item->id }}" name="qty"  style="display: none;" onchange="this.form.submit()">
				    					<option disabled selected>Qty</option>
				    					<option value="1">1</option>
				    					<option value="2">2</option>
				    					<option value="3">3</option>
				    					<option value="4">4</option>
				    					<option value="5">5</option>
				    					<option value="6">6</option>
				    					<option value="7">7</option>
				    					<option value="8">8</option>
				    					<option value="9">9</option>
				    					<option value="10">10</option>
				    					<option value="11">11</option>
				    					<option value="12">12</option>
				    				</select>
		        				</form>
		        			</div>
		        			<div class="form-group">
		        				<button class="btn btn-danger btn-sm form-control input-sm item-del-btn" data-toggle="modal" data-target="#delete" data-name="{{ $item->item }}" data-url="{{ route('order.destroy', [encrypt($cart->id), $item->id]) }}" title="Delete"><i class="fa fa-trash"></i> Discard</button>
		        			</div>
		        		</div>
		        	</div>
	        	</div>
	        	@endforeach
			@endif
		</div>		
	</div>
</div>

<!-- Modal -->
<div id="delete" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<p>Discard the item, <b class="item-name"></b>?</p>
			</div>
			<div class="modal-footer">
				<form method="post" action="" class="item-url">
					{{ csrf_field() }}
					{{ method_field('delete') }}
					<button type="submit" class="btn btn-danger btn-sm">Yes</button>
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">No</button>
				</form>
			</div>
		</div>
	</div>
</div>
@stop

@section('scripts')
	<script type="text/javascript">
		$(document).ready(function(){
			$('.edit-qty-btn').on('click', function(){

				var editId = $(this).data('id');

				$(this).hide();
				$('#editQtyInput' + editId).show();

				var editOldQty = $(this).data('qty');
				$('#editOldQty' + editId).val(editOldQty);

				var editPrice = $(this).data('price');
				$('#editQtyPrice' + editId).val(editPrice);

				var editUrl = $(this).data('url');
				$('#editQtyForm' + editId).attr('action', editUrl);
			});

			$('.item-del-btn').on('click', function(){
				var itemName = $(this).data('name');
				var itemUrl = $(this).data('url');
				$('.item-name').text(itemName);
				$('.item-url').attr('action', itemUrl);
			});
		});
	</script>
@stop
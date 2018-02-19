@extends('layouts.home')

@section('content')
<div class="row">
	<div class="col-md-2">
		<div class="panel panel-default">
			<div class="panel-heading">
				Categories
			</div>
			<div class="panel-body">
				<ul class="nav nav-pills nav-stacked">
					<li><a href="{{ route('order.index', $cart->id) }}">All</a></li>
					@foreach($user->profileCategoryMenus as $category)
						<li><a href="{{ route('order.category', [$cart->id, $category->id, $category->name]) }}">{{ $category->name }}</a></li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
	<div class="col-md-10">
		<div class="panel panel-default">
		    <div class="panel-heading">
		    	<div class="row">
		    		<div class="col-md-12">
				    	Menu 
				    	<div class="pull-right">
			    			<b>Table Number: {{ $cart->table_number }}</b>
				    	</div>
		    		</div>
		    	</div>
		    	<div class="row">
		    		<div class="col-md-12">
			    		<button class="btn btn-default btn-sm" data-toggle="modal" data-target="#addons">Add-ons</button>
			    		<div class="pull-right">
							<a href="{{ route('view.cart', $cart->id) }}" class="btn btn-default btn-sm">Cart</a>
			    		</div>
		    		</div>
		    	</div>
		    	<div class="row">
		    		<div class="col-md-12">
		    			<div class="pull-right">
				    		Cart Price: {{ $cart->cartItems->sum('price') }}				
		    			</div>
		    		</div>
		    	</div>
		    </div>

		    <div class="panel-body">
		        <div class="row">
		        	@if($user->profileMenus->isEmpty())
		        		<div class="col-md-12 text-center">
			        		No Menus created yet. =(<br>
			        		<b>PLEASE CONTACT MANAGEMENT FOR ASSISTANCE</b>
		        		</div>
		        	@else
			        	@foreach($user->profileMenus as $menu)
			        	<div class="col-md-2">
				        	<div class="panel panel-default">
				        		<div class="panel-heading text-center">
				        			{{ $menu->name }}
				        		</div>
				        		<div class="panel-body">
				        			<div class="form-group text-center">
					        			<img src="{{ asset($menu->image) }}" class="img-rounded img-thumbnail">	
				        			</div>
				        			<div class="form-group text-center">
					        			<label>Price:</label> {{ $menu->price }}
				        			</div>
				        			<div class="form-group text-center">
					        			<button class="btn btn-default btn-sm form-control order-btn" data-toggle="modal" data-target="#orderModal" data-url="{{ route('order.store', $cart->id) }}" data-cx="{{ $cart->cx }}" data-name="{{ $menu->name }}" data-price="{{ $menu->price }}" data-image="{{ asset($menu->image) }}" data-description="{{ $menu->description }}" >Order</button>
				        			</div>
				        		</div>
				        	</div>
			        	</div>
			        	@endforeach
		        	@endif
		        </div>
		    </div>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="orderModal" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header text-center">
				<span id="orderName1"></span>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form action="" method="post" id="orderUrl">
				<div class="modal-body">
					{{ csrf_field() }}
    				<input type="hidden" name="cx" id="orderCx">
    				<input type="hidden" name="name" id="orderName">
    				<input type="hidden" name="price" id="orderPrice">
    				<input type="hidden" name="image" id="orderImage">
					<div class="form-group text-center">
	        			<img src="" class="img-rounded img-thumbnail" id="orderImage1">	
        			</div>
        			<div class="form-group text-center">
	        			<label>Price:</label> <span id="orderPrice1"></span>
        			</div>
        			<div class="form-group">
        				<p class="text-center" id="orderDescription"></p>
        			</div>
        			<div class="row">
        				<div class="col-md-offset-5 col-md-2">
		    				<select class="form-control input-sm mgb5" name="qty" required>
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
    					</div>
        			</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-default btn-sm form-control input-sm">Add to Cart</button>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="addons" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				Add-ons
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<form action="{{ route('order.store', $cart->id) }}" method="post">
				<div class="modal-body">
					{{ csrf_field() }}
					@if($user->profileAddons->isEmpty())
						No Add-ons created yet.
					@else
						@foreach($user->profileAddons as $addon)
						<div class="row">
							<div class="col-xs-8">
								<div class="checkbox">
									<label><input type="checkbox" name="addon" value="{{ $addon->name }}">{{ $addon->name }}</label>
								</div>
							</div>
							<div class="col-xs-4">
								<div class="checkbox">									
									<select class="form-control input-sm" name="qty" required>
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
								</div>
							</div>
						</div>
						@endforeach
					@endif
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-default btn-sm form-control input-sm">Add to Cart</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		$('.order-btn').on('click', function(){
			var orderUrl = $(this).data('url');
			var orderCx = $(this).data('cx');
			var orderName = $(this).data('name');
			var orderPrice = $(this).data('price');
			var orderImage = $(this).data('image');
			var orderDescription = $(this).data('description');

			$('#orderUrl').val(orderUrl);
			$('#orderCx').val(orderCx);
			$('#orderName').val(orderName);
			$('#orderName1').html(orderName);
			$('#orderPrice').val(orderPrice);
			$('#orderPrice1').html(orderPrice);
			$('#orderImage').val(orderImage);
			$('#orderImage1').attr('src', orderImage);
			$('#orderDescription').html(orderDescription);
		});
	});
</script>
@stop
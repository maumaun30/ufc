@extends('layouts.home')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
    	<div class="row">
    		<div class="col-md-12">
		    	Menu 
	    		<button class="btn btn-default btn-sm">Add-ons</button>
		    	<div class="pull-right">
		    		Cart Price: {{ $cart->cartItems->sum('price') }}
					<a href="{{ route('view.cart', $cart->id) }}" class="btn btn-default btn-sm">Cart</a>
		    	</div>
    		</div>
    	</div>
    </div>

    <div class="panel-body">
        <div class="row">
        	@foreach($menus as $menu)
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
		        			<form action="{{ route('order.store', $cart->id) }}" method="post">
		        				{{ csrf_field() }}
		        				<input type="hidden" name="cx" value="{{ $cart->cx }}">
		        				<input type="hidden" name="name" value="{{ $menu->name }}">
		        				<input type="hidden" name="price" value="{{ $menu->price }}">
		        				<input type="hidden" name="image" value="{{ $menu->image }}">
		        				<select class="form-control input-sm mgb5" name="qty">
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
			        			<button type="submit" class="form-control input-sm btn btn-default btn-sm">Add to Cart</button>
		        			</form>
	        			</div>
	        		</div>
	        	</div>
        	</div>
        	@endforeach
        </div>
    </div>
</div>
@endsection

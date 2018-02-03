@extends('layouts.home')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
    	Menu
		<a href="{{ route('view.cart', $cart->id) }}" class="btn btn-default">Cart</a>
    </div>

    <div class="panel-body">
        <div class="row">
        	@foreach($menus as $menu)
        	<div class="col-md-4">
	        	<div class="panel panel-default">
	        		<div class="panel-heading">
	        			{{ $menu->name }}
	        		</div>
	        		<div class="panel-body">
	        			Ulam Image<br>
	        			{{ $menu->price }}<br>
	        			<form action="{{ route('order.store', $cart->id) }}" method="post">
	        				{{ csrf_field() }}
	        				<input type="hidden" name="cx" value="{{ $cart->cx }}">
	        				<input type="hidden" name="name" value="{{ $menu->name }}">
	        				<input type="hidden" name="price" value="{{ $menu->price }}">
	        				<select class="form-control" name="qty">
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
		        			<button type="submit" class="btn btn-default">Add to Cart</button>
	        			</form>
	        		</div>
	        	</div>
        	</div>
        	@endforeach
        </div>
    </div>
</div>
@endsection

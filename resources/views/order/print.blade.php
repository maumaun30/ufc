<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<div style="width: 300px; padding: 10px;">		
		<center>
			<h3>{{ $user->company }}</h3>
			{{ $user->address }}
		</center>
		<br>
		<br>
		<label>Date: </label> {{ date_format($cart->updated_at, 'M-d-Y') }}<br>
		<label>Time: </label> {{ date_format($cart->updated_at, 'g:i A') }}<br>
		<br>
		<label>Customer Name: </label> {{ $cart->cx }}
		<br>
		<label>Items:</label><br>
		<ul>
		@foreach($cart->cartItems as $item)
			<li >
				<b>{{ $item->qty }}</b> x <b>{{ $item->item }}</b>, Price: <b>{{ $item->price }}</b>
			</li>
		@endforeach
		</ul>
		Total Items: <b>{{ $cart->cartItems->count() }}</b>
		<br>
		Total Price: <b>{{ $cart->cartItems->sum('price') }}</b>
		<br>
		<br>
		<center>
			Thank you for ordering with us!
			<br>
			Please come again!
		</center>
	</div>

<script type="text/javascript">
	// window.onload = function() { window.print(); }
</script>
</body>
</html>
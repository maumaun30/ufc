@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
    	<i class="fa fa-tachometer"></i> Dashboard
    </div>
    <div class="panel-body">
    	<div class="row">
    		<div class="col-md-3">
    			<div class="panel panel-info">
    				<div class="panel-heading">
    					<i class="fa fa-shopping-cart"></i> Orders
    				</div>
    				<div class="panel-body">
    					@if($user->cartQueue->where('status', '!=', 0)->isEmpty())
							No orders yet.
						@else
						@foreach($user->cartQueue->where('status', '!=', 0)->take(3) as $cart)
							<label>{{ $cart->cx }}</label> Price : {{ $cart->total }} Table: {{ $cart->table_number }}
							<ul>
								@foreach($cart->cartItems as $item)
									<li>
										{{ $item->item }} x {{ $item->qty }} = {{ $item->price }}
									</li>
								@endforeach
							</ul>
						@endforeach
						@endif
    				</div>
    			</div>
    		</div>
    		<div class="col-md-3">
    			<div class="panel panel-danger">
    				<div class="panel-heading">
    					<i class="fa fa-money"></i> Sales
    				</div>
    				<div class="panel-body">    					
    					@if($user->profileSales->isEmpty())
    						No Sales yet.
    					@else
							@foreach($user->profileSales as $sale)
								<label>{{ $sale->cx }}</label> Price: {{ $sale->price }}
	    						<ul>
	    							@foreach($items = explode(',', $sale->items) as $item)
										<li>{{ $item }}</li>
									@endforeach
	    						</ul>
							@endforeach
    					@endif
    				</div>
    			</div>
    		</div>
    		<div class="col-md-3">
    			<div class="panel panel-warning">
    				<div class="panel-heading">
    					<i class="fa fa-star"></i> Ratings
    				</div>
    				<div class="panel-body">
    					@if($user->profileRatings->isEmpty())
    						No Ratings yet.
    					@else
    						<ul>
    							@foreach($user->profileRatings as $rating)
    								<li>
    									{{ $rating->cx }}, {{ $rating->score }} stars
    								</li>
    							@endforeach
    						</ul>
    					@endif
    				</div>
    			</div>
    		</div>
    		<div class="col-md-3">
    			<div class="panel panel-success">
    				<div class="panel-heading">
    					<i class="fa fa-book"></i> Feedbacks
    				</div>
    				<div class="panel-body">
    					@if($user->profileFeedbacks->isEmpty())
    						No Feedbacks yet.
    					@else
    						<ul>
    							@foreach($user->profileFeedbacks as $feedback)
    								<li>
    									{{ $feedback->cx }}, {{ $feedback->feedback }}
    								</li>
    							@endforeach
    						</ul>
    					@endif
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>
@endsection

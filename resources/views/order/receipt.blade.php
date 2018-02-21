@extends('layouts.home')

@section('styles')
<style type="text/css">
.clearfix {
  clear:both;
}

a {
  color: tomato;
  text-decoration: none;
}

a:hover {
  color: #2196f3;
}

pre {
display: block;
padding: 9.5px;
margin: 0 0 10px;
font-size: 13px;
line-height: 1.42857143;
color: #333;
word-break: break-all;
word-wrap: break-word;
background-color: #F5F5F5;
border: 1px solid #CCC;
border-radius: 4px;
}

.success-box {
  margin:10px 0;
  padding:10px 10px;
  border:1px solid #eee;
  background:#f9f9f9;
}

.success-box img {
  margin-right:10px;
  display:inline-block;
  vertical-align:top;
}

.success-box > div {
  vertical-align:top;
  display:inline-block;
  color:#888;
}

/* Rating Star Widgets Style */
.rating-stars {
	display: inline;
}

.rating-stars ul {
  list-style-type:none;
  padding:0;
  
  -moz-user-select:none;
  -webkit-user-select:none;
}
.rating-stars ul > li.star {
  display:inline-block;
  
}

/* Idle State of the stars */
.rating-stars ul > li.star > i.fa {
  font-size:2em; /* Change the size of the stars */
  color:#ccc; /* Color on idle state */
}

/* Hover state of the stars */
.rating-stars ul > li.star.hover > i.fa {
  color:#FFCC36;
}

/* Selected state of the stars */
.rating-stars ul > li.star.selected > i.fa {
  color:#FF912C;
}
</style>
@stop

@section('content')
<div class="row" style="margin-bottom: 10px;">
	<div class="col-md-12 text-center">
		<a href="{{ route('create.cart') }}" class="btn btn-default btn-sm form-control input-sm">Click here for New Order</a>
	</div>
</div>
<div class="row">
	<div class="col-md-8">
		<div class="panel panel-default">
			<div class="panel-heading text-center">
				<label>Receipt</label>
			</div>
			<div class="panel-body text-center">
				<div class="row">
					<div class="col-md-12">
						<label>Date: </label> {{ date_format($cart->updated_at, 'M-d-Y') }}<br>
						<label>Time: </label> {{ date_format($cart->updated_at, 'g:i A') }}
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<label>You ordered:</label>
					</div>
				</div>
				@foreach($cart->cartItems as $item)
					<div class="row">
						<div class="col-md-12">
							{{ csrf_field() }}
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
				
			</div>
		</div>		
	</div>
	<div class="col-md-4">
		<div class="panel panel-default">
			<div class="panel-body text-center">
				<div class="row">
					<div class="col-md-12">
						@if(isset($cart->cartRating))
						<div class='success-box'>
							<img alt='tick image' width='32' src='https://i.imgur.com/3C3apOp.png'/>
							<div class='text-message'>
								@if($cart->cartRating->score > 1)
								Thanks! You rated us {{ $cart->cartRating->score }} <i class='fa fa-star fa-fw' style="color: orange; font-size: 1.25em;"></i>
								@else
								Thanks! We will improve ourselves. You rated us {{ $cart->cartRating->score }} <i class='fa fa-star fa-fw' style="color: orange; font-size: 1.25em;"></i>
								@endif
							</div>
						</div>
						@else
						<div class="form-group">
							How will you rate us today?
						</div>
						<div class="form-group">
							<form action="{{ route('rating.store', [Auth::user()->id, encrypt($cart->id)]) }}" method="post" id="ratingForm">
								{{ csrf_field() }}
								<input type="hidden" name="cx1" value="{{ $cart->cx }}">
								<input type="hidden" name="score" id="score">
					        	<section class='rating-widget'>
								<!-- Rating Stars Box -->
									  <div class='rating-stars'>
									    <ul id='stars'>
									      <li class='star' title='Poor' data-value='1'>
									        <i class='fa fa-star fa-fw'></i>
									      </li>
									      <li class='star' title='Fair' data-value='2'>
									        <i class='fa fa-star fa-fw'></i>
									      </li>
									      <li class='star' title='Good' data-value='3'>
									        <i class='fa fa-star fa-fw'></i>
									      </li>
									      <li class='star' title='Excellent' data-value='4'>
									        <i class='fa fa-star fa-fw'></i>
									      </li>
									      <li class='star' title='WOW!!!' data-value='5'>
									        <i class='fa fa-star fa-fw'></i>
									      </li>
									    </ul>
									  </div>
								</section>
							</form>
						</div>
						@endif
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
	</div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){
  
	  /* 1. Visualizing things on Hover - See next part for action on click */
	  $('#stars li').on('mouseover', function(){
	    var onStar = parseInt($(this).data('value'), 10); // The star currently mouse on
	   
	    // Now highlight all the stars that's not after the current hovered star
	    $(this).parent().children('li.star').each(function(e){
	      if (e < onStar) {
	        $(this).addClass('hover');
	      }
	      else {
	        $(this).removeClass('hover');
	      }
	    });
	    
	  }).on('mouseout', function(){
	    $(this).parent().children('li.star').each(function(e){
	      $(this).removeClass('hover');
	    });
	  });
	  
	  
	  /* 2. Action to perform on click */
	  $('#stars li').on('click', function(){
	    var onStar = parseInt($(this).data('value'), 10); // The star currently selected
	    var stars = $(this).parent().children('li.star');
	    
	    for (i = 0; i < stars.length; i++) {
	      $(stars[i]).removeClass('selected');
	    }
	    
	    for (i = 0; i < onStar; i++) {
	      $(stars[i]).addClass('selected');
	    }

	    
	    // JUST RESPONSE (Not needed)
	    var ratingValue = parseInt($('#stars li.selected').last().data('value'), 10);
	    $('#score').val(ratingValue);
	    $('#ratingForm').submit();
	    // var msg = "";
	    // if (ratingValue > 1) {
	    //     msg = "Thanks! You rated us " + ratingValue + " stars.";
	    // }
	    // else {
	    //     msg = "We will improve ourselves. You rated us a " + ratingValue + " star.";
	    // }
	    // responseMessage(msg);
	    
	  });
	  
	  
	});


	// function responseMessage(msg) {
	//   $('.success-box').show();  
	//   $('.success-box div.text-message').html("<span>" + msg + "</span>");
	//   $('.rating-widget').hide();
	// }
</script>
@stop
@extends('layouts.home')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.1.6/css/swiper.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.1.6/css/swiper.min.css">
<style type="text/css">
	.swiper-container {
	    width: 100%;
	    height: 100vh;
	    padding: 0;
	    margin: 0;
	    position: fixed;
	    z-index: 0;
	    top: 0;
	    left: 0;
	    right: 0;
	    bottom: 0;
	}
	.swiper-slide {
		background-size: cover;
		background-repeat: no-repeat, repeat;
        background-attachment: fixed;
        background-position: center;
		height: 100vh;
	}
</style>
@stop

@section('swiper')
@if(Auth::user())
	@if(Auth::user()->profileSwipers->isEmpty())
	@else
	<!-- Slider main container -->
	<div class="swiper-container">
	    <!-- Additional required wrapper -->
	    <div class="swiper-wrapper">
	        <!-- Slides -->
	        @foreach(Auth::user()->profileSwipers as $swiper)
	        <div class="swiper-slide" style="background-image: url({{ asset($swiper->image) }})"></div>
	        @endforeach
	    </div>
	    <!-- If we need pagination -->
	    <div class="swiper-pagination"></div>

	</div>
	@endif
@endif
@stop

@section('content')
<div class="row">
	<div class="col-md-offset-9 col-md-3">
		<div class="panel panel-default">
		    <div class="panel-heading">
		    	<div class="row">
		    		<div class="col-md-12">
						Welcome
						<div class="pull-right">
							<b id="setTableText"></b>
			    			<button class="btn btn-default btn-sm pull-right" id="setTableBtn" data-toggle="modal" data-target="#setTableModal">Set Table</button>
						</div>
		    		</div>
		    	</div>
			</div>

		    <div class="panel-body text-center">
		    	<div id="orderBtn">
		    		<form action="{{ route('post.cart') }}" method="post">
		    			{{ csrf_field() }}
		    			<div class="form-group{{ $errors->has('cx') ? ' has-error' : '' }}">
							<input type="text" name="cx" class="form-control" placeholder="Your Name" required>
							@if ($errors->has('cx'))
			                    <span class="help-block">
			                        <strong>{{ $errors->first('cx') }}</strong>
			                    </span>
			                @endif
			                <input type="hidden" name="table_number" id="tableNumber">
			            </div>
				        <div class="form-group">
			            	<button type="submit" class="btn btn-default btn-sm form-control input-sm">Order Now</button>
			            </div>
		    		</form>
		    	</div>
		    	<div id="orderText">
		        	Table number not yet set. Please contact management.
		        </div>
		    </div>
		</div>
	</div>
</div>

@if(Auth::user())
<div class="row">
	<div class="col-md-offset-9 col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading text-center">
				Our Ratings
			</div>
			<div class="panel-body text-center">
				<div class="mgb5">
					@for ($i = 0; $i < floor(Auth::user()->profileRatings->avg('score')); $i++)
					    <i class="fa fa-star" style="color: orange;"></i>
					@endfor
				</div>
				<label>Score: {{ number_format(Auth::user()->profileRatings->avg('score'), 2, '.', '') }}</label>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-offset-9 col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading text-center">
				Recent Feedbacks
			</div>
			<div class="panel-body">
				@if(Auth::user()->profileFeedbacks->where('accept', 1)->isEmpty())
				<div class="text-center">
					No Feedbacks yet.
				</div>
				@else
				@foreach(Auth::user()->profileFeedbacks->where('accept', 1)->take(3) as $feedback)
				<div class="row mgb5">
					<div class="col-md-12">
						<p class="mgb5">"{{ $feedback->feedback }}"</p>
						<div class="mgb5 text-center">
							@isset(Auth::user()->profileRatings->where('cart_id', $feedback->cart_id)->first()->score)
							@for ($i = 0; $i < Auth::user()->profileRatings->where('cart_id', $feedback->cart_id)->first()->score; $i++)
							    <i class="fa fa-star" style="color: orange;"></i>
							@endfor
							@endisset
						</div>
						<div class="text-muted text-center">
							{{ $feedback->cx }}, {{ date_format($feedback->created_at, 'M-d-Y g:i A') }}
						</div>
					</div>
				</div>
				<hr>
				@endforeach
				@endif
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-offset-9 col-md-3">
		<div class="panel panel-default">
			<div class="panel-heading text-center">
				Contact Us
			</div>
			<div class="panel-body">
				<ul class="list-unstyled">
					<li><a href="{{ route('my_profile.index', [Auth::user()->id, str_slug(Auth::user()->company, '-')]) }}"><i class="fa fa-user"></i> {{ Auth::user()->company }} Profile</a></li>
                    <li><i class="fa fa-address-book"></i> {{ Auth::user()->address }}</li>
                    <li><i class="fa fa-envelope"></i> {{ Auth::user()->email }}</li>
                    <li><i class="fa fa-phone"></i> {{ Auth::user()->contact_number }}</li>
                </ul>
			</div>
		</div>
	</div>
</div>
@endif

<!-- Modal -->
<div id="setTableModal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<label>Set Table Number</label>
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<input type="text" class="form-control input-sm" id="setTableInput">
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm" id="setTableSubmit">Set</button>
				<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">Cancel</button>
			</div>
		</div>

	</div>
</div>
@stop

@section('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.1.6/js/swiper.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.1.6/js/swiper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.1.6/js/swiper.esm.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.1.6/js/swiper.esm.bundle.js"></script>

<script>
	$(document).ready(function(){
		// alert(sessionStorage.getItem("table_number"));
		if (localStorage.getItem("table_number") !== null) {
			$('#orderText').hide();
			$('#setTableBtn').hide();
		    $('#setTableText').html('Table Number: ' + localStorage.getItem("table_number"));
		    $('#tableNumber').val(localStorage.getItem("table_number"));
		}
		else {
			$('#orderBtn').hide();
		}

		$('#setTableSubmit').on('click', function(){
			// Check browser support
			if (typeof(Storage) !== "undefined") {
				var setTableValue = $('#setTableInput').val();
			    // Store
			    localStorage.setItem("table_number", setTableValue);
			    // Retrieve
			    $('#setTableText').html('Table Number: ' + localStorage.getItem("table_number"));
			    $('#tableNumber').val(localStorage.getItem("table_number"));
			    $('#setTableModal').modal('hide');
			    $('#setTableBtn').hide();
			    $('#orderText').hide();
			    $('#orderBtn').show();
			} else {
			    $('#setTableText').html('Sorry, your browser does not support Web Storage...');
			}
		});
	});
</script>

<script>
  var mySwiper = new Swiper ('.swiper-container', {
    // Optional parameters
    direction: 'horizontal',
    loop: true,
    autoplay: {
	    delay: 5000,
	},

    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
    },

  })
  </script>
@stop
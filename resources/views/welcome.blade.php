@extends('layouts.home')

@section('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.1.6/css/swiper.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Swiper/4.1.6/css/swiper.min.css">
<style type="text/css">
	.swiper-container {
	    width: 100%;
	    height: 350px;
	}
</style>
@stop

@section('content')
<div class="row">
	<div class="col-md-9">
		<div class="panel panel-default">
			<div class="panel-body">
				<!-- Slider main container -->
				<div class="swiper-container">
				    <!-- Additional required wrapper -->
				    <div class="swiper-wrapper">
				        <!-- Slides -->
				        <div class="swiper-slide">Slide 1</div>
				        <div class="swiper-slide">Slide 2</div>
				        <div class="swiper-slide">Slide 3</div>
				        ...
				    </div>
				    <!-- If we need pagination -->
				    <div class="swiper-pagination"></div>
				 
				    <!-- If we need navigation buttons -->
				    <div class="swiper-button-prev"></div>
				    <div class="swiper-button-next"></div>

				</div>
			</div>
		</div>
	</div>
	<div class="col-md-3">
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
			        <a href="{{ route('create.cart') }}" class="btn btn-default">Order Now!</a>
		    	</div>
		    	<div id="orderText">
		        	Table number not yet set. Please contact management.
		        </div>
		    </div>
		</div>
	</div>
</div>

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
@endsection


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

    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
    },

    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },

  })
  </script>
@stop
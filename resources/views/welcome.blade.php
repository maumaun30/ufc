@extends('layouts.home')

@section('content')
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

    <div class="panel-body">
        May I have your order please?<br>
        <a href="{{ route('create.cart') }}" class="btn btn-default">Order Now!</a>
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
<script>
	$(document).ready(function(){
		// alert(sessionStorage.getItem("table_number"));
		if (sessionStorage.getItem("table_number") !== null) {
			$('#setTableBtn').hide();
		    $('#setTableText').html('Table Number: ' + sessionStorage.getItem("table_number"));
		}

		$('#setTableSubmit').on('click', function(){
			// Check browser support
			if (typeof(Storage) !== "undefined") {
				var setTableValue = $('#setTableInput').val();
			    // Store
			    sessionStorage.setItem("table_number", setTableValue);
			    // Retrieve
			    $('#setTableText').html('Table Number: ' + sessionStorage.getItem("table_number"));

			    $('#setTableModal').modal('hide');
			    $('#setTableBtn').hide();
			} else {
			    $('#setTableText').html('Sorry, your browser does not support Web Storage...');
			}
		});
	});
</script>
@stop
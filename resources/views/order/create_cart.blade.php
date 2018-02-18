@extends('layouts.home')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-12">
				Cart
				<div class="pull-right">
					<b class="setTableText"></b>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<form action="{{ route('post.cart') }}" method="post">
			{{ csrf_field() }}
			 <div class="form-group{{ $errors->has('cx') ? ' has-error' : '' }}">
				<input type="text" name="cx" class="form-control" placeholder="Your Name" required autofocus>
				@if ($errors->has('cx'))
                    <span class="help-block">
                        <strong>{{ $errors->first('cx') }}</strong>
                    </span>
                @endif
                <input type="hidden" name="table_number" id="tableNumber">
            </div>
            <div class="form-group">
            	<button type="submit" class="btn btn-default">Show Menu</button>
            </div>
		</form>
	</div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
	$(document).ready(function(){
		var tableNumber = localStorage.getItem('table_number');
		$('#tableNumber').val(tableNumber);
		$('#setTableText').html(tableNumber);
	});
</script>
@stop
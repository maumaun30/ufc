@extends('layouts.home')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Cart
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
            </div>
            <div class="form-group">
            	<button type="submit" class="btn btn-default">Show Menu</button>
            </div>
		</form>
	</div>
</div>
@stop
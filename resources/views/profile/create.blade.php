@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Add Profile
	</div>
	<div class="panel-body">
		<form method="post" action="{{ route('profile.store') }}" enctype="form-data/multipart">
			{{ csrf_field() }}
			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
				<input type="text" name="name" class="form-control" placeholder="Company" required autofocus>
				@if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
			<div class="form-group{{ $errors->has('owner') ? ' has-error' : '' }}">
				<input type="text" name="owner" class="form-control" placeholder="Owner" required>
				@if ($errors->has('owner'))
                    <span class="help-block">
                        <strong>{{ $errors->first('owner') }}</strong>
                    </span>
                @endif
            </div>
			<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
				<textarea name="address" class="form-control" placeholder="Address" required></textarea>
				@if ($errors->has('address'))
                    <span class="help-block">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                @endif
            </div>
			<button type="submit" class="btn btn-default btn-sm">Add</button>
		</form>
	</div>
</div>
@stop
@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Edit Profile
	</div>
	<div class="panel-body">
		<form method="post" action="{{ route('profile.update', $profile->id) }}" enctype="form-data/multipart">
			{{ csrf_field() }}
			{{ method_field('patch') }}
			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
				<input type="text" name="name" class="form-control" placeholder="Company" value="{{ $profile->name }}" required autofocus>
				@if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
			<div class="form-group{{ $errors->has('owner') ? ' has-error' : '' }}">
				<input type="text" name="owner" class="form-control" placeholder="Owner" value="{{ $profile->owner }}" required>
				@if ($errors->has('owner'))
                    <span class="help-block">
                        <strong>{{ $errors->first('owner') }}</strong>
                    </span>
                @endif
            </div>
			<div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
				<textarea name="address" class="form-control" placeholder="Address" required>{{ $profile->address }}</textarea>
				@if ($errors->has('address'))
                    <span class="help-block">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                @endif
            </div>
			<button type="submit" class="btn btn-default btn-sm">Update</button>
		</form>
	</div>
</div>
@stop
@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Edit Add-ons Category
	</div>
	<div class="panel-body">
		<form method="post" action="{{ route('addon_category.update', [encrypt($user->id), $addon_category->id]) }}">
			{{ csrf_field() }}
			{{ method_field('patch') }}
			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
				<input type="text" name="name" class="form-control input-sm" placeholder="Name" value="{{ $addon_category->name }}" required autofocus>
				@if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
			<button type="submit" class="btn btn-default btn-sm">Update</button>
		</form>
	</div>
</div>
@stop
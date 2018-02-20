@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Edit Add-ons
	</div>
	<div class="panel-body">
		<form method="post" action="{{ route('addon.update', [encrypt($user->id), $addon->id]) }}">
			{{ csrf_field() }}
			{{ method_field('patch') }}
			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
				<input type="text" name="name" class="form-control" placeholder="Name" value="{{ $addon->name }}" required>
				@if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                <select class="form-control input-sm" name="category">
                    <option selected value="{{ $category->id }}">{{ $category->name }}</option>
                    @foreach($addon_categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('category'))
                    <span class="help-block">
                        <strong>{{ $errors->first('category') }}</strong>
                    </span>
                @endif
            </div>
			<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
				<input type="text" name="price" class="form-control" placeholder="Price" value="{{ $addon->price }}" required>
				@if ($errors->has('price'))
                    <span class="help-block">
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
                @endif
            </div>
			<button type="submit" class="btn btn-default btn-sm">Update</button>
		</form>
	</div>
</div>
@stop
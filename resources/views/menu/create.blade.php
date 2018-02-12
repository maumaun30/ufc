@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Add Menu
	</div>
	<div class="panel-body">
		<form method="post" action="{{ route('menu.store', encrypt($user->id)) }}" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
				<input type="text" name="code" class="form-control input-sm" placeholder="Code" value="{{ old('code') }}" required autofocus>
				@if ($errors->has('code'))
                    <span class="help-block">
                        <strong>{{ $errors->first('code') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                <select class="form-control input-sm" name="category">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
                @if ($errors->has('category'))
                    <span class="help-block">
                        <strong>{{ $errors->first('category') }}</strong>
                    </span>
                @endif
            </div>
			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
				<input type="text" name="name" class="form-control input-sm" placeholder="Name" value="{{ old('name') }}" required>
				@if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
			<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
				<input type="text" name="price" class="form-control input-sm" placeholder="Price" value="{{ old('price') }}" required>
				@if ($errors->has('price'))
                    <span class="help-block">
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
                @endif
            </div>
			<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
				<textarea name="description" class="form-control input-sm" placeholder="Description" required>{{ Request::old('description') }}</textarea>
				@if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
            	<label>Upload Photo</label>
				<input type="file" name="image" class="form-control input-sm">
				@if ($errors->has('image'))
                    <span class="help-block">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label>Featured</label>
                <select name="featured" class="form-control input-sm">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
			<button type="submit" class="btn btn-default btn-sm">Add</button>
		</form>
	</div>
</div>
@stop
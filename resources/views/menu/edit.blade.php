@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Edit Menu
	</div>
	<div class="panel-body">
		<form method="post" action="{{ route('menu.update', [encrypt($user->id), $menu->id]) }}">
			{{ csrf_field() }}
			{{ method_field('patch') }}
			<div class="form-group{{ $errors->has('code') ? ' has-error' : '' }}">
				<input type="text" name="code" class="form-control input-sm" placeholder="Code" value="{{ $menu->code }}" required autofocus>
				@if ($errors->has('code'))
                    <span class="help-block">
                        <strong>{{ $errors->first('code') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('category') ? ' has-error' : '' }}">
                <select class="form-control input-sm" name="category">
                        <option value="{{ $menu->categoryMenu->id }}">{{ $menu->categoryMenu->name }}</option>
                    @foreach($user->profileCategoryMenus as $category)
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
				<input type="text" name="name" class="form-control input-sm" placeholder="Name" value="{{ $menu->name }}" required>
				@if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
			<div class="form-group{{ $errors->has('price') ? ' has-error' : '' }}">
				<input type="text" name="price" class="form-control input-sm" placeholder="Price" value="{{ $menu->price }}" required>
				@if ($errors->has('price'))
                    <span class="help-block">
                        <strong>{{ $errors->first('price') }}</strong>
                    </span>
                @endif
            </div>
			<div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
				<textarea name="description" class="form-control input-sm" placeholder="Description" required>{{ $menu->description }}</textarea>
				@if ($errors->has('description'))
                    <span class="help-block">
                        <strong>{{ $errors->first('description') }}</strong>
                    </span>
                @endif
            </div>
			<button type="submit" class="btn btn-default btn-sm">Update</button>
		</form>
	</div>
</div>
@stop
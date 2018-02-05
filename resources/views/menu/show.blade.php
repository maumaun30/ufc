@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-12">
				Menu
				<div class="pull-right">
					<a href="{{ route('menu.edit', [$user->id, $menu->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<img src="{{ asset($menu->image) }}" class="img-rounded img-thumbnail">								
				</div>
				<form action="{{ route('change.menu.photo', [$user->id, $menu->id]) }}" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
					{{ method_field('patch') }}
		            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
		            	<label>Change Photo</label>
						<input type="file" name="image" class="form-control" onchange="this.form.submit()">
						@if ($errors->has('image'))
		                    <span class="help-block">
		                        <strong>{{ $errors->first('image') }}</strong>
		                    </span>
		                @endif
		            </div>
	            </form>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<form action="{{ route('change.featured', [$user->id, $menu->id]) }}" method="post">
						<label>Featured:</label>
						@if($menu->featured == 1)
							Yes
						@else
							No
						@endif

						{{ csrf_field() }}
						{{ method_field('patch') }}
						<button type="submit" class="btn btn-default btn-sm">Change</button>
					</form>
				</div>
				<div class="form-group">
					<label>Code: </label>
					{{ $menu->code }}								
				</div>
				<div class="form-group">
					<label>Name: </label>
					{{ $menu->name }}								
				</div>
				<div class="form-group">
					<label>Price: </label>
					{{ $menu->price }}
				</div>
				<div class="form-group">
					<label>Description: </label>
					{{ $menu->description }}
				</div>						
			</div>
		</div>
	</div>
</div>
@stop
@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-12">
				Menu
				<div class="pull-right">
					<div class="btn-group">
						<a href="{{ route('menu.create', encrypt($user->id)) }}" class="btn btn-default btn-sm" title="Add Again"><i class="fa fa-plus"></i></a>
						<a href="{{ route('menu.edit', [encrypt($user->id), $menu->id]) }}" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
						<button class="btn btn-danger btn-sm menu-name-btn" data-toggle="modal" data-target="#delete" data-name="{{ $menu->name }}" data-url="{{ route('menu.destroy', [encrypt($user->id), $menu->id]) }}" title="Delete"><i class="fa fa-trash"></i></button>
					</div>
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
				<form action="{{ route('change.menu.photo', [encrypt($user->id), $menu->id]) }}" method="post" enctype="multipart/form-data">
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
					<form action="{{ route('change.featured.menu', [encrypt($user->id), $menu->id]) }}" method="post">
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
					<label>Category: </label>
					{{ $menu->categoryMenu->name }}								
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
				<div class="form-group">
					<label>Created on: </label>
					{{ date_format($menu->created_at, 'M-d-Y g:i A') }}
				</div>							
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="delete" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<p>Delete the menu, <b class="menu-name"></b>?</p>
			</div>
			<div class="modal-footer">
				<form method="post" action="" class="menu-url">
					{{ csrf_field() }}
					{{ method_field('delete') }}
					<button type="submit" class="btn btn-danger">Yes</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
				</form>
			</div>
		</div>

	</div>
</div>
@stop

@section('scripts')
<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>

<script>
	$('.menu-name-btn').on('click', function(){
		var menuName = $(this).data('name');
		var menuUrl = $(this).data('url');
		$('.menu-name').text(menuName);
		$('.menu-url').attr('action', menuUrl);
	});
</script>
@stop
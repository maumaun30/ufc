@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-12">
				Add-ons
				<div class="pull-right">
					<div class="btn-group">
						<a href="{{ route('addon.create', encrypt($user->id)) }}" class="btn btn-default btn-sm" title="Add Again"><i class="fa fa-plus"></i></a>
						<a href="{{ route('addon.edit', [encrypt($user->id), $addon->id]) }}" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
						<button class="btn btn-danger btn-sm addon-name-btn" data-toggle="modal" data-target="#delete" data-name="{{ $addon->name }}" data-url="{{ route('addon.destroy', [encrypt($user->id), $addon->id]) }}" title="Delete"><i class="fa fa-trash"></i></button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<form action="{{ route('change.featured', [encrypt($user->id), $addon->id]) }}" method="post">
						<label>Featured:</label>
						@if($addon->featured == 1)
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
					<label>Name: </label>
					{{ $addon->name }}								
				</div>
				<div class="form-group">
					<label>Price: </label>
					{{ $addon->price }}
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
				<p>Delete the addon, <b class="addon-name"></b>?</p>
			</div>
			<div class="modal-footer">
				<form method="post" action="" class="addon-url">
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
	$('.addon-name-btn').on('click', function(){
		var addonName = $(this).data('name');
		var addonUrl = $(this).data('url');
		$('.addon-name').text(addonName);
		$('.addon-url').attr('action', addonUrl);
	});
</script>
@stop
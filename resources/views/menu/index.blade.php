@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Menu
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<div class="row mgb5">
					<div class="col-md-12">
						<a href="{{ route('menu.create', $user->id) }}" class="btn btn-default btn-sm pull-right">Create</a>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-bordered table-striped table-condensed table-hover">
						<thead>
							<tr>
								<th>Code</th>
								<th>Name</th>
								<th>Price</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							@foreach($user->profileMenus as $menu)
								<tr>
									<td>{{ $menu->code }}</td>
									<td>{{ $menu->name }}</td>
									<td>{{ $menu->price }}</td>
									<td>
										<div class="btn-group">
											<a href="{{ route('menu.show', [$user->id, $menu->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-eye"></i></a>
											<a href="{{ route('menu.edit', [$user->id, $menu->id]) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
											<button type="submit" class="btn btn-danger btn-sm menu-name-btn" data-toggle="modal" data-target="#delete" data-name="{{ $menu->name }}" data-url="{{ route('menu.destroy', [$user->id, $menu->id]) }}"><i class="fa fa-trash"></i></button>
										</div>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
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
@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-12">
				Menu
				<div class="pull-right">
					<a href="{{ route('category.index', encrypt($user->id)) }}" class="btn btn-default btn-sm">Categories</a>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				@if($categories->isEmpty())
					No Categories created yet. =( <a href="{{ route('category.create', encrypt($user->id)) }}">Click here to ADD</a>
				@else
					@if($user->profileMenus->isEmpty())
						No Menus created yet. =( <a href="{{ route('menu.create', encrypt($user->id)) }}">Click here to ADD</a>
					@else
						<div class="row mgb5">
							<div class="col-md-12">
								<a href="{{ route('menu.create', encrypt($user->id)) }}" class="btn btn-default btn-sm pull-right">Add</a>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-condensed table-hover">
								<thead>
									<tr>
										<th>Code</th>
										<th>Category</th>
										<th>Name</th>
										<th>Price</th>
										<th>Featured</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($menus = $user->profileMenus()->paginate(10) as $menu)
										<tr>
											<td>{{ $menu->code }}</td>
											<td>{{ $menu->categoryMenu->name }}</td>
											<td>{{ $menu->name }}</td>
											<td>{{ $menu->price }}</td>
											<td>
												@if($user->profileMenus->isEmpty())
												@else
													@if($menu->featured == 1)
														Yes
													@else
														No
													@endif
												@endif
											</td>
											<td>
												<div class="btn-group">
													<a href="{{ route('menu.show', [encrypt($user->id), $menu->id]) }}" class="btn btn-default btn-sm" title="View More"><i class="fa fa-eye"></i></a>
													@if($user->profileMenus->isEmpty())
													@else
														<button class="btn btn-warning btn-sm menu-featured-btn" data-toggle="modal" data-target="#featured" data-furl="{{ route('change.featured.menu', [encrypt($user->id), $menu->id]) }}" title="@if($menu->featured == 1) Featured @else Not Featured @endif">
															@if($menu->featured == 1)
																<i class="fa fa-star"></i>
															@else
																<i class="fa fa-star-o"></i>
															@endif
														</button>
													@endif
													<a href="{{ route('menu.edit', [encrypt($user->id), $menu->id]) }}" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
													<button class="btn btn-danger btn-sm menu-name-btn" data-toggle="modal" data-target="#delete" data-name="{{ $menu->name }}" data-url="{{ route('menu.destroy', [encrypt($user->id), $menu->id]) }}" title="Delete"><i class="fa fa-trash"></i></button>
												</div>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						{{ $menus->links() }}
					@endif
				@endif
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
					<button type="submit" class="btn btn-danger btn-sm">Yes</button>
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">No</button>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="featured" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				@if($user->profileMenus->isEmpty())
				@else
					@if($menu->featured == 1)
						Remove as Featured?
					@else
						Mark as Featured?
					@endif
				@endif
			</div>
			<div class="modal-footer">
				<form action="" method="post" class="featured-url">
					{{ csrf_field() }}
					{{ method_field('patch') }}
					<button type="submit" class="btn btn-default btn-sm">Yes</button>
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">No</button>
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

	$('.menu-featured-btn').on('click', function(){
		var featuredUrl = $(this).data('furl');
		$('.featured-url').attr('action', featuredUrl);
	});
</script>

@stop
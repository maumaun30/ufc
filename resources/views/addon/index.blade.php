@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-12">
				Add-Ons
				<div class="pull-right">
					<a href="{{ route('addon_category.index', encrypt($user->id)) }}" class="btn btn-default btn-sm">Categories</a>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				@if($addon_categories->isEmpty())
					No Categories created yet. =( <a href="{{ route('addon_category.create', encrypt($user->id)) }}">Click here to ADD</a>
				@else
					@if($user->profileAddons->isEmpty())
						No Add-ons created yet. =( <a href="{{ route('addon.create', encrypt($user->id)) }}">Click here to ADD</a>
					@else
						<div class="row mgb5">
							<div class="col-md-12">
								<a href="{{ route('addon.create', encrypt($user->id)) }}" class="btn btn-default btn-sm pull-right">Add</a>
							</div>
						</div>
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-condensed table-hover">
								<thead>
									<tr>
										<th>Name</th>
										<th>Category</th>
										<th>Price</th>
										<th>Featured</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($user->profileAddons as $addon)
										<tr>
											<td>{{ $addon->name }}</td>
											<td>{{ $addon->categoryAddon->name }}</td>
											<td>{{ $addon->price }}</td>
											<td>
												@if($user->profileAddons->isEmpty())
												@else
													@if($addon->featured == 1)
														Yes
													@else
														No
													@endif
												@endif
											</td>
											<td>
												<div class="btn-group">
													<a href="{{ route('addon.show', [encrypt($user->id), $addon->id]) }}" class="btn btn-default btn-sm" title="View More"><i class="fa fa-eye"></i></a>
													@if($user->profileAddons->isEmpty())
													@else
														<button class="btn btn-warning btn-sm addon-featured-btn" data-toggle="modal" data-target="#featured" data-furl="{{ route('change.featured', [encrypt($user->id), $addon->id]) }}" title="@if($addon->featured == 1) Featured @else Not Featured @endif">
															@if($addon->featured == 1)
																<i class="fa fa-star"></i>
															@else
																<i class="fa fa-star-o"></i>
															@endif
														</button>
													@endif
													<a href="{{ route('addon.edit', [encrypt($user->id), $addon->id]) }}" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
													<button class="btn btn-danger btn-sm addon-name-btn" data-toggle="modal" data-target="#delete" data-name="{{ $addon->name }}" data-url="{{ route('addon.destroy', [encrypt($user->id), $addon->id]) }}" title="Delete"><i class="fa fa-trash"></i></button>
												</div>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
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
				<p>Delete the addon, <b class="addon-name"></b>?</p>
			</div>
			<div class="modal-footer">
				<form method="post" action="" class="addon-url">
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
				@if($user->profileAddons->isEmpty())
				@else
					@if($addon->featured == 1)
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
	$('.addon-name-btn').on('click', function(){
		var addonName = $(this).data('name');
		var addonUrl = $(this).data('url');
		$('.addon-name').text(addonName);
		$('.addon-url').attr('action', addonUrl);
	});

	$('.addon-featured-btn').on('click', function(){
		var featuredUrl = $(this).data('furl');
		$('.featured-url').attr('action', featuredUrl);
	});
</script>

@stop
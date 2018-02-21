@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Add-ons Categories
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				@if($addon_categories->isEmpty())
					No Add-ons Categories created yet. =( <a href="{{ route('addon_category.create', encrypt($user->id)) }}">Click here to ADD</a>
				@else
					<div class="row mgb5">
						<div class="col-md-12">
							<a href="{{ route('addon_category.create', encrypt($user->id)) }}" class="btn btn-default btn-sm pull-right">Add</a>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-condensed table-hover">
							<thead>
								<tr>
									<th>Name</th>
									<th>Date/Time</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($addon_categories as $addon_category)
									<tr>
										<td>{{ $addon_category->name }}</td>
										<td>{{ date_format($addon_category->created_at, 'M-d-Y g:i A') }}</td>
										<td>
											<div class="btn-group">
												<a href="{{ route('addon_category.edit', [encrypt($user->id), $addon_category->id]) }}" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
												<button class="btn btn-danger btn-sm addon_category-name-btn" data-toggle="modal" data-target="#delete" data-name="{{ $addon_category->name }}" data-url="{{ route('addon_category.destroy', [encrypt($user->id), $addon_category->id]) }}" title="Delete"><i class="fa fa-trash"></i></button>
											</div>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
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
				<p>Delete the category, <b class="addon_category-name"></b>?</p>
			</div>
			<div class="modal-footer">
				<form method="post" action="" class="addon_category-url">
					{{ csrf_field() }}
					{{ method_field('delete') }}
					<button type="submit" class="btn btn-danger btn-sm">Yes</button>
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
	$('.addon_category-name-btn').on('click', function(){
		var addon_categoryName = $(this).data('name');
		var addon_categoryUrl = $(this).data('url');
		$('.addon_category-name').text(addon_categoryName);
		$('.addon_category-url').attr('action', addon_categoryUrl);
	});
</script>
@stop
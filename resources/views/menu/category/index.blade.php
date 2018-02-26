@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Categories
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				@if($user->profileCategoryMenus->isEmpty())
					No Categories created yet. =( <a href="{{ route('category.create', encrypt($user->id)) }}">Click here to ADD</a>
				@else
					<div class="row mgb5">
						<div class="col-md-12">
							<a href="{{ route('category.create', encrypt($user->id)) }}" class="btn btn-default btn-sm pull-right">Add</a>
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
								@foreach($user->profileCategoryMenus as $category)
									<tr>
										<td>{{ $category->name }}</td>
										<td>{{ date_format($category->created_at, 'M-d-Y g:i A') }}</td>
										<td>
											<div class="btn-group">
												<a href="{{ route('category.edit', [encrypt($user->id), $category->id]) }}" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
												<button class="btn btn-danger btn-sm category-name-btn" data-toggle="modal" data-target="#delete" data-name="{{ $category->name }}" data-url="{{ route('category.destroy', [encrypt($user->id), $category->id]) }}" title="Delete"><i class="fa fa-trash"></i></button>
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
				<p>Delete the category, <b class="category-name"></b>?</p>
			</div>
			<div class="modal-footer">
				<form method="post" action="" class="category-url">
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
	$('.category-name-btn').on('click', function(){
		var categoryName = $(this).data('name');
		var categoryUrl = $(this).data('url');
		$('.category-name').text(categoryName);
		$('.category-url').attr('action', categoryUrl);
	});
</script>
@stop
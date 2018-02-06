@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Inventory
	</div>
	<div class="panel-body">
		@if($user->profileInvs->isEmpty())
			No Items on the Inventory is created yet. =( <a href="{{ route('inventory.create', encrypt($user->id)) }}">Click here to ADD</a>
		@else
		<div class="row mgb5">
			<div class="col-md-12">
				<a href="{{ route('inventory.create', encrypt($user->id)) }}" class="btn btn-default btn-sm pull-right">Add</a>
			</div>
		</div>
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-condensed">
				<thead>
					<tr>
						<th>Inventory ID</th>
						<th>Name</th>
						<th>Unit Price</th>
						<th>Quantity</th>
						<th>Unit</th>
						<th>Price</th>
						<th>Date Reordered</th>
						<th>Value</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
					@foreach($user->profileInvs as $inventory)
						<tr>
							<td>IN{{ $inventory->id }}</td>
							<td>{{ $inventory->name }}</td>
							<td>{{ $inventory->price }}</td>
							<td>{{ $inventory->qty }}</td>
							<td>{{ $inventory->vom }}</td>
							<td>{{ $inventory->price }}</td>
							<td>{{ $inventory->date_reorder }}</td>
							<td>{{ $inventory->value }}</td>
							<td>
								<div class="btn-group">
									<a href="{{ route('inventory.show', [encrypt($user->id), $inventory->id]) }}" class="btn btn-default btn-sm" title="View More"><i class="fa fa-eye"></i></a>
									<a href="{{ route('inventory.edit', [encrypt($user->id), $inventory->id]) }}" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
									<button class="btn btn-danger btn-sm inventory-name-btn" data-toggle="modal" data-target="#delete" data-name="{{ $inventory->name }}" data-url="{{ route('inventory.destroy', [encrypt($user->id), $inventory->id]) }}" title="Delete"><i class="fa fa-trash"></i></button>
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

<!-- Modal -->
<div id="delete" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				<p>Delete the item, <b class="inventory-name"></b>?</p>
			</div>
			<div class="modal-footer">
				<form method="post" action="" class="inventory-url">
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
	$('.inventory-name-btn').on('click', function(){
		var inventoryName = $(this).data('name');
		var inventoryUrl = $(this).data('url');
		$('.inventory-name').text(inventoryName);
		$('.inventory-url').attr('action', inventoryUrl);
	});
</script>

@stop
@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Inventory
	</div>
	<div class="panel-body">
		<div class="row mgb5">
			<div class="col-md-12">
				<form action="{{ route('inventory.index.monthly.range', encrypt($user->id)) }}" method="get" class="form-inline">
					{{ csrf_field() }}
					<div class="form-group">
						<label>Year:</label>
						<select class="form-control input-sm" name="year" required>
							<option disabled selected>Year</option>
							<option value="2018">2018</option>
							<option value="2019">2019</option>
							<option value="2020">2020</option>
							<option value="2021">2021</option>
						</select>
					</div>
					<div class="form-group">
						<label>From:</label>
						<select class="form-control input-sm" name="start_month" required>
							<option disabled selected>Month</option>
							<option value="Jan-01-">January</option>
							<option value="Feb-01-">February</option>
							<option value="Mar-01-">March</option>
							<option value="Apr-01-">April</option>
							<option value="May-01-">May</option>
							<option value="Jun-01-">June</option>
							<option value="Jul-01-">July</option>
							<option value="Aug-01-">August</option>
							<option value="Sep-01-">September</option>
							<option value="Oct-01-">October</option>
							<option value="Nov-01-">November</option>
							<option value="Dec-01-">December</option>
						</select>
					</div>
					<div class="form-group">
						<label>To:</label>								
						<select class="form-control input-sm" name="end_month" required>
							<option disabled selected>Month</option>
							<option value="Jan-31-">January</option>
							<option value="Feb-28-">February</option>
							<option value="Mar-31-">March</option>
							<option value="Apr-30-">April</option>
							<option value="May-31-">May</option>
							<option value="Jun-30-">June</option>
							<option value="Jul-31-">July</option>
							<option value="Aug-31-">August</option>
							<option value="Sep-30-">September</option>
							<option value="Oct-31-">October</option>
							<option value="Nov-30-">November</option>
							<option value="Dec-31-">December</option>
						</select>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-default btn-sm">Search</button>
					</div>
				</form>
			</div>
		</div>
		@if($inventories->isEmpty())
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
					@foreach($inventories as $inventory)
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
		{{ $inventories->links() }}
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
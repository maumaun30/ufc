@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Inventory
	</div>
	<div class="panel-body">
		<div class="row mgb5">
			<div class="col-md-12">
				<a href="{{ route('inventory.create', $profile->id) }}" class="btn btn-default btn-sm pull-right">Create</a>
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
						<th>VoM</th>
						<th>Date Reordered</th>
						<th>Value</th>
					</tr>
				</thead>
				<tbody>
					@foreach($inventories as $inventory)
						<tr>
							<td>{{ $inventory->inv_id }}</td>
							<td>{{ $inventory->name }}</td>
							<td>{{ $inventory->price }}</td>
							<td>{{ $inventory->qty }}</td>
							<td>{{ $inventory->vom }}</td>
							<td>{{ $inventory->price }}</td>
							<td>{{ $inventory->date_reorder }}</td>
							<td>{{ $inventory->value }}</td>
							<td>
								<div class="btn-group">
									<a href="{{ route('inventory.show', [$profile->id, $inventory->id]) }}" class="btn btn-default btn-sm"><i class="fa fa-eye"></i></a>
									<a href="#" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
									<button class="btn btn-danger btn-sm profile-name-btn" data-toggle="modal" data-target="#delete" data-name="" data-url=""><i class="fa fa-trash"></i></button>
								</div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>	
</div>
@stop
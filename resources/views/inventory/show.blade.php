@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-12">
				Inventory
				<div class="pull-right">
					<div class="btn-group">
						<a href="{{ route('inventory.create', encrypt($user->id)) }}" class="btn btn-default btn-sm" title="Add Again"><i class="fa fa-plus"></i></a>
						<a href="{{ route('inventory.edit', [encrypt($user->id), $inventory->id]) }}" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
						<button class="btn btn-danger btn-sm item-name-btn" data-toggle="modal" data-target="#delete" data-name="{{ $inventory->name }}" data-url="{{ route('inventory.destroy', [encrypt($user->id), $inventory->id]) }}" title="Delete"><i class="fa fa-trash"></i></button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label>Inventory ID: </label>
					IN{{ $inventory->id }}								
				</div>
				<div class="form-group">
					<label>Name: </label>
					{{ $inventory->name }}								
				</div>
				<div class="form-group">
					<label>Price: </label>
					{{ $inventory->price }}
				</div>				
				<div class="form-group">
					<label>Quantity: </label>
					{{ $inventory->qty }} {{ $inventory->vom }}						
				</div>
				<div class="form-group">
					<label>Date Reordered: </label>
					{{ $inventory->date_reorder }}								
				</div>
				<div class="form-group">
					<label>Total Value: </label>
					{{ $inventory->value }}								
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
				<p>Delete the item, <b class="item-name"></b>?</p>
			</div>
			<div class="modal-footer">
				<form method="post" action="" class="item-url">
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
	$('.item-name-btn').on('click', function(){
		var itemName = $(this).data('name');
		var itemUrl = $(this).data('url');
		$('.item-name').text(itemName);
		$('.item-url').attr('action', itemUrl);
	});
</script>
@stop
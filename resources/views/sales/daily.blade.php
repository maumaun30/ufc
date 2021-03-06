@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-12">
				Sales (Daily)
				<a href="{{ route('sales.index', encrypt($user->id)) }}" class="btn btn-default btn-sm pull-right">All</a>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<!-- <div class="row">
			<div class="col-md-12">
				<canvas id="myChart"></canvas>
			</div>
		</div> -->
		<div class="row">
			<div class="col-md-12">
				@if($today->isEmpty())
					No Sales created yet for today. =(
				@else
				<div class="row">
					<div class="col-md-12">
						<div class="table-responsive">
							<table class="table table-bordered table-striped table-condensed table-hover">
								<thead>
									<tr>
										<th>Name</th>
										<th>Items</th>
										<th>Total Price</th>
										<th>Date/Time</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@foreach($today as $sale)
										<tr>
											<td>{{ $sale->cx }}</td>
											<td>
												<ul>
													@foreach($items = explode(',', $sale->items) as $item)
														<li>{{ $item }}</li>
													@endforeach
												</ul>
											</td>
											<td>{{ $sale->price }}</td>
											<td>{{ date_format($sale->created_at, 'M-d-Y / g:i A') }}</td>
											<td>
												<div class="btn-group">
													<a href="{{ route('sales.edit', [encrypt($user->id), $sale->id]) }}" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
													<button class="btn btn-danger btn-sm sale-name-btn" data-toggle="modal" data-target="#delete" data-name="{{ $sale->name }}" data-url="{{ route('sales.destroy', [encrypt($user->id), $sale->id]) }}" title="Delete"><i class="fa fa-trash"></i></button>
												</div>
											</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						{{ $today->links() }}						
					</div>
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
				<p>Delete the data, <b class="sale-name"></b>?</p>
			</div>
			<div class="modal-footer">
				<form method="post" action="" class="sale-url">
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
	$('.sale-name-btn').on('click', function(){
		var saleName = $(this).data('name');
		var saleUrl = $(this).data('url');
		$('.sale-name').text(saleName);
		$('.sale-url').attr('action', saleUrl);
	});
</script>

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js"></script> -->

<script>
// var ctx = document.getElementById("myChart").getContext('2d');
// var myChart = new Chart(ctx, {
//     type: 'line',
//     data: {
//         labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
//         datasets: [{
//             label: 'Income',
//             data: [12, 19, 3, 5, 2, 3],
//             backgroundColor: [
//                 'rgba(255, 99, 132, 0.2)'
//             ],
//             borderColor: [
//                 'rgba(255,99,132,1)'
//             ],
//             borderWidth: 2
//         }]
//     },
//     options: {
//         scales: {
//             yAxes: [{
//                 ticks: {
//                     beginAtZero:true
//                 }
//             }]
//         }
//     }
// });
</script>
@stop
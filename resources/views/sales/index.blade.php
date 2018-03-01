@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-12">
				Sales
				<a href="{{ route('sales.index.daily', encrypt($user->id)) }}" class="btn btn-default btn-sm pull-right">Daily</a>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div class="row mgb5">
			<div class="col-md-12">
				<form action="{{ route('sales.index.monthly.range', encrypt($user->id)) }}" method="get" class="form-inline">
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
							<option value="-01-01">January</option>
							<option value="-02-01">February</option>
							<option value="-03-01">March</option>
							<option value="-04-01">April</option>
							<option value="-05-01">May</option>
							<option value="-06-01">June</option>
							<option value="-07-01">July</option>
							<option value="-08-01">August</option>
							<option value="-09-01">September</option>
							<option value="-10-01">October</option>
							<option value="-11-01">November</option>
							<option value="-12-01">December</option>
						</select>
					</div>
					<div class="form-group">
						<label>To:</label>								
						<select class="form-control input-sm" name="end_month" required>
							<option disabled selected>Month</option>
							<option value="-01-31">January</option>
							<option value="-02-29">February</option>
							<option value="-03-31">March</option>
							<option value="-04-30">April</option>
							<option value="-05-31">May</option>
							<option value="-06-30">June</option>
							<option value="-07-31">July</option>
							<option value="-08-31">August</option>
							<option value="-09-30">September</option>
							<option value="-10-31">October</option>
							<option value="-11-30">November</option>
							<option value="-12-31">December</option>
						</select>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-default btn-sm">Search</button>
					</div>
				</form>
			</div>
		</div>
		<div class="row mgb5">
			<div class="col-md-6">
				<canvas id="myChart"></canvas>
			</div>
			<div class="col-md-6">
				@if($sales->isEmpty())
					No Sales created yet for this month. =(
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
									@foreach($sales as $sale)
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
						{{ $sales->links() }}						
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.bundle.min.js"></script>

<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [
        	@for ($i=1; $i < 12; $i++)
        		'{{ date('F', mktime(0, 0, 0, $i, 1)) }}',
        	@endfor
        ],
        datasets: [{
            label: 'Income',
            data: [{{ $array_incomes }}],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)'
            ],
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});
</script>
@stop
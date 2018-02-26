@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-12">
				Ratings
				<div class="pull-right">
					<label>Average Score: </label> {{ $user->profileRatings->avg('score') }}
				</div>
			</div>
		</div>
	</div>
	<div class="panel-body">
		@if($user->profileRatings->isEmpty())
		<p>No Ratings yet.</p>
		@else
		<div class="table-responsive">
			<table class="table table-hover table-striped table-bordered">
				<thead>
					<tr>
						<th>Customer Name</th>
						<th>Score</th>
						<th>Date/Time</th>
					</tr>
				</thead>
				<tbody>
					@foreach($ratings = $user->profileRatings()->paginate(10) as $rating)
					<tr>
						<td>{{ $rating->cx }}</td>
						<td>
						@for ($i = 0; $i < $rating->score; $i++)
						    <i class="fa fa-star" style="color: orange;"></i>
						@endfor
						({{ $rating->score }})
						</td>
						<td>{{ date_format($rating->created_at, 'M-d-Y g:i A') }}</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		{{ $ratings->links() }}
		@endif
	</div>
</div>
@stop
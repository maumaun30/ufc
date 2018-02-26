@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Feedbacks
	</div>
	<div class="panel-body">
		@if($user->profileFeedbacks->isEmpty())
			<p>No Feedbacks yet.</p>
		@else
		@foreach($feedbacks = $user->profileFeedbacks()->paginate(10) as $feedback)
			<div class="panel-group" id="accordion{{ $feedback->id }}">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-12">
								<button data-toggle="collapse" data-parent="#accordion{{ $feedback->id }}" href="#collapse{{ $feedback->id }}" class="btn btn-primary btn-sm">{{ $feedback->cx }} <span class="caret"></span></button>
								<ul class="pull-right list-inline">
									@if($feedback->accept == 1)
									<li>Status: <b class="text-success">Accepted</b></li>
									@elseif($feedback->accept == 0)
									<li>Status: <b class="text-danger">Not Accepted</b></li>
									@endif
									<li>
										<form action="{{ route('feedback.accept', [encrypt($user->id), $feedback->id]) }}" method="post">
											{{ csrf_field() }}
											{{ method_field('patch') }}
										    <button type="submit" class="btn btn-success btn-sm" title="Accept"><i class="fa fa-check"></i></button>
										</form>
									</li>
									<li>
										<form action="{{ route('feedback.dontaccept', [encrypt($user->id), $feedback->id]) }}" method="post">
											{{ csrf_field() }}
											{{ method_field('patch') }}
										    <button type="submit" class="btn btn-danger btn-sm" title="Do not accept!"><i class="fa fa-times"></i></button>
										</form>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<div id="collapse{{ $feedback->id }}" class="panel-collapse collapse in">
						<div class="panel-body">
							<div class="mgb5">
								<p>{{ $feedback->feedback }}</p>
							</div>
							<div class="text-muted">
								Submitted on: {{ date_format($feedback->created_at, 'M-d-Y g:i A') }}
							</div>
						</div>
					</div>
				</div>
			</div>
		@endforeach
		{{ $feedbacks->links() }}
		@endif
	</div>
</div>
@stop
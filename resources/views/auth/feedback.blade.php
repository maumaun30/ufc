@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Feedbacks
	</div>
	<div class="panel-body">
		@foreach($feedbacks = $user->profileFeedbacks()->paginate(10) as $feedback)
			<div class="panel-group" id="accordion{{ $feedback->id }}">
				<div class="panel panel-default">
					<div class="panel-heading">
						<div class="row">
							<div class="col-md-12">
								<button data-toggle="collapse" data-parent="#accordion{{ $feedback->id }}" href="#collapse{{ $feedback->id }}" class="btn btn-primary btn-sm">{{ $feedback->cx }} <span class="caret"></span></button>
							</div>
						</div>
					</div>
					<div id="collapse{{ $feedback->id }}" class="panel-collapse collapse in">
						<div class="panel-body">
							<p>{{ $feedback->feedback }}</p>
						</div>
					</div>
				</div>
			</div>
		@endforeach
		{{ $feedbacks->links() }}
	</div>
</div>
@stop
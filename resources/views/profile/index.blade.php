@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Profiles
	</div>
	<div class="panel-body">
		<div class="row mgb5">
			<div class="col-md-12">
				<a href="{{ route('profile.create') }}" class="btn btn-default btn-sm pull-right">Create</a>
			</div>
		</div>
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-condensed">
				<thead>
					<tr>
						<th>Company Name</th>
						<th>Owner's Name</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($profiles as $profile)
						<tr>
							<td>{{ $profile->name }}</td>
							<td>{{ $profile->owner }}</td>
							<td>
								<div class="btn-group">
									<a href="{{ route('profile.show', $profile->id) }}" class="btn btn-default btn-sm"><i class="fa fa-eye"></i></a>
									<a href="{{ route('profile.edit', $profile->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a>
									<button class="btn btn-danger btn-sm profile-name-btn" data-toggle="modal" data-target="#delete" data-name="{{ $profile->name }}" data-url="{{ route('profile.destroy', $profile->id) }}"><i class="fa fa-trash"></i></button>
								</div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
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
				<p>Delete the profile, <b class="profile-name"></b>?</p>
			</div>
			<div class="modal-footer">
				<form method="post" action="" class="profile-url">
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
	$('.profile-name-btn').on('click', function(){
		var profileName = $(this).data('name');
		var profileUrl = $(this).data('url');
		$('.profile-name').text(profileName);
		$('.profile-url').attr('action', profileUrl);
	});
</script>
@stop
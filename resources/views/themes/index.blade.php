@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Themes
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				@if($user->profileThemes->isEmpty())
					No Themes created yet. =( <a href="{{ route('themes.create', encrypt($user->id)) }}">Click here to ADD</a>
				@else
					<div class="row">
						<div class="col-md-12">
							<a href="{{ route('themes.create', encrypt($user->id)) }}" class="btn btn-default btn-sm pull-right">Add</a>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<label>Choose your theme</label>							
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<select class="form-control input-sm" id="themeOption">
									@foreach($user->profileThemes as $theme)
										<option value="{{ $theme->name }}" data-apply="{{ route('themes.apply', [encrypt($user->id), $theme->id]) }}" data-delete="{{ route('themes.destroy', [encrypt($user->id), $theme->id]) }}" data-edit="{{ route('themes.edit', [encrypt($user->id), $theme->id]) }}">{{ $theme->name }}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<form action="" method="post" id="themeForm">
								{{ csrf_field() }}
								{{ method_field('patch') }}
								<div class="btn-group btn-group-sm">
									<button type="submit" class="btn btn-success theme-apply-btn" title="Apply"><i class="fa fa-check"></i></button>
									<a href="" class="btn btn-primary theme-edit-btn" title="Edit"><i class="fa fa-pencil"></i></a>
									<button type="button" class="btn btn-danger theme-delete-btn" data-toggle="modal" data-target="#delete" title="Delete"><i class="fa fa-times"></i></button>
								</div>
							</form>
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
				<p>Delete the theme, <b class="theme-name"></b>?</p>
			</div>
			<div class="modal-footer">
				<form method="post" action="" class="theme-url">
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
	$('.theme-delete-btn').on('click', function(){
		var themeName = $('#themeOption').val();
		var themeUrl = $('#themeOption').find(':selected').data('delete');
		$('.theme-name').text(themeName);
		$('.theme-url').attr('action', themeUrl);
	});

	$('.theme-apply-btn').on('click', function(){
		var themeUrl = $('#themeOption').find(':selected').data('apply');
		$('#themeForm').attr('action', themeUrl);
	});

	$('.theme-edit-btn').on('click', function(){
		var themeUrl = $('#themeOption').find(':selected').data('edit');
		$(this).attr('href', themeUrl);
	});
</script>
@stop
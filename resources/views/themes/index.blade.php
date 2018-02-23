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
										<option value="{{ $theme->name }}" data-apply="{{ route('themes.apply', [encrypt($user->id), $theme->id]) }}" data-delete="{{ route('themes.destroy', [encrypt($user->id), $theme->id]) }}" data-edit="{{ route('themes.edit', [encrypt($user->id), $theme->id]) }}" data-image="{{ asset($theme->bg_image) }}" data-iurl="{{ route('themes.update.bgimage', [encrypt($user->id), $theme->id]) }}">{{ $theme->name }}</option>
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
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Background Image</label>
							</div>
							<div class="form-group">
								<img src="" class="img-rounded img-thumbnail" id="bgImage" style="height:480px;">
							</div>
							<div class="form-group">
								<label>Change Image</label>
							</div>
							<form action="" method="post" enctype="multipart/form-data" id="bgImageForm">
								{{ csrf_field() }}
								{{ method_field('patch') }}
					            <div class="form-group{{ $errors->has('bg_image') ? ' has-error' : '' }}">
									<input type="file" class="form-control input-sm" name="bg_image" placeholder="Background Image" onchange="this.form.submit()">
									@if ($errors->has('bg_image'))
					                    <span class="help-block">
					                        <strong>{{ $errors->first('bg_image') }}</strong>
					                    </span>
					                @endif
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
	$(document).ready(function(){
		$('#bgImage').attr('src', $('#themeOption').find(':selected').data('image'));
		$('#bgImageForm').attr('action', $(this).find(':selected').data('iurl'));

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

		$('#themeOption').on('change', function(){
			var imgSrc = $(this).find(':selected').data('image');
			var imgUrl = $(this).find(':selected').data('iurl');
			$('#bgImage').attr('src', imgSrc);
			$('#bgImageForm').attr('action', imgUrl);
		});
	});
</script>
@stop
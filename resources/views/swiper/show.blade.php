@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-12">
				Swiper
				<div class="pull-right">
					<div class="btn-group">
						<a href="{{ route('swiper.create', encrypt($user->id)) }}" class="btn btn-default btn-sm" title="Add Again"><i class="fa fa-plus"></i></a>
						<button class="btn btn-danger btn-sm swiper-name-btn" data-toggle="modal" data-target="#delete" data-name="{{ $swiper->title }}" data-url="{{ route('swiper.destroy', [encrypt($user->id), $swiper->id]) }}" title="Delete"><i class="fa fa-trash"></i></button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6">
				<img src="{{ asset($swiper->image) }}" class="img-rounded img-thumbnail">
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<form action="{{ route('change.featured.swiper', [encrypt($user->id), $swiper->id]) }}" method="post">
						<label>Featured:</label>
						@if($swiper->featured == 1)
							Yes
						@else
							No
						@endif

						{{ csrf_field() }}
						{{ method_field('patch') }}
						<button type="submit" class="btn btn-default btn-sm">Change</button>
					</form>
				</div>
				<div class="form-group">
					<label>Title: </label>
					{{ $swiper->title }}								
				</div>
				<div class="form-group">
					<label>Created on: </label>
					{{ date_format($swiper->created_at, 'M-d-Y g:i A') }}
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
				<p>Delete the swiper, <b class="swiper-name"></b>?</p>
			</div>
			<div class="modal-footer">
				<form method="post" action="" class="swiper-url">
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
	$('.swiper-name-btn').on('click', function(){
		var swiperName = $(this).data('name');
		var swiperUrl = $(this).data('url');
		$('.swiper-name').text(swiperName);
		$('.swiper-url').attr('action', swiperUrl);
	});
</script>
@stop
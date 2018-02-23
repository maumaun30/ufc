@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-12">
				Swiper
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				@if($user->profileSwipers->isEmpty())
					No Swipers created yet. =( <a href="{{ route('swiper.create', encrypt($user->id)) }}">Click here to ADD</a>
				@else
					<div class="row mgb5">
						<div class="col-md-12">
							<a href="{{ route('swiper.create', encrypt($user->id)) }}" class="btn btn-default btn-sm pull-right">Add</a>
						</div>
					</div>
					<div class="table-responsive">
						<table class="table table-bordered table-striped table-condensed table-hover">
							<thead>
								<tr>
									<th>Title</th>
									<th>Featured</th>
									<th>Date/Time</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($swipers = $user->profileSwipers()->paginate(10) as $swiper)
									<tr>
										<td>{{ $swiper->title }}</td>
										<td>
											@if($user->profileSwipers->isEmpty())
											@else
												@if($swiper->featured == 1)
													Yes
												@else
													No
												@endif
											@endif
										</td>
										<td>{{ date_format($swiper->created_at,'M-d-Y g:i A') }}</td>
										<td>
											<div class="btn-group">
												<a href="{{ route('swiper.show', [encrypt($user->id), $swiper->id]) }}" class="btn btn-default btn-sm" title="View More"><i class="fa fa-eye"></i></a>
												@if($user->profileSwipers->isEmpty())
												@else
													<button class="btn btn-warning btn-sm swiper-featured-btn" data-toggle="modal" data-target="#featured" data-furl="{{ route('change.featured.swiper', [encrypt($user->id), $swiper->id]) }}" title="@if($swiper->featured == 1) Featured @else Not Featured @endif">
														@if($swiper->featured == 1)
															<i class="fa fa-star"></i>
														@else
															<i class="fa fa-star-o"></i>
														@endif
													</button>
												@endif
												<button class="btn btn-danger btn-sm swiper-name-btn" data-toggle="modal" data-target="#delete" data-name="{{ $swiper->title }}" data-url="{{ route('swiper.destroy', [encrypt($user->id), $swiper->id]) }}" title="Delete"><i class="fa fa-trash"></i></button>
											</div>
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					{{ $swipers->links() }}
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
				<p>Delete the swiper, <b class="swiper-name"></b>?</p>
			</div>
			<div class="modal-footer">
				<form method="post" action="" class="swiper-url">
					{{ csrf_field() }}
					{{ method_field('delete') }}
					<button type="submit" class="btn btn-danger btn-sm">Yes</button>
					<button type="button" class="btn btn-default btn-sm" data-dismiss="modal">No</button>
				</form>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div id="featured" class="modal fade" role="dialog">
	<div class="modal-dialog modal-sm">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
			<div class="modal-body">
				@if($user->profileSwipers->isEmpty())
				@else
					@if($swiper->featured == 1)
						Remove as Featured?
					@else
						Mark as Featured?
					@endif
				@endif
			</div>
			<div class="modal-footer">
				<form action="" method="post" class="featured-url">
					{{ csrf_field() }}
					{{ method_field('patch') }}
					<button type="submit" class="btn btn-default btn-sm">Yes</button>
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
	$('.swiper-name-btn').on('click', function(){
		var swiperName = $(this).data('name');
		var swiperUrl = $(this).data('url');
		$('.swiper-name').text(swiperName);
		$('.swiper-url').attr('action', swiperUrl);
	});

	$('.swiper-featured-btn').on('click', function(){
		var featuredUrl = $(this).data('furl');
		$('.featured-url').attr('action', featuredUrl);
	});
</script>

@stop
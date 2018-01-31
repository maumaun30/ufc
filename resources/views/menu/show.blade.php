@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					Menu
				</div>
				<div class="panel-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label>Code: </label>
								{{ $menu->code }}								
							</div>
							<div class="form-group">
								<label>Name: </label>
								{{ $menu->name }}								
							</div>
							<div class="form-group">
								<label>Price: </label>
								{{ $menu->price }}
							</div>
							<div class="form-group">
								<label>Description: </label>
								{{ $menu->description }}
							</div>						
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Profiles
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label>Company: </label>
					{{ $profile->name }}								
				</div>
				<div class="form-group">
					<label>Owner's: </label>
					{{ $profile->owner }}
				</div>
				<div class="form-group">
					<label>Address: </label>
					{{ $profile->address }}
				</div>						
			</div>
		</div>							
	</div>
</div>
@stop


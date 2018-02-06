@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-12">
				Profile
				<div class="pull-right">
					<div class="btn-group">
						<a href="{{ route('profile.edit', encrypt($user->id)) }}" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-pencil"></i></a>
						<a href="{{ route('change.password', encrypt($user->id)) }}" class="btn btn-warning btn-sm" title="Change Password"><i class="fa fa-lock"></i></a>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-6">
				<img src="{{ asset($user->logo) }}" class="img-circle img-thumbnail">
				<form action="{{ route('profile.logo', encrypt($user->id)) }}" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
					{{ method_field('patch') }}
		            <div class="form-group{{ $errors->has('logo') ? ' has-error' : '' }}">
		            	<label>Change Logo</label>
						<input type="file" name="logo" class="form-control" onchange="this.form.submit()">
						@if ($errors->has('logo'))
		                    <span class="help-block">
		                        <strong>{{ $errors->first('logo') }}</strong>
		                    </span>
		                @endif
		            </div>
	            </form>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label>Name:</label>
					{{ $user->name }}
				</div>
				<div class="form-group">
					<label>Email Address:</label>
					{{ $user->email }}
				</div>
				<div class="form-group">
					<label>Company:</label>
					{{ $user->company }}
				</div>
				<div class="form-group">
					<label>Address:</label>
					{{ $user->address }}
				</div>
			</div>
		</div>		
	</div>
</div>
@stop
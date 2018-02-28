@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		<div class="row">
			<div class="col-md-12">
				Edit Profile
			</div>
		</div>
	</div>
	<div class="panel-body">
		<div class="row">
			<div class="col-md-12">
				<form method="POST" action="{{ route('profile.update', encrypt($user->id)) }}">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" placeholder="Name" required autofocus>
                        @if ($errors->has('name'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" placeholder="Email Address" required>
                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('company') ? ' has-error' : '' }}">
                        <input type="text" name="company" class="form-control" placeholder="Company" required value="{{ $user->company }}">
                        @if ($errors->has('company'))
                            <span class="help-block">
                                <strong>{{ $errors->first('company') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                        <textarea name="address" class="form-control" placeholder="Address" required>{{ $user->address }}</textarea>
                        @if ($errors->has('address'))
                            <span class="help-block">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('about') ? ' has-error' : '' }}">
                        <textarea name="about" class="form-control" placeholder="About" required>{{ $user->about }}</textarea>
                        @if ($errors->has('about'))
                            <span class="help-block">
                                <strong>{{ $errors->first('about') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-default btn-sm">Update</button>
                    </div>
                </form>
			</div>
		</div>		
	</div>
</div>
@stop
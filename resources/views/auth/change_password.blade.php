@extends('layouts.home')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Change Password</div>

    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">                
                <form method="POST" action="{{ route('change.password.update', encrypt($user->id)) }}">
                    {{ csrf_field() }}
                    {{ method_field('patch') }}

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password" required>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-default btn-sm">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

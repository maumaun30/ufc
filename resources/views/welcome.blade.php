@extends('layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Welcome</div>

    <div class="panel-body">
        <a href="{{ route('profile.index') }}" class="btn btn-default">Company Profiles</a>
    </div>
</div>
@endsection

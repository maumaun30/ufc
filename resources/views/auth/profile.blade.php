@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Profile
	</div>
	<div class="panel-body">
		Name: {{ $user->name }}<br>
		Company: {{ $user->company }}<br>
		Address: {{ $user->name }}<br>
		Logo: {{ $user->logo }}<br>
	</div>
</div>
@stop
@extends('layouts.home')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Menu</div>

    <div class="panel-body">
        <div class="row">
        	@foreach($menus as $menu)
        	<div class="col-md-4">
	        	<div class="panel panel-default">
	        		<div class="panel-heading">
	        			Ulam Name
	        		</div>
	        		<div class="panel-body">
	        			Ulam Image<br>
	        			Price
	        		</div>
	        	</div>
        	</div>
        </div>
    </div>
</div>
@endsection

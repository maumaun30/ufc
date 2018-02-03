@extends('layouts.home')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Welcome</div>

    <div class="panel-body">
        May I have your order please?<br>
        <a href="{{ route('create.cart') }}" class="btn btn-default">Order Now!</a>
    </div>
</div>
@endsection

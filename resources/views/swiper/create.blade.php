@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Add Swiper
	</div>
	<div class="panel-body">
		<form method="post" action="{{ route('swiper.store', encrypt($user->id)) }}" enctype="multipart/form-data">
			{{ csrf_field() }}
			<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
				<input type="text" name="title" class="form-control input-sm" placeholder="Title" value="{{ old('title') }}" required>
				@if ($errors->has('title'))
                    <span class="help-block">
                        <strong>{{ $errors->first('title') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
            	<label>Upload Photo</label>
				<input type="file" name="image" class="form-control input-sm">
				@if ($errors->has('image'))
                    <span class="help-block">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
                <label>Featured</label>
                <select name="featured" class="form-control input-sm">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
			<button type="submit" class="btn btn-default btn-sm">Add</button>
		</form>
	</div>
</div>
@stop
@extends('layouts.app')

@section('content')
<div class="panel panel-default">
	<div class="panel-heading">
		Add Theme
	</div>
	<div class="panel-body">
		<form method="post" action="{{ route('themes.store', encrypt($user->id)) }}">
			{{ csrf_field() }}
			<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
				<input type="text" name="name" class="form-control input-sm" placeholder="Name" value="{{ old('name') }}" required autofocus>
				@if ($errors->has('name'))
                    <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
            	<label>Front Page</label>
            </div>
			<div class="form-group{{ $errors->has('bg_color') ? ' has-error' : '' }}">
				<label>Background Color</label>
				<input type="color" name="bg_color" class="form-control input-sm" placeholder="Background Color" value="{{ old('bg_color') }}">
				@if ($errors->has('bg_color'))
                    <span class="help-block">
                        <strong>{{ $errors->first('bg_color') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('ft_family') ? ' has-error' : '' }}">
            	<label>Font Style</label>
				<select class="form-control input-sm" name="ft_family">
					<option disabled selected>Select font style</option>
					<option value="Calibri">Calibri</option>
					<option value="Arial">Arial</option>
					<option value="Open Sans">Open Sans</option>
					<option value="Lato">Lato</option>
				</select>
				@if ($errors->has('ft_family'))
                    <span class="help-block">
                        <strong>{{ $errors->first('ft_family') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('ft_size') ? ' has-error' : '' }}">
            	<label>Font Size</label>
				<select class="form-control input-sm" name="ft_size">
					<option disabled selected>Select font size</option>
					<option value="10">Small</option>
					<option value="12">Medium</option>
					<option value="14">Large</option>
					<option value="20">Huge</option>
				</select>
				@if ($errors->has('ft_size'))
                    <span class="help-block">
                        <strong>{{ $errors->first('ft_size') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('ft_color') ? ' has-error' : '' }}">
            	<label>Font Color</label>
				<input type="color" name="ft_color" class="form-control input-sm" placeholder="Font Color" value="{{ old('ft_color') }}">
				@if ($errors->has('ft_color'))
                    <span class="help-block">
                        <strong>{{ $errors->first('ft_color') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group">
            	<label>Panel</label>
            </div>
            <div class="form-group{{ $errors->has('pnl_color') ? ' has-error' : '' }}">
            	<label>Color</label>
				<input type="color" class="form-control input-sm" placeholder="Font Color" value="{{ old('pnl_color') }}" id="panelColor">
				<input type="hidden" name="pnl_color" id="panelColorInput">
				@if ($errors->has('pnl_color'))
                    <span class="help-block">
                        <strong>{{ $errors->first('pnl_color') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group{{ $errors->has('pnl_opacity') ? ' has-error' : '' }}">
            	<label>Transparency</label>
				<select class="form-control input-sm" name="pnl_opacity">
					<option disabled selected>Select panel transparency</option>
					<option value="0">Clear</option>
					<option value="0.3">Minimal Clear</option>
					<option value="0.8">Slightly Clear</option>
					<option value="1">Not Clear</option>
				</select>
				@if ($errors->has('pnl_opacity'))
                    <span class="help-block">
                        <strong>{{ $errors->first('pnl_opacity') }}</strong>
                    </span>
                @endif
            </div>
			<button type="submit" class="btn btn-default btn-sm">Add</button>
		</form>
	</div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
	function convertHex(hex,opacity){
	    hex = hex.replace('#','');
	    r = parseInt(hex.substring(0,2), 16);
	    g = parseInt(hex.substring(2,4), 16);
	    b = parseInt(hex.substring(4,6), 16);

	    result = '+r+','+g+','+b+','+opacity/100+';
	    return result;
	}

	$('#panelColor').on('change', function(){
		var pnlVal = $(this).val();
		$('#panelColorInput').val(convertHex(pnlVal,50));
	})
</script>
@stop
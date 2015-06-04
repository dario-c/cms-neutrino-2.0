<div class="form-group">
	<br>
	@foreach($postTypeField->source() as $index => $value)
		<?php 
			$fill = false;
			if(isset($post)) $fill = (strpos($post->getMeta($postTypeField->id), $value) !== false) ? true : false;
		?>

		{!! Form::label($postTypeField->id.'[]',' ') !!}
		{!! Form::radio($postTypeField->id.'[]', $index, $fill,
			[
				'required'					=> ($postTypeField->parameter('required') == true) ? 'required' : null, 
				'data-fv-notempty'			=> ($postTypeField->parameter('required') == true) ? 'true' : null,
				'data-fv-notempty-message' 	=> ($postTypeField->parameter('required') == true) ? 'Please select an option' : null,
		]) !!}
		{{ $index }}
	@endforeach
</div>
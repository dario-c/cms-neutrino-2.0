<div class="form-group">
	<br>

	@foreach($postTypeField->source() as $index => $value)

		{!! Form::label($postTypeField->id.'[]',' ') !!}
		{!! Form::checkbox($postTypeField->id.'[]', $index, 
			(strpos($post->getMeta($postTypeField->id), $value) !== false) ? true : false,
			[
				'required'					=> ($postTypeField->parameter('required') == true) ? 'required' : null, 
				'data-fv-notempty'			=> ($postTypeField->parameter('required') == true) ? 'true' : null,
			    'data-fv-notempty-message' 	=> ($postTypeField->parameter('required') == true) ? 'Please select an option' : null,
		]) !!}
		{{ $index }}
	@endforeach
</div>
<div class="form-group">
	<br>

	@foreach($postTypeField->source() as $index => $value)

		{!! Form::label($postTypeField->id.'[]',' ') !!}
		{!! Form::checkbox($postTypeField->id.'[]', $index, 
			(strpos($post->getMeta($postTypeField->id), $value) !== false) ? true : false,
			[]) !!}
		{{ $index }}
	@endforeach
</div>
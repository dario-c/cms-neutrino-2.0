<div class="form-group">
	<br>
	@foreach($postTypeField->source() as $index => $value)
		{!! Form::label($postTypeField->id.'[]',' ') !!}
		{!! Form::checkbox($postTypeField->id.'[]', $index, $value,[]) !!}
		{{ $index }}
	@endforeach
</div>
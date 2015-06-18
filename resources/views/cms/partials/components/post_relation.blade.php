<div class="form-group">

	@if($postTypeField->parameters['multiple'])
		<span class="form-label">{{ $postTypeField->title.(($postTypeField->parameter('required') == true) ? ' *' : '')}}</span>

		<div class="selection-options">
			@foreach($postTypeField->source() as $index => $value)
				<?php 
					$fill = (isset($post->id)) ? $postTypeField->isRelated($postTypeField->id, $post->id, $index) : false;
				?>

				{!! Form::checkbox($postTypeField->id.'[]', $index, $fill,
					[
						'id'						=> $postTypeField->id.'_'.$index,
						'required'					=> ($postTypeField->parameter('required') == true) ? 'required' : null,
						'data-fv-notempty'			=> ($postTypeField->parameter('required') == true) ? 'true' : null,
					    'data-fv-notempty-message' 	=> ($postTypeField->parameter('required') == true) ? 'Please select an option' : null,
				]) !!}
				{!! Form::label($postTypeField->id.'_'.$index, $value, ['class' => 'selection-label']) !!}
			@endforeach
		</div>

	@else
		{!! Form::label($postTypeField->id, $postTypeField->title.(($postTypeField->parameter('required') == true) ? ' *' : '' )) !!}
		{!! Form::select($postTypeField->id, $postTypeField->source(), (isset($post)) ? $post->getMeta($postTypeField->id) : null,[
			'class' 					=> 'form-control',
			'required'					=> ($postTypeField->parameter('required') == true) ? 'required' : null, 
			'data-fv-notempty'			=> ($postTypeField->parameter('required') == true) ? 'true' : null,
			'data-fv-notempty-message' 	=> ($postTypeField->parameter('required') == true) ? 'Please select an option' : null,
		]) !!}
	@endif

</div>
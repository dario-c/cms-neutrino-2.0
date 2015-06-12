<div class="form-group">
	<span class="form-label">{{ $postTypeField->title.(($postTypeField->parameter('required') == true) ? ' *' : '')}}</span>

	<div class="selection-options">
		@foreach($postTypeField->source() as $index => $value)
			<?php 
				$fill = false;
				if(isset($post)) $fill = (strpos($post->getMeta($postTypeField->id), $value) !== false) ? true : false;
			?>
				{!! Form::checkbox($postTypeField->id.'[]', $index, $fill,
					[
						'id'						=> $index,
						'required'					=> ($postTypeField->parameter('required') == true) ? 'required' : null,
						'data-fv-notempty'			=> ($postTypeField->parameter('required') == true) ? 'true' : null,
					    'data-fv-notempty-message' 	=> ($postTypeField->parameter('required') == true) ? 'Please select an option' : null,
				]) !!}
				{!! Form::label($index, $index, ['class' => 'selection-label']) !!}
		@endforeach
	</div>
</div>
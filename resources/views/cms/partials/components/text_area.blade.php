<div class="form-group">
	{!! Form::label($postTypeField->id, $postTypeField->title.(($postTypeField->parameter('required') == true) ? ' *' : '' )) !!}
	{!! Form::textarea($postTypeField->id, (isset($post)) ? $post->getMeta($postTypeField->id) : null, array_filter([ 
		'class' 					=> 'form-control', 
		'placeholder'				=> $postTypeField->placeholder,
		
		'required'					=> ($postTypeField->parameter('required') == true) ? 'required' : null, 
		'data-fv-notempty'			=> ($postTypeField->parameter('required') == true) ? 'true' : null,
        'data-fv-notempty-message' 	=> ($postTypeField->parameter('required') == true) ? 'This field is required, cannot be left empty' : null
    ])) !!}
</div>
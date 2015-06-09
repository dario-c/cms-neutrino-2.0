<div class="form-group">
	{!! Form::label($postTypeField->id.'_name', $postTypeField->title.(($postTypeField->parameter('required') == true) ? ' *' : '' )) !!}

	<?php
		$values = (isset($post)) ? json_decode($post->getMeta($postTypeField->id)) : null;
	?>
	
	{!! Form::text($postTypeField->id.'_name', (isset($post)) ? $values->name : null, array_filter([ 
		'class' 					=> 'form-control', 
		'placeholder'				=> 'Title of the action',
		
		'required'					=> ($postTypeField->parameter('required') == true) ? 'required' : null, 
		'data-fv-notempty'			=> ($postTypeField->parameter('required') == true) ? 'true' : null,
        'data-fv-notempty-message' 	=> ($postTypeField->parameter('required') == true) ? 'This field is required, cannot be left empty' : null
    ])) !!}
</div>

<div class="form-group">
	{!! Form::url($postTypeField->id.'_url', (isset($post)) ? $values->url : null, array_filter([ 
		'class' 					=> 'form-control', 
		'placeholder'				=> 'http://example.com',
		
		'required'					=> ($postTypeField->parameter('required') == true) ? 'required' : null, 
		'data-fv-notempty'			=> ($postTypeField->parameter('required') == true) ? 'true' : null,
        'data-fv-notempty-message' 	=> ($postTypeField->parameter('required') == true) ? 'This field is required, cannot be left empty' : null,
        'data-fv-uri'				=> true,
        'data-fv-uri-message' 		=> 'The field requires a valid url address (ex: <strong>http://</strong>www.example.com)',
        'data-fv-trigger'			=> 'blur'
    ])) !!}
</div>
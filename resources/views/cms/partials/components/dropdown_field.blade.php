<div class="form-group">
	{!! Form::label($postTypeField->id, $postTypeField->title.(($postTypeField->parameter('required') == true) ? ' *' : '' )) !!}
    {!! Form::select($postTypeField->id, $postTypeField->source(), (isset($post)) ? $post->getMeta($postTypeField->id) : null,[
    	'class' 					=> 'form-control',
		'required'					=> ($postTypeField->parameter('required') == true) ? 'required' : null, 
		'data-fv-notempty'			=> ($postTypeField->parameter('required') == true) ? 'true' : null,
	    'data-fv-notempty-message' 	=> ($postTypeField->parameter('required') == true) ? 'Please select an option' : null,
    ]) !!}
</div>
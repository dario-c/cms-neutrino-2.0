<div class="form-group">
	{!! Form::label($postTypeField->id, $postTypeField->title.(($postTypeField->parameter('required') == true) ? ' *' : '' )) !!}

	{!! Form::url($postTypeField->id, (isset($post)) ? $post->getMeta($postTypeField->id) : null, array_filter([ 
        'class'                     => 'form-control', 
        'placeholder'               => 'http://example.com',

        'required'                  => ($postTypeField->parameter('required') == true) ? 'required' : null,
        'data-fv-notempty'          => ($postTypeField->parameter('required') == true) ? 'true' : null,
        'data-fv-notempty-message'  => ($postTypeField->parameter('required') == true) ? 'This field is required, cannot be left empty' : null,
        
        'data-fv-uri'               => true,
        'data-fv-uri-message'       => 'The field requires a valid url address (ex: <strong>http://</strong>www.example.com)',
        
        'data-fv-regexp'            => ($postTypeField->parameter('contains') != '') ? true : null, 
        'pattern'                   => ($postTypeField->parameter('contains') != '') ? preg_quote($postTypeField->parameter('contains'), '.') : null,
        'data-fv-regexp-message'    => ($postTypeField->parameter('contains') != '') ? 'The url address needs to contain <strong>'.$postTypeField->parameter('contains').'</strong>' : null,

        'data-fv-trigger'           => 'blur'
    ])) !!}
</div>
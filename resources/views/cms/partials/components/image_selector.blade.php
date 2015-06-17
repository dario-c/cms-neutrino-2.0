<div class="form-group image-selector" id="{{ $postTypeField->id }}-image-selector">
	
    {!! Form::label($postTypeField->id, $postTypeField->title.(($postTypeField->parameter('required') == true) ? ' *' : '' )) !!}
	
    {!! Form::hidden($postTypeField->id, (isset($post)) ? $post->getMeta($postTypeField->id) : null, []) !!} 

	<?php $imageId = Input::old($postTypeField->id, (isset($post)) ? $post->getMeta($postTypeField->id) : 0); ?>
    
    <div class="panel panel-default">
        <div class="panel-body">
            <img class="image-preview" src="{{ Media::getLink($imageId, 'thumbnail', asset('assets/cms/images/placeholders/image.png')) }}" placeholder="{{ asset('assets/cms/images/placeholders/image.png') }}" width="110" height="110" alt="preview" />
            
            <blockquote class="pull-left">
                <p><button type="button" class="btn btn-default btn-media-library" selector="{{ $postTypeField->id }}-image-selector">Select image</button></p>
                <footer>
                    <span>{{ Media::getName($imageId, 'No image selected') }}</span>
                    <a class="btn-delete-file {{ ($imageId == 0) ? 'hide' : '' }}" href="javascript:void(0);">delete</a> 
                </footer>
            </blockquote>
    
            <div class="clearfix"></div>
        </div>
    </div>
</div>
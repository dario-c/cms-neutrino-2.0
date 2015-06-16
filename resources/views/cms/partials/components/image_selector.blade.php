<div class="form-group image-selector" id="{{ $postTypeField->id }}-image-selector">
	
	{{ var_dump(Media::getLink(3)) }}
	
    {!! Form::label($postTypeField->id, $postTypeField->title.(($postTypeField->parameter('required') == true) ? ' *' : '' )) !!}
	
    {!! Form::hidden($postTypeField->id, (isset($post)) ? $post->getMeta($postTypeField->id) : null, array_filter([ ])) !!}
    
    <div class="panel panel-default">
        <div class="panel-body">
            <img class="image-preview" src="{{ asset('assets/cms/images/placeholders/image.png') }}" placeholder="{{ asset('assets/cms/images/placeholders/image.png') }}" width="110" height="110" alt="preview" />
            
            <blockquote class="pull-left">
                <p><button type="button" class="btn btn-default btn-media-library" selector="{{ $postTypeField->id }}-image-selector">Select image</button></p>
                <footer>
                    {{ 'Filename' or 'No image selected' }}
                    
                    @if (1==1)
                    <a href="javascript:void(0);">delete</a> 
                    @endif
                </footer>
            </blockquote>
    
            <div class="clearfix"></div>
        </div>
    </div>
</div>
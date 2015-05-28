<!-- POST TITLE -->
<div class="form-group">
	{!! Form::label('title', "Title *") !!}
	{!! Form::text('title', null, [
		'required'					=> 'required', 
		'class' 					=> 'form-control sluggable', 
		'placeholder'				=> 'Enter a title here..',
		'data-fv-notempty'			=> 'true',
        'data-fv-notempty-message' 	=> 'This field is required, cannot be left empty'
    ]) !!}
</div>

<div class="form-group slug-group hide">
    <span class="slug">
        <strong>Permalink:</strong> /{{ $postType->slug }}/<span class="current-slug">{{ $post->slug or '' }}</span>/ <button type="button" class="btn btn-default btn-xs" tabindex="-1">Edit</button>
        {!! Form::hidden('slug') !!}
    </span>
</div>

@foreach ($postTypeFields as $postTypeField)

    @include($postTypeField->template)

@endforeach

<hr />

{!! Form::hidden('type', $postType->name) !!}
{!! Form::hidden('state') !!}

<button type="button" class="btn btn-default btn-submit" post-state="draft">Save as Draft</button>
<button type="button" class="btn btn-success btn-submit" post-state="published">Publish</button>
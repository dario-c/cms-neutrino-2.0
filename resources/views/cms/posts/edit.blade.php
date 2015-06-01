@extends('cms.base')

@section('content')

	<h1>Edit {{ ucwords($postType->singular_name) }}</h1>
	
	@include('cms.partials.forms.flash_messages')
	
	{!! Form::model($post, ['method' => 'PATCH', 'action' => array('CmsPostTypeController@update', $postType->name, $post->id), 'class' => 'form-validation']) !!}

		@include('cms.partials.forms.post_type', ['submitText' => 'Save'])
	
	{!! Form::close() !!}

@stop
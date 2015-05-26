@extends('cms.base')

@section('content')

	<h1>Add new {{ ucwords($postType->singular_name) }}</h1>
	
	{!! Form::open(['method' => 'POST', 'action' => array('CmsPostTypeController@store', $postType->name)]) !!}

		@include('cms.partials.forms.post_type', ['submitText' => 'Save'])
	
	{!! Form::close() !!}

@stop
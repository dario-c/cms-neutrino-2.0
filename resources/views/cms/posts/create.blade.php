@extends('cms.base')

@section('content')

	<h1>Add new {{ ucwords($postType->singular_name) }}</h1>
	
	@include('cms.partials.forms.flash_messages')
	
	{!! Form::open(['method' => 'POST', 'action' => array('CmsPostTypeController@store', $postType->name), 'class' => 'form-validation']) !!}

		@include('cms.partials.forms.post_type', ['submitText' => 'Save'])
	
	{!! Form::close() !!}

@stop

@section('styles')
        
	@foreach ($postType->getStyles() as $filename)
    <link type="text/css" rel="stylesheet" href="{{ $filename }}" />
    @endforeach
        
@stop
        
@section('scripts') 
       
	@foreach ($postType->getScripts() as $filename)
    <script type="text/javascript" src="{{ $filename }}"></script>
    @endforeach

@stop
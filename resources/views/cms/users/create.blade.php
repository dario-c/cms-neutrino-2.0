@extends('cms.base')

@section('content')

	@include('cms.partials.forms.flash_messages')

	{!! Form::open(['method' => 'POST', 'action' => 'CmsUserController@store']) !!}

		@include('cms.partials.forms.user', ['submitText' => 'Register'])
	
	{!! Form::close() !!}

@stop
@extends('cms.base')

@section('content')

	{!! Form::open(['method' => 'POST', 'action' => 'CmsUserController@store']) !!}

		@include('cms.partials.forms.user', ['submitText' => 'Register'])
	
	{!! Form::close() !!}

@stop
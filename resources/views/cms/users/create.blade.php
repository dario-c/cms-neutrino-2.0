@extends('app')

@section('content')
	@include('partials.forms.flash_messages')

	{!! Form::open(['method' => 'POST', 'action' => 'CmsUserController@store']) !!}

		@include('partials.forms.user', ['submitText' => 'Register'])
	
	{!! Form::close() !!}

@stop
@extends('app')

@section('content')

	{!! Form::open(['method' => 'POST', 'action' => 'CmsUserController@store']) !!}

		@include('partials.forms.user', ['submitText' => 'Register'])
	
	{!! Form::close() !!}

@stop
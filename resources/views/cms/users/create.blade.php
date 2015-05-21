@extends('app')

@section('content')

	{!! Form::open(['method' => 'POST', 'action' => 'CmsUserController@store']) !!}

		@include('partials.forms._user', ['submitText' => 'Register'])
	
	{!! Form::close() !!}

@stop
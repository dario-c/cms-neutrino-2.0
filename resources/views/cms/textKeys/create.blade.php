@extends('app')

@section('content')

	{!! Form::open(['method' => 'POST', 'action' => 'CmsTextKeyController@store']) !!}

		@include('partials.forms._text_keys', ['submitText' => 'Create Text Key','category'=>null, 'value'=>null])
	
	{!! Form::close() !!}

@stop
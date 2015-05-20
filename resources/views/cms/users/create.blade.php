@extends('app')

@section('content')

	{!! Form::open(['method' => 'POST', 'action' => 'CmsUserController@store']) !!}

		@include('cms.users._formCommonInput')

		<div class="form-group">
			{!! Form::label('password', "Password:") !!}
		    {!! Form::password('password', null) !!}
		</div>

		<div class="form-group">
		    {!! Form::submit('Register') !!}
		</div>

	{!! Form::close() !!}

@stop
@extends('app');

@section('content')

	{!! Form::model($user, ['method' => 'PATCH', 'action' => ['CmsUserController@update', $user->id]]) !!}
		
		<div class="form-group">
		    {!! Form::label('name', "Name:") !!}
		    {!! Form::text('name', null) !!}
	    </div>

	    <div class="form-group">
		   	{!! Form::label('email', "Email:") !!}
		    {!! Form::email('email', null) !!}
	    </div>
			{{$user->role->name}}

		<div class="form-group">
		    {!! Form::submit() !!}
		</div>
	
	{!! Form::close() !!}	

@stop
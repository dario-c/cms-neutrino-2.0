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

	    <div class="form-group">
		   	{!! Form::label('email', "Email:") !!}
		    {!! Form::select('role_id', $roles, null) !!}
	    </div>
			{{$user->role->name}}

		<div class="form-group">
		    {!! Form::submit() !!}
		</div>
	
	{!! Form::close() !!}	

	{!! Form::open(['method' => 'DELETE', 'action' => ['CmsUserController@update', $user->id]] ) !!}
	      <button type="submit" class="btn btn-danger btn-mini">Delete</button>
	{!! Form::close() !!}

@stop

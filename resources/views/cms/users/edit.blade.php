@extends('app');

@section('content')

	{!! Form::model($user, ['method' => 'PATCH', 'action' => ['CmsUserController@update', $user->id]]) !!}

	   	@if(Auth::user()->role->name === 'admin' )
			@include('cms.users._editUserFormAdmin')
	   	@else
			@include('cms.users._editUserForm')
		@endif

		<div class="form-group">
		    {!! Form::submit('Edit', ['class' => 'btn btn-info']) !!}
		</div>
		
		<div class="form-group">
		    {!! Form::submit('Edit', ['class' => 'btn btn-info']) !!}
		</div>

	{!! Form::close() !!}	

@stop
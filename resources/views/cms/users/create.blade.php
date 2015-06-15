@extends('cms.base')

@section('content')

	<h1>Add new User</h1>

	@include('cms.partials.forms.flash_messages')

	{!! Form::open(['method' => 'POST', 'action' => 'CmsUserController@store', 'class' =>'form-validation']) !!}
		<div class="btn-toolbar text-right">
			<button type="button" class="btn btn-success btn-submit">Register</button>
		</div>

		@include('cms.partials.forms.user', [
			'passwordRequired'		=> 'true',
			'passwordPlaceholder'	=> ''
		])

	{!! Form::close() !!}

@stop
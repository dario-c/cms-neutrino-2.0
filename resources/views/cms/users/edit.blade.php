@extends('cms.base')

@section('content')

	<h1>Edit User</h1>

	@include('cms.partials.forms.flash_messages')

	{!! Form::model($user, ['method' => 'PATCH', 'action' => ['CmsUserController@update', $user->id], 'class' =>'form-validation']) !!}
		<div class="btn-toolbar text-right">
			<button type="button" class="btn btn-success btn-submit">Edit</button>
			@if(Auth::user()->isAdmin() )
				<a class="btn btn-danger"  title="Delete" data-href="{{ action('CmsUserController@destroy', [$user->id]) }}" data-toggle="modal" data-target="#confirm-delete" href="#">Delete</a>
			@endif
		</div>

		@include('cms.partials.forms.user', [
			'passwordRequired'		=> 'false',
			'passwordPlaceholder'	=> 'Type to change the user\'s password'
		])

	{!! Form::close() !!}
@stop
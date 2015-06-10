@extends('cms.base')

@section('content')

	<h1>Send Information</h1>

	@include('cms.partials.forms.flash_messages')

	{!! Form::open(['method' => 'POST', 'action' => 'CmsEmailController@send']) !!}

		<div class="form-group">
			{!! Form::label('name', "Name:") !!}
			{!! Form::text('name', null, ['class' => 'form-control',]) !!}
		</div>

		<div class="form-group">
			{!! Form::label('random', "Random String:") !!}
			{!! Form::text('random', null, ['class' => 'form-control',]) !!}
		</div>

		<div class="form-group">
			{!! Form::submit("Send Email", ['class' => 'btn btn-info']) !!}
		</div>

	
	{!! Form::close() !!}

@stop
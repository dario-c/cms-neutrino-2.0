@extends('cms.base')

@section('content')

	<h1>Home</h1>

	<div class="panel-body">
		You are logged in! @textkey('TEXT_KEY_ONE', 'First Text Key', 'category')
		@textkey('TEXT_KEY_TWO', 'Second Text Key', 'category')
	</div>
	
@endsection
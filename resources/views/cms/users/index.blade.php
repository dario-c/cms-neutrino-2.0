@extends('app');

@section('content')
	@unless ($users->isEmpty())
	<div class="panel panel-default">
		<table class="table">
			<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Current Role</th>
			</tr>
		@foreach ($users as $user)
			<tr>
				<td> {{ $user->name }} </td>
				<td> {{ $user->email }} </td>
				<td> {{ $user->role->name }} </td>
			</tr>
		@endforeach

		</table>
	</div>
	@endunless
@stop
<!-- NAME -->
<div class="form-group">
	{!! Form::label('name', "Name:") !!}
	{!! Form::text('name', null) !!}
</div>


<!-- EMAIL -->
<div class="form-group">
	{!! Form::label('email', "Email:") !!}
	{!! Form::email('email', null) !!}
</div>


<!-- PASSWORD -->
<div class="form-group">
	{!! Form::label('password', "Password:") !!}
	{!! Form::password('password', null) !!}
</div>


<!-- ROLE -->
@if(Auth::user()->role->name === 'admin' )
	<div class="form-group">
		{!! Form::label('role', "Role:") !!}
		{!! Form::select('role_id', $roles, null) !!}
	</div>
@elseif(isset($user))
	<div class="form-group">
		{!! Form::label('role', "Role:") !!}
		{{ $user->role->name }}
	</div>
@endif


<!-- SUBMIT -->
<div class="form-group">
	{!! Form::submit($submitText, ['class' => 'btn btn-info']) !!}
</div>

<!-- NAME -->
<div class="form-group">
	{!! Form::label('name', "Name:") !!}
	{!! Form::text('name', null, [
		'class'						=> 'form-control',

		'required'					=> 'required',
		'data-fv-notempty'			=> 'true',
		'data-fv-notempty-message' 	=> 'This field is required, cannot be left empty',
		'data-fv-trigger'			=> 'blur'
	]) !!}
</div>


<!-- EMAIL -->
<div class="form-group">
	{!! Form::label('email', "Email:") !!}
	{!! Form::email('email', null, [
		'class'						=> 'form-control',

		'required'					=> 'required',
		'data-fv-notempty'			=> 'true',
		'data-fv-notempty-message' 	=> 'This field is required, cannot be left empty',
		'data-fv-emailaddress'		=> 'true',
		'data-fv-emailaddress-message'=> 'The value is not a valid email address',
		'data-fv-trigger'			=> 'blur'
	]) !!}
</div>


<!-- PASSWORD -->
<div class="form-group">
	{!! Form::label('password', "Password:") !!}
	{!! Form::password('password',[
		'class'						=> 'form-control',
		'placeholder'				=> $passwordPlaceholder,
		
		'required'					=> $passwordRequired,
		'data-fv-notempty'			=> $passwordRequired,
		'data-fv-notempty-message' 	=> 'This field is required, cannot be left empty',
		'data-fv-trigger'			=> 'blur'
	]) !!}
</div>


<!-- ROLE -->
@if(Auth::user()->isAdmin() )
	<div class="form-group">
		{!! Form::label('role', "Role:") !!}
		{!! Form::select('role_id', $roles, null,['class' => 'form-control']) !!}
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

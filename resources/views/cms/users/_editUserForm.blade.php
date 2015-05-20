@include('cms.users._formCommonInput')

<div class="form-group">
   	{!! Form::label('role', "Role:") !!}
   	{{ $user->role->name }}
</div>
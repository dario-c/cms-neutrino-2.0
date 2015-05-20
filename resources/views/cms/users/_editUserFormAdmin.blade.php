@include('cms.users._formCommonInput')
<div class="form-group">
   	{!! Form::label('role', "Role:") !!}
    {!! Form::select('role_id', $roles, null) !!}
</div>
@include('cms.users._deleteUserForm')

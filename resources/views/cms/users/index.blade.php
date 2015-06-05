@extends('cms.base')

@include('cms.partials.forms.flash_messages')

@section('content')

	

<div class="row">
	<div class="col-xs-5">
		<h1> Users </h1>
	</div>
	
	<div class="col-xs-7">
		{!! Html::linkAction('CmsUserController@create', 'Add new', array(), array('class' => 'btn btn-success pull-right')) !!}
	</div>

	<div class="row">
		<div class="col-xs-12">
			
			<form class="pull-right" role="search">
			   <div class="input-group">
					<div class="inner-addon right-addon">
						<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
						<input type="text" class="form-control filter" placeholder="Search for...">
					</div>
				</div>
			</form>
			
			<div class="btn-group pull-right" style="margin-right: 20px;">
				<a href="javascript:void(0);" id="list" class="change-grid btn btn-default active">
					<span class="glyphicon glyphicon-th-list"></span>
				</a>
				<a href="javascript:void(0);" id="grid" class="change-grid btn btn-default">
					<span class="glyphicon glyphicon-th"></span>
				</a>
			</div>
			
			<div class="pull-left" style="margin-right: 20px;">
				Sort by:
				<select name="sort-by" class="">
					<option value="alpha">Alphabetical</option>
					<option value="date">Date</option>
					<option value="other">Other</option>
				</select>
			</div>
		</div>
	</div>
</div>

<hr />

<div class="list-container">
	<div class="row list-header hide-in-grid">
		<div class="col-xs-2">#</div>
		<div class="col-xs-3">Name</div>
		<div class="col-xs-3">Email</div>
		<div class="col-xs-2">Role</div>
		<div class="col-xs-2">Tools</div>
	</div>

	@if (count($users))
		@foreach ($users as $index => $user)
			<div class="row list-item filterable">
				<div class="col-xs-2">
					<span class="hide-in-grid">{{ $index }}</span>
				</div>
				<div class="col-xs-3">
					<strong class="pointer">{{ $user->name }}</strong>
				</div>
				<div class="col-xs-3">{{ $user->email }}</div>
				<div class="col-xs-2">{{ $user->role->name }}</div>
				<div class="col-xs-2">
					<div class="list-item-actions">
					    <a class="btn" title="Edit" href="{{ action('CmsUserController@edit', [$user->id]) }}"><span class="glyphicon glyphicon-pencil"></span></a>
					    <a class="btn"  title="Delete" data-href="{{ action('CmsUserController@destroy', [$user->id]) }}" data-toggle="modal" data-target="#confirm-delete" href="#"><span class="glyphicon glyphicon-trash"></span></a>
					</div>
				</div>
			</div>
		@endforeach
	@else
		<div class="alert alert-warning" role="alert">
			No results were found 
		</div>
	@endif
</div>
@stop
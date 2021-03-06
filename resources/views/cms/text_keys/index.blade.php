@extends('cms.base')

@section('content')

<div class="row">
	<div class="col-xs-5">
		<h1>Text Keys</h1>
	</div>
	
	<div class="col-xs-7">
		{!! Html::linkAction('CmsTextKeyController@create', 'Add new', array(), array('class' => 'btn btn-success pull-right')) !!}
	</div>
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

<hr />

@include('cms.partials.forms.flash_messages')

<div class="list-container">
	<div class="row list-header hide-in-grid">
		<div class="col-xs-2">#</div>
		<div class="col-xs-3">Text Key</div>
		<div class="col-xs-3">Value (English)</div>
		<div class="col-xs-2">Category</div>
		<div class="col-xs-2">Tools</div>
	</div>

	@if (count($textKeys))
		@foreach ($textKeys as $index => $textKey)
			<div class="row list-item filterable">
				<div class="col-xs-2">
					<span class="hide-in-grid">{{ $index }}</span>
				</div>
				<div class="col-xs-3">
					<strong class="pointer">{{ $textKey->title }}</strong>
				</div>
				<div class="col-xs-3">{{ $textKey->valueForLanguage('1') }}</div>
				<div class="col-xs-2">{{ $textKey->category->title }}</div>
				<div class="col-xs-2">
					<div class="list-item-actions">
					    <a class="btn" title="Edit" href="{{ action('CmsTextKeyController@edit', [$textKey->id]) }}"><span class="glyphicon glyphicon-pencil"></span></a>
					    <a class="btn"  title="Delete" data-href="{{ action('CmsTextKeyController@destroy', [$textKey->id]) }}" data-toggle="modal" data-target="#confirm-delete" href="#"><span class="glyphicon glyphicon-trash"></span></a>
					</div>
				</div>
			</div>
		@endforeach
	@else
	<div class="alert alert-warning" role="alert">
		No results were found 
	</div>
</div>
@endif

@stop


 


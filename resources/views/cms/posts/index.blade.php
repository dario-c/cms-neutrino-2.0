@extends('cms.base')

@section('content')                    
<div class="row">
    <div class="col-xs-5">
        <h1>{{ $postType->name }}</h1>
    </div>

    <div class="col-xs-7">    
        <a class="btn btn-success pull-right" href="{{ action('CmsPostTypeController@create', [$postType->name]) }}">Add new</a>
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

@if(Session::has('deleted'))
<!-- TODO: Do we need this? -->

<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    Post has successfully been deleted
</div>

@endif

<div class="list-container">
    <div class="row list-header hide-in-grid">
        <div class="col-xs-2">#</div>
        <div class="col-xs-4">Title</div>
        <div class="col-xs-2">Slug</div>
        <div class="col-xs-2">Updated at</div>
        <div class="col-xs-2">Author</div>
    </div>
    
    @foreach ($posts as $index => $post)
    
    <div class="row list-item filterable">
        <div class="col-xs-2">
            <span class="hide-in-grid">{{ $index }}</span>
            <span class="list-image"><img class="pointer" src="http://placehold.it/400x300" /></span>
        </div>
        <div class="col-xs-4">
            <strong class="pointer">{{ $post->title }} [{{ $post->state }}]</strong>
            <div class="list-item-actions">
                <a href="edit/{{ $post->post_id }}/">Edit</a> | 
                <a href="#">Preview</a> | 
                <a data-href="delete/{{ $post->post_id }}/" data-toggle="modal" data-target="#confirm-delete" href="#">Delete</a>
            </div>
        </div>
        <div class="col-xs-2 hide-in-grid">{{ $post->slug }}</div>
        <div class="col-xs-2 hide-in-grid">{{ $post->updated_at }}</div>
        <div class="col-xs-2 hide-in-grid">
            {{-- $post->user->user_name --}}
            <i class="glyphicon glyphicon-move pull-right"></i>
        </div>
    </div>
    
    @endforeach
    
    <div class="no-results {{ count($posts) == 0 ? '' : 'hide' }}">
        <div class="alert alert-warning" role="alert">
            No results were found 
        </div>
    </div>
</div>
@endsection
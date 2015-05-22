<div class="panel-group" id="accordion">
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a href="/cms/">
                    <span class="glyphicon glyphicon-home"></span> 
                    Dashboard
                </a>
            </h4>
        </div>
    </div>

    <hr />
    
    @foreach (Neutrino\PostType::all() as $postType)
        
        @if (empty($postType->parent))

    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a href="/cms/{{ $postType->name }}/">
                    <span class="glyphicon glyphicon-option-vertical"></span> 
                    {{ ucwords($postType->name) }}
                </a>
            </h4>
        </div>
        <div id="collapse-{{ $postType->name }}" class="panel-collapse collapse {{ str_contains(Request::url(), $postType->name) ? 'in' : '' }}">
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="/cms/{{ $postType->name }}/">- View all {{ $postType->name }}</a>
                </li>
                <li class="list-group-item">
                    <a href="/cms/{{ $postType->name }}/create/">- Add new {{ $postType->singular_name }}</a>
                </li>
                
               @foreach (Neutrino\PostType::all() as $subPostType)
    
                    @if (1 == $postType->name) {{-- $subPostType->parent --}}
                    
                <li class="list-group-item">
                    <a href="/cms/{{ $subPostType->name }}/"> {{ ucwords($subPostType->name) }}</a>
                </li>    
                    
                    @endif
    
                @endforeach
            </ul>
        </div>
    </div>
    
        @endif
    
    @endforeach
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a href="/cms/text-keys/">
                    <span class="glyphicon glyphicon-font"></span> 
                    Text keys
                </a>
            </h4>
        </div>
        <div id="collapse-settings" class="panel-collapse collapse {{ str_contains(Request::url(), 'text-keys') ? 'in' : '' }}">
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="/cms/text-keys/">- View text keys</a>
                </li>
            </ul>
        </div>
    </div>
    
    <hr />
    
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a href="/cms/users/">
                    <span class="glyphicon glyphicon-cog"></span> 
                    Settings
                </a>
            </h4>
        </div>
        <div id="collapse-settings" class="panel-collapse collapse {{ str_contains(Request::url(), 'users') ? 'in' : '' }}">
            <ul class="list-group">
                <li class="list-group-item">
                    <a href="/cms/users/">- View users</a>
                </li>
                <li class="list-group-item">
                    <a href="/cms/users/create/">- Add user</a>
                </li>
            </ul>
        </div>
    </div>
</div>

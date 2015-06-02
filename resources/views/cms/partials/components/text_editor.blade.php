<div class="form-group">
    {!! Form::label($postTypeField->id, $postTypeField->title.(($postTypeField->parameter('required') == true) ? ' *' : '' )) !!}
    
    <div class="btn-toolbar" role="toolbar" data-role="editor-toolbar" data-target="#editor-{{ $postTypeField->id }}">
        <div class="btn-group" role="group" aria-label="size">
            
            @if ($postTypeField->parameter('toolbar') == 'advanced')
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false" tabindex="-1">
                    <i class="fa fa-text-height"></i>
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>
                    <li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>
                    <li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>
                </ul>
            </div>
            @endif
            
            <button type="button" class="btn btn-default" aria-label="Bold (Ctrl/Cmd+B)" data-edit="bold" tabindex="-1">
                <i class="fa fa-bold"></i>
            </button>
            <button type="button" class="btn btn-default" aria-label="Italic (Ctrl/Cmd+I)" data-edit="italic" tabindex="-1">
                <i class="fa fa-italic"></i>
            </button>
            <button type="button" class="btn btn-default" aria-label="Underline (Ctrl/Cmd+U)" data-edit="underline" tabindex="-1">
                <i class="fa fa-underline"></i>
            </button>
            <button type="button" class="btn btn-default" aria-label="Strikethrough" data-edit="strikethrough" tabindex="-1">
                <i class="fa fa-strikethrough"></i>
            </button>
        </div>
        <div class="btn-group" role="group" aria-label="list">
            <button type="button" class="btn btn-default" aria-label="Bullet list" data-edit="insertunorderedlist" tabindex="-1">
                <i class="fa fa-list-ul"></i>
            </button>
            <button type="button" class="btn btn-default" aria-label="Number list" data-edit="insertorderedlist" tabindex="-1">
                <i class="fa fa-list-ol"></i>
            </button>
        </div>
        <div class="btn-group" role="group" aria-label="indentation">
            <button type="button" class="btn btn-default" aria-label="Reduce indent (Shift+Tab)" data-edit="outdent" tabindex="-1">
                <i class="fa fa-outdent"></i>
            </button>
            <button type="button" class="btn btn-default" aria-label="Indent (Tab)" data-edit="indent" tabindex="-1">
                <i class="fa fa-indent"></i>
            </button>
        </div>
        
        @if ($postTypeField->parameter('toolbar') == 'advanced')
        <div class="btn-group" role="group" aria-label="justify">
            <button type="button" class="btn btn-default" aria-label="Align Left" data-edit="justifyleft" tabindex="-1">
                <i class="fa fa-align-left"></i>
            </button>
            <button type="button" class="btn btn-default" aria-label="Align Center" data-edit="justifycenter" tabindex="-1">
                <i class="fa fa-align-center"></i>
            </button>
            <button type="button" class="btn btn-default" aria-label="Align Right" data-edit="justifyright" tabindex="-1">
                <i class="fa fa-align-right"></i>
            </button>
            <button type="button" class="btn btn-default" aria-label="Align Justify" data-edit="justifyfull" tabindex="-1">
                <i class="fa fa-align-justify"></i>
            </button>
        </div>
        @endif
        
        <!--<div class="btn-group" role="group" aria-label="link">
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default" id="pictureBtn" data-original-title="Insert picture (or just drag &amp; drop)" tabindex="-1">
                    <i class="fa fa-image"></i>
                </button>
                <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" style="opacity: 0; position: absolute; top: 0px; left: 0px; width: 41px; height: 30px;" tabindex="-1">
            </div>
                
            <div class="btn-group" role="group">
                <button type="button" class="btn btn-default" data-container="body" data-toggle="popover" data-placement="bottom" tabindex="-1">
                    <i class="fa fa-link"></i>
                    <span class="popover-custom-content">
                        <input placeholder="http://" type="text" data-edit="createLink" tabindex="-1">
                        <a class="btn btn-default" type="button">Add</a>
                    </span>
                </button>
            </div>
		    <button type="button" class="btn btn-default" aria-label="Remove Hyperlink" data-edit="unlink" tabindex="-1">
                <i class="fa fa-unlink"></i>
            </button>
        </div>-->
        
        <div class="btn-group" role="group" aria-label="other">    
            <button type="button" class="btn btn-default" aria-label="Undo (Ctrl/Cmd+Z)" data-edit="undo" tabindex="-1">
                <i class="fa fa-undo"></i>
            </button>
        </div>
    </div>

    <div class="text-editor form-control" id="#editor-{{ $postTypeField->id }}" name="{{ $postTypeField->id }}">{!! (isset($post)) ? $post->getMeta($postTypeField->id) : '' !!}</div>
    
</div>
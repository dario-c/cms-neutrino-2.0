<div class="media-files row">
    @foreach ($files as $file)
    <div class="col-md-2 col-xs-4 thumbnail-holder filterable">
        <div class="selectable" file_id="{{ $file->id }}" file_name="{{ $file->name }}" file_dimensions="{{ $file->width }}x{{ $file->height }}" file_thumb="{{ Media::getLink($file->id, 'thumbnail') }}" bt_click="highlight">
            <img src="{{ Media::getLink($file->id, 'thumbnail') }}" alt="{{ $file->name }}" />
            <span class="sr-only">{{ $file->name }}</span>
        </div>
    </div>
    @endforeach
    
    <div class="col-xs-12 no-results {{ (count($files)) ? 'hide' : '' }}">
        <div class="alert alert-warning" role="alert">
            No images upload yet, upload your first now
        </div>
    </div>
    
    <div class="col-xs-12 filterable no-filter-result hide">
	    <div class="alert alert-warning" role="alert">
            Could not find any results for the given keyword
        </div>
    </div>
</div>
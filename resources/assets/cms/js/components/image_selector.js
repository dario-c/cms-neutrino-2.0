(function($) { 
  
    var $imageSelectorButtons = $('.image-selector .btn-media-library');

    $imageSelectorButtons.on('click', openMediaLibrary); 
    
    /**
     * Open Media Library and subscript event
     * 
     * @return void
     */
    function openMediaLibrary() 
    {    
        $('#image-select-modal').modal('show');
        
        var $imageSelector  = $(this).parents('.image-selector:first');
        var subscription 	= events.subscribe('media_library_select', fillAndPreviewFile);
    }    
    
    /**
     * Handle select image event when published, hide modal, remove subscribed event
     * 
     * @return void
     */   
    function fillAndPreviewFile(obj) 
    {		
		var $selectedItem = $('#image-select-modal .selectable.active');
			
		selectMediaItem($selectedItem, $imageSelector);
		
		$('#image-select-modal').modal('hide');
		
		subscription.remove();
    }
    
    /**
     * Set selected image info in preview and hidden input
     * 
     * @param object $selectedItem
     * @param object $imageSelector
     * @return void
     */
    function selectMediaItem($selectedItem, $imageSelector)
	{
		var $imageSelectorInput		= $imageSelector.find('input[type=hidden]');
		var $imageSelectorPreview	= $imageSelector.find('img');
		var $imageSelectorInfo		= $imageSelector.find('blockquote footer');
		var $deleteSelectedImage	= $('<a href="javascript:void(0);">delete</a>');
		
		$imageSelectorInput.val($selectedItem.attr('file_id'));
		$imageSelectorPreview.attr('src', $selectedItem.attr('file_thumb'));
		$imageSelectorInfo.html($selectedItem.attr('file_name'));
		
		$deleteSelectedImage.on('click', function() 
		{
			removeSelectedMediaItem($imageSelector);
		});
		
		$imageSelectorInfo.append($deleteSelectedImage);
	}
    
    /**
     * Remove currently selected image, clear hidden input as well.
     * 
     * @param object $container
     * @return void
     */
    function removeSelectedMediaItem($container)
	{
		var $imageSelectorInput		= $container.find('input[type=hidden]');
		var $imageSelectorPreview	= $container.find('img');
		var $imageSelectorInfo		= $container.find('blockquote footer');
		
		$imageSelectorInput.val(0);
		$imageSelectorPreview.attr('src', $imageSelectorPreview.attr('placeholder'));
		$imageSelectorInfo.html('No image selected');
	}
	
})(jQuery);

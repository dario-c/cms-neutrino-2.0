(function($) { 
  
    var $imageSelectorButtons 	= $('.image-selector .btn-media-library');
	var $imageDeleteButtons		= $('.image-selector .btn-delete-file');
	
    $imageSelectorButtons.on('click', openMediaLibrary); 
    $imageDeleteButtons.on('click', deleteSelectedFile);
    
    /**
     * Open Media Library and subscript event
     * 
     * @return void
     */
    function openMediaLibrary() 
    {    
        $('#image-select-modal').modal('show');
        
        var $imageSelector  = $(this).parents('.image-selector:first');
        var subscription 	= events.subscribe('media_library_select', function(obj) 
        {     
	        fillAndPreviewFile($imageSelector); 
	        subscription.remove();
	    });
    }    
    
    /**
     * Remove currently selected image, clear hidden input as well.
     * 
     * @param object $container
     * @return void
     */
    function deleteSelectedFile()
    {
	    var $deleteSelectedImage	= $(this);
	    var $imageSelector  		= $deleteSelectedImage.parents('.image-selector:first');
	    var $imageSelectorInput		= $imageSelector.find('input[type=hidden]');
		var $imageSelectorPreview	= $imageSelector.find('img');
		var $imageSelectorInfo		= $imageSelector.find('blockquote footer span');
		
		$imageSelectorInput.val(0);
		$imageSelectorPreview.attr('src', $imageSelectorPreview.attr('placeholder'));
		$imageSelectorInfo.html('No image selected');
		$deleteSelectedImage.addClass('hide');
    }
    
    /**
     * Handle select image event when published, hide modal, remove subscribed event
     * 
     * @return void
     */   
    function fillAndPreviewFile($imageSelector)
    {		
		var $selectedItem = $('#image-select-modal .selectable.active');
			
		selectMediaItem($selectedItem, $imageSelector);
		
		$('#image-select-modal').modal('hide');
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
		var $imageSelectorInfo		= $imageSelector.find('blockquote footer span');
		var $deleteSelectedImage	= $imageSelector.find('.btn-delete-file');
		console.log($imageSelector);
		console.log($imageSelectorInfo);
		console.log($deleteSelectedImage);
		$imageSelectorInput.val($selectedItem.attr('file_id'));
		$imageSelectorPreview.attr('src', $selectedItem.attr('file_thumb'));
		$imageSelectorInfo.html($selectedItem.attr('file_name'));
		$deleteSelectedImage.removeClass('hide');
		
		$imageSelectorInfo.append($deleteSelectedImage);
	}
    
})(jQuery);
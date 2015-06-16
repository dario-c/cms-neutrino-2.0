(function($) { 
  
    var $imageSelectorButtons = $('.image-selector .btn-media-library');

    $imageSelectorButtons.on('click', function() {
	    
        $('#image-select-modal').modal('show');
        
        var $imageSelector  = $(this).parents('.image-selector:first');
        var subscription 	= events.subscribe('media_library_select', function(obj) {
			
			var $selectedItem = $('#image-select-modal .selectable.active');
				
			selectMediaItem($selectedItem, $imageSelector);
			
			$('#image-select-modal').modal('hide');
			
			subscription.remove();
		});
        
    });
    
    function selectMediaItem($selectedItem, $imageSelector)
	{
		console.log($selectedItem);
		console.log($imageSelector);
		
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

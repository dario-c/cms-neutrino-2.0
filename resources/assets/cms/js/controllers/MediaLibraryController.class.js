function MediaLibraryController($scope, BT)
{
	var self 	= this;
	var element = $('#image-select-modal')
	
	this.initialize = function(poElement)
	{
		loadFiles();
	}
	
	this.selectImage = function(poElement)
	{
		if(!poElement.is(':disabled')) 
		{
			events.publish('media_library_select');
		}
	}
	
	this.highlight = function(poElement)
	{
		var $selectableItems = $('#image-select-modal .selectable');
		var $fileInfo		 = $('#image-select-modal:visible .file-info');
		var $selectButton	 = $('#image-select-modal .btn-select-image');
		var deselect		 = poElement.hasClass('active');
		
		setFileInfo(poElement);
			
		$selectableItems.removeClass('active');
		poElement.toggleClass('active', !deselect);			   
		$fileInfo.toggleClass('hidden', deselect);
		$selectButton.prop('disabled', function(i, v) { return deselect; });
	}
	
	this.refresh = function(container)
	{
		var container = (container) ? container : element.find('.media-library-container');

		$.ajax({
			url: '/cms/partials/media/files',
			success: function(data) {
				container.html(data);
				
				// refresh event handling
				BT.refresh();
			}
		});
	}
	
	function loadFiles()
	{
		element.on('show.bs.modal', function(e)
		{
			var container = $(this).find('.media-library-container');
		
			self.refresh(container);
		});
	}
	
	function setFileInfo($selectedItem)
	{
		var $fileInfo = $('#image-select-modal:visible .file-info');
			
		$fileInfo.find('.file-info-image').attr('src', $selectedItem.attr('file_thumb'));
		$fileInfo.find('.file-info-filename').html($selectedItem.attr('file_name'));
		$fileInfo.find('.file-info-dimensions').html($selectedItem.attr('file_dimensions'));
		$fileInfo.find('.file-info').attr('file_id', $selectedItem.attr('file_id'));
	}
}
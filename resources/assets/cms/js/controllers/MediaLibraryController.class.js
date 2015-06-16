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
			var container  = $(this).find('.media-library-container');
		
			self.refresh(container);
		});
	}
}
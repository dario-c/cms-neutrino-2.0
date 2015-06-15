function UploadController($scope, BT)
{
	var self 		= this;
	var uploaders	= [];
	var settings  	= {
        debug:              true,
        dropzone:           '.upload-drop-zone',
        filename:           'uploadfile',
        filetype:           'image',
        maxSize:            20,
        maxUploads:         10,
        extensions:         ['jpg', 'jpeg', 'png', 'gif', 'mp4'],
        selector:           '.upload',
        uploadButton:       '.btn-upload',
        uploadContainer:    '.upload-container',
        uploadItems:        '.list-group',
        upload_url:         '/cms/upload-handler', // server side handler
        progress_url:       '/cms/upload-progress' // server side handler
    };
	
	this.initialize = function(poElement)
	{
		// maybe translate data attributes to settings 
		
		initializeUploaders();
	}
	
	function initializeUploaders()
	{
		$(settings.selector).each(function()
        {
            var $uploadButton    = $(this).find(settings.uploadButton);
            var $uploadContainer = $(this).find(settings.uploadContainer);
            var $uploadItems     = $(this).find(settings.uploadItems);
            var $dropZone        = $(this).find(settings.dropzone);
            
            var uploader = new ss.SimpleUpload({
                button: $uploadButton,
                customHeaders: {
	                'X-CSRF-Token' : $('meta[name="_token"]').attr('content')
                },
                debug: settings.debug,
                dropzone: $dropZone,
                dragClass: 'drop',
                url: settings.upload_url,
                progressUrl: settings.progress_url,
                responseType: 'json',
                name: settings.filename,
                noParams: true,
                multiple: true,
                multipart: true,
                maxUploads: settings.maxUploads,
                maxSize: 1024 * settings.maxSize,
                accept: (settings.filetype.length > 0) ? settings.filetype + '/*' : '',
                allowedExtensions: settings.extensions,
                hoverClass: 'hover',
                focusClass: 'active',
                disabledClass: 'disabled',   
                onSubmit:   function(filename, extension) 
                {
                    if($('[file="' + filename + '"]:visible').length > 0)
                    {
                        alert('This file is already in the upload queue.');
                        return false;
                    }
                    
                    $uploadContainer.removeClass('hide');
                    
                    var $progressBar        = $('<div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>');
                    var $progressContainer  = $('<div class="progress progress-striped active pull-right"></div>');
                    //var $fileSize           = $('<span class="file-size"></span>');
                    var $uploadItem         = $('<a class="list-group-item" file="' + filename + '"></a>');
                    var $uploadStatus       = $('<span class="badge pull-right">uploading</span>');                
                    
                    $progressContainer.append($progressBar); 
        
                    $uploadItem.append($uploadStatus);
                    $uploadItem.append($progressContainer);
                    $uploadItem.append($('<span class="file-name">' + filename + '</span>'));
                    //$uploadItem.append($fileSize);
                      
                    $uploadItems.append($uploadItem);
            
                    this.setProgressBar($progressBar);
                    //this.setFileSizeBox($fileSize);
                    this.setProgressContainer($progressContainer);
                },
                onError:    function(filename, type, status, statusText, response, uploadBtn)
                {
                    var $uploadItem = $uploadItems.find('[file="' + filename + '"]');
                     
                    uploadStatusHandler($uploadItem, false);
                },
                onSizeError: function( filename, fileSize )
                {
                    alert('File is too large, maximum allowed size is: ' + settings.maxSize + 'mb');  
                },
                onComplete: function(filename, response) 
                {
                    var $uploadItem = $uploadItems.find('[file="' + filename + '"]');
                     
                    uploadStatusHandler($uploadItem, (response != false));
                    updateFilename($uploadItem, response);
                    
                    // cmsMediaLibrary.refresh($('#image-select-modal:visible').find('.media-library-container'));
                }
            });
            
            uploaders.push(uploader);
        });
	}	
	
	function uploadStatusHandler($uploadItem, success)
    {
        var $uploadStatus = $uploadItem.find('.badge');
        
        addRemoveButton($uploadItem);
        
        if(success)
        {
            $uploadItem.addClass('list-group-item-success')
            $uploadStatus.addClass('alert-success');
            $uploadStatus.html('Success');
            return;
        }          
        
        $uploadItem.addClass('list-group-item-danger')
        $uploadStatus.addClass('alert-danger');
        $uploadStatus.html('Failed');
    }
    
    function updateFilename($uploadItem, response)
    {
        if(response.filename)
        {
            $uploadItem.find('.file-name').html(response.filename);
        }
    }
    
    function addRemoveButton($uploadItem)
    {
        var $uploadRemove = $('<button type="button" class="close pull-right" aria-label="Close"><span aria-hidden="true">&times;</span></button>');
                
        $uploadRemove.on('click', function() 
        { 
            $uploadContainer = $uploadItem.parents('.upload-container:first');
            
            $uploadItem.remove();
            
            if($uploadContainer.find(settings.uploadItems).children().length == 0)
            {
                $uploadContainer.addClass('hide');
            } 
        });
        
        $uploadItem.prepend($uploadRemove);
    }
}
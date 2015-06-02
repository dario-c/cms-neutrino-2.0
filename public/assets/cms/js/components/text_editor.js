(function($) { 
  
    $('.text-editor').each(function() {
	    
        $(this).wysiwyg({
            hotKeys: {
    			'ctrl+b meta+b': 'bold',
    			'ctrl+i meta+i': 'italic',
    			'ctrl+u meta+u': 'underline',
    			'ctrl+z meta+z': 'undo',
    			'ctrl+y meta+y meta+shift+z': 'redo',
    		}
        });
        $(this).cleanHtml()
        $('<textarea class="hide" name="' + $(this).attr('name') + '">' + $(this).html() + '</textarea>').insertAfter($(this));
    });
    
    $('.text-editor').on('keyup', function() {
	    
        $('textarea[name=' + $(this).attr('name') + ']').val($(this).html());
    });
    
    $('.btn-toolbar [data-edit]').on('click', function() {
	    
        $('.text-editor').trigger('keyup');
    });
    
})(jQuery);
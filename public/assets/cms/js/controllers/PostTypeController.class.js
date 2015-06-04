function PostTypeController($scope, BT)
{
	var self = this;
	
	this.initialize = function(poElement)
	{
		BT.trigger('createSlug', poElement);
	}
	
	this.submit = function(poElement)
	{
        var lstrState = poElement.attr('post-state');
        var loForm	  = poElement.parents('form:first');
        
        if(lstrState)
        {
            loForm.find('[name=state]').val(lstrState);
        }
         
        loForm.find('[type=submit]').trigger('click'); // for form validation
        //$(this).parents('form:first').submit();
	}
		
	this.createSlug = function(poElement)
	{
		var lstrPostSlug = convertToPermalink(poElement.val());
                
        if(lstrPostSlug != '')
        {
            $scope.find('.current-slug').html(lstrPostSlug);
            $scope.find('[name=slug]').val(lstrPostSlug);
            $scope.find('.slug-group').removeClass('hide');
        }
	}
	
	function convertToPermalink(pstrValue) 
	{
        return pstrValue.replace(/[^a-z0-9]+/gi, '-').replace(/^-*|-*$/g, '').toLowerCase();
    }
}
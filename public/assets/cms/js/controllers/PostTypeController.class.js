function PostTypeController($scope, BT)
{
	/*
	 * On initialize trigger create slug for post type forms
	 *
	 * @param object poElement
	 * @return void
	 */
	this.initialize = function(poElement)
	{
		BT.trigger('createSlug', poElement);
	};
	
	/*
	 * Handle custom submit for post types, different states (publish, save as draft, update, etc.)
	 *
	 * @param object poElement
	 * @return void
	 */
	this.submit = function(poElement)
	{
		var lstrState	= poElement.attr('post-state');
		var loForm		= poElement.parents('form:first');
		
		if(lstrState)
		{
			loForm.find('[name=state]').val(lstrState);
		}
		 
		loForm.find('[type=submit]').trigger('click'); // for form validation
	};
	
	/*
	 * Create a slug on blur for the given post_title
	 *
	 * @param object poElement
	 * @return void
	 */
	this.createSlug = function(poElement)
	{
		var lstrPostSlug = convertToPermalink(poElement.val());
				
		if(lstrPostSlug !== '')
		{
			$scope.find('.current-slug').html(lstrPostSlug);
			$scope.find('[name=slug]').val(lstrPostSlug);
			$scope.find('.slug-group').removeClass('hide');
		}
	};
	
	/*
	 * Create a slug from string
	 *
	 * @param string pstrValue
	 * @return string
	 */
	function convertToPermalink(pstrValue)
	{
		return pstrValue.replace(/[^a-z0-9]+/gi, '-').replace(/^-*|-*$/g, '').toLowerCase();
	}
}
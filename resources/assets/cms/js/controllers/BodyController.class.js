function BodyController($scope, BT)
{
	/*
	 * Initialize things we need onload for the whole body
	 *
	 * @return void
	 */
	this.initialize = function()
	{
		initPopOvers();
		initDeleteModal();
		initGridHandling();
		initFormValidation();
	}
	
	/*
	 * Initialize custom popover handling
	 *
	 * @return void
	 */
	function initPopOvers()
	{
		$scope.find("[data-toggle=popover]").popover({
            html : true,
            content: function() {
              return $(this).find('.popover-custom-content').html();
            }
        });
	}
	
	/*
	 * Initalizing delete modal handling
	 *
	 * @return void
	 */
	function initDeleteModal()
	{
		$scope.find('#confirm-delete').on('show.bs.modal', function(e) 
		{
            $(this).find('#confirm-delete-form').attr('action', $(e.relatedTarget).data('href'));
        });
	}
	
	/*
	 * Initialize Grid handling for every list in the CMS
	 *
	 * @return void
	 */
	function initGridHandling()
	{
		$scope.find('.change-grid').on('click', function()
        {
            $('.change-grid').removeClass('active');
            $(this).addClass('active');
            
            $('.list-container').toggleClass('grid-view', ($(this).attr('id') == 'grid'));
        });
	}
	
	/*
	 * Initialize Form validation for every form with class .form-validation
	 *
	 * @return void
	 */
	function initFormValidation()
	{
		$('.form-validation').each(function() 
		{
            $(this).formValidation();
        });
	}
}
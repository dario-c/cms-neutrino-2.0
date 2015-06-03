function BodyController($scope, BT)
{
	this.initialize = function()
	{
		initPopOvers();
		initDeleteModal();
		initGridHandling();
		initFormValidation();
	}
	
	function initPopOvers()
	{
		$scope.find("[data-toggle=popover]").popover({
            html : true,
            content: function() {
              return $(this).find('.popover-custom-content').html();
            }
        });
	}
	
	function initDeleteModal()
	{
		$scope.find('#confirm-delete').on('show.bs.modal', function(e) 
		{
            $(this).find('#confirm-delete-form').attr('action', $(e.relatedTarget).data('href'));
        });
	}
	
	function initGridHandling()
	{
		$scope.find('.change-grid').on('click', function()
        {
            $('.change-grid').removeClass('active');
            $(this).addClass('active');
            
            $('.list-container').toggleClass('grid-view', ($(this).attr('id') == 'grid'));
        });
	}
	
	function initFormValidation()
	{
		$('.form-validation').each(function() 
		{
            $(this).formValidation();
        });
	}
}
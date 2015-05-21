<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title', 'Neutrino CMS - Caviar Digital')</title>
        
        <meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link type="text/css" rel="stylesheet" href="{{ asset_path }}/css/libraries/bootstrap.min.css" />
        <link type="text/css" rel="stylesheet" href="{{ asset_path }}/css/app.css" />
        <link type="text/css" rel="stylesheet" href="{{ asset_path }}/css/libraries/form-validation.min.css" />
        <link type="text/css" rel="stylesheet" href="{{ asset_path }}/css/libraries/font-awesome.min.css" rel="stylesheet" />
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
    </head>
    <body>
	 
		<div class="container-fluid">
	        @include('partials/top_bar.blade.php')
	        
	        <div class="row main-content">
	            <div class="col-sm-3 menu-bar">   
	                @include('partials/menu_bar.blade.php')    
	            </div>
	            <div class="col-sm-9">
					@yield('content')
	            </div>
	        </div>
		</div>
	
		<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <h4>Confirm your action</h4>
                        Are you sure you want to delete this?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <a href="#" class="btn btn-danger danger">Delete</a>
                    </div>
                </div>
            </div>
        </div>
        
        <script type="text/javascript" src="{{ asset_path }}/js/jquery-1.11.2.min.js"></script>
        <script type="text/javascript" src="{{ asset_path }}/js/bootstrap.min.js"></script>
        <script type="text/javascript" src="{{ asset_path }}/js/form-validation.min.js"></script>
        <script type="text/javascript" src="https://raw.githubusercontent.com/formvalidation/formvalidation/master/dist/js/framework/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://raw.githubusercontent.com/mindmup/bootstrap-wysiwyg/master/external/jquery.hotkeys.js"></script>
        <script type="text/javascript" src="{{ asset_path }}/js/bootstrap-wysiwyg.min.js"></script>
        <script type="text/javascript">
            
            $("[data-toggle=popover]").popover({
                html : true,
                content: function() {
                  return $(this).find('.popover-custom-content').html();
                }
            });
            
            $('[name=post_title]').on('blur', function() {
                var lstrPostTitle = convertToPermalink($(this).val());
                
                if(lstrPostTitle != '')
                {
                    $('.current-slug').html(lstrPostTitle);
                    $('[name=post_slug]').val(lstrPostTitle);
                    $('.slug-group').removeClass('hide');
                }
            });
            
            $('[name=post_title]').trigger('blur');
            
            $('.form-validation').each(function() {
                $(this).formValidation();
            });
            
            $('form .btn-submit').on('click', function(){
                var lstrState = $(this).attr('post-state');
                
                if(lstrState)
                {
                    $(this).parents('form:first').find('[name=post_state]').val(lstrState);
                }
                
                $(this).parents('form:first').submit(); 
                $(this).parents('form:first').find('[type=submit]').trigger('click'); // for form validation
            });
            
            $('#confirm-delete').on('show.bs.modal', function(e) {
                $(this).find('.danger').attr('href', $(e.relatedTarget).data('href'));
            });
            
            $('input.filter').on('keyup', function() {
                var loRows = $('.filterable').hide();
                
                if ($(this).val().length) {
                    var laData = $(this).val().split(' ');
                    
                    $.each(laData, function (lnIndex, lstrValue) {
                        loRows.filter(":contains('" + lstrValue + "')").show();
                    });
                } 
                else {
                    loRows.show();
                }

                if($('.filterable:visible').length) {
                    $('.no-results').addClass('hide').hide();
                }
                else {
                    $('.no-results').removeClass('hide').show();
                }
            });
            
            $('.change-grid').on('click', function()
            {
                $('.change-grid').removeClass('active');
                $(this).addClass('active');
                
                if($(this).attr('id') == 'grid')
                {
                    $('.list-container').addClass('grid-view');
                }
                else
                {
                    $('.list-container').removeClass('grid-view');
                }
            });
            
            $('[name=user_password][strength-container]').on('keyup', function() {
                var lnScore = 1;
                var laTitle = ['weak', 'better', 'strong', 'awesome'];
                var laClass = ['danger', 'warning', 'success', 'success'];

                //if txtpass has both lower and uppercase characters give 1 point
                if ( ( $(this).val().match(/[a-z]/) ) && ( $(this).val().match(/[A-Z]/) ) ) lnScore++;
            
                //if txtpass has at least one number give 1 point
                if ($(this).val().match(/\d+/)) lnScore++;
            
                //if txtpass has at least one special caracther give 1 point
                if ( $(this).val().match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,),.]/) ) lnScore++; 
                
                var loProgressBar = $($(this).attr('strength-container')).find('.progress-bar');
                
                loProgressBar.css('width', (25 * lnScore) + '%');
                loProgressBar.html(laTitle[lnScore - 1]);
                loProgressBar.attr('class', 'progress-bar progress-bar-' + laClass[lnScore - 1]);
            });
            
            $('.reveal').mousedown(function() {
                var loPassword  = $(this).parents('.input-group:first').find('[name=user_password]');
                var loText      = loPassword.clone().attr('type', 'text');
                
                loPassword.hide();
                loText.insertAfter(loPassword);
            }).mouseup(function() {
                $(this).parents('.input-group:first').find('[name=user_password]').show();
            	$(this).parents('.input-group:first').find('[name=user_password][type=text]').remove();
            }).mouseout(function() {
                $(this).parents('.input-group:first').find('[name=user_password]').show();
            	$(this).parents('.input-group:first').find('[name=user_password][type=text]').remove();
            });
            
            function convertToPermalink(pstrValue) {
                return pstrValue.replace(/[^a-z0-9]+/gi, '-').replace(/^-*|-*$/g, '').toLowerCase();
            }
        </script>
        
        {% for filename in component_js_files %}
        <script type="text/javascript" src="{{ filename }}"></script>
        {% endfor %}
        
        {% for resource in Resource.getScripts() %}
        <script type="text/javascript" src="{{ asset_path }}/js/{{ resource }}"></script>
        {% endfor %}
        
    </body>
</html>
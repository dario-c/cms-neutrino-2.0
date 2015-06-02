<!DOCTYPE html>
<html lang="en">
    <head>
        <title>@yield('title', 'Neutrino CMS - Caviar Digital')</title>
        
        <meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link type="text/css" rel="stylesheet" href="{{ asset('assets/cms/css/libraries.css') }}" />
        <link type="text/css" rel="stylesheet" href="{{ asset('assets/cms/css/app.css') }}" />
        
        @if (isset($postType))
        
			@foreach ($postType->getStyles() as $filename)
	        <link type="text/css" rel="stylesheet" href="{{ $filename }}" />
	        @endforeach
        
        @endif
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
    </head>
    <body>
	 
		<div class="container-fluid">
	        @include('cms.partials.top_bar')
	        
	        @if (Auth::guest())
	        <div class="">
				@yield('content')
            </div>
	        @else
	        <div class="row main-content">
	            <div class="col-sm-3 menu-bar">   
	                @include('cms.partials.menu_bar')    
	            </div>
	            <div class="col-sm-9">
					@yield('content')
	            </div>
	        </div>
	        @endif
		</div>
	
		@include('cms.partials.modals.confirm_delete')
        
        <script type="text/javascript" src="{{ asset('assets/cms/js/libraries.js') }}"></script>
        <script type="text/javascript">
            
            $("[data-toggle=popover]").popover({
                html : true,
                content: function() {
                  return $(this).find('.popover-custom-content').html();
                }
            });
            
            $('.sluggable').on('blur', function() {
                var lstrPostSlug = convertToPermalink($(this).val());
                
                if(lstrPostSlug != '')
                {
                    $('.current-slug').html(lstrPostSlug);
                    $('[name=slug]').val(lstrPostSlug);
                    $('.slug-group').removeClass('hide');
                }
            });
            
            $('.sluggable').trigger('blur');
            
            $('.form-validation').each(function() {
                $(this).formValidation();
            });
            
            $('form .btn-submit').on('click', function(){
                var lstrState = $(this).attr('post-state');
                
                if(lstrState)
                {
                    $(this).parents('form:first').find('[name=state]').val(lstrState);
                }
                 
                $(this).parents('form:first').find('[type=submit]').trigger('click'); // for form validation
                //$(this).parents('form:first').submit();
            });
            
            $('#confirm-delete').on('show.bs.modal', function(e) {
                $(this).find('#confirm-delete-form').attr('action', $(e.relatedTarget).data('href'));
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
        
        @if (isset($postType))
        
			@foreach ($postType->getScripts() as $filename)
	        <script type="text/javascript" src="{{ $filename }}"></script>
	        @endforeach
        
        @endif
        
    </body>
</html>
<!DOCTYPE html>
<html lang="en" bt_app="Neutrino">
    <head>
        <title>@yield('title', 'Neutrino CMS - Caviar Digital')</title>
        
        <meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link type="text/css" rel="stylesheet" href="{{ asset('assets/cms/css/libraries.css') }}" />
        <link type="text/css" rel="stylesheet" href="{{ asset('assets/cms/css/app.css') }}" />
        
        @yield('styles')
        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
			<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
    </head>
    <body bt_controller="BodyController" bt_ready="initialize">
	 
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
		@include('cms.partials.modals.media_library')
        
        <script type="text/javascript" src="{{ asset('assets/cms/js/libraries.js') }}"></script>
        <script type="text/javascript" src="{{ asset('assets/cms/js/app.js') }}"></script>
		<script type="text/javascript">
            
            // REPLACE WITH BENTLEY FILTER
            /*$('input.filter').on('keyup', function() {
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
            });*/
            
        </script>
        
		@yield('scripts')
        
    </body>
</html>
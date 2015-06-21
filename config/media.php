<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Media Image Options
	|--------------------------------------------------------------------------
	|
	| To let the application generate images on the fly and cache them, the
	| system needs to know which sizes are allowed. And it needs to know
	| the rules per option. (width, height, fit, quality, position).
	|
	*/

	'image_options' => [
		
		'thumbnail' => [200, 200, true, 70, 'center'],
		'small' 	=> [480, 480, false, 70, 'center'],
		'medium' 	=> [720, 720, false, 80, 'center'],
		'large' 	=> [960, 960, false, 80, 'center'],
		'example' 	=> [300, 300, true, 60, 'top-left'],
		
		/*
			The possible values are:
	
			- top-left
			- top
			- top-right
			- left
			- center (default)
			- right
			- bottom-left
			- bottom
			- bottom-right
		*/
	],
	
];
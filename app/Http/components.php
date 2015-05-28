<?php

use Neutrino\Component;

/*
|--------------------------------------------------------------------------
| Application Components
|--------------------------------------------------------------------------
|
| Here is where you can register field components to the application.
| Add a new component type with a template, rules and/or resources 
| like javascript and css. Below you can see a syntaxt example.
|
*/

/*
 * EXAMPLE:
 * Component::register('location_picker', 'location_picker.blade.php', 'LocationPickerComponent', array(
 *	  'location-picker.js'  => 'script', 
 *	  'location-picker.css' => 'style'
 * ));
 */

Component::register('text_field', 'text_field.blade.php', 'TextFieldComponent');
Component::register('text_area', 'text_area.blade.php', 'TextAreaComponent');
Component::register('select_box', 'select_box.blade.php', 'SelectBoxComponent');
Component::register('url_field', 'url_field.blade.php', 'UrlFieldComponent');
Component::register('image_selector', 'image_selector.blade.php', 'ImageSelectorComponent');







/*

@foreach($postTypeFields as $postTypeField)

	@include($postTypeField->template)


//
$component = Component::findByTypeOrFail('text_field');

return COMPONENT_TEMPLATE_PATH.$component->template;
*/
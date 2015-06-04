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

Component::register('text_field', 'text_field', 'TextFieldComponent');
Component::register('text_area', 'text_area', 'TextAreaComponent');
Component::register('text_editor', 'text_editor', 'TextEditorComponent', array(
	'text_editor.js' 	=> 'script',
	'text_editor.css'	=> 'style' 
));
Component::register('checkbox', 'checkbox', 'CheckboxComponent');
Component::register('radio_button', 'radio_button', 'RadioButtonComponent');
Component::register('url_field', 'url_field', 'UrlFieldComponent');
Component::register('select_box', 'select_box', 'SelectBoxComponent');
Component::register('image_selector', 'image_selector', 'ImageSelectorComponent');
Component::register('action_field', 'action_field', 'ActionFieldComponent');
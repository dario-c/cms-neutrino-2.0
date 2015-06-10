/*

Copyright (C) 2015 by Pascal van Gemert

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.

*/

/**
 * WELCOME TO BENTLEY  JS 
 *
 * BentleyJS is a server side rendering / hybrid minimalistic Javascript framework
 * var BT = new BentleyJS();
 */
function BentleyJS()
{
	var self		= this;
	
	self.appScope	= null;
	self.events		= ['click', 'change', 'blur', 'keyup', 'keydown', 'keypress', 'focus', 'hover', 'mouseup', 'mousedown', 'mouseover', 'scroll'];
	self.basePath	= (window.BentleyJS.BASE_PATH) ? window.BentleyJS.BASE_PATH : '/assets/js/';

	function __construct()
	{
		self.appScope = $('[bt_app]:first');

		initialize();

		triggerReady();
	}
	
	function initialize()
	{
		self.refresh();
	}
	
	/*
	 * Refresh events and filters
	 *
	 * @return void
	 */
	this.refresh = function()
	{
		$.each(self.events, function(pnIndex, pstrEvent)
		{
			applyEvents(pstrEvent);
		});

		applyFilters();
	};
	
	/*
	 * Trigger an event by method in given scope, default scope is the app scope
	 *
	 * @param string pstrMethod
	 * @param object poScope
	 * @return void
	 */
	this.trigger = function(pstrMethod, poScope)
	{
		var loScope = (poScope) ? poScope : self.appScope;
		
		$.each(self.events, function(pnIndex, pstrEvent)
		{
			var loElement = loScope.find('[bt_' + pstrEvent + '=' + pstrMethod + ']');
			
			if(loElement.length > 0)
			{
				loElement.trigger(pstrEvent);
			}
		});
	};
	
	/*
	 * Get an controller
	 *
	 * @param string pstrController
	 * @return object (Controller Class)
	 */
	this.controller = function(pstrController)
	{
		try
		{
			var lstrControllerName = escapeBeforeEval($(this).parents('[bt_controller]:first').attr('bt_controller'));
			
			loadController(['controllers/' + lstrControllerName + '.class'], function()
			{
				var loControllerClass = window[lstrControllerName];
				
				return new loControllerClass();
			}, false);
		}
		catch(poError)
		{
			self.log('Controller not exists : ' + lstrControllerName);
			self.log(poError);
		}
	};
	
	/**
	 * Applies the given event inside the app scope
	 *
	 * @param string pstrEvent
	 * @return void
	 */
	function applyEvents(pstrEvent)
	{
		self.appScope.find('[bt_'+ pstrEvent +']').each(function()
		{
			var loElement = $(this);
			
			loElement.off(pstrEvent);
			loElement.on(pstrEvent, function(e)
			{
				var lstrExpression  = loElement.attr('bt_'+ pstrEvent);
				var loScope			= loElement.parents('[bt_controller]:first');
				
				try
				{
					var lstrControllerName	= escapeBeforeEval(loScope.attr('bt_controller'));
					
					return callControllerMethod(lstrControllerName, lstrExpression, loScope, loElement);
				}
				catch(poError)
				{
					self.log(lstrExpression + ' not exists in controller: ' + lstrControllerName);
					self.log(poError);
				}
			});
		});
	}
	
	/*
	 * Applies filter to the elements with filter attribute
	 *
	 * @return void
	 */
	function applyFilters()
	{
		self.appScope.find('[bt_filter]').each(function()
		{
			var loFilterInput		= $(this);
			var lstrFilterSelector 	= $(this).attr('bt_filter');
			
			loFilterInput.off('keyup');
			loFilterInput.on('keyup', function(e)
			{
				var lstrFilterValue = $(this).val();
				
				self.appScope.find(lstrFilterSelector).each(function()
				{
					var loFilterItem  = $(this);
					var lbDisplayItem = (loFilterItem.text().toLowerCase().indexOf(lstrFilterValue.toLowerCase()) != -1);
					
					loFilterItem.toggle(lbDisplayItem);
				});
				
				var lbDisplayNoResults = (self.appScope.find(lstrFilterSelector + ':visible').length == 0);
				
				self.appScope.find(lstrFilterSelector + '.no-filter-result').toggle(lbDisplayNoResults);
			});
		});
	}
	
	/*
	 * Trigger bt_ready events after onload
	 * This can be used to initialize sliders or other js dependencies on load
	 *
	 * @return void
	 */
	function triggerReady()
	{
		self.appScope.find('[bt_ready]').each(function()
		{
			var loScope			= $(this);
			var lstrExpression  = loScope.attr('bt_ready');

			try
			{
				var lstrControllerName = escapeBeforeEval(loScope.attr('bt_controller'));

				return callControllerMethod(lstrControllerName, lstrExpression, loScope, loScope);
			}
			catch(poError)
			{
				if(loScope.attr('bt_controller') == undefined)
				{
					self.log('Missing bt_controller="" definition for object:');
					self.log(loScope);
				}
				else
				{
					self.log(lstrExpression + ' not exists in controller: ' + lstrControllerName);
				}
				
				self.log(poError);
			}
		});
	}
	
	/*
	 * Call a method on a given controller
	 *
	 * @param string pstrControllerName
	 * @param string pstrMethod
	 * @param object poScope
	 * @param object poElement
	 * @return void
	 */
	function callControllerMethod(pstrControllerName, pstrMethod, poScope, poElement)
	{
		loadController(['controllers/' + pstrControllerName + '.class'], function()
		{
			var loControllerClass = window[pstrControllerName];
			var loController      = new loControllerClass(poScope, self);

			if(pstrMethod.indexOf('()') == -1)
			{
				return eval('loController.' + escapeBeforeEval(pstrMethod) + '(poElement);');
			}
		
			return eval('loController.' + escapeBeforeEval(pstrMethod));
		});
	}
	
	/*
	 * Lazy load a controller and execute the given callback, can be non-async
	 *
	 * @param array paFiles
	 * @param function pfCallback
	 * @param boolean pbAsync (default: true)
	 * @return void
	 */
	function loadController(paFiles, pfCallback, pbAsync)
	{
		$.each(paFiles, function(pnIndex, pstrControllerFileName)
		{
			var lbScriptLoaded	= false,
				loScript		= document.getElementsByTagName('script')[0],
				loNewScript		= document.createElement('script');
		
			// IE
			loNewScript.onreadystatechange = function ()
			{
				if (loNewScript.readyState === 'loaded' || loNewScript.readyState === 'complete')
				{
					if(!lbScriptLoaded) pfCallback();
					
					lbScriptLoaded = true;
				}
			};
		
			// others
			loNewScript.onload = function ()
			{
				if(!lbScriptLoaded)	pfCallback();
				
				lbScriptLoaded = true;
			};
		
			loNewScript.src = self.basePath + pstrControllerFileName + '.js';
			loScript.parentNode.insertBefore(loNewScript, loScript);
		});
	}
	
	/**
	 * Escape string for eval, to not get evil
	 *
	 * @param string pstrValueToEscape
	 * @return string
	 */
	function escapeBeforeEval(pstrValueToEscape)
	{
		return pstrValueToEscape.replace(/['"+]/, ''); // /^[\w+]$/
	}
	
	/**
	 * Log a message to console.
	 * 
	 * @param string pstrMessage
	 * @return void
	 */
	this.log = function(pstrMessage)
	{
		try
		{
			console.log(pstrMessage);
		}
		catch (e) {}
		finally { return; }
	};
	
	/*
	 * Check if jQuery is available, if not throw error
	 */
	if(!window.jQuery)
	{
		throw 'To use BentleyJS, jQuery needs to be loaded first.';
	}
	
	/*
	 * Call constructer on dom ready
	 */
	$(function()
	{
		__construct();
	});
}

'use strict';
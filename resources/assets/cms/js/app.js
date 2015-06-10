window.BentleyJS = window.BentleyJS || {};

(function(ns)
{
	"use strict";

	ns.DEBUG		= false;
	ns.BASE_PATH	= '/assets/cms/js/';
	
	// Set debug flag
	if(ns.DEBUG) document.body.className += " debug";

	ns.BT = new BentleyJS();
	
})(window.BentleyJS);
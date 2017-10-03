/**
 * @license jQuery webcam plugin v1.0.0 09/12/2010
 * http://www.xarg.org/project/jquery-webcam-plugin/
 *
 * Copyright (c) 2010, Robert Eisele (robert@xarg.org)
 * Dual licensed under the MIT or GPL Version 2 licenses.
 **/
var this_webcam = null,
	web_object = 'XwebcamXobjectX';

(function ($) {

var webcam = {
	"extern": null, // external select token to support jQuery dialogs
	"append": true, // append object instead of overwriting
	"width": 320,
	"height": 240,
	"mode": "callback", // callback | save | stream
	"swffile": "jscam.swf",
	"quality": 100,
	"debug":	function() {},
	"onCapture":	function() {},
	"onTick":	function() {},
	"onSave":	function() {},
	"onLoad":	function() {}
};


window["webcam"] = webcam;

$["fn"]["webcam"] = function(options) {

	if (typeof options === "object") {
	    for (var ndx in webcam) {
			if (options[ndx] !== undefined) {
			    webcam[ndx] = options[ndx];
			}
	    }
	}
	this_webcam = this;
	webcam["init"] = function() {

		var source = '<object id="' + web_object + '" type="application/x-shockwave-flash" data="'+
			webcam["swffile"]+'" width="'+webcam["width"]+'" height="'+webcam["height"]+
			'"><param name="movie" value="'+webcam["swffile"]+
			'" /><param name="FlashVars" value="mode='+webcam["mode"]+'&amp;quality='+
			webcam["quality"]+'" /><param name="allowScriptAccess" value="always" /></object>';

		if (null !== webcam["extern"]) {
		    $(webcam["extern"])[webcam["append"] ? "append" : "html"](source);
		    $(webcam["extern"])["html"](source);
		} else {
		    //this_webcam[webcam["append"] ? "append" : "html"](source);
		    this_webcam["html"](source);
		}
	}
	webcam.init();

	var run = 3;
	(_register = function() {

	    if (document.getElementById(web_object) && document.getElementById(web_object)["capture"] !== undefined) {
			/* Simple callback methods are not allowed :-/ */
			webcam["capture"]  = function(x) {
			    try {
				return document.getElementById(web_object)["capture"](x);
			    } catch(e) {}
			}
			webcam["save"] = function(x) {
			    try {
				return document.getElementById(web_object)["save"](x);
			    } catch(e) {}
			}
			webcam["setCamera"] = function(x) {
			    try {
				return document.getElementById(web_object)["setCamera"](x);
			    } catch(e) {}
			}
			webcam["getCameraList"] = function() {
			    try {
				return document.getElementById(web_object)["getCameraList"]();
			    } catch(e) {}
			}
			webcam["pauseCamera"] = function() {
			    try {
				return document.getElementById(web_object)["pauseCamera"]();
			    } catch(e) {}
			}		
			webcam["resumeCamera"] = function() {
			    try {
				return document.getElementById(web_object)["resumeCamera"]();
			    } catch(e) {}
			}
			webcam["resume"] = function() {
			    try {
			    	webcam.init();
			    } catch(e) {}
			}

			webcam["destroy"] = function() {
			    try {
			    	$('#'+web_object).parent().html('<div class="no_device"></div>');
			    } catch(e) {}
			}

	    } else if (0 == run) {
			webcam["debug"]("error", "Flash movie not yet registered!");
	    } else {
			/* Flash interface not ready yet */
			run--;
			window.setTimeout(_register, 1000 * (4 - run));
	    }
	})();
}

})(jQuery);

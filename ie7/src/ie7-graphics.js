/*
	IE7, version 0.8 (alpha) (2005/05/23)
	Copyright: 2004-2005, Dean Edwards (http://dean.edwards.name/)
	License: http://creativecommons.org/licenses/LGPL/2.1/
*/

IE7.addModule("ie7-graphics", function() {

if (appVersion < 5.5) return; // IE5.0 not supported

// constants
// this filter is used to replace a PNG image
var $ALPHA_IMAGE_LOADER = "DXImageTransform.Microsoft.AlphaImageLoader";
var $FILTER = "progid:" + $ALPHA_IMAGE_LOADER + "(src='%1',sizingMethod='scale')";

// ** IE7 VARIABLE
// e.g. only apply the hack to files ending in ".png"
// IE7_PNG_SUFFIX = ".png";

// regular expression version of the above
var _pngTest = new RegExp((window.IE7_PNG_SUFFIX || "-trans.png") + "$", "i");
var _filtered = [];

// apply a filter
function _addFilter($element) {
	var $filter = $element.filters[$ALPHA_IMAGE_LOADER];
	if ($filter) {
		$filter.src = $element.src;
		$filter.enabled = true;
	} else {
		$element.runtimeStyle.filter = $FILTER.replace(/%1/, $element.src);
		_filtered.push($element);
	}
	// remove the real image
	$element.src = BLANK_GIF;
};
function _removeFilter($element) {
	$element.src = $element.pngSrc;
	$element.filters[$ALPHA_IMAGE_LOADER].enabled = false;
};

// -----------------------------------------------------------------------
//  support opacity (CSS3)
// -----------------------------------------------------------------------

ie7CSS.addFix(/opacity\s*:\s*([\d.]+)/, function($match, $offset) {
	return "zoom:1;filter:progid:DXImageTransform.Microsoft.Alpha(opacity=" +
		((parseFloat($match[$offset + 1]) * 100) || 1) + ")";
});

// -----------------------------------------------------------------------
//  fix PNG transparency (CSS background images)
// -----------------------------------------------------------------------


// replace background(-image): url(..) ..  with background(-image): .. ;filter: ..;
var $BACKGROUND = /background(-image)?\s*:\s*([^\(};]*)url\(([^\)]+)\)([^;}]*)/;
ie7CSS.addFix($BACKGROUND, function($match, $offset) {
	var $url = getString($match[$offset + 3]);
	return _pngTest.test($url) ? "filter:" +
		$FILTER.replace(/scale/, "crop").replace(/%1/, $url) + ";zoom:1;background" +
		  ($match[$offset + 1]||"") + ":" + ($match[$offset + 2]||"") + "none" +
		  ($match[$offset + 4]||"") : $match[$offset];
});

// -----------------------------------------------------------------------
//  fix PNG transparency (HTML images)
// -----------------------------------------------------------------------

if (ie7HTML) {
	ie7HTML.addRecalc("img,input", function($element) {
		if ($element.tagName == "INPUT" && $element.type != "image") return;
		_fixImg($element);
		addEventHandler($element, "onpropertychange", function() {
			if (!_printing && event.propertyName == "src" &&
				$element.src.indexOf(BLANK_GIF) == -1) _fixImg($element);
		});
	});
	function _fixImg($element) {
		if (_pngTest.test($element.src)) {
			// we have to preserve width and height
			var $image = new Image($element.width, $element.height);
			$image.onload = function() {
				$element.width = $image.width;
				$element.height = $image.height;
			};
			$image.src = $element.src;
			// store the original url (we'll put it back when it's printed)
			$element.pngSrc = $element.src;
			// add the AlphaImageLoader thingy
			_addFilter($element);
		}
	};
}

// assume that background images should not be printed
//  (if they are not transparent then they'll just obscure content)
// but we'll put foreground images back...
var _printing = false;
addEventHandler(window, "onbeforeprint", function() {
	_printing = true;
	for (var i = 0; i < _filtered.length; i++) _removeFilter(_filtered[i]);
});
addEventHandler(window, "onafterprint", function() {
	for (var i = 0; i < _filtered.length; i++) _addFilter(_filtered[i]);
	_printing = false;
});

});
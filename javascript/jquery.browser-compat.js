(function ($) {
	if ($.browser) {
		return;
	}

	var ua = navigator.userAgent.toLowerCase();
	var match = /(edge|edg|opr|opera|chrome|safari|firefox|msie|trident(?=\/))\/?\s*(\d+(?:\.\d+)*)/.exec(ua) || [];
	var browser = {
		mozilla: false,
		opera: false,
		msie: false,
		safari: false,
		version: '0'
	};

	if (match[1] === 'trident' || match[1] === 'msie') {
		browser.msie = true;
		browser.version = (/(?:msie |rv:)(\d+(?:\.\d+)*)/.exec(ua) || [0, '0'])[1];
	} else if (match[1] === 'firefox') {
		browser.mozilla = true;
		browser.version = match[2] || '0';
	} else if (match[1] === 'safari') {
		browser.safari = true;
		browser.version = match[2] || '0';
	} else if (match[1] === 'opera' || match[1] === 'opr') {
		browser.opera = true;
		browser.version = match[2] || '0';
	}

	$.browser = browser;
})(jQuery);

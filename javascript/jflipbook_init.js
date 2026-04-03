(function ($) {
	'use strict';

	function toBool(value, defaultValue) {
		if (typeof value === 'boolean') {
			return value;
		}
		if (typeof value === 'number') {
			return value === 1;
		}
		if (typeof value === 'string') {
			return ['1', 'true', 'oui', 'on'].indexOf(value.toLowerCase()) !== -1;
		}
		return defaultValue;
	}

	function isJqueryCompatible() {
		var version = ($.fn && $.fn.jquery) ? $.fn.jquery.split('.') : ['0'];
		return parseInt(version[0], 10) >= 3;
	}

	function initJflipbook(context) {
		$('.jflipbook', context).each(function () {
			var $book = $(this);
			if ($book.data('jflipbookInit')) {
				return;
			}

			var options = {
				background: ($book.data('couleur') || '#ccc').toString(),
				cornersTop: toBool($book.data('corners'), false),
				scale: ($book.data('scale') || 'fit').toString()
			};
			var width = parseInt($book.data('largeur'), 10) || 450;
			var height = parseInt($book.data('hauteur'), 10) || 500;

			$book.jFlip(width, height, options);
			$book.data('jflipbookInit', true);
		});
	}

	$(function () {
		if (!isJqueryCompatible()) {
			if (window.console && console.warn) {
				console.warn('jFlipBook nécessite jQuery 3+ (version détectée : ' + $.fn.jquery + ').');
			}
			return;
		}

		initJflipbook(document);
	});

	if (typeof onAjaxLoad === 'function') {
		onAjaxLoad(initJflipbook);
	}
})(jQuery);

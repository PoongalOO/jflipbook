<?php

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

/**
 * Ajouter la feuille de style côté public.
 */
function jflipbook_insert_head_css(string $flux): string {
	$css = find_in_path('css/jflip_style.css');
	if ($css) {
		$flux .= '<link rel="stylesheet" href="' . attribut_html(timestamp($css)) . '">';
	}

	return $flux;
}

/**
 * Charger les scripts jQuery du plugin dans l'ordre.
 */
function jflipbook_jquery_plugins(array $scripts): array {
	$scripts[] = 'javascript/jquery.browser-compat.js';
	$scripts[] = 'javascript/jquery.jflip-0.3.min.js';
	$scripts[] = 'javascript/jflipbook_init.js';

	return $scripts;
}

<?php

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

function formulaires_configurer_jflipbook_charger_dist(): array {
	return [
		'largeur' => (int) lire_config('jflipbook/largeur', 450),
		'hauteur' => (int) lire_config('jflipbook/hauteur', 500),
		'couleur' => (string) lire_config('jflipbook/couleur', '#ccc'),
		'corners' => (string) lire_config('jflipbook/corners', '0'),
		'scale' => (string) lire_config('jflipbook/scale', 'fit'),
	];
}

function formulaires_configurer_jflipbook_verifier_dist(): array {
	$erreurs = [];
	$scales = ['noresize', 'fit', 'fill'];
	$corners = ['0', '1'];

	if ((int) _request('largeur') < 100) {
		$erreurs['largeur'] = _T('jflipbook:erreur_largeur');
	}

	if ((int) _request('hauteur') < 100) {
		$erreurs['hauteur'] = _T('jflipbook:erreur_hauteur');
	}

	$couleur = (string) _request('couleur');
	if (!preg_match('/^#?[0-9a-fA-F]{3,8}$/', $couleur)) {
		$erreurs['couleur'] = _T('jflipbook:erreur_couleur');
	}

	if (!in_array((string) _request('corners'), $corners, true)) {
		$erreurs['corners'] = _T('jflipbook:erreur_corners');
	}

	if (!in_array((string) _request('scale'), $scales, true)) {
		$erreurs['scale'] = _T('jflipbook:erreur_scale');
	}

	return $erreurs;
}

function formulaires_configurer_jflipbook_traiter_dist(): array {
	$couleur = trim((string) _request('couleur'));
	if ($couleur !== '' && $couleur[0] !== '#') {
		$couleur = '#' . $couleur;
	}

	ecrire_config('jflipbook', [
		'largeur' => (int) _request('largeur'),
		'hauteur' => (int) _request('hauteur'),
		'couleur' => $couleur,
		'corners' => (string) _request('corners'),
		'scale' => (string) _request('scale'),
	]);

	return [
		'message_ok' => _T('jflipbook:config_enregistree'),
		'editable' => true,
	];
}

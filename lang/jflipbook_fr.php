<?php

if (!defined('_ECRIRE_INC_VERSION')) {
	return;
}

$GLOBALS[$GLOBALS['idx_lang']] = [
	'configurer_titre' => 'Configurer jFlipBook',
	'config_enregistree' => 'Configuration enregistrée.',

	'largeur' => 'Largeur du livre (px)',
	'hauteur' => 'Hauteur du livre (px)',
	'couleur' => 'Couleur de fond des pages',
	'coins' => 'Position des coins réactifs',
	'scale' => 'Redimensionnement des images',

	'fill' => 'Redimensionner les images en gardant le ratio',
	'fit' => 'Redimensionner uniquement les images trop grandes',
	'noresize' => 'Ne pas redimensionner les images',
	'false' => 'En bas, à gauche et à droite',
	'true' => 'En haut, à gauche et à droite',

	'erreur_largeur' => 'La largeur doit être un nombre supérieur ou égal à 100.',
	'erreur_hauteur' => 'La hauteur doit être un nombre supérieur ou égal à 100.',
	'erreur_couleur' => 'La couleur doit être un code hexadécimal valide (ex. #cccccc).',
	'erreur_corners' => 'La position des coins sélectionnée est invalide.',
	'erreur_scale' => 'Le mode de redimensionnement est invalide.',
];

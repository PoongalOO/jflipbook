# jFlipBook

**Plugin SPIP** — Livre d'images avec effet de pages tournantes.

Transforme les images jointes à un article en un livre interactif feuilletable, grâce à la bibliothèque jQuery [jFlip](http://www.jquery.info/spip.php?article78).

- **Version** : 1.0.0
- **Compatibilité SPIP** : 4.0.0 → 5.99.*
- **Catégorie** : Multimédia
- **Licence** : GPL
- **Auteur** : [PoongalOO](https://webinfo-concept.fr)
- **Documentation** : https://contrib.spip.net/jFlipBook

---

## Sommaire

1. [Prérequis](#prérequis)
2. [Installation](#installation)
3. [Utilisation](#utilisation)
4. [Configuration](#configuration)
5. [Paramètres du modèle](#paramètres-du-modèle)
6. [Intégration dans un squelette](#intégration-dans-un-squelette)
7. [Structure du plugin](#structure-du-plugin)
8. [Internationalisation](#internationalisation)
9. [Développement & contribution](#développement--contribution)

---

## Prérequis

| Dépendance | Version minimale |
|------------|-----------------|
| SPIP       | 4.0.0           |
| jQuery     | 3.x             |
| PHP        | 7.4+            |

> jQuery 3+ est obligatoire. Si une version antérieure est détectée, le plugin affiche un avertissement dans la console et ne s'initialise pas.

---

## Installation

1. Télécharger l'archive du plugin depuis [contrib.spip.net](https://contrib.spip.net/jFlipBook).
2. Décompresser le dossier `jflipbook/` dans `plugins/` (ou `plugins/auto/`).
3. Aller dans **Espace privé → Plugins** et activer **jFlipBook**.

SPIP charge automatiquement les feuilles de style et les scripts JavaScript via les pipelines `insert_head_css` et `jquery_plugins`.

---

## Utilisation

### 1. Préparer l'article

1. Dans l'espace privé, ouvrir l'article souhaité.
2. **Joindre les images** comme documents (formats supportés : `jpg`, `png`, `gif`, `webp`).  
   L'ordre d'affichage suit le numéro de titre des documents.
3. **Associer le mot-clé `jflip`** à l'article.  
   *(Si l'utilisation des mots-clés n'est pas activée sur le site, afficher la page de configuration et l'activer.)*

### 2. Inclure le modèle dans le squelette

Dans le squelette d'article (`article.html` ou équivalent), inclure le modèle :

```html
<INCLURE{fond=jflipbook}{id_article}>
```

Le modèle vérifie lui-même la présence du mot-clé `jflip` : il ne s'affiche que si l'article possède ce mot-clé.

---

## Configuration

La configuration globale se fait dans **Espace privé → Configuration → jFlipBook**.

| Paramètre | Description | Valeur par défaut |
|-----------|-------------|-------------------|
| `largeur` | Largeur du livre en pixels (min. 100) | `450` |
| `hauteur` | Hauteur du livre en pixels (min. 100) | `500` |
| `couleur` | Couleur de fond des pages (code hexadécimal) | `#ccc` |
| `corners` | Position des coins réactifs | `0` (bas) |
| `scale`   | Mode de redimensionnement des images | `fit` |

### Valeurs possibles pour `corners`

| Valeur | Comportement |
|--------|-------------|
| `0`    | Coins réactifs en bas, à gauche et à droite |
| `1`    | Coins réactifs en haut, à gauche et à droite |

### Valeurs possibles pour `scale`

| Valeur     | Comportement |
|------------|-------------|
| `noresize` | Les images ne sont pas redimensionnées |
| `fit`      | Les images trop grandes sont réduites pour être entièrement visibles |
| `fill`     | Toutes les images sont redimensionnées en conservant le ratio pour remplir le cadre |

---

## Paramètres du modèle

Le modèle `jflipbook.html` lit ses options depuis la configuration globale via des attributs `data-*` sur l'élément `<ul class="jflipbook">` :

| Attribut `data-*` | Source de configuration            |
|-------------------|------------------------------------|
| `data-largeur`    | `jflipbook/largeur`                |
| `data-hauteur`    | `jflipbook/hauteur`                |
| `data-couleur`    | `jflipbook/couleur`                |
| `data-corners`    | `jflipbook/corners`                |
| `data-scale`      | `jflipbook/scale`                  |

Ces valeurs sont lues par `javascript/jflipbook_init.js` lors de l'initialisation du livre.

---

## Intégration dans un squelette

### Exemple minimal dans `article.html`

```html
<!-- Insertion du jFlipBook -->
<INCLURE{fond=jflipbook}{id_article}>
```

### Exemple complet (voir `article-exemple.html`)

Le fichier `article-exemple.html` fourni avec le plugin est un squelette d'article SPIP complet montrant l'intégration du jFlipBook aux côtés du texte, des documents et d'une éventuelle pétition.

### Rendu HTML généré

```html
<div class="divers flip_gallery">
    <h4>
        <img src="…/img_pack/jflip.png" … />
        Livre jFlip de N image(s)
    </h4>
    <small>Cliquez dans un des coins de l'image pour tourner les pages.</small>
    <ul class="jflipbook"
        data-largeur="450"
        data-hauteur="500"
        data-couleur="#ccc"
        data-corners="0"
        data-scale="fit">
        <li>
            <a href="URL_DOCUMENT" title="Titre">
                <img src="…" … />
            </a>
        </li>
        <!-- … autres pages … -->
    </ul>
</div>
```

---

## Structure du plugin

```
jflipbook/
├── paquet.xml                          Déclaration du plugin (métadonnées, pipelines, menu)
├── jflipbook_pipelines.php             Pipelines SPIP (CSS et JS)
├── jflipbook_head.php                  Ancienne inclusion d'entête (héritage)
├── jflipbook.html                      Modèle principal du livre (fond=jflipbook)
├── article-exemple.html                Exemple de squelette d'article avec jFlipBook
├── LICENSE                             Licence GPL
│
├── css/
│   └── jflip_style.css                 Styles du composant (canvas, galerie)
│
├── exec/
│   └── jflipbook.php                   Page d'administration (espace privé)
│
├── fonds/
│   └── cfg_jflipbook.html              Ancien formulaire de configuration (héritage)
│
├── formulaires/
│   ├── configurer_jflipbook.html       Formulaire de configuration (vue)
│   └── configurer_jflipbook.php        Formulaire de configuration (contrôleur : charger/vérifier/traiter)
│
├── img_pack/
│   └── jflip.png                       Icône du plugin
│
├── javascript/
│   ├── jquery.browser-compat.js        Correctif de compatibilité jQuery ($.browser)
│   ├── jquery.jflip-0.3.min.js         Bibliothèque jFlip (minifiée)
│   └── jflipbook_init.js               Initialisation automatique des livres sur la page
│
├── lang/
│   └── jflipbook_fr.php                Chaînes de traduction (français)
│
└── prive/
    └── squelettes/
        └── contenu/
            └── configurer_jflipbook.html  Squelette de la page de configuration (espace privé)
```

### Pipelines utilisés

| Pipeline         | Fonction                                      |
|------------------|-----------------------------------------------|
| `insert_head_css`  | Injecte `css/jflip_style.css` dans le `<head>` |
| `jquery_plugins`   | Enregistre les trois scripts JS dans l'ordre  |

### Ordre de chargement des scripts JavaScript

1. `javascript/jquery.browser-compat.js` — correctif `$.browser` supprimé dans jQuery 1.9+
2. `javascript/jquery.jflip-0.3.min.js` — moteur du livre interactif
3. `javascript/jflipbook_init.js` — cherche tous les `.jflipbook` dans la page et appelle `.jFlip()`

L'initialisation est également branchée sur le hook `onAjaxLoad` de SPIP pour prendre en charge les contenus chargés en AJAX.

---

## Internationalisation

Les chaînes de traduction sont stockées dans `lang/jflipbook_<code_langue>.php`.  
Seul le français (`jflipbook_fr.php`) est fourni dans cette version.

Pour ajouter une langue, créer le fichier `lang/jflipbook_<code>.php` en respectant la structure suivante :

```php
<?php
if (!defined('_ECRIRE_INC_VERSION')) { return; }

$GLOBALS[$GLOBALS['idx_lang']] = [
    'configurer_titre' => 'Configure jFlipBook',
    'largeur'          => 'Book width (px)',
    'hauteur'          => 'Book height (px)',
    'couleur'          => 'Page background colour',
    'coins'            => 'Interactive corners position',
    'scale'            => 'Image resizing',
    'fill'             => 'Resize keeping aspect ratio',
    'fit'              => 'Resize only oversized images',
    'noresize'         => 'Do not resize images',
    'false'            => 'Bottom left and right',
    'true'             => 'Top left and right',
    // … messages d'erreur …
];
```

---

## Développement & contribution

### Validation du formulaire de configuration

Le contrôleur `formulaires/configurer_jflipbook.php` applique les règles suivantes :

- `largeur` et `hauteur` : entiers ≥ 100
- `couleur` : expression régulière `/^#?[0-9a-fA-F]{3,8}$/`
- `corners` : valeur parmi `['0', '1']`
- `scale` : valeur parmi `['noresize', 'fit', 'fill']`

### Contribuer

Les contributions (traductions, corrections, nouvelles fonctionnalités) sont les bienvenues sur la page officielle du plugin :  
👉 https://contrib.spip.net/jFlipBook

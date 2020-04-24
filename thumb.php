<?php
// Thumb = thumbnail (timbre poste)
// Prendre reg.jpg
// Générer une miniature carrée de 200x200px
// Son nom devra être reg-200x200;jpg

// nom de fichier de l'image
$nom = 'reg.jpg';

// "Créer" le nom complet de l'image (chemin + nom de fichier)
$nomComplet = __DIR__ . '/uploads/' . $nom;

// On récupère les informations de l'image
$infosImage = getimagesize($nomComplet);

// Définition des dimensions de l'image "finale"
$largeurFinale = 200;
$hauteurFinale = 200;

// On crée l'image de destination vide 'en mémoire RAM"
$imageDest = imagecreatetruecolor($largeurFinale, $hauteurFinale);

// On charge l'image source en mémoire (en fonction de son type)
switch($infosImage['mime']){
    case 'image/jpeg' :
        $imageSrc = imagecreatefromjpeg($nomComplet);
        break;

    case 'image/png':
        $imageSrc = imagecreatefrompng($nomComplet);
        break;

    case 'image/gif':
        $imageSrc = imagecreatefromgif($nomComplet);
        break;
}

// On initialise les décalages et on gère le cas "image carrée"
$decalageX = 0;
$decalageY = 0;

// Si largeur > hauteur
if($infosImage[0] > $infosImage[1]){
    // Image paysage
    // On calcule le décalageX = (largeurImage - largeurCarré) / 2
    $decalageX = ($infosImage[0] - $infosImage[1]) / 2;
    $tailleCarreSrc = $infosImage[1];
}

// Si largeur < hauteur
if($infosImage[0] <= $infosImage[1]){
    // Image portrait
    //hauteurCarré = largeur
    // DecalageY = (hauteurImage - hauteurCarré) / 2
    $decalageY = ($infosImage[1] - $infosImage[0]) / 2;
    $tailleCarreSrc = $infosImage[0];
}

// Copier le contenu du carré source dans le carré destination
imagecopyresampled(
    $imageDest, // Image dans laquelle on copie l'image d'origine
    $imageSrc, // Image d'origine
    0, // Décalage horizontal dans l'image de destination
    0, // Décalage vertical dans l'image de destination
    $decalageX, // Décalage horizontal dans l'image source
    $decalageY, // Décalage vertical dans l'image source
    $largeurFinale, // Largeur de la zone cible dans l'image de destination
    $hauteurFinale, // Hauteur de la zone cible dans l'image de destination
    $tailleCarreSrc, // Largeur de la zone cible dans l'image source
    $tailleCarreSrc // Hauteur de la zone cible dans l'image source
);

// On enregistre l'image de destination
// On définit le chemin d'enregistrement et le nom du fichier destination
$nomDest = __DIR__ . '/uploads/' . 'reg-200x200.' ;

// On enregistre physiquement 
switch($infosImage['mime']){
    case 'image/jpeg' :
        imagejpeg($imageDest, $nomDest .'jpg');
        break;

    case 'image/png' :
        imagepng($imageDest, $nomDest .'png');
        break;

    case 'image/gif' :
        imagegif($imageDest, $nomDest . 'gif');
        break;
}

// On détruit les images "en mémoire RAM"
imagedestroy($imageDest);
imagedestroy($imageSrc);
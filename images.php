<?php
// On va redimensionner l'image da4eba186b58b509ad8936661debea82.jpg
// Réduction de moitié

// nom de fichier de l'image
$nom = 'da4eba186b58b509ad8936661debea82.jpg';

// "Créer" le nom complet de l'image (chemin + nom de fichier)
$nomComplet = __DIR__ . '/uploads/' . $nom;

// On récupère les informations de l'image
$infosImage = getimagesize($nomComplet);

// Définition des dimensions de l'image "finale"
$largeurFinale = $infosImage[0]/2; // [0] -> largeur
$hauteurFinale = $infosImage[1]/2; // [1] -> hauteur

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

// Copier l'image source dans l'image dans l'image destination
imagecopyresampled(
    $imageDest, // Image dans laquelle on copie l'image d'origine
    $imageSrc, // Image d'origine
    0, // Décalage horizontal dans l'image de destination
    0, // Décalage vertical dans l'image de destination
    0, // Décalage horizontal dans l'image source
    0, // Décalage horizontal dans l'image source
    $largeurFinale, // Largeur de la zone cible dans l'image de destination
    $hauteurFinale, // Hauteur de la zone cible dans l'image de destination
    $infosImage[0], // Largeur de la zone cible dans l'image source
    $infosImage[1] // Hauteur de la zone cible dans l'image source
);

// On enregistre l'image de destination
// On définit le chemin d'enregistrement et le nom du fichier destination
$nomDest = __DIR__ . '/uploads/' . 'fichierreduit.' ;

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
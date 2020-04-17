<?php
// On veut lire un fichier "fichier.txt" et afficher son contenu dans la page

$fichier = fopen('fichier.txt','r');

// On verrouille le fichier
flock($fichier, LOCK_SH);
// A partir d'ici on a un accès partagé au fichier

// On lit le fichier
echo fread($fichier, filesize('fichier.txt'));

// On dévérouille le fichier
flock($fichier, LOCK_UN);

// On ferme le fichier
fclose($fichier);
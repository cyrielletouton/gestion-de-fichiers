<?php
// On veut créer un fichier "fichier.txt" et écrire "Bonjour" dedans

$fichier = fopen('fichier.txt','a');

// On verrouille le fichier
flock($fichier, LOCK_EX);
// A partir d'ici j'ai un accès exclusif au fichier

// On écrit dans le fichier
fwrite($fichier, "Bonjour ");

// On dévérouille le fichier
flock($fichier, LOCK_UN);

// On ferme le fichier
fclose($fichier);
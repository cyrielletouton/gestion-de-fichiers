<?php

// On crée un dossier "uploads" si il n'existe pas
if (!file_exists('uploads')){
    mkdir('uploads');
}

// On créé un fichier "travail.txt" dans uploads
$fichier = fopen('uploads/travail.txt', 'w');
fclose($fichier);

// Afficher la liste des fichiers contenus dans "uploads"
$contenus = scandir('uploads');
foreach($contenus as $contenu){
    echo "<p>$contenu</p>";
}

// Supprimer le fichier travail.txt dans uploads
if(file_exists('uploads/travail.txt')){
    unlink('uploads/travail.txt');
}



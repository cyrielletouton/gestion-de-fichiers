<?php
// Créer un formulaire HTML contenant un bouton "Parcourir" permettant d'aller sélectionner un fichier
// Traiter le formulaire et stocker le fichier dans le dossier "uploads"

// Traitement du formulaire
if(isset($_FILES) && !empty($_FILES)){
    // On vérifie que tous les fichiers attendus sont envoyés
    if(isset($_FILES['fichier']) && !empty($_FILES['fichier'])){
        // On récupère les données
        $fichier = $_FILES['fichier'];

        // On vérifie si le transfert s'est mal déroulé 'error' = 1
        if($fichier['error'] != 0){
            echo 'Une erreur s\'est produite, devinez laquelle';
            die;
        }

        // On limite aux images png et jpg (jpeg aussi)
        $types = ['image/png', 'image/jpeg'];

        // On vérifie si le type du fichier est absent de la liste
        if(!in_array($fichier['type'], $types)){
            echo "Le type de fichier doit être une image jpg ou png";
            die;
        }

        // On veut limiter la taille à 1Mo max
        if($fichier['size'] > 1048576){
            echo 'Le fichier est trop volumineux (1Mo maxi)';
        die;
        }

        // Le transfert s'est bien déroulé, on déplace l'image temporaire après lui avoir généré un nouveau nom
        // Générer un nom pour le fichier -> nom + extension
        // On récupère l'extension de notre fichier
        $extension = pathinfo($fichier['name'], PATHINFO_EXTENSION);

        // On génère un nom  "aléatoire"
        $nom = md5(uniqid()) . '.' .$extension ;

        // On génère le nom complet -> nom et chemin complet vers le dossier de destination
        $nomComplet = __DIR__ . '/uploads/' . $nom ;

        // On déplace le fichier
        if(!move_uploaded_file($fichier['tmp_name'], $nomComplet)){
            echo "Le fichier n'a pas été copié !";
            die;
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de fichiers</title>
</head>
<body>

    <h1>Upload de fichiers</h1>
    <!-- ATTENTION enctype obligatoire quand un champ "file" est utilisé -->
    <form method="post" enctype="multipart/form-data">
        <div>
            <label for="fichier">Fichier : </label>
            <input type="file" name="fichier" id="fichier" multiple>
        </div>
        <button>Envoyer le fichier</button>
    </form>
    
</body>
</html>
<?php
session_start();
ob_start();

?>

<?php

// Vérifie si le formulaire a été soumis avec un fichier
    if(isset($_FILES['file'])){
        // Récupère les informations du fichier téléchargé
        $tmpName = $_FILES['file']['tmp_name'];
        $name = $_FILES['file']['name'];
        $size = $_FILES['file']['size'];
        $error = $_FILES['file']['error'];
        $type = $_FILES['file']['type'];

        // Récupère l'extension du fichier
        $tabExtension = explode('.', $name);
        $extension = strtolower(end($tabExtension));

        // Liste des extensions autorisées
        $extensionAutorised = ['jpg', 'jpeg', 'gif', 'png'];

        // Taille maximale autorisée en octets
        $maxSize = 1000000000;

        // Vérifie si l'extension du fichier est autorisée, que la taille est inférieure à la limite et qu'il n'y a pas d'erreur lors du téléchargement
        if(in_array($extension, $extensionAutorised) && $size <= $maxSize && $error == 0){

            // Génère un nom unique pour le fichier
            $uniqueName = uniqid('', true);
            $fileName = $uniqueName.'.'.$extension;

            // Déplace le fichier téléchargé vers un dossier spécifié
            move_uploaded_file($tmpName, './upload/'.$fileName);
        }
        else{
            // Affiche un message d'erreur si les conditions ne sont pas remplies
            echo "un problème est survenu";
        }
    }

?>


<form action="uploadPic.php" method="POST" enctype="multipart/form-data">
        <label for="file">Fichier</label>
        <input type="file" name="file">
        <button type="submit">Enregistrer</button>
</form>


<?php

$content = ob_get_clean();
$title = "Ajout produit";
$totalQuantity = isset($_SESSION['totalQuantity']) ? $_SESSION['totalQuantity'] : 0;
require "template.php";
require "functions.php";
<?php

// il faudra redimensionner les images commes on le souhaite, mais de maniere lineaire pour ne pas la defformer
// on pourra aussi si on le souhaite mettre ce code sous la forme d'une fonction pour que se soit plus simple

// On récupère les dimensions de l'image
$dimensions = getimagesize($_FILES['avatar']['tmp_name']);
$width_orig = $dimensions[0];
$height_orig = $dimensions[1];
 
// On vérifie si les dimensions sont inférieures à 500*500px
if($width_orig<=500 AND $height_orig<=500)
{
    // On supprime le fichier existant
    $fichiers = glob('/photos/' . $_SESSION['id'] . '.*');
    foreach($fichiers as $fichier)
    {
        unlink($fichier);
    }
     
    // On télécharge et on enregistre le fichier envoyé via profil.php
    $nom_fichier = $_FILES['avatar']['name'];
    $nom_fichier = preg_replace('#(.+)(\.(jpg|jpeg|gif|png))$#', $_SESSION['id'] . '$2', $nom_fichier);
     
    move_uploaded_file($_FILES['avatar']['tmp_name'], 'photos/' . $nom_fichier);
     
    // On redimensionne le fichier si différent de 70*70px
    if($width_orig != 70 OR $height_orig != 70)
    {
        // Le fichier
        $filename = './photos/' . $nom_fichier;
 
        // Définition de la largeur et de la hauteur maximale
        $width = 70;
        $height = 70;
 
        // Cacul des nouvelles dimensions
        $ratio_orig = $width_orig/$height_orig;
 
        if ($width/$height > $ratio_orig)
        {
           $width = $height*$ratio_orig;
        }
        else
        {
           $height = $width/$ratio_orig;
        }
 
        // Redimensionnement
        $image_p = imagecreatetruecolor($width, $height);
        $image = imagecreatefrompng($filename);
        imagecopyresampled($image_p, $image, 0, 0, 0, 0, $width, $height, $width_orig, $height_orig);
         
    }
    else
    {
        header('Location: profil.php?info=ok');
    }
    header('Location: profil.php?info=ok');
}
else
{
    header('Location: profil.php?info=size');
}

?>
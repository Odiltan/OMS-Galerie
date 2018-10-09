<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
if(($_GET['action'] == "add-galerie") && !empty($_POST))  
{ 

 
    $titre = $connexion->quote(utf8_decode($_POST['titre'])); 
    $description = $connexion->quote(utf8_decode('<p>'.$_POST['description'].'</p>')); 
 
        $count = $connexion->exec("INSERT INTO `galerie` (`id`, `titre`, `description`, `date_mel`)                          VALUES (NULL, $titre, $description, NOW());"); 
 
    $idGalerie = $connexion->lastInsertId(); 
 
    $pathDossierGalerie = 'galerie/'.$idGalerie.'/'; 
 
    if(!@mkdir($pathDossierGalerie, 0755)); 
    if(!@mkdir($pathDossierGalerie.'min/', 0755)); 
 
    if($_FILES["miniature"]["error"]==0) 
    { 
        require('include/classImg.php'); 
 
        $img = $_FILES['miniature']; 
 
        $ext = strtolower(substr($img['name'],-3)); 
        $imgNomFichier = 'miniature.'.$ext; 
 
        $pathImage = $pathDossierGalerie.$imgNomFichier; 
 
        move_uploaded_file($img['tmp_name'], $pathImage); 
 
        Img::creerMin($pathImage, $pathDossierGalerie, $imgNomFichier, 700, 300); 
 
        if($ext != "jpg") unlink($pathImage); 
 
            $updateMiniature = $connexion->prepare('UPDATE `galerie`                                                  SET `miniature` = \'miniature.jpg\'                                                  WHERE `galeries`.`id` = :id_galerie LIMIT 1 ;'); 
        $updateMiniature->bindParam(':id_galerie', $idGalerie, PDO::PARAM_INT); 
        $updateMiniature->execute(); 
    } 
 
echo '<meta http-equiv="refresh" content="0; url=galerie-add-photos.php?idGalerie='.$idGalerie.'" />'; 
}
?>

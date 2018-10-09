<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php include('header.inc.php');  
 
    $idGalerie = $_GET['id']; 
 
         
    $resultats=$connexion->query("SELECT * FROM galerie WHERE id = $idGalerie             ");  
    $resultats->setFetchMode(PDO::FETCH_OBJ); 
     
    $galerie = $resultats->fetch(); 
     
    $titre = utf8_encode($galerie->titre); 
    $description = utf8_encode($galerie->description); 
     
    $pathDossierGalerie = 'galerie/'.$galerie->id.'/'; 
    $pathDossierMiniatures = $pathDossierGalerie.'min/'; 
     
      
    $images = array(); 
     
    $resultats=$connexion->query("SELECT * FROM images WHERE galerie_id = $idGalerie              ");  
    $resultats->setFetchMode(PDO::FETCH_OBJ); 
     
    while($image = $resultats->fetch()) { 
     
        $srcMiniature = $pathDossierMiniatures.$image->id.'.'.$image->extension; 
        $commentaire = utf8_encode($image->commentaire); 
         
        $images[] = array('path' => $srcMiniature, 'commentaire' => $commentaire); 
    } 
     
    
  ?> 
 
<div class="row"> 
    <div class="col-lg-12"> 
        <h1 class="page-header"><?php echo $titre; ?> <small><?php echo $description; ?></small></h1> 
    </div> 
</div> 
 
 
 
 <div class="row"> 
 
<?php 
     $i = 0; 
    foreach($images as $img) { 
        $i++; 
    ?> 
        <div class="col-md-3 portfolio-item"> 
            <a href="<?php echo $img['path']; ?>"> 
                <img class="img-responsive" src="<?php echo $img['path']; ?>"  
                     title="<?php echo $img['commentaire']; ?>" alt="" /> 
            </a> 
        </div> 
 
    <?php 
        if($i==4) { 
            echo '</div>'; 
            echo '<div class="row">'; 
            $i=0; 
        } 
    } 
     
if (count($images) == 0) { 
         
       echo '<div class="alert alert-info" role="alert">'; 
       echo '<p>La galerie ne contient aucune image.              </p>'; 
       echo '</div>'; 
    } 
?> 
 
</div> 

<?php include('footer.inc.php'); ?> 

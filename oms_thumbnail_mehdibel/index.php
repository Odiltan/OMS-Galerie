<!DOCTYPE html>
<html lang="fr">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Galerie OMS</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/thumbnail-gallery.css" rel="stylesheet">

  </head>

<!--  <body>

     Navigation 
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Home
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">About</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Services</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

     Page Content 
    <div class="container">

      <h1 class="my-4 text-center text-lg-left">Thumbnail Gallery</h1>

      <div class="row text-center text-lg-left">

        <div class="col-lg-3 col-md-4 col-xs-6">
          <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="http://placehold.it/400x300" alt="">
          </a>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-6">
          <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="http://placehold.it/400x300" alt="">
          </a>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-6">
          <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="http://placehold.it/400x300" alt="">
          </a>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-6">
          <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="http://placehold.it/400x300" alt="">
          </a>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-6">
          <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="http://placehold.it/400x300" alt="">
          </a>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-6">
          <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="http://placehold.it/400x300" alt="">
          </a>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-6">
          <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="http://placehold.it/400x300" alt="">
          </a>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-6">
          <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="http://placehold.it/400x300" alt="">
          </a>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-6">
          <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="http://placehold.it/400x300" alt="">
          </a>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-6">
          <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="http://placehold.it/400x300" alt="">
          </a>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-6">
          <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="http://placehold.it/400x300" alt="">
          </a>
        </div>
        <div class="col-lg-3 col-md-4 col-xs-6">
          <a href="#" class="d-block mb-4 h-100">
            <img class="img-fluid img-thumbnail" src="http://placehold.it/400x300" alt="">
          </a>
        </div>
      </div>

    </div>
     /.container 

     Footer 
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2017</p>
      </div>
       /.container 
    </footer>

     Bootstrap core JavaScript 
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>-->

<!DOCTYPE html> 
   <html lang="fr"> 
      <head> 
… 
      </head> 
   
      <body> 
 
         <div class="container"> 
 
            <div class="masthead"> 
               <h3 class="text-muted">OMS De Nantes !!!</h3> 
               <nav> 
                  <ul class="nav nav-justified"> 
                     <li class="active"><a href="index.php">Acceuil </a></li> 
                     <li><a href="liste-galeries.php"> Galerie Photos </a></li> 
                     <li><a href="admin-index.php"> Adminstrateur </a></li> 
                  </ul> 
               </nav> 
            </div>   
             <?php include("header.inc.php"); ?>
  <?php 
 
 $PARAM_hote='localhost'; // le chemin vers le serveur 
 $PARAM_port='3306'; // numéro de port 
 $PARAM_nom_bd='omsdb_belhaj'; // le nom de votre base de données 
 $PARAM_utilisateur='Belhaj'; // nom d'utilisateur pour se connecter 
 $PARAM_mot_passe='Nantes44'; // mot de passe de l'utilisateur pour se connecter 
  
 $connexion = new PDO('mysql:host='.$PARAM_hote.';port='.$PARAM_port.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe); 
 
?> 
             
            <div class="row"> 
 
                 <?php 
  $resultats=$connexion->query("SELECT * FROM `galeries`");  
  $resultats->setFetchMode(PDO::FETCH_OBJ);  
 
  while( $galeries = $resultats->fetch() )
  { 
   $path = 'galeries/'.$galeries->id.'/';  
   $pathImg = 'galeries/'.$galeries->id.'/gal-'.$galeries->id.'.jpg';  
 ?>
               <div class="col-lg-4 text-center"> 
                  <a href="galerie-1.php">
                      <img class="img-circle" src="<?php echo $pathImg; ?>" alt=""></a> 
                  <h2><?php echo $galeries->titre; ?></h2> 
                  <p><?php echo $galeries->description; ?></p> 
                  <p><a class="btn btn-default" href="galerie-1.php" role="button">Voir PLus &raquo;</a></p> 
               </div> 
<?php
  }
  ?>
            </div> 
 <?php include("footer.inc.php");?>
         </div>   
 
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
         <script src="js/bootstrap.min.js"></script> 
         <script src="vendor/jquery/jquery.min.js"></script>
         <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
 
      </body> 
   </html>

</html>

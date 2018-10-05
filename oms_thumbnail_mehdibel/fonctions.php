<?php

/*** fonction de conversions dates / heures ******************************************************/

    // décalage de la date du jour de n jours (positifs ou négatifs, format MySQL Y-m-d)
    function move_date($nJours)
    {
        $date = strftime("%Y-%m-%d", mktime(0, 0, 0, date('m'), date('d')+$nJours, date('Y')));
        return $date;
    }



    function convert_dateSQL($date_php)
    {
        $tableau = explode ("/" , $date_php);
        $date_sql = $tableau[2]."-".$tableau[1]."-".$tableau[0];
        return $date_sql; 
    }

    function convert_datePHP($date_sql)
    {
        $tableau = explode ("-" , $date_sql);
        $date_php = date("d/m/Y" , mktime(0 , 0 , 0 , $tableau[1] , $tableau[2] , $tableau[0]));
        return $date_php; 
    }

    function convert_date($date_mysql)
    {
        $tableau = explode ("-" , $date_mysql);
        $date_php = date("d/m/Y" , mktime(0 , 0 , 0 , $tableau[1] , $tableau[2] , $tableau[0]));
        return $date_php; 
    }

    function convert_date_heure($date_mysql)
    {
        $tableau_DH = explode (" " , $date_mysql);
        $la_date = convert_date($tableau_DH[0]);
        $tableau_H = explode (":" , $tableau_DH[1]);
        $heure = $tableau_H[0].':'.$tableau_H[1];
        $chaine_DH = $la_date." à ".$heure;

        return $chaine_DH; 
    }

    function recup_heure($date_mysql)
    {
        $tableau_DH = explode (" " , $date_mysql);
        $tableau_H = explode (":" , $tableau_DH[1]);
        $heure = $tableau_H[0].':'.$tableau_H[1];

        return $heure; 
    }

/*** Fonctions ***********************************************************************/

	function stripAccents($string) {
		return strtr($string,'àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ',
	'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
	}

	function stripEspaces($string) {
		return strtr($string,' ', '_');
	}
	
	function stripGuillemets($string) {
		return str_replace('"', '&quot;', $string);
	}
	

	function getExtensionFichier($file)
	{
		$ext = substr(strtolower(strrchr(basename($file), ".")), 1);
		return $ext;
	}

	function tranfererFichier($tabFichier, $repertoire_destination)
	{
		$file_upload = stripAccents($tabFichier['name']);
		
		// on copie le fichier que l'on vient d'uploader dans le répertoire de destination
		copy ($tabFichier['tmp_name'], $repertoire_destination.'/'.$file_upload); 
	}  



	function supprimerFichier($repertoire_destination, $fichier)
	{
		unlink($repertoire_destination."/".$fichier);
	}

	function supprimerPhoto($idGalerie, $fichier)
	{
		supprimerFichier("galeries/galerie_".$idGalerie, $fichier);
		supprimerFichier("galeries/galerie_".$idGalerie."/min", $fichier);
	}
	


	function tranfererImage($tabImage, $repertoire_destination, $hImage)
	{
		// on défini la hauteur de l'image réduite à créer  
		$ratioMiniature = $hImage;
		
		// on récupère des informations sur le fichier transféré
		$tableau = @getimagesize($tabImage['tmp_name']); 
		
		if ($tableau == FALSE) { 
			unlink($tabImage['tmp_name']);
			/** exception <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/
			// le fichier uploadé n'est pas une image 
			exit('Le type du fichier n\'est pas reconnu comme image.');
		}

		if ($tableau[2] != 2 && $tableau[2] != 3) {
			/** exception <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/
			// L'image n'est pas de type jpeg ou png
			exit('Vous ne pouvez transférer que des images au format jpeg ou png.');
			unlink($tabImage['tmp_name']);
		}
	
		$file_upload = stripAccents($tabImage['name']);
		
		// on copie le fichier que l'on vient d'uploader dans le répertoire de destination
		copy ($tabImage['tmp_name'], $repertoire_destination.'/'.$file_upload); 
		
		// Création des images réduites : 
		
		// *** si notre image est de type jpeg 
		if ($tableau[2] == 2) { 
			// on crée une image à partir de notre grande image à l'aide de la librairie GD 
			$src = imagecreatefromjpeg($repertoire_destination.'/'.$file_upload); 

			// $tableau[0] -> largeur de l'image d'origine
			// $tableau[1] -> longueur de l'image d'origine
			
			if($tableau[1] < $hImage) {
				$largeurMini = $tableau[0];
				$hauteurMini = $tableau[1];
				
				// on copie notre fichier généré dans le répertoire de destination 
				imagejpeg ($src, $repertoire_destination.'/'.$file_upload); 
			}
			else {
				$largeurMini = round(($tableau[0]*$hImage)/$tableau[1]);
				$hauteurMini = $hImage;
				
				$imMiniature = imagecreatetruecolor($largeurMini, $hauteurMini); 
				imagecopyresampled($imMiniature, $src, 0, 0, 0, 0, $largeurMini, $hauteurMini, $tableau[0], $tableau[1]);
	
				// on copie notre fichier généré dans le répertoire de destination 
				imagejpeg ($imMiniature, $repertoire_destination.'/'.$file_upload); 
			}
			
			imagedestroy($src);
		} 
	}  



	/*** 
			Fonction ajoutée pour le transfert de photos de galeries photos.
			dernière fonction MAJ
	***/
	function tranfererImageGalerie($tabImage, $repertoire_destination, $hImage)
	{
		// on défini la hauteur de l'image réduite à créer  
		$ratioMiniature = $hImage;
		
		// on récupère des informations sur le fichier transféré
		$tableau = @getimagesize($tabImage['tmp_name']); 
		
		if ($tableau == FALSE) { 
			unlink($tabImage['tmp_name']);
			/** exception <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/
			// le fichier uploadé n'est pas une image 
			exit('Le type du fichier n\'est pas reconnu comme image.');
		}

		if ($tableau[2] != 2 && $tableau[2] != 3) {
			/** exception <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/
			// L'image n'est pas de type jpeg ou png
			exit('Vous ne pouvez transférer que des images au format jpeg ou png.');
			unlink($tabImage['tmp_name']);
		}
	
		$file_upload = stripAccents($tabImage['name']);
		
		// on copie le fichier que l'on vient d'uploader dans le répertoire de destination
		copy ($tabImage['tmp_name'], $repertoire_destination.'/'.$file_upload); 
		
		// Création des images réduites : 
		
		// *** si notre image est de type jpeg 
		if ($tableau[2] == 2) { 
			// on crée une image à partir de notre grande image à l'aide de la librairie GD 
			$src = imagecreatefromjpeg($repertoire_destination.'/'.$file_upload); 

			// $tableau[0] -> largeur de l'image d'origine
			// $tableau[1] -> longueur de l'image d'origine
			
			if($tableau[1] < $hImage) {
				$largeurMini = $tableau[0];
				$hauteurMini = $tableau[1];
				
				// on copie notre fichier généré dans le répertoire de destination 
				imagejpeg ($src, $repertoire_destination.'/'.$file_upload); 
			}
			else {
				$largeurMini = round(($tableau[0]*$hImage)/$tableau[1]);
				$hauteurMini = $hImage;
				
				$imMiniature = imagecreatetruecolor($largeurMini, $hauteurMini); 
				imagecopyresampled($imMiniature, $src, 0, 0, 0, 0, $largeurMini, $hauteurMini, $tableau[0], $tableau[1]);
	
				// on copie notre fichier généré dans le répertoire de destination 
				imagejpeg ($imMiniature, $repertoire_destination.'/'.$file_upload); 
			}
			
			imagedestroy($src);
		} 
	}  




	function tranfererImageBIS($tabImage, $repertoire_destination, $mini) // fonction d'origine
	{
		if(!@mkdir("galerie/".$repertoire_destination."big/", 0755));
		if(!@mkdir("galerie/".$repertoire_destination."small/", 0755));
	
		// on défini le répertoire où sont stockées les images de grande taille  
		$dir_big = $repertoire_destination."big/";  
		
		// on défini le répertoire où seront stockées les miniatures  
		$dir_mini = $repertoire_destination."small/";  
		
		// on défini les hauteurs des images réduites à créer  
		$ratioBig = 221;  
		$ratioSmall = 68;  
		$ratioMiniature = 53;  // image pour les annonces par liste
		
		// on récupère des informations sur le fichier transféré
		$tableau = @getimagesize($tabImage['tmp_name']); 
		
		if ($tableau == FALSE) { 
			unlink($tabImage['tmp_name']);
			/** exception <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/
			// le fichier uploadé n'est pas une image 
			exit('Le type du fichier n\'est pas reconnu comme image.');
		}

		if ($tableau[2] != 2 && $tableau[2] != 3) {
			/** exception <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<*/
			// L'image n'est pas de type jpeg ou png
			exit('Vous ne pouvez transférer que des images au format jpeg ou png.');
			unlink($tabImage['tmp_name']);
		}
	
		$file_upload = stripAccents($tabImage['name']);
		
		// on copie le fichier que l'on vient d'uploader dans le répertoire de destination
		copy ($tabImage['tmp_name'], $repertoire_destination.'/'.$file_upload); 
		
		// Création des images réduites : 
		
		// *** si notre image est de type jpeg 
		if ($tableau[2] == 2) { 
			// on crée une image à partir de notre grande image à l'aide de la librairie GD 
			$src = imagecreatefromjpeg($repertoire_destination.'/'.$file_upload); 

			$imBig = imagecreatetruecolor(round(($tableau[0]*$ratioBig)/$tableau[1]), $ratioBig); 
			imagecopyresampled($imBig, $src, 0, 0, 0, 0, round(($tableau[0]*$ratioBig)/$tableau[1]), $ratioBig, $tableau[0],$tableau[1]);

			// on copie notre fichier généré dans le répertoire des miniatures 
			imagejpeg ($imBig, $dir_big.'/'.$file_upload); 

			$imSmall = imagecreatetruecolor(round(($tableau[0]*$ratioSmall)/$tableau[1]), $ratioSmall); 
			imagecopyresampled($imSmall, $src, 0, 0, 0, 0, round(($tableau[0]*$ratioSmall)/$tableau[1]), $ratioSmall, $tableau[0],$tableau[1]);

			// on copie notre fichier généré dans le répertoire des miniatures 
			imagejpeg ($imSmall, $dir_mini.'/'.$file_upload); 

			if($mini) {
				$imMiniature = imagecreatetruecolor(round(($tableau[0]*$ratioMiniature)/$tableau[1]), $ratioMiniature); 
				imagecopyresampled($imMiniature, $src, 0, 0, 0, 0, round(($tableau[0]*$ratioMiniature)/$tableau[1]), $ratioMiniature, $tableau[0],$tableau[1]);

				// on copie notre fichier généré dans le répertoire de destination 
				imagejpeg ($imMiniature, $repertoire_destination.'/'.$file_upload); 
			}

			imagedestroy($src);
			if(!$mini) unlink($repertoire_destination.'/'.$file_upload); 
		} 
	}  



	function clearDir($dossier) {
			
		$ouverture=@opendir($dossier);

		if (!$ouverture) return;

		while($fichier=readdir($ouverture)) {
			if ($fichier == '.' || $fichier == '..') continue;
			if (is_dir($dossier."/".$fichier)) {
				$r=clearDir($dossier."/".$fichier);
				if (!$r) return false;
			}
			else {
				$r=@unlink($dossier."/".$fichier);
				if (!$r) return false;
			}
		}

		closedir($ouverture);
		$r=@rmdir($dossier);
		
		if (!$r) return false;
		return true;
	}



function supprimer_repertoire($dir)  
{ 
	$current_dir = opendir($dir); 
	while($entryname = readdir($current_dir))  
	{ 
		if(is_dir("$dir/$entryname") and ($entryname != "." and $entryname!=".."))  
		{ 
			supprimer_repertoire("${dir}/${entryname}"); 
		}  
		elseif($entryname != "." and $entryname!="..") 
		{ 
			unlink("${dir}/${entryname}"); 
		} 
	} //Fin tant que 
	closedir($current_dir); 
	rmdir(${dir}); 
} 


?>
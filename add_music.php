<?php
session_start();
require('config/config.php');
require('model/functions.fn.php');

if( isset($_FILES['music']) && !empty($_FILES['music']) && 
	isset($_POST['title']) && !empty($_POST['title'])){
	
	$file = $_FILES['music'];

	if (is_file($destination)){

			// Si le "fichier" reçu est bien un fichier
		$ext = strtolower(substr(strrchr($file['name'], '.')  ,1));
		// Vérification des extentions
		if (preg_match('/\.(mp3|ogg)$/i', $file['name'])) {
			$filename = md5(uniqid(rand(), true));
			$destination = "musics/{$filename}.{$_SESSION['id']}.{$ext}";
 
			exec('INSERT INTO IIM_GIT_SoundCloud(title,file) VALUES($filename,$destination)');
			
		} else {
			$error = 'Erreur, le fichier n\'a pas une extension autorisée !';
		}
	// }

	}

	else{
		$error = 'Erreur, le fichier n\'est pas un véritable fichier !';
	}

}

include 'view/_header.php';
include 'view/add_music.php';
include 'view/_footer.php';
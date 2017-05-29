<?php //fichier : library/config/function.php

function redirect($url){
	header('Location: '.$url);
	exit();

}

function dateEU($in, $hour = false){
	
	//si $in est vide
	if (empty($in)) {

		//on renvoie un msg particulier
		return 'NC';

	//sinon
	}else{

		//on cree un objet temporel pour la date donnee en parametre
		$date = new DateTime($in);

		//si on a demande l'heure
		if ( $hour == true) {

			return $date->format('d/m/Y, à H:i:s');
			
		}else

		//on retourne le format qui nous interesse
		return $date->format('d/m/Y');
	}
}

function image($filename, $back = false){

	$root = '';

	//si back
	if($back)
			$root = '../';

	//si le filename est vide
	if (empty($filename)) {
		
		//on retourne l'image oar defaut
		return $root.'img/imageNotFound.jpg';
	
	//sinon
	}else{
		
		//on retourne le chemin vers l'image
		return $root.'data/'.$filename;
	}
}


/* fonction qui securise une chaine de caracteres (ex password) */
function cryptPassword($s){
	
	//on crypte une fois la chaine
	$version1 = hash('sha512', $s);
	
	//on salte (on ajoute un sel)
	$versionSalt = $version1.'$ùôfbzjhaf2';
	
	//on recrypte
	$versionFinale = hash('sha512', $versionSalt);
	return $versionFinale;

}

// var_dump(cryptPassword('Parisian_insider!0085'));


//function qui ajoute un msg dans la session
function flash_in($type, $message){

	//si le type de msg n'existe pas encore
	if(empty($_SESSION['message'][$type])){

		//on le cree
	$_SESSION['message'][$type] = [];

	//fin du test
	}

	//on ajoute le msg dans cette case
	array_push($_SESSION['message'][$type],$message);

}


//function qui affiche tous les msgs en attente, et les efface de la session
function flash_out(){

	//pour chaque type de msg
	foreach ($_SESSION['message'] as $key => $value) {
		
		//on parcourt toutes les cases de ce type de msg
		foreach ($value as $message) {
			
			//on affiche le msg
			echo '<p class="alert alert-'.$key.'">'.$message.'</p>';
		}
	}

	//on re-initialise les msgs a vide
	$_SESSION['message'] =[];
	
}
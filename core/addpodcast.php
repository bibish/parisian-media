<?php //fichier core/addinsider.php


//on doit inclure le fichier de config/setting.php
include('../config/config.php');


//si l'utilisateur n'est pas connecte
if(empty($_SESSION['user_id']))
	//on le redirige vers le login
	redirect('../back/login.php');


//si l'utilisateur n'a pas envoye le formulaire
if (empty($_POST))
	//on le renvoie sur la page formulaire
	redirect('../back/addpodcast.php');


$error = false;

//si le titre n'est pas rempli
if (empty($_POST['titre'])){
	//on cree un msg d'erreur
	flash_in('danger','Le titre est obligatoire.');
	$error = true;
}	

//si lle son titre est vide
if (empty($_POST['son_titre'])){
	//on cree un msg d'erreur
	flash_in('danger','Le titre du podcast est obligatoire.');
	$error = true;
}

//si la semaine est vide
if (empty($_POST['sous_titre'])){
	//on cree un msg d'erreur
	flash_in('danger','La date de la semaine est obligatoire.');
	$error = true;
}
//si le text est vide
if (empty($_POST['texte'])){
	//on cree un msg d'erreur
	flash_in('danger','Le texte est obligatoire.');
	$error = true;
}

//si on a recu un fichier
if($_FILES['son']['size'] > 0){

	//on verifie qu'il n'y a pas eu d'erreurs de transfert
	if($_FILES['son']['error'] != 0){
		$error = true;
		flash_in('danger','Le fichier est corrompu, essayez-en un autre.');
	}

	//on verifie que le fichier ne depasse pas le poids maximal
	if($_FILES['son']['error'] == 2 || $_FILES['son']['size'] > intval($_POST['MAX_FILE_SIZE'])){

		//on declenche une erreur
		$error = true;
		flash_in('danger','Le fichier doit faire moins de 15Mo.');
	}

	//on verifie qu'il a la bonne extension
	$extensionsValides = array('mp3', 'mp4', 'Ogg', 'WAVE', 'PCM', 'WebM');

	//on recupere l'extension du fichier envoye
	$filename = explode('.', strtolower($_FILES['son']['name']));
	$extensionFichier = $filename[count($filename) - 1];

	//si l'extension du fichier n'est pas dans le tableau
	if(!in_array($extensionFichier,$extensionsValides)){
		$error = true;
		flash_in('danger','Le fichier doit être au format Ogg, MP3, MP4, PCM, WebM ou WAVE. ');
	}

//fin fichier
}else{
		
	//on cree un msg d'erreur
	flash_in('danger','Le fichier audio est obligatoire.');
	$error = true;
}


//si on a trouve une erreur
if($error){
	//on va sur la page de form
	redirect('../back/addpodcast.php');

//sinon (tout est ok)
}else{

	//on prepare les variables de requete avec les donnees obligatoires
	$colonnes = 'titre, son_titre, sous_titre, texte ';
	$values = ':t, :st, :soust, :txt';
	$tab = array(
		':t' =>$_POST['titre'],
		':st' =>$_POST['son_titre'],
		':soust' =>$_POST['sous_titre'],		
		':txt' =>$_POST['texte']
	);

	//on teste tous les champs non obligatoires pour les ajouter a nnos variables de requete si besoin
	// if(!empty($_POST['personnes'])){
	// 	$colonnes .= ', personnes';	//$colonnes = $colonnes.',editor';
	// 	$values .= ', :perso';
	// 	$tab[':perso'] = $_POST['personnes'];
	// }

	if(!empty($_POST['x'])){
		$colonnes .= ', x';	
		$values .= ', :x';
		$tab[':x'] = $_POST['x'];
	}

	if(!empty($_POST['y'])){
		$colonnes .= ', y';	
		$values .= ', :y';
		$tab[':y'] = $_POST['y'];
	}
	if(!empty($_POST['facebook_link'])){
		$colonnes .= ', fb';	
		$values .= ', :fb';
		$tab[':fb'] = $_POST['facebook_link'];
	}

	
	//on lance la requete dans la base
	$insert = $mysql->prepare('INSERT INTO podcast ('.$colonnes.', updated_at) VALUES('.$values.', NOW() )');
	$insert->execute($tab);
	
	//on cree le msg de confirmation
	$id = $mysql->lastInsertId();



	//s'il y a un fichier
	if($_FILES['son']['size'] > 0){	

		//on cree le nouveau nom du fichier
		$nom = 'podcast-'.$id.'-'.time().'.'.$extensionFichier;

		//on deplace le fichier de la memoire temporaire vers le dossier final
		move_uploaded_file($_FILES['son']['tmp_name'],'../data/'.$nom);

		//on met a jour la base de donnees
		$son = $mysql->prepare('UPDATE podcast SET son = :urls WHERE id = :i');
		$son->execute(array(':urls' => $nom, ':i' => $id));

	//fin du test fichier
	}


	//on va sur la page de detail du livre qui vient d'etre cree
	flash_in('success','Le podcast a bien été ajouté.'); 

	//on va sur la page de detail du livre qui vient d'etre cree
	redirect('../back/podcast.php');

//fin du sinon (tout est OK)
}
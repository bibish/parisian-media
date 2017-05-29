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
	redirect('../back/addinsider.php');


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
	flash_in('danger','Le titre de l\'Insider est obligatoire.');
	$error = true;
}

//si lle son titre est vide
if (empty($_POST['sous_titre'])){
	//on cree un msg d'erreur
	flash_in('danger','La date de la semaine est obligatoire.');
	$error = true;
}
//si le text before est vide
if (empty($_POST['text_before'])){
	//on cree un msg d'erreur
	flash_in('danger','Le texte est obligatoire.');
	$error = true;
}
//si le text after est vide
if (empty($_POST['text_after'])){
	//on cree un msg d'erreur
	flash_in('danger','Le texte est obligatoire.');
	$error = true;
}

//si on a recu un fichier son
if($_FILES['son']['size'] > 0){

	//on verifie qu'il n'y a pas eu d'erreurs de transfert
	if($_FILES['son']['error'] != 0){
		$error = true;
		flash_in('danger','Le fichier audio est corrompu, essayez-en un autre.');
	}

	//on verifie que le fichier ne depasse pas le poids maximal
	if($_FILES['son']['error'] == 2 || $_FILES['son']['size'] > intval($_POST['MAX_FILE_SIZE'])){

		//on declenche une erreur
		$error = true;
		flash_in('danger','Le fichier audio doit faire moins de 15Mo.');
	}

	//on verifie qu'il a la bonne extension
	$extensionsValides_son = array('mp3', 'mp4');

	//on recupere l'extension du fichier envoye
	$filename_son = explode('.', strtolower($_FILES['son']['name']));
	$extensionFichier_son = $filename_son[count($filename_son) - 1];

	//si l'extension du fichier n'est pas dans le tableau
	if(!in_array($extensionFichier_son,$extensionsValides_son)){
		$error = true;
		flash_in('danger','Le fichier audio doit être au format mp3 ou mp4.');
	}

//fin fichier
}else if($_FILES['son']['error'] == 2){
	$error = true;
	flash_in('danger','Le fichier audio doit faire moins de 15Mo.');
}



//si on a recu un fichier image
if($_FILES['image']['size'] > 0){

	//on verifie qu'il n'y a pas eu d'erreurs de transfert
	if($_FILES['image']['error'] != 0){
		$error = true;
		flash_in('danger','Le fichier image est corrompu, essayez-en un autre.');
	}

	//on verifie que le fichier ne depasse pas le poids maximal
	if($_FILES['image']['error'] == 2 || $_FILES['image']['size'] > intval($_POST['MAX_FILE_SIZE'])){

		//on declenche une erreur
		$error = true;
		flash_in('danger','Le fichier image doit faire moins de 15Mo.');
	}

	//on verifie qu'il a la bonne extension
	$extensionsValides = array('jpg', 'jpeg', 'png', 'gif');

	//on recupere l'extension du fichier envoye
	$filename = explode('.', strtolower($_FILES['image']['name']));
	$extensionFichier = $filename[count($filename) - 1];

	//si l'extension du fichier n'est pas dans le tableau
	if(!in_array($extensionFichier,$extensionsValides)){
		$error = true;
		flash_in('danger','Le fichier image doit être au format png, jpg, jpeg ou gif.');
	}

//fin fichier
}

//si on a trouve une erreur
if($error){
	//on va sur la page de form
	redirect('../back/addinsider.php');

//sinon (tout est ok)
}else{

	//on prepare les variables de requete avec les donnees obligatoires
	$colonnes = 'titre, son_titre, sous_titre, text_before, text_after ';
	$values = ':t, :st, :soust, :tb, :ta ';
	$tab = array(
		':t' =>$_POST['titre'],
		':st' =>$_POST['son_titre'],		
		':soust' =>$_POST['sous_titre'],
		':tb' =>$_POST['text_before'],		
		':ta' =>$_POST['text_after']
		
	);

	//on teste tous les champs non obligatoires pour les ajouter a nnos variables de requete si besoin
	if(!empty($_POST['image'])){
		$colonnes .= ', image';	//$colonnes = $colonnes.',editor';
		$values .= ', :urli';
		$tab[':urli'] = $_POST['image'];
	}
	if(!empty($_POST['facebook_link'])){
		$colonnes .= ', fb';	//$colonnes = $colonnes.',editor';
		$values .= ', :fb';
		$tab[':fb'] = $_POST['facebook_link'];
	}
	

	
	//on lance la requete dans la base
	$insert = $mysql->prepare('INSERT INTO insider ('.$colonnes.', updated_at) VALUES('.$values.', NOW() )');
	$insert->execute($tab);
	
	//on cree le msg de confirmation
	$id = $mysql->lastInsertId();

	//s'il y a un fichier son
	if($_FILES['son']['size'] > 0){	

		//on cree le nouveau nom du fichier
		$nom_son = 'insider-'.$id.'-'.time().'.'.$extensionFichier_son;

		//on deplace le fichier de la memoire temporaire vers le dossier final
		move_uploaded_file($_FILES['son']['tmp_name'],'../data/'.$nom_son);

		//on met a jour la base de donnees
		$son = $mysql->prepare('UPDATE insider SET son = :son WHERE id = :i');
		$son->execute(array(':son' => $nom_son, ':i' => $id));

	//fin du test fichier
	}



	//s'il y a un fichier image
	if($_FILES['image']['size'] > 0){	

		//on cree le nouveau nom du fichier
		$nom = 'insider-'.$id.'-'.time().'.'.$extensionFichier;

		//on deplace le fichier de la memoire temporaire vers le dossier final
		move_uploaded_file($_FILES['image']['tmp_name'],'../data/'.$nom);

		//on met a jour la base de donnees
		$image = $mysql->prepare('UPDATE insider SET image = :img WHERE id = :i');
		$image->execute(array(':img' => $nom, ':i' => $id));

	//fin du test fichier
	}


	//on va sur la page de detail du livre qui vient d'etre cree
	flash_in('success','L\'Insider a bien été ajouté.'); 

	//on va sur la page de detail du livre qui vient d'etre cree
	redirect('../back/insider.php');

//fin du sinon (tout est OK)
}


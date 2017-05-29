<?php   //core/update.php

//on met la config
include('../config/config.php');

//si l'utilisateur n'est pas connecte
if(empty($_SESSION['user_id'])){
	//on le vire vers le login
	redirect('login.php');
}

// si on a pas recu de formulaire
if ( empty($_POST) ) {

	// vers liste livres
	redirect('../back/insider.php');
}

if (empty($_POST['id'])) {
	
	redirect('../back/insider.php');
}
// on verifie que le livre modofié appartient vien au user


$insider = $mysql->prepare('SELECT * FROM insider WHERE id = :i ');
$insider->execute(array(
	':i' => $_POST['id']
	));
if ($insider-> rowCount() ==0) {
		flash_in('danger','error');	
		redirect('../back/insider.php');
		
}


$error=false;

//si le titre n'est pas rempli
if (empty($_POST['titre'])){
	//on cree un msg d'erreur
	flash_in('danger','Le titre est obligatoire.');
	$error = true;
}	


//si lle son titre est vide
if (empty($_POST['son_titre'])){
	//on cree un msg d'erreur
	flash_in('danger','Le titre de l\'insider est obligatoire.');
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


if ($error) {

	redirect('../back/insider.php');
}else{

	$requete = 'UPDATE insider SET titre = :t, son_titre = :st, sous_titre = :soust, text_before = :tb, text_after = :ta, fb =:fb ';
	$tab = array(
		':t' => $_POST['titre'],
		':st' => $_POST['son_titre'],		
		':soust' => $_POST['sous_titre'],
		':tb' => $_POST['text_before'],		
		':ta' => $_POST['text_after'],
		':id' => $_POST['id'],
		':fb' => $_POST['facebook_link']
	);

	if (empty($_POST['image'])) {
		$requete .= ',image = NULL';
		
	}else{
		$requete .=',image = :img';
		$tab[':img'] = $_POST['image'];
	}


	



	//s'il y a un fichier son
	if($_FILES['son']['size'] > 0){	

		//on cree le nouveau nom du fichier
		$nom_son = 'insider-'.$_POST['id'].'-'.time().'.'.$extensionFichier_son;

		//on deplace le fichier de la memoire temporaire vers le dossier final
		move_uploaded_file($_FILES['son']['tmp_name'],'../data/'.$nom_son);

		//on ajoute la colonne cover dans la requete
		$requete .= ',son = :son';
		$tab[':son'] = $nom_son;

		//on lit les donnes du livre avant odification
		$dataBefore_son = $insider->fetch(PDO::FETCH_ASSOC);

		//on supprime le fichier image de l'ancienne couverture
		unlink('../data/'.$dataBefore_son['son']);

	//fin du test fichier
	}



	//s'il y a un fichier image
	if($_FILES['image']['size'] > 0){	

		//on cree le nouveau nom du fichier
		$nom = 'insider-'.$_POST['id'].'-'.time().'.'.$extensionFichier;

		//on deplace le fichier de la memoire temporaire vers le dossier final
		move_uploaded_file($_FILES['image']['tmp_name'],'../data/'.$nom);

		//on ajoute la colonne cover dans la requete
		$requete .= ',image = :img';
		$tab[':img'] = $nom;

		//on lit les donnes du livre avant odification
		$dataBefore = $insider->fetch(PDO::FETCH_ASSOC);

		//on supprime le fichier image de l'ancienne couverture
		unlink('../data/'.$dataBefore['image']);

	//fin du test fichier
	}


	$update = $mysql->prepare($requete.', updated_at = NOW() WHERE id = :id');
	$update->execute($tab);
	
	// var_dump($update);
	// var_dump($tab);


	flash_in('success', 'L\'Insider a bien été modifié.');	
	redirect('../back/insider.php');



}	











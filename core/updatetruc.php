<?php   //core/updatetruc.php

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
	redirect('../back/truc.php');

}
if (empty($_POST['id'])) {
	
	redirect('../back/truc.php');
}



$truc = $mysql->prepare('SELECT * FROM truck WHERE id = :i ');
$truc->execute(array(
	':i' => $_POST['id']
));
if ($truc-> rowCount() ==0) {
		flash_in('danger','error');	
		redirect('../back/truc.php');
}


$error=false;

//si le titre n'est pas rempli
if (empty($_POST['titre'])){
	//on cree un msg d'erreur
	flash_in('danger','Le titre est obligatoire.');
	$error = true;
}	


//si le text before est vide
if (empty($_POST['texte'])){
	//on cree un msg d'erreur
	flash_in('danger','Le texte est obligatoire.');
	$error = true;
}
if (empty($_POST['sous_titre'])){
	//on cree un msg d'erreur
	flash_in('danger','Le sous-titre est obligatoire.');
	$error = true;
}

//si on a recu un fichier
if($_FILES['image']['size'] > 0){

	//on verifie qu'il n'y a pas eu d'erreurs de transfert
	if($_FILES['image']['error'] != 0){
		$error = true;
		flash_in('danger','Le fichier est corrompu, essayez-en un autre.');
	}

	//on verifie que le fichier ne depasse pas le poids maximal
	if($_FILES['image']['error'] == 2 || $_FILES['image']['size'] > intval($_POST['MAX_FILE_SIZE'])){

		//on declenche une erreur
		$error = true;
		flash_in('danger','Le fichier doit faire moins de 1Mo.');
	}

	//on verifie qu'il a la bonne extension
	$extensionsValides = array('jpg', 'jpeg', 'png', 'gif');

	//on recupere l'extension du fichier envoye
	$filename = explode('.', strtolower($_FILES['image']['name']));
	$extensionFichier = $filename[count($filename) - 1];

	//si l'extension du fichier n'est pas dans le tableau
	if(!in_array($extensionFichier,$extensionsValides)){
		$error = true;
		flash_in('danger','Le fichier doit être au format png, jpg, jpeg ou gif.');
	}
	
//fin fichier
}


if ($error) {

	redirect('../back/truc.php');
}else{

	$requete = 'UPDATE truck SET titre = :t,  texte = :txt, sous_titre = :soustxt, fb = :fb   ';
	$tab = array(
		':i' => $_POST['id'],
		':t' => $_POST['titre'],
		':txt' => $_POST['texte'],
		':soustxt' => $_POST['sous_titre'],
		':fb'=> $_POST['facebook_link']
	);



	//s'il y a un fichier
	if($_FILES['image']['size'] > 0){	

		//on cree le nouveau nom du fichier
		$nom = 'truc-'.$_POST['id'].'-'.time().'.'.$extensionFichier;

		//on deplace le fichier de la memoire temporaire vers le dossier final
		move_uploaded_file($_FILES['image']['tmp_name'],'../data/'.$nom);

		//on ajoute la colonne cover dans la requete
		$requete .= ',image = :img';
		$tab[':img'] = $nom;

		//on lit les donnes du livre avant odification
		$dataBefore = $truc->fetch(PDO::FETCH_ASSOC);

		//on supprime le fichier image de l'ancienne couverture
		unlink('../data/'.$dataBefore['image']);

	//fin du test fichier
	}


	$update = $mysql->prepare($requete.', updated_at = NOW() WHERE id = :i');
	$update->execute($tab);
	
	//var_dump($update);
	//var_dump($tab);

	flash_in('success', 'Le truc a bien été modifié.');	
	redirect('../back/truc.php');



}	











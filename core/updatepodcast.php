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
	redirect('../back/podcast.php');

}
if (empty($_POST['id'])) {
	
	redirect('../back/podcast.php');
}
// on verifie que le livre modofié appartient vien au user


$podcast = $mysql->prepare('SELECT * FROM podcast WHERE id = :id ');
$podcast->execute(array(
	':id' => $_POST['id']
	));
if ($podcast-> rowCount() ==0) {
		flash_in('danger','error');	
		redirect('../back/podcast.php');
		
}


$error=false;

//si le titre n'est pas rempli
if (empty($_POST['titre'])){
	//on cree un msg d'erreur
	flash_in('danger','Le titre est obligatoire.');
	$error = true;
}	





if ($error) {

	redirect('../back/podcast.php');
}else{

	$requete = 'UPDATE podcast SET titre = :t  ';
	$tab = array(
		':t' => $_POST['titre'],
		// ':st' => $_POST['son_titre'],		
		// ':soust' => $_POST['sous_titre'],
		// ':texte' => $_POST['texe'],		
		// ':p' => $_POST['personnes'],
		 ':id' => $_POST['id']
	);

	// if (empty($_POST['personnes'])) {
	// 	$requete .= ',personnes = NULL';
		
	// }else{
	// 	$requete .=',personnes = :personnes';
	// 	$tab[':personnes'] = $_POST['personnes'];
	// }

	if (empty($_POST['texte'])) {
		$requete .= ',texte = NULL';
		
	}else{
		$requete .=',texte = :texte';
		$tab[':texte'] = $_POST['texte'];
	}

	if (empty($_POST['sous_titre'])) {
		$requete .= ',sous_titre = NULL';
		
	}else{
		$requete .=',sous_titre = :sous_titre';
		$tab[':sous_titre'] = $_POST['sous_titre'];
	}

	if (empty($_POST['son_titre'])) {
		$requete .= ',son_titre = NULL';
		
	}else{
		$requete .=',son_titre = :son_titre';
		$tab[':son_titre'] = $_POST['son_titre'];
	}	

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
}

	if (empty($_POST['x'])) {
		$requete .= ',x = NULL';
		
	}else{
		$requete .=',x = :x';
		$tab[':x'] = $_POST['x'];
	}

	if (empty($_POST['y'])) {
		$requete .= ',y = NULL';
		
	}else{
		$requete .=',y = :y';
		$tab[':y'] = $_POST['y'];
	}

	if (empty($_POST['facebook_link'])) {
		$requete .= ',fb = NULL';
		
	}else{
		$requete .=',fb = :fb';
		$tab[':fb'] = $_POST['facebook_link'];
	}


	//s'il y a un fichier
	if($_FILES['son']['size'] > 0){	

		//on cree le nouveau nom du fichier
		$nom = 'podcast-'.$_POST['id'].'-'.time().'.'.$extensionFichier;

		//on deplace le fichier de la memoire temporaire vers le dossier final
		move_uploaded_file($_FILES['son']['tmp_name'],'../data/'.$nom);

		//on ajoute la colonne cover dans la requete
		$requete .= ',son = :urls';
		$tab[':urls'] = $nom;

		//on lit les donnes du livre avant odification
		$dataBefore = $podcast->fetch(PDO::FETCH_ASSOC);

		//on supprime le fichier son de l'ancienne couverture
		unlink('../data/'.$dataBefore['son']);

	//fin du test fichier
	}



	$update = $mysql->prepare($requete.', updated_at = NOW() WHERE id = :id');
	$update->execute($tab);
	

	// var_dump($update);
	// var_dump($tab);

	flash_in('success', 'Le podcast a bien été modifié.');	
	redirect('../back/podcast.php');



}
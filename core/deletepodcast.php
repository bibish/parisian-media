<?php  //core/deletepodcast.php

//on met la config
include('../config/config.php');

//si l'utilisateur n'est pas connecte
if(empty($_SESSION['user_id'])){
	//on le vire vers le login
	redirect('back/login.php');
}

// si pas d'id dans l'adresse
if (empty($_GET['id'])) {
	

	
	// vers liste livres
	redirect('../back/podcast.php');

}	
$podcast = $mysql->prepare('SELECT * FROM podcast WHERE id = :i ');
$podcast->execute(array(
	':i' => $_GET['id']
	));
// si pas de livre avec cet id OU pas le livre nappartient pas au user connecte 
if ( $podcast->rowCount() ==0  ) {
	
	// vers liste livre
	redirect('../back/podcast.php');
}
else{

	// prepare et execute la requete 
	$delete = $mysql->prepare('DELETE FROM podcast WHERE id = :i ');
	$delete->execute(array(
			':i'=>$_GET['id']

		));

	// message de confirmation 
	flash_in('success', 'Le podcast a bien été supprimé.');

	// vers liste livre 
	redirect('../back/podcast.php');
}	







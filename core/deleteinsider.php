<?php  //core/deleteinsider.php

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
	redirect('../back/insider.php');

}	
$insider = $mysql->prepare('SELECT * FROM insider WHERE id = :i ');
$insider->execute(array(
	':i' => $_GET['id']
	));
// si pas de livre avec cet id OU pas le livre nappartient pas au user connecte 
if ( $insider->rowCount() ==0  ) {
	
	// vers liste livre
	redirect('../back/insider.php');
}
else{

	// prepare et execute la requete 
	$delete = $mysql->prepare('DELETE FROM insider WHERE id = :i ');
	$delete->execute(array(
			':i'=>$_GET['id']

		));

	// message de confirmation 
	flash_in('success', 'L\'Insider a bien été supprimé.');

	// vers liste livre 
	redirect('../back/insider.php');
}	







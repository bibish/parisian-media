<?php //fichier core/hp.php

//on doit inclure le fichier de config/setting.php
include('../config/config.php');

//si l'utilisateur n'est pas connecte
if(empty($_SESSION['user_id']))

	//on le redirige vers le login
	redirect('../back/login.php');

//si l'utilisateur n'a pas envoye le formulaire
if (empty($_POST))
	//on le renvoie sur la page formulaire
	redirect('../back/hp.php');
$error = false;

//si le titre n'est pas rempli
if ( empty($_POST['podcast']) || empty($_POST['truc']) || empty($_POST['insider'])){
	//on cree un msg d'erreur
	flash_in('danger','Tous les textes sont obligatoires.');
	$error = true;
}
//si on a trouve une erreur
if($error){
	//on va sur la page de form
	redirect('../back/hp.php');

//sinon (tout est ok)
}
else{
		$podcast = $mysql->prepare('UPDATE content SET texte = :txt WHERE category = :c');
		$podcast->execute(array(':c' => 'podcast', ':txt' => $_POST['podcast']));

		$insider = $mysql->prepare('UPDATE content SET texte = :txt WHERE category = :c');
		$insider->execute(array(':c' => 'insider', ':txt' => $_POST['insider']));

		$truc = $mysql->prepare('UPDATE content SET texte = :txt WHERE category = :c');
		$truc->execute(array(':c' => 'truc', ':txt' => $_POST['truc']));
	

	//on va sur la page de detail du livre qui vient d'etre cree
	flash_in('success','La Home Page a bien été modifiée.'); 
	
	//on va sur la page de detail du livre qui vient d'etre cree
	redirect('../back/hp.php');

//fin du sinon (tout est OK)
}
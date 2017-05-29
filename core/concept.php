<?php //fichier core/concept.php
//on doit inclure le fichier de config/setting.php
include('../config/config.php');
//si l'utilisateur n'est pas connecte
if(empty($_SESSION['user_id']))
	//on le redirige vers le login
	redirect('../back/login.php');
//si l'utilisateur n'a pas envoye le formulaire
if (empty($_POST))
	//on le renvoie sur la page formulaire
	redirect('../back/concept.php');
$error = false;
//si le titre n'est pas rempli
if (empty($_POST['texte'])){
	//on cree un msg d'erreur
	flash_in('danger','Le texte est obligatoire.');
	$error = true;
}	
//si on a trouve une erreur
if($error){
	//on va sur la page de form
	redirect('../back/concept.php');
//sinon (tout est ok)
}else{
		$concept = $mysql->prepare('UPDATE content SET texte = :txt WHERE category = :c');
		$concept->execute(array(':c' => 'concept', ':txt' => $_POST['texte']));
	//on va sur la page de detail du livre qui vient d'etre cree
	flash_in('success','La page concept a bien été modifiée.'); 
	//on va sur la page de detail du livre qui vient d'etre cree
	redirect('../back/concept.php');
//fin du sinon (tout est OK)
}
<?php //fichier : core/login.php

//on met la config
include('../config/config.php');

//si on n'a pas recu de formulaire
if(empty($_POST)){

	//on va vers back/login.php
	redirect('../back/login.php');

//sinon
}else{

	//on cree une requete qui cherche un utilisateur avec le couple pseudo/password
	$login = $mysql->prepare('SELECT * FROM users WHERE user = :pseudo AND password = :pass' );
	$login->execute(array(
		':pseudo' => $_POST['pseudo'],
		':pass' => cryptPassword($_POST['password'])
	));

	//si on a eu un resultat
	if($login->rowCount() == 1){
		$data = $login->fetch(PDO::FETCH_ASSOC);
		
		//on cree les donnees dans la session
		$_SESSION['user_id'] = $data['id'];
		$_SESSION['user_pseudo'] = $data['user'];


		//on cree un msg de confirmation
		flash_in('success','Vous êtes bien connecté.');
		
		//on va vers back/index.php
		redirect('../back/index.php');
	
	//sinon
	}else{
		
		//TODO MSG ERREUR
		flash_in('danger','Les pseudo et mot de passe ne correspondent pas.');
		
		//on va vers back/index.php
		redirect('../back/login.php');
	
	//fin du test resultat
	}

//fin du test formulaire
}
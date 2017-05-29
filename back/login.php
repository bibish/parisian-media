<?php //fichier : library/back/login.php

//on met la config
include('../config/config.php');

//si l'utilisateur n'est pas connecte
if(!empty($_SESSION['user_id'])){
	//on le vire vers le login
	redirect('index.php');
}


?><!DOCTYPE html>
<html lang="fr">

	<head>

		<?php include('../includes/head_back.php'); ?>

		<title>BACK PARISIAN</title>

	</head>


	<body class="light-blue lighten-4">

		<?php include('../includes/header_back.php'); ?>

		<h1>Se connecter</h1>

		<div class="row">
    		<form class="col s12" action="../core/login.php" method="POST">
      			<div class="row">
        			<div class="input-field col s6">
          				<input  id="first_name" name="pseudo" type="text" class="validate">
          				<label for="first_name" name="pseudo" >User</label>
        			</div>
       				<div class="input-field col s6">
          				<input id="last_name" type="text" class="validate" name="password">
          				<label for="last_name">Password</label>
        			</div>
      			</div>
      			<input class="waves-effect waves-light btn" type="submit" class="validate" value="Se connecter" >
      			<i class="material-icons left"></i>


    		</form>
  		</div>
        
  		
		<!-- <form action="../core/login.php" method="POST" >
			<p><input type="text"  class="validate"      name="pseudo" placeholder="Pseudo" /></p>
			<p><input type="password" class="validate"  name="password" placeholder="Mot de passe"/></p>

			<p><input type="submit" class="validate" value="Se connecter" class="btn btn-default" /></p>
		</form> -->

	

	</body>

</html>
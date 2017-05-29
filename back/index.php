<?php //fichier : back/index.php

//on met la config
include('../config/config.php');

//si l'utilisateur n'est pas connecte
if(empty($_SESSION['user_id'])){
	//on le vire vers le login
	redirect('login.php');
}

$db = $mysql->prepare('SELECT * FROM users ');
$db->execute();
$data = $db->fetch(PDO::FETCH_ASSOC);


?><!DOCTYPE html>
<html lang="fr">

		<head>

			<?php include('../includes/head_back.php'); ?>

			<title>Accueil - Back parisian insider</title>

		</head>


		<body class="light-blue lighten-4">
			<?php include('../includes/header_back.php'); ?>
			<div class="container ">

				

				<h1 class="center">Accueil</h1>

		        


		    	<h4>Bonjour <?php echo $_SESSION['user_pseudo']; ?></h4>

		    	<a href="../core/deco.php" class="waves-effect waves-light btn deep-orange accent-4">Se déconnecter</a>

		    </div>	


		

		</body>

	</html>

</html>
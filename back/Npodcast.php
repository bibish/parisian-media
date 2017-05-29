<?php //fichier : back/Npodcast.php

//on met la config
include('../config/config.php');

//s'il n'y a pas d'id dans l'adresse
if (empty ($_GET['id'])) {
	
	redirect('podcast.php');
}

//on cree la requete qui cherche l'insider correspondant a l'id
$podcast = $mysql->prepare('SELECT * FROM podcast WHERE id = :i');
$podcast->execute(array(':i' => $_GET['id']));

//si on a eu un (et un seul) resultat
if( $podcast->rowCount() == 1){
	
	//on lit ses donnees
	$data = $podcast->fetch(PDO::FETCH_ASSOC);
	//$user = $mysql->prepare('SELECT * FROM users WHERE id = :i');
	//$user->execute(array(':i'=> $data['owner']));
	//$dataUser = $user->fetch(PDO::FETCH_ASSOC);

//sinon (on a eu zero ou plusieurs resultats)
}else{
	
	//on retourne sur la liste des livres
	redirect('podcast.php');
}






?><!DOCTYPE html>
<html lang="fr">

	<head>

		<?php include('../includes/head_back.php'); ?>

		<title><?php echo $data['titre']; ?> - Back Parisian Insider</title>

	</head>


	<body class="light-blue lighten-4">

		<?php include('../includes/header_back.php'); ?>
		<div class="container">
		<h1><?php echo $data['titre']; ?></h1>

		<p>Question du Podcast : <?php echo $data['son_titre']; ?></p>

		<p>Date : <?php echo $data['sous_titre']; ?></p>
		
		<p>Texte : <?php echo $data['texte']; ?></p>

		<audio controls>
  			<source src="<?php echo image($data['son'], true); ?>"  type="audio/ogg">
		</audio>

		<!-- <p>Nom des personnes interviewées : <?php echo $data['personnes']; ?></p> -->
		<p>lien fb :  <?php echo $data['fb']; ?></p>

		<p>Coordonnée en X : <?php echo $data['x']; ?></p>

		<p>Coordonnée en Y : <?php echo $data['y']; ?></p>


			
        <p><a href="updatepodcast.php?id=<?php echo $data['id']; ?>" class="btn btn-warning">Modifier</a><a href="../core/deletepodcast.php?id=<?php echo $data['id']; ?>" class="btn btn-danger">Supprimer</a></p>

            




		
        </div>
	</body>

</html>
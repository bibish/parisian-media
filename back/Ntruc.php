<?php //fichier : back/Ntruc.php

//on met la config
include('../config/config.php');

//s'il n'y a pas d'id dans l'adresse
if (empty ($_GET['id'])) {
	
	redirect('truc.php');
}

//on cree la requete qui cherche le truc correspondant a l'id
$truc = $mysql->prepare('SELECT * FROM truck WHERE id = :i');
$truc->execute(array(':i' => $_GET['id']));

//si on a eu un (et un seul) resultat
if( $truc->rowCount() == 1){
	
	//on lit ses donnees
	$data = $truc->fetch(PDO::FETCH_ASSOC);
	//$user = $mysql->prepare('SELECT * FROM users WHERE id = :i');
	//$user->execute(array(':i'=> $data['owner']));
	//$dataUser = $user->fetch(PDO::FETCH_ASSOC);

//sinon (on a eu zero ou plusieurs resultats)
}else{
	
	//on retourne sur la liste des livres
	redirect('truc.php');
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
		
		<p>Texte : <?php echo $data['texte']; ?></p>

		<p>Date : <?php echo $data['sous_titre']; ?></p>
		<p>Lien fb : <?php echo $data['fb']; ?></p>


		<figure>

			<img src="<?php echo image($data['image'], true); ?>" alt="<?php echo $data['titre']; ?>"/>
			<figcaption><?php echo $data['titre']; ?></figcaption>
			

		</figure>

		

		
			
            <p><a href="updatetruc.php?id=<?php echo $data['id']; ?>" class="btn btn-warning">Modifier</a><a href="../core/deletetruc.php?id=<?php echo $data['id']; ?>" class="btn btn-danger">Supprimer</a></p>

            




		</div>

	</body>

</html>
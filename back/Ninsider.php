<?php //fichier : back/Ninsider.php

//on met la config
include('../config/config.php');

//s'il n'y a pas d'id dans l'adresse
if (empty ($_GET['id'])) {
	
	redirect('insider.php');
}

//on cree la requete qui cherche l'insider correspondant a l'id
$insider = $mysql->prepare('SELECT * FROM insider WHERE id = :i');
$insider->execute(array(':i' => $_GET['id']));

//si on a eu un (et un seul) resultat
if( $insider->rowCount() == 1){
	
	//on lit ses donnees
	$data = $insider->fetch(PDO::FETCH_ASSOC);
	//$user = $mysql->prepare('SELECT * FROM users WHERE id = :i');
	//$user->execute(array(':i'=> $data['owner']));
	//$dataUser = $user->fetch(PDO::FETCH_ASSOC);

//sinon (on a eu zero ou plusieurs resultats)
}else{
	
	//on retourne sur la liste des livres
	redirect('insider.php');
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

		<p>Titre de l'épisode : <?php echo $data['son_titre']; ?></p>

		<p>Date : <?php echo $data['sous_titre']; ?></p>
		
		<p>Texte avant image : <?php echo $data['text_before']; ?></p>

		<p>Texte après image : <?php echo $data['text_after']; ?></p>

		<p>lien fb <?php echo $data['fb']; ?></p>

		<figure>

			<img src="<?php echo image($data['image'], true); ?>" alt="<?php echo $data['titre']; ?>"/>
			<figcaption><?php echo $data['titre']; ?></figcaption>

		</figure>

		<audio controls>
  			<source src="<?php echo image($data['son'], true); ?>"  type="audio/ogg">
		</audio>

		


			
        <p><a href="updateinsider.php?id=<?php echo $data['id']; ?>" class="btn btn-warning">Modifier</a><a href="../core/deleteinsider.php?id=<?php echo $data['id']; ?>" class="btn btn-danger">Supprimer</a></p>

            




		
        </div>
	</body>

</html>
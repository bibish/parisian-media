<?php //fichier : podcast.php

//on met la config
include('../config/config.php');

//si l'utilisateur n'est pas connecte
if(empty($_SESSION['user_id'])){
	//on le vire vers le login
	redirect('login.php');
}


//on cree une requete qui determine le nbre total de livre dans la base
$nbtotal = $mysql->prepare('SELECT count(*) AS total FROM podcast');
$nbtotal->execute();
$number = $nbtotal->fetch(PDO::FETCH_ASSOC);

//on test si la base insider contient des elements pour ne pas que la pagination bug

if ($number['total'] != 0) {
    //on determine le nombre de resultats a afficher par page
    $nb = 8;

    //on determine le nbre total de page a afficher
    $pageTotal = ceil($number['total'] / $nb);

    //si on n'a pas de numero de page dans l'adresse
    if(empty($_GET['p']))
    //on definit que l'on se trouve sur la premiere page
    $_GET['p'] = 1;
    //sinon
    else
    //on transforme la variable pr avoir sa valeur numerique
    $_GET['p'] = intval($_GET['p']);

    //si on essaie de voir une page qui n'existe pas
    if($_GET['p'] > $pageTotal)
    redirect('podcast.php');

    //on construit la limite que l'on souhaite
    $limit = ' LIMIT '.(($_GET['p'] -1) * $nb).', '.$nb;


    //on va creer la requete qui lit tous les livres 
    $podcasts = $mysql->prepare('SELECT * FROM podcast ORDER BY titre'.$limit);
    //on execute la requete
    $podcasts->execute();
}












?>
<!DOCTYPE html>
<html lang="fr">

	<head>

		<?php include('../includes/head_back.php'); ?>

		<title>Accueil - Back Podcast</title>
        <style type="text/css">.pagination{display: inherit;}</style>

	</head>


	<body class="light-blue lighten-4">

		<?php include('../includes/header_back.php'); ?>
        <div class="container">
		<h1>Les podcasts</h1>

		<table class=" striped">

			<tr class="info">
				<th><h5>Podcasts</h5></th>
                <th><h5>Date de création</h5></th>
                <th><h5>Date de modification</h5></th>
                <th><h5>Actions</h5></th>
			</tr>

            <a href="addpodcast.php" class="btn btn-warning btn-xl">AJOUTER UN PODCAST</a>

            <?php 
        
            //on lit tous les resultats de la base
            while( $podcast = $podcasts->fetch(PDO::FETCH_ASSOC) ){
        
            
        
            ?>
			
        

        <tr>
            <td><a href="Npodcast.php?id=<?php echo $podcast['id']; ?>"><?php echo $podcast['titre'];?></a> </td>
            
            <td><?php echo $podcast['created_at']; ?></td>
            <td><?php echo $podcast['updated_at']; ?></td>
            
            
         

            	
            			 <td><a href="../back/updatepodcast.php?id=<?php echo $podcast['id']; ?>" class="btn btn-warning btn-xs">
                        Modifier</a>
                        <a href="../core/deletepodcast.php?id=<?php echo $podcast['id']; ?>" class="btn btn-danger btn-xs">Supprimer</a></td>
                        
           


        
        </tr>
         <?php 
            }
         ?>
       

		</table>

        
        <?php

        //on ajoute la pagination (si necessaire)
        if($pageTotal > 1 ){
            echo '<ul class="pagination">';

                //on cree une boucle qui commence a 1, qui va jusqu'au nbre total de page, et qui ecrit un lien pour chaque page
                for ($i = 1; $i <= $pageTotal; $i++){
                    $class = '';
                    //si on est sur la page active, on ajoute une class
                    if($i == $_GET['p'])
                        $class = 'class="active"';

                    echo '<li '.$class.'><a href="podcast.php?p='.$i.'">'.$i.'</a></li>';
                }


            echo '</ul>';
        }
        ?>

	</div>

	</body>

	</html>

</html>
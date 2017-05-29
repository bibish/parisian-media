<?php  //back/updateinsider.php

//on met la config
include('../config/config.php');

//si l'utilisateur n'est pas connecte
if(empty($_SESSION['user_id'])){
	//on le vire vers le login
	redirect('login.php');
}

// si pas d'id dans l'adresse
if (empty($_GET['id'])) {
	

	
	// vers liste livres
	redirect('../back/truc.php');

}

$truc = $mysql->prepare('SELECT * FROM truck WHERE id = :i ');
$truc->execute(array(
	':i' => $_GET['id']
	));
if ($truc->rowCount()==0) {
	
	redirect('../back/truc.php');
}
else{

	$data = $truc->fetch(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="fr">

	<head>

		<?php include('../includes/head_back.php'); ?>
		

		<title>Modifier Truc</title>

	</head>


	<body class="light-blue lighten-4">

		<?php include('../includes/header_back.php'); ?>
		<div class="container">
		<h1>Modifier Truc</h1>
		<form action="../core/updatetruc.php" method="POST" enctype="multipart/form-data">

    	<input type="hidden" name="MAX_FILE_SIZE" value="1048576">

		<form class="form-horizontal" method="POST" action="../core/updatetruc.php">
		<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>

		      <fieldset>

		        <div class="form-group">
		          	<label class="control-label" for="inputDefault">Titre du Truc de la semaine</label>
		            <input type="text" class="form-control" id="inputDefault" name="titre" value="<?php echo $data['titre'] ?>">
		           
		        </div>

		        

		        
		        <div class="form-group">
		            	<label for="textArea" class="col-lg-2 control-label">Texte</label>
		              	<textarea class="form-control" rows="3" id="textArea" name="texte" ><?php echo $data['texte'] ?></textarea>
		           
		        </div>

		         <div class="form-group">
		            	<label for="textArea" class="col-lg-2 control-label">Date (Semaine du XX/XX/XXXX )</label>
		              	<textarea class="form-control" rows="3" id="textArea" name="sous_titre" ><?php echo $data['sous_titre'] ?></textarea>
		           
		        </div>
		         <div class="form-group">
            		<label for="textArea" class="col-lg-2 control-label">lien facebook de l'article pour les commentaires</label>
              		<textarea class="form-control" rows="3" id="textArea" name="facebook_link"><?php echo $data['fb'] ?></textarea>   
        		</div>

		        

		        <div class="form-group">
		          		<label class="btn btn-default btn-file" for="inputDefault">Image</label>
		            	<input type="file"  id="inputDefault" name="image" value="<?php echo $data['image'] ?>" >
		           
		        </div>

		         		


		        		

		        

		        

		          <div class="col-lg-10 col-lg-offset-2">
		            <button type="submit" class="btn btn-lg btn-warning">Modifier le Truc</button>
		          </div>

		      </fieldset>


    	</form>
    	</form>
	</body>

</html>

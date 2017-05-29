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
	redirect('../back/insider.php');

}

$insider = $mysql->prepare('SELECT * FROM insider WHERE id = :i ');
$insider->execute(array(
	':i' => $_GET['id']
	));
if ($insider->rowCount()==0) {
	
	redirect('../back/insider.php');
}
else{

	$data = $insider->fetch(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="fr">

	<head>

		<?php include('../includes/head_back.php'); ?>
		

		<title>modifier insider</title>

	</head>


	<body class="light-blue lighten-4">

		<?php include('../includes/header_back.php'); ?>
		<div class="container">
		<h1>Modifier Insider</h1>
		<form action="../core/updateinsider.php" method="POST" enctype="multipart/form-data">

    	<input type="hidden" name="MAX_FILE_SIZE" value="15728640">

		<form class="form-horizontal" method="POST" action="../core/updateinsider.php">
		<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>

		      <fieldset>

		        <div class="form-group">
		          	<label class="control-label" for="inputDefault">Numéro de l'épisode</label>
		            <input type="text" class="form-control" id="inputDefault" name="titre" value="<?php echo $data['titre'] ?>">
		           
		        </div>

		        <div class="form-group">

		          	<label class="control-label" for="inputDefault">Titre de l'épisode</label>
		           
		            <input type="text" class="form-control" id="inputDefault" name="son_titre" value="<?php echo $data['son_titre'] ?>">
		           
		        </div>

		        <div class="form-group">
		            	<label for="textArea" class="col-lg-2 control-label">Date (Semaine du XX/XX/XXXX)</label>
		             	<textarea class="form-control" rows="3" id="textArea" name="sous_titre"><?php echo $data['sous_titre'] ?></textarea>
		            
		        </div>

		        <div class="form-group">
		            	<label for="textArea" class="col-lg-2 control-label">Texte avant image</label>
		              	<textarea class="form-control" rows="3" id="textArea" name="text_before" > <?php echo $data['text_before'] ?></textarea>
		           
		        </div>

		        <div class="form-group">
		            	<label for="textArea" class="col-lg-2 control-label">Texte après image</label>
		              	<textarea class="form-control" rows="3" id="textArea" name="text_after" ><?php echo $data['text_after'] ?></textarea>
		            
		        </div> 

		        <div class="form-group">
		            	<label for="textArea" class="col-lg-2 control-label">Lien facebook</label>
		              	<textarea class="form-control" rows="3" id="textArea" name="facebook_link" ><?php echo $data['fb'] ?></textarea>
		            
		        </div> 

		        <div class="form-group">
		          		<label class="btn btn-default btn-file" for="inputDefault">Image</label>
		            	<input type="file"  id="inputDefault" name="image" value="<?php echo $data['image'] ?>" >
		           
		        </div>

		         		<div class="form-group">
		          		<label class="btn btn-default btn-file" for="inputDefault">Fichier audio</label>
		           
		            	<input type="file" id="inputDefault" name="son" value="<?php echo $data['son'] ?>">
		           
		        </div>

		        		

		        

		          <div class="col-lg-10 col-lg-offset-2">
		            <button type="submit" class="btn btn-lg btn-warning">Modifier l'Insider</button>
		          </div>

		      </fieldset>


    	</form>
    	</div>
	</body>

</html>

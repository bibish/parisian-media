<?php //parisian/back/addinsider.php

include ('../config/config.php');

if (empty($_SESSION['user_id']))


	redirect('login.php');

?><!DOCTYPE html>

<html lang="fr">

	<head>

		<?php include('../includes/head_back.php'); ?>

		<title>Ajouter un truc - Back parisian insider</title>
		

	</head>

	<body class="light-blue lighten-4">

	<?php include('../includes/header_back.php'); ?>


 <div class="container">
		<h1>Ajouter un Truc</h1>

    <form action="../core/addtruc.php" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="MAX_FILE_SIZE" value="15728640">
    
    <form class="form-horizontal" method="POST" action="../core/addtruc.php">

      <fieldset>

        <div class="form-group">
          <label class="control-label" for="inputDefault">Titre Truc de la semaine</label>
            <input type="text" class="form-control" id="inputDefault" name="titre">
           
        </div>


        <div class="form-group">
            <label for="textArea" class="col-lg-2 control-label">Texte</label>
              <textarea class="form-control" rows="3" id="textArea" name="texte"></textarea>
           
        </div>

        <div class="form-group">
            <label for="textArea" class="col-lg-2 control-label">Date (Semaine du XX/XX/XXXX)</label>
              <textarea class="form-control" rows="3" id="textArea" name="sous_titre"></textarea>
           
        </div>

        <div class="form-group">
            <label for="textArea" class="col-lg-2 control-label">lien facebook de l'article pour les commentaires</label>
              <textarea class="form-control" rows="3" id="textArea" name="facebook_link"></textarea>
           
        </div>

        

        <div class="form-group">
          <label class="btn btn-default btn-file" for="inputDefault">Image</label>
            <input type="file"  id="inputDefault" name="image" />
           
        </div>

         

        
          <div class="col-lg-10 col-lg-offset-2">
            <button type="submit" class="btn btn-lg btn-warning">Ajouter le Truc</button>
          </div>
      </fieldset>


    </form>


  </div>





	</body>

</html>


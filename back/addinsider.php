<?php //parisian/back/addinsider.php

include ('../config/config.php');

if (empty($_SESSION['user_id']))


	redirect('login.php');

?><!DOCTYPE html>

<html lang="fr">

	<head>

		<?php include('../includes/head_back.php'); ?>

		<title >Ajouter Insider - Back parisian insider</title>
		

	</head>

  <body class="light-blue lighten-4">
      <?php include('../includes/header_back.php'); ?>
      <div class="container ">


		
    <h1 class="center">Ajouter un Insider</h1>

    <form action="../core/addinsider.php" method="POST" enctype="multipart/form-data">

    <input type="hidden" name="MAX_FILE_SIZE" value="15728640">

    

    <form class="form-horizontal" method="POST" action="../core/addinsider.php">

      <fieldset>

        <div class="form-group">

          <label class="control-label" for="inputDefault">Numéro de l'épisode</label>
          <input type="text" class="form-control" id="inputDefault" name="titre">
           
        </div>


        <div class="form-group">

          <label class="control-label" for="inputDefault">Titre de l'épisode</label>
          <input type="text" class="form-control" id="inputDefault" name="son_titre">
           
        </div>


        <div class="form-group">

            <label for="textArea" class="col-lg-2 control-label">Date (Semaine du XX/XX/XXXX)</label>
            <textarea class="form-control" rows="3" id="textArea" name="sous_titre"></textarea>
            
        </div>

        <div class="form-group">

            <label for="textArea" class="col-lg-2 control-label">Texte avant image</label>
            <textarea class="form-control" rows="3" id="textArea" name="text_before"></textarea>
           
        </div>

        <div class="form-group">

            <label for="textArea" class="col-lg-2 control-label">Texte après image</label>
            <textarea class="form-control" rows="3" id="textArea" name="text_after"></textarea>
            
        </div> 

        <div class="form-group">

            <label for="textArea" class="col-lg-2 control-label">Lien facebook</label>
            <textarea class="form-control" rows="3" id="textArea" name="facebook_link"></textarea>
            
        </div> 

        <div class="form-group">

          <label class="btn btn-default btn-file" for="inputDefault">Image</label>
          <input type="file"  id="inputDefault" name="image">
           
        </div>

         <div class="form-group">

            <label class="btn btn-default btn-file" for="inputDefault">Fichier audio</label>
            <input type="file" id="inputDefault" name="son">
           
        </div>

        

        <div class="col-lg-10 col-lg-offset-2">
           
          <button type="submit" class="btn btn-lg btn-warning">Ajouter l'Insider</button>
          
        </div>
     

      </fieldset>


    </form>


  </div>



  </div>

	</body>

</html>


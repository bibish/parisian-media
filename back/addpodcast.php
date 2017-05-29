<?php //parisian/back/addpodcast.php

include ('../config/config.php');

if (empty($_SESSION['user_id']))


  redirect('login.php');

?><!DOCTYPE html>

<html lang="fr">

  <head>

    <?php include('../includes/head_back.php'); ?>

    <title>Ajouter Podcast - Back parisian insider</title>
   

  </head>

  <body class="light-blue lighten-4">

  <?php include('../includes/header_back.php'); ?>


 <div class="container">
    <h1>Ajouter un Podcast</h1>


<!-- ////////////////////////////////////// -->
    <form class="form-horizontal" action="../core/addpodcast.php" method="POST" enctype="multipart/form-data">
    <!-- 15mo max  -->
    <input type="hidden" name="MAX_FILE_SIZE" value="15728640">

  <!-- //////////////////////////////////   -->


      <fieldset>

         <div class="form-group">
          <label class="control-label" for="inputDefault">Numéro du Podcast</label>
            <input type="text" class="form-control" id="inputDefault" name="titre">
           
        </div>


        <div class="form-group">
          <label class="control-label" for="inputDefault">Question du Podcast</label>
           
            <input type="text" class="form-control" id="inputDefault" name="son_titre">
           
        </div>

            

        <div class="form-group">
            <label for="textArea" class="col-lg-2 control-label">Date (Semaine du XX/XX/XXXX)</label>
              <textarea class="form-control" rows="3" id="textArea" name="sous_titre"></textarea>
            
        </div>

        <div class="form-group">
            <label for="textArea" class="col-lg-2 control-label">Texte</label>
              <textarea class="form-control" rows="3" id="textArea" name="texte"></textarea>
           
        </div>
         <div class="form-group">
            <label for="textArea" class="col-lg-2 control-label">Lien facebook</label>
              <textarea class="form-control" rows="3" id="textArea" name="facebook_link"></textarea>
            
        </div>
            
         <div class="form-group">
          <label class="btn btn-default btn-file" for="inputDefault">Fichier audio</label>
           
            <input type="file" id="inputDefault" name="son">
           
        </div>

        <!-- <div class="form-group">
            <label for="textArea" class="col-lg-2 control-label">Nom des personnes interviewées</label>
              <textarea class="form-control" rows="3" id="textArea" name="personnes"></textarea>
            
        </div> --> 

        <div class="form-group">
          <label class="control-label" for="inputDefault">Coordonnée en X</label>
            <input type="text" class="form-control" id="inputDefault" name="x">
           
        </div> 

        <div class="form-group">
          <label class="control-label" for="inputDefault">Coordonnée en Y</label>
           <input type="text" class="form-control" id="inputDefault" name="y">
        </div>

        
          <div class="col-lg-10 col-lg-offset-2">
            <button type="submit" class="btn btn-lg btn-warning">Ajouter le Podcast</button>
          </div>
      </fieldset>


    </form>


  </div>





  </body>

</html>
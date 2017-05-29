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
  redirect('../back/index.php');

}

$insider = $mysql->prepare('SELECT * FROM podcast WHERE id = :i ');
$insider->execute(array(
  ':i' => $_GET['id']
  ));
if ($insider->rowCount()==0) {
  
  redirect('../back/podcast.php');
}
else{

  $data = $insider->fetch(PDO::FETCH_ASSOC);
}

?>
<!DOCTYPE html>
<html lang="fr">

  <head>

    <?php include('../includes/head_back.php'); ?>
   

    <title>Modifier Podcast</title>

  </head>


  <body class="light-blue lighten-4">

    <?php include('../includes/header_back.php'); ?>

    
 <div class="container">

    <h1 class="">Modifier Podcast</h1>

    
    <!-- ////////////////////////////////////// -->
    <form class="form-horizontal" action="../core/updatepodcast.php" method="POST" enctype="multipart/form-data">
    <!-- 15mo max  -->
    <input type="hidden" name="MAX_FILE_SIZE" value="15728640">

  <!-- //////////////////////////////////   -->
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>"/>

      <fieldset>


        <div class="form-group">
          <label class="control-label" for="inputDefault">Numéro du Podcast</label>
            <input type="text" class="form-control" id="inputDefault" name="titre" value="<?php echo $data['titre']; ?>">
           
        </div>


        <div class="form-group">
          <label class="control-label" for="inputDefault">Question du Podcast</label>
           
            <input type="text" class="form-control" id="inputDefault" name="son_titre" value="<?php echo $data['son_titre']; ?>">
           
        </div>


        <div class="form-group">
            <label for="textArea" class="col-lg-2 control-label">Date (Semaine du XX/XX/XXXX)</label>
              <textarea class="form-control" rows="3" id="textArea" name="sous_titre"><?php echo $data['sous_titre']; ?></textarea>
            
        </div>

        <div class="form-group">
            <label for="textArea" class="col-lg-2 control-label">Texte</label>
              <textarea class="form-control" rows="3" id="textArea" name="texte"><?php echo $data['texte']; ?></textarea>
           
        </div>

         <div class="form-group">
            <label for="textArea" class="col-lg-2 control-label">Lien facebook</label>
              <textarea class="form-control" rows="3" id="textArea" name="facebook_link"><?php echo $data['fb']; ?></textarea>
           
        </div>
            
         <div class="form-group">
          <label class="btn btn-default btn-file" for="inputDefault">Fichier audio</label>
           
            <input type="file" id="inputDefault" name="son" >
           
        </div>

        <!-- <div class="form-group">
            <label for="textArea" class="col-lg-2 control-label">Nom des personnes interviewées</label>
              <textarea class="form-control" rows="3" id="textArea" name="personnes"></textarea>
            
        </div> --> 

        <div class="form-group">
          <label class="control-label" for="inputDefault">Coordonnée en X</label>
            <input type="text" class="form-control" id="inputDefault" name="x" value="<?php echo $data['x']; ?>">
           
        </div> 

        <div class="form-group">
          <label class="control-label" for="inputDefault">Coordonnée en Y</label>
           <input type="text" class="form-control" id="inputDefault" name="y" value="<?php echo $data['y']; ?>">
        </div>

        
          <div class="col-lg-10 col-lg-offset-2">
            <button type="submit" class="btn btn-lg btn-warning">Modifier le Podcast</button>
          </div>
      </fieldset>


    </form>


  </div>

  </body>

</html>
<?php //parisian/back/contact.php
include ('../config/config.php');
if (empty($_SESSION['user_id']))
  redirect('login.php');
$content = $mysql->prepare('SELECT * FROM content WHERE category = :c');
$content->execute(array(
   
   ':c' => 'contact'
  
  ));
$text = $content->fetch(PDO::FETCH_ASSOC);
?><!DOCTYPE html>
<html lang="fr">
  <head>
    <?php include('../includes/head_back.php'); ?>
    <title>Contact - Back parisian insider</title>
    
  </head>
  <body class="light-blue lighten-4">
  <?php include('../includes/header_back.php'); ?>
<div class ="container">
<h1>Modifier la page contact</h1>
<form class="form-horizontal" method="POST" action="../core/contact2.php">
  <fieldset>
   
    
    <div class="form-group">
      <label for="textArea" class="col-lg-2 control-label">Texte conctact</label>
      <div class="col-lg-10">
        <textarea class="form-control" rows="3" id="textArea" name="texte"><?php echo $text['texte']; ?></textarea>
        <span class="help-block"></span>
      </div>
    </div>
    
    
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        
        <button type="submit" class="btn btn-lg btn-warning">Modifier</button>
      </div>
    </div>
  </fieldset>
</form>
</div>
  </body>
</html>
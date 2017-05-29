<?php //parisian/back/hp.php

include ('../config/config.php');

if (empty($_SESSION['user_id']))


	redirect('login.php');

$podcast_content = $mysql->prepare('SELECT * FROM content WHERE category = :pod');
$podcast_content->execute(array(
  ':pod' => 'podcast',
  ));

$text_pod = $podcast_content->fetch(PDO::FETCH_ASSOC);


$insider_content = $mysql->prepare('SELECT * FROM content WHERE category = :ins');
$insider_content->execute(array(
  ':ins' => 'insider',
  ));

$text_ins = $insider_content->fetch(PDO::FETCH_ASSOC);


$truc_content = $mysql->prepare('SELECT * FROM content WHERE category = :truc');
$truc_content->execute(array(
  ':truc' => 'truc',
  ));

$text_truc = $truc_content->fetch(PDO::FETCH_ASSOC);



?><!DOCTYPE html>

<html lang="fr">

	<head>

		<?php include('../includes/head_back.php'); ?>

		<title>Home Page - Back parisian insider</title>
		

	</head>

	<body class=" light-blue lighten-4">

	<?php include('../includes/header_back.php'); ?>
<div class="container">

<div style="padding:20px;">

<h1>Modifier la Home Page</h1>



<form class="form-horizontal" method="POST" action="../core/hp.php">
  <fieldset>
   
    
    <div class="form-group">
      <label for="textArea" class="col-lg-2 control-label">Catégorie Podcast</label>
      <div class="col-lg-10">
        <textarea class="form-control" rows="3" id="textArea" name="podcast"><?php echo $text_pod['texte']; ?></textarea>
        <span class="help-block"></span>
      </div>
    </div>

    <div class="form-group">
      <label for="textArea" class="col-lg-2 control-label">Catégorie Insider</label>
      <div class="col-lg-10">
        <textarea class="form-control" rows="3" id="textArea" name="insider"><?php echo $text_ins['texte']; ?></textarea>
        <span class="help-block"></span>
      </div>
    </div>

     <div class="form-group">
      <label for="textArea" class="col-lg-2 control-label">Catégorie Truc</label>
      <div class="col-lg-10">
        <textarea class="form-control" rows="3" id="textArea" name="truc"><?php echo $text_truc['texte']; ?></textarea>
        <span class="help-block"></span>
      </div>
    </div>
    
    <div class="form-group">
      <div class="col-lg-10 col-lg-offset-2">
        
        <button type="submit" class="btn btn-lg btn-warning">Modifier les catégories</button>
      </div>
    </div>
  </fieldset>
</form>


</div>
</div>
	</body>

</html>


<?php // fichier : library/includes/header-back.php
// on recupere le chemin du script en cours
include('config/config.php');

$address = $_SERVER['PHP_SELF'];
// ondecoupe le chemin selon les /
$tab = explode('/', $address);
// on recupere la derniere case du tableau => longueure du tableau -1
$filename = $tab[count($tab) - 1];

$content = $mysql->prepare('SELECT * FROM content WHERE category = :c');
$content->execute(array(
   
   ':c' => 'concept'
  
  ));
$text = $content->fetch(PDO::FETCH_ASSOC);

?>


    <!DOCTYPE html>
    <html lang="en">
    <?php 
            // on insere le head en php php
            include('includes/head.php');
        ?>

        <body>
            <?php 
            // on insere le menu php
            include('includes/header.php');
        ?>
                <section class="concept">
                    <div id="entete">
                        <h1>Nous sommes,<br />PARISIAN INSIDER</h1>
                    </div>
                   <div class="content clearfix">
                    <h2>Hydre bi-tête et bigoût. Nous sommes Mister J et Mister G.</h2>
                    <p>
                        <?php  echo $text['texte'];?>
                    </p><br /><h2>Parisian Insider</h2>.</p>
                    </div>
                </section>
                <?php 
            // on insere le head en php php
            include('includes/footer.php');
        ?>
        </body>
    </html>
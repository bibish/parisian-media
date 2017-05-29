<?php 
include('config/config.php');
// on recupere le chemin du script en cours
$address = $_SERVER['PHP_SELF'];
// ondecoupe le chemin selon les /
$tab = explode('/', $address);
// on recupere la derniere case du tableau => longueure du tableau -1
$filename = $tab[count($tab) - 1];



//on cree la requete qui cherche l'insider correspondant a l'id
$podcast = $mysql->prepare('SELECT * FROM podcast ORDER BY created_at DESC LIMIT 1');
$podcast->execute();



//on cree la requete qui cherche l'insider correspondant a l'id
$insider = $mysql->prepare('SELECT * FROM insider ORDER BY created_at DESC LIMIT 1');
$insider->execute();




///////////////////////////////text content /////////////////////////


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

        <div id="slides">
            <div class="slides-container">
                <div id="firtslide">


                    <?php 
                        if( $podcast->rowCount() == 1){

                        $data = $podcast->fetch(PDO::FETCH_ASSOC);


                    ?>

                    <audio preload="auto" id="son1">
                        <source src="<?php echo image($data['son']); ?>"></source>
                    </audio>
                   
                    <div class="container">
                    
                        <p class="track"> <?php echo $data['titre']; ?>
                        <br /><br /><span>  <?php echo $data['son_titre']; ?> <span>
                        </p>

                        <div class="btn-control">
                            <button data-am-button="small" class="btn-mute"><i class="fa fa-volume-off"></i></button>
                            <button data-am-button="large" class="btn-play-pause"><i class="fa fa-play"></i></button>
                            <button data-am-button="small" class="btn-stop"><i class="fa fa-stop"></i></button>	
                        </div>
                    
                        <div class="progress-bar">
                            <span class="progress"></span>
                        </div>
                    </div>
                    <?php }?>

                </div>


                <div id="secondslide">

                 <?php

                        if( $insider->rowCount() == 1){
    
                        //on lit ses donnees
                        $data_ins = $insider->fetch(PDO::FETCH_ASSOC);


                ?>
                    <audio preload="auto" id="son2">
                        <source src="<?php echo image($data_ins['son']); ?>"></source>
                    </audio>

                    <div class="container">
                    
                        <p class="track"> <?php echo $data_ins['titre']; ?>
                        <br /><span>  <?php echo $data_ins['son_titre']; ?> <span>

                        <div class="btn-control">
                            <button data-am-button="small" class="btn-mute"><i class="fa fa-volume-off"></i></button>
                            <button data-am-button="large" class="btn-play-pause"><i class="fa fa-play"></i></button>
                            <button data-am-button="small" class="btn-stop"><i class="fa fa-stop"></i></button>	
                        </div>

                        <div class="progress-bar">
                                <span class="progress"></span>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>

        <nav class="slides-navigation">
            <a href="#" class="next"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>
            <a href="#" class="prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
        </nav>


        </div>
        <section class="wrap">
            <article>
                <h1>Les podcasts</h1>
                <p>
                <?php echo $text_pod['texte']; ?>
                </p>
                <p><a href="archives.php">Voir tous les podcasts</a></p>
            </article>

            <article>
                <h1>Les insiders</h1>
                <p>
                   <?php echo $text_ins['texte']; ?>     
                </p>
                <p><a href="archives.php">Voir tous les insiders</a></p>
            </article>

            <article>
                <h1>Les trucs</h1>
                <p>
                    <?php echo $text_truc['texte']; ?> 
                </p>
                <p><a href="archives.php">Voir tous les trucs</a></p>
                </article>
        </section>

                <p>
                    <a href="archives.php" > Voir toutes les archives</a>
                </p>
                <?php 
            // on insere le head en php php
            include('includes/footer.php');
        ?>
        </body>
    </html>
<?php // fichier : library/includes/header-back.php
// on recupere le chemin du script en cours

include('config/config.php');
$address = $_SERVER['PHP_SELF'];
// ondecoupe le chemin selon les /
$tab = explode('/', $address);
// on recupere la derniere case du tableau => longueure du tableau -1
$filename = $tab[count($tab) - 1];

if (empty($_GET['id'])) {
    
    //on cree la requete qui cherche l'insider correspondant a l'id
    $last_podcast = $mysql->prepare('SELECT * FROM podcast ORDER BY created_at DESC LIMIT 1');
    $last_podcast->execute();

    if( $last_podcast->rowCount() == 1){

                        $last_data = $last_podcast->fetch(PDO::FETCH_ASSOC);
    }
    else{
        redirect('404.php');
    }

}else{

//on cree la requete qui cherche l'insider correspondant a l'id
$podcast = $mysql->prepare('SELECT * FROM podcast WHERE id = :id');
$podcast->execute(array(
    ':id' => $_GET['id']
    ));

if( $podcast->rowCount() == 1){

                        $last_data = $podcast->fetch(PDO::FETCH_ASSOC);
}
else{
        redirect('404.php');
    }

}


$next = $mysql->prepare('SELECT * FROM podcast WHERE created_at > :datenext ORDER BY created_at ASC LIMIT 1 ');
$next->execute(array(
    ':datenext' => $last_data['created_at']
    ));
$nextid = $next->fetch(PDO::FETCH_ASSOC);



$before = $mysql->prepare('SELECT * FROM podcast WHERE created_at < :datebefore ORDER BY created_at DESC LIMIT 1 ');
$before->execute(array(
    ':datebefore' => $last_data['created_at']
    ));
$beforeid = $before->fetch(PDO::FETCH_ASSOC);


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
        
                <section class="podcast">
                    <div class="slides-container">
                        <div id="firtslide">
                            <audio preload="auto" id="son1">
                                <source src="<?php echo image($last_data['son']); ?>"></source>
                            </audio>
                            <div class="container">
                                 <p class="track"> <?php echo $last_data['titre']; ?>
                                <br /><span> Parisian Insider  <span>
                    <div class="btn-control">
                        <button data-am-button="small" class="btn-mute"><i class="fa fa-volume-off"></i></button>
                        <button data-am-button="large" class="btn-play-pause"><i class="fa fa-play"></i></button>
                        <button data-am-button="small" class="btn-stop"><i class="fa fa-stop"></i></button>	
                    </div>
                    <div class="progress-bar">
                        <span class="progress"></span>
                            </div>
                        </div>
                    </div>
                    </div>
                </section>
                <section class="podcast">
                   <div class="content">
                    <h1><?php echo $last_data['son_titre']; ?></h1><br />
                    <h2><?php echo $last_data['sous_titre'] ?> </h2><br />
                    <p><?php  echo $last_data['texte'];?></p>
                    <div id="arrow">

                    <?php if (!empty($beforeid)) {

                        $previd = $beforeid['id']; ?>
                    <a href="podcast.php?id=<?php echo $previd; ?>" id="btn-left"><span><i class="fa fa-angle-left" aria-hidden="true"></i> Podcast précédent</span></a>

                    <?php 
                }

                        if (!empty($nextid)) {
                            $suivantid = $nextid['id'];
                            $suivant =  '<a href="podcast.php?id='.$suivantid.'" id="btn-right"><span>Podcast suivant <i class="fa fa-angle-right" aria-hidden="true"></i></span></a>';

                            echo $suivant;

                        }

                    ?>
                   



                    </div>
                    <a href="#" class="map-toggle arrow">Lieu de l'interview</a>
                    <div id="map"></div>
                    </div>
                </section>

                  <?php
                    if (!empty($last_data['fb'])) {
                        ?>

                  <section id="facebook_comment">
                        <div id="fb-root"></div>
                            <script>(function(d, s, id) {
                                var js, fjs = d.getElementsByTagName(s)[0];
                                if (d.getElementById(id)) return;
                                js = d.createElement(s); js.id = id;
                                js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.6";
                                fjs.parentNode.insertBefore(js, fjs);
                                }(document, 'script', 'facebook-jssdk'));
                            </script>
                            <div class="fb-comments" data-href="<?php echo $last_data['fb'];?>" data-numposts="2" data-width="100%" data-include-parent="false" data-numposts="3"></div>
                            <div class="fb-like" data-href="https://www.facebook.com/Parisian-insider-1712567512292127/?fref=ts" data-layout="button" data-action="like" 
                            data-show-faces="true" >
                            </div>
                </section> 

                 <?php      
                    }

                 ?>
                <?php 
            // on insere le head en php php
            include('includes/footer.php');
        ?>

        
        </body>
        
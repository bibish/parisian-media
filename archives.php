<?php 
include('config/config.php');
// on recupere le chemin du script en cours
$address = $_SERVER['PHP_SELF'];
// ondecoupe le chemin selon les /
$tab = explode('/', $address);
// on recupere la derniere case du tableau => longueure du tableau -1
$filename = $tab[count($tab) - 1];



//on cree la requete qui cherche l'insider correspondant a l'id
$archives = $mysql->prepare('(SELECT id, \'truc\' AS genre, titre, texte, sous_titre, created_at,  image FROM truck)

UNION 

(SELECT id, \'insider\' AS genre, titre, text_before AS texte, sous_titre, created_at, image FROM insider)

UNION 

(SELECT id, \'podcast\' AS genre, titre, texte, sous_titre, created_at, \'\' AS image FROM podcast) ORDER BY created_at');
$archives->execute();


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
                <section class="archives">
                    <h1>Les archives</h1>
                    <div class="content clearfix">
                   

                    <!-- //on lit tous les resultats de la base -->
            <?php

                while( $archive = $archives->fetch(PDO::FETCH_ASSOC) ){
                        
                        //on recupere les infos sur l'utilisateur qui cree la fiche
                    ?>
                        
                     <a href="<?php echo $archive['genre'].'.php?id='.$archive['id'];?> ">
                        <div class="articles">
                            <figure>

                            <?php 

                                if ( $archive['genre'] == 'insider'){
                            ?>

                                   <img src="img/bg_ids.jpg" alt="Insider">
                            <?php

                                }else if ($archive['genre'] == 'podcast' ) {
                            ?>
                                    <img src="img/bg_pds.jpg" alt="Podcast">
                            <?php

                                }else if ($archive['genre'] == 'truc' ) {
                            ?>
                                    <img src="img/bg_trc.jpg" alt="Truc">
                            <?php

                                }
                            
                            ?>
                                
                            </figure>
                            <?php 

                                if ( $archive['genre'] == 'insider'){
                            ?>

                                <h1 class="titreinsider" ><?php echo substr($archive['titre'], 0,15).'...' ?></h1> 
                            <?php

                                }else if ($archive['genre'] == 'podcast' ) {
                            ?>
                                <h1 class="titrepodcast" ><?php echo substr($archive['titre'], 0,15).'...' ?></h1>  
                            <?php

                                }else if ($archive['genre'] == 'truc' ) {
                            ?>
                                <h1 class="titretruc" ><?php echo substr($archive['titre'], 0,15).'...' ?></h1>  
                            <?php

                                }
                            
                            ?>
                            

                            <?php 

                                if ( $archive['genre'] == 'insider'){
                            ?>

                                   
                                <span class="spaninsider"> <?php echo $archive['created_at'] ?> </span>
                            <?php

                                }else if ($archive['genre'] == 'podcast' ) {
                            ?>
                                    
                                <span class="spanpodcast"> <?php echo $archive['created_at'] ?> </span>
                            <?php

                                }else if ($archive['genre'] == 'truc' ) {
                            ?>
                                    
                                <span class="spantruc"> <?php echo $archive['created_at'] ?> </span>
                            <?php

                                }
                            
                            ?>
                            <p><?php echo substr($archive['texte'], 0,200).'...' ; ?></a></p>                            
                        </div>
                      </a>  

                     <?php 


                }
            ?>   


                    </div>
                    
                </section>
                <?php 
            // on insere le head en php php
            include('includes/footer.php');
        ?>
        </body>
    </html>
<?php

include('config/config.php');

$content = $mysql->prepare('SELECT * FROM content WHERE category = :c');
$content->execute(array(
   
   ':c' => 'contact'
  
  ));
 $last_data = $content->fetch(PDO::FETCH_ASSOC);
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
                <section class="contact">
                        <h1>Contactez-nous</h1>
                   <div class="content">
                    <p> <?php echo $last_data['texte']; ?></p>

                    <form action="core/contact.php" method="POST">


                        <p><input required type="text" name="prenom" placeholder="Prénom" /></p>

                        <p><input required type="text" name="nom" placeholder="Nom" /></p>

                        <p><input required type="text" name="email" placeholder="E-mail" /></p>

                        <p><input type="text" name="phone" placeholder="Téléphone" /></p>

                        <p>
                            <select required name="select">
                                <option disabled selected>Je suis...</option>
                                <option>Un homme</option>
                                <option>Une Femme</option>
                                <option>Autre chose ...</option>
                            </select>
                        </p>

                        <p>
                            <select required name="select_2">
                                <option disabled selected>J'écoute...</option>
                                <option>Le podcast de la semaine</option>
                                <option>L'insider de la semaine</option>
                                <option>Le truc de la semaine</option>
                                <option>Tout !</option>
                            </select>
                        </p>

                        <p><textarea required name="message" placeholder="Votre message..."></textarea></p>

                        <p><input type="submit" value="Envoyer" /></p>
                    </form>
                    </div>
                </section>
                <?php 
            // on insere le head en php php
            include('includes/footer.php');
        ?>
        </body>
    </html>
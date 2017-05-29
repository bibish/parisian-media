<?php //fichier core/contact.php
//on doit inclure le fichier de config/setting.php
include('../config/config.php');

require('../config/PHPMailerAutoload.php');
//si l'utilisateur n'est pas connecte

//si l'utilisateur n'a pas envoye le formulaire
if (empty($_POST))
	//on le renvoie sur la page formulaire
	redirect('../contact.php');
$error = false;
//si le titre n'est pas rempli
if (empty($_POST['message'])){
	//on cree un msg d'erreur
	flash_in('danger',' faut ecrire un message pour que ca marche il parait !.');
	$error = true;
}

if (empty($_POST['nom'])){
	//on cree un msg d'erreur
	flash_in('danger','Le nom est obligatoire .');
	$error = true;
}
if (empty($_POST['prenom'])){
	//on cree un msg d'erreur
	flash_in('danger','Le prenom est obligatoire.');
	$error = true;
}
if (empty($_POST['email'])){
	//on cree un msg d'erreur
	flash_in('danger','il nous faut ton email si on veux repondre ');
	$error = true;
}
if (empty($_POST['select'])){
	//on cree un msg d'erreur
	flash_in('danger','il manque un genre ');
	$error = true;
}
if (empty($_POST['select_2'])){
	//on cree un msg d'erreur
	flash_in('danger','faut aussi choisir une category d article  ');
	$error = true;
}
if ($error) {
	redirect('../contact.php');
}else{

	$colonnes = 'nom, prenom, email, texte, sexe, article ';
	$values = ':n, :pnom, :mail, :txt, :sexe, :article';
	$tab = array(
		':n' =>$_POST['nom'],
		':pnom' =>$_POST['prenom'],
		':mail' =>$_POST['email'],		
		':sexe' =>$_POST['select'],
		':article' =>$_POST['select_2'],
		':txt' => $_POST['message']
	);

}
if(!empty($_POST['phone'])){
		$colonnes .= ', phone';	
		$values .= ', :phone';
		$tab[':phone'] = $_POST['message'];
	}

	

	$insert = $mysql->prepare('INSERT INTO message ('.$colonnes.') VALUES('.$values.' )');
	$insert->execute($tab);

	

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtpauth.online.net';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'contact@parisianinsider.com';                 // SMTP username
$mail->Password = '3)y6Zn,X';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('contact@parisianinsider.com', 'Mailer');
$mail->addAddress($_POST['email'], $_POST['nom'].' '.$_POST['prenom']);     // Add a recipient
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Contact sur Parisian Insider';
$mail->Body    = 'Nous avons bien reçu votre message. Il sera traité rapidement.';
$mail->AltBody = 'Nous avons bien reçu votre message. Il sera traité rapidement.';

if(!$mail->send()) {
	flash_in('danger','Il y a eu un problème, veuillez re-essayer.'); 
} else {

//on va sur la page de detail du livre qui vient d'etre cree
	flash_in('success','On a recu le mail !'); 
}

$mail_parisian = new PHPMailer;

//$mail_parisian->SMTPDebug = 3;                               // Enable verbose debug output

$mail_parisian->isSMTP();                                      // Set mailer to use SMTP
$mail_parisian->Host = 'smtpauth.online.net';  // Specify main and backup SMTP servers
$mail_parisian->SMTPAuth = true;                               // Enable SMTP authentication
$mail_parisian->Username = 'contact@parisianinsider.com';                 // SMTP username
$mail_parisian->Password = '3)y6Zn,X';                           // SMTP password
$mail_parisian->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail_parisian->Port = 587;                                    // TCP port to connect to

$mail_parisian->setFrom('contact@parisianinsider.com', 'Mailer');
$mail_parisian->addAddress('parisian.inside@gmail.com');     // Add a recipient
$mail_parisian->isHTML(true);                                  // Set email format to HTML

$mail_parisian->Subject =  $_POST['nom'].' '.$_POST['prenom'] ;
$mail_parisian->Body    =  $_POST['nom'].', '.$_POST['prenom'].' /'.$_POST['select'].' /'.$_POST['select_2'].' /'.$_POST['message'].' et son mail : '.$_POST['email'];
$mail_parisian->AltBody =  $_POST['nom'].', '.$_POST['prenom'].' /'.$_POST['select'].' /'.$_POST['select_2'].' /'.$_POST['message'].' et son mail : '.$_POST['email'];

$mail_parisian->send();
	//on va sur la page de detail du livre qui vient d'etre cree
	redirect('../contact.php');	


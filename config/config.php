<?php //fichier :library/setting.php

//on demarre la session
session_start();

//on initialise les msgs de session
if (!isset($_SESSION['message']))
	$_SESSION['message'] =[];


// on cree une connexion a la base de donnees
define("SQL_HOST", "lalala");
define("SQL_USER", "lalala");
define("SQL_PASS", "mieux vaut essayer de taper root");
define("SQL_DBNAME", "un nom random de db");



 // define("SQL_HOST", "localhost");
 // define("SQL_USER", "root");
 // define("SQL_PASS", "root");
 // define("SQL_DBNAME", "ParisianInsider");

// On lance la connexion a la base
try{
    $mysql = new PDO("mysql:dbname=".SQL_DBNAME.";charset=utf8;host=".SQL_HOST,SQL_USER,SQL_PASS);

} catch(Exception $e){ // on recupere les erreurs eventuelles
    die('Erreur : ' .$e->getMessage());
}


//on importe les fonctions
include('function.php');
<?php //fichier :/core/deco.php

//on met la config
include('../config/config.php');

//on vide les variables de session
unset($_SESSION['user_id']);
unset($_SESSION['user_pseudo']);
$_SESSION = null;

//on detruit la session
session_destroy();

//on redirige vers le login
redirect('../back/login.php');
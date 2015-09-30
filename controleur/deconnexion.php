<?php
session_start();

if (isset($_SESSION["pseudo"]))
{
	//Destruction de la session + message OK
	$_SESSION = array();
	session_destroy();

	$deco = true;
}
else
{
	//Message KO
	$deco = false;
}

//Connexion/déconnexion
if (isset($_SESSION["pseudo"]))
{
	//Affichage "Bienvenue, pseudo" + déco
	$menu = true;
}
else
{
	//Affichage co
	$menu = false;
}

include_once("vue/deconnexion.php")
?>
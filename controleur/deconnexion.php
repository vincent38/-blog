<?php
session_start();

//Inclusion des ID SQL
include_once("modele/connexionsql.php");
//Inclusion des fonctions relatives aux membres
include_once("modele/fonctionsdb.php");

if (isset($_SESSION["pseudo"]))
{
	//Destruction de la session + message OK
	$_SESSION = array();
	session_destroy();

	setcookie("username","",time()-3600,null,null,false,true);
	setcookie("passwd","",time()-3600,null,null,false,true);

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

$title = "Déconnexion ...";

include_once("vue/deconnexion.php")
?>
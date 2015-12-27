<?php
/*
	controleur/charte.php par Vincent AUBRIOT
	Availible @ https://github.com/vincent38/-blog/
	Contient : Charte

	Inclus dans : ../charte.php
*/
session_start();

//Inclusion connexionBDD
include_once("modele/connexionsql.php");

//Inclusion fonctions SQL
include_once("modele/fonctionsdb.php");

//Inclusion api
include_once("apivariables.php");

//Test si maintenance
if(returnValueFromParam("maintenanceMode") == "true"){
	header("Location: maintenance.php");
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

$title = "Charte du site";

//Inclusion vue index 
include_once("vue/charte.php");
?>

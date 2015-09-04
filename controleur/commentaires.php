<?php
/*
	controleur/commentaires.php par Vincent AUBRIOT
	Availible @ https://github.com/vincent38/-blog/
	Contient : Récupération du billet via GET, affichage/envoi de commentaires

	Inclus dans : ../commentaires.php
*/

//Inclusion connexionBDD
include_once("modele/connexionsql.php");

//Inclusion fonctions SQL
include_once("modele/fonctionsdb.php");

//GESTION DES BILLETS

if (isset($_GET["id"]))
{
	$billets = AffichageBillet($_GET["id"]);
}
else
{
	die ;
}

//Inclusion vue index
include_once("vue/commentaires.php");
?>
<?php

session_start();

//Inclusion connexionBDD
include_once("modele/connexionsql.php");

//Inclusion fonctions SQL
include_once("modele/fonctionsdb.php");

//Get images
$listepics = AffichageNomsImages();

//Tri images
foreach ($listepics as $cle => $pic)
{
	$listepics["cle"]["id"] = $pic["id"];
	$listepics["cle"]["name"] = htmlspecialchars($pic["name"]);
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

include_once("vue/add_post.php");
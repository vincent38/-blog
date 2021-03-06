<?php

session_start();

//pub
$pub = "";

//Inclusion des ID SQL
include_once("modele/connexionsql.php");
//Inclusion des fonctions relatives aux membres
include_once("modele/fonctionsdb.php");

//Test si maintenance
if(returnValueFromParam("maintenanceMode") == "true"){
	header("Location: maintenance.php");
}

//Session checker 3000
if (empty($_SESSION))
{
	header("Location: connexion.php");
}

//Gravatar
$url = get_gravatar($_SESSION["mail"]);

//Select comms
$nbcomms = selectComms($_SESSION["pseudo"]);

//Select posts
$nbposts = selectPosts($_SESSION["pseudo"]);

//Select comms G
$nbcommstempG = selectCommsGlobal();
 
//comms autres
$nbcommsG = $nbcommstempG - $nbcomms;

//Select posts G
$nbpoststempG = selectPostsGlobal();

//Posts autres
$nbpostsG = $nbpoststempG - $nbposts;

//Ranking
$rank = Ranking($_SESSION["pseudo"]);

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

$title = "Bienvenue, ".$_SESSION["pseudo"]." - voici votre profil.";

include_once("vue/membre.php");
?>
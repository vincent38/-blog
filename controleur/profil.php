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

if (isset($_GET["pseudo"]) AND !empty($_GET["pseudo"]))
{
	$user = getUserByPseudo($_GET["pseudo"]);

	if (!empty($user))
	{
		$title = "Profil de ".$user["pseudo"];
	} else {
		$title = "Profil inexistant";
	}

	//Gravatar
	$url = get_gravatar($user["mail"]);
	
	//Select comms
	$nbcomms = selectComms($user["pseudo"]);
	
	//Select posts
	$nbposts = selectPosts($user["pseudo"]);
	
	//Select comms G
	$nbcommstempG = selectCommsGlobal();
	 
	//comms autres
	$nbcommsG = $nbcommstempG - $nbcomms;
	
	//Select posts G
	$nbpoststempG = selectPostsGlobal();
	
	//Posts autres
	$nbpostsG = $nbpoststempG - $nbposts;
	
	//Ranking
	$rank = Ranking($user["pseudo"]);
	
	//Date inscription
	$date = $user["date_i"];
} else {
	$title = "Merci de renseigner un pseudo !";
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

include_once("vue/profil.php");
?>
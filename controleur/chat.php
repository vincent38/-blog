<?php

session_start();

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
else
{
	//Affichage "Bienvenue, pseudo" + déco
	$menu = true;
}

//Test permissions
$access = RankingComment($_SESSION["pseudo"]);
if ($access["miaounet_mod"] == "0")
{
	header("Location: index.php");
}

$messages = getMessageOnChat();

$title = "MiaouNET - Chat interne";

include_once("vue/chat.php");
?>
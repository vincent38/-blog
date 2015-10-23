<?php

session_start();

//Inclusion des ID SQL
include_once("modele/connexionsql.php");
//Inclusion des fonctions relatives aux membres
include_once("modele/fonctionsdb.php");

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
if ($access["miaounet_admin"] == "0")
{
	header("Location: index.php");
}

if (!empty($_POST["rank"]) AND !empty($_POST["id"]))
{
	setRank($_POST["id"], $_POST["rank"]);
}

if (!isset($_GET["id"]))
{
	header("Location: index.php");
}
else
{
	$user = getUser($_GET["id"]);
	if (empty($user["pseudo"]))
	{
		header("Location: index.php");
	}
}

include_once("vue/edit_rank.php");
?>
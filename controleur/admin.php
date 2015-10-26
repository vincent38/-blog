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

$users = getUsers();

foreach ($users as $cle => $user)
{
	$users["cle"]["pseudo"] = htmlspecialchars($user["pseudo"]);
	$users["cle"]["date_inscription"] = $user["date_inscription"];
	$users["cle"]["id"] = $user["id"];
	$users["cle"]["rank"] = $user["rank"];
}

$title = "MiaouNET - Administration";

include_once("vue/admin.php");
?>
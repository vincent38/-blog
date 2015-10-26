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
if ($access["miaounet_mod"] == "0")
{
	header("Location: index.php");
}

$comments = AffichageCommentairesGeneral();
foreach ($comments as $cle => $comment)
{
	$comments["cle"]["auteur"] = htmlspecialchars($comment["auteur"]);
	$comments["cle"]["datewrote"] = $comment["datewrote"];
	$comments["cle"]["commentaire"] = nl2br(htmlspecialchars($comment["commentaire"]));
}

$posts = AffichagePostsGeneral();

foreach ($posts as $cle => $post)
{
	$posts["cle"]["titre"] = htmlspecialchars($post["titre"]);
	$posts["cle"]["auteur"] = htmlspecialchars($post["auteur"]);
	$posts["cle"]["contenu"] = nl2br(htmlspecialchars($post["contenu"]));
	$posts["cle"]["available"] = $post["available"];
}

$title = "MiaouNET - Modération";

include_once("vue/moderation.php");
?>
<?php
/*
	controleur/commentaires.php par Vincent AUBRIOT
	Availible @ https://github.com/vincent38/-blog/
	Contient : Récupération du billet via GET, affichage/envoi de commentaires

	Inclus dans : ../commentaires.php
*/
session_start();

//pub
$pub = "";

//Inclusion connexionBDD
include_once("modele/connexionsql.php");

//Inclusion fonctions SQL
include_once("modele/fonctionsdb.php");

//Inclusion api
include_once("apivariables.php");

//Ajouter un commentaire
if (isset($_SESSION["pseudo"]) AND isset($_POST["id_billet"]) AND isset($_POST["commentaire"]))
{
	
		PostComment($_POST["id_billet"], $_SESSION["pseudo"], $_POST["commentaire"]);
		$published = true;
		
}

//PRINT COMMENT FORM

if (isset($_SESSION["pseudo"]))
{
	//Ranking
	$usercomment = RankingComment($_SESSION["pseudo"]);
	if ($usercomment["write_comment"] == "1")
	{
		$form = true;
	}
	else
	{
		$form = false;
		$error = "<h4>Poster un commentaire :</h4><p><i class=\"fa fa-times\"></i> Vous n'avez pas les permissions requises pour poster un commentaire !</p><br />";
	}
}
else
{
	$form = false;
	$error = "<h4>Poster un commentaire :</h4><p><i class=\"fa fa-times\"></i> Merci de vous connecter pour pouvoir poster un commentaire !</p><br />";
}


//GESTION DES BILLETS

if (isset($_GET["id"]))
{
	$billets = AffichageBillet($_GET["id"]);
	$comments = AffichageCommentaires($_GET["id"]);
	foreach ($comments as $cle => $comment)
	{
		$comments["cle"]["auteur"] = htmlspecialchars($comment["auteur"]);
		$comments["cle"]["datewrote"] = $comment["datewrote"];
		$comments["cle"]["commentaire"] = nl2br(htmlspecialchars($comment["commentaire"]));
	}
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

$billets["titre"] = preg_replace("#(\\\')#i","'", $billets["titre"]); //'
$billets["titre"] = preg_replace('#(\\\"")#i','"', $billets["titre"]); //'

$title = $billets["titre"];

//Inclusion vue index 
include_once("vue/commentaires.php");
?>

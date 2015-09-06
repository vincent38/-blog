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

//Inclusion fonctions SQL
include_once("apivariables.php");

//Ajouter un commentaire
if (isset($_POST["auteur"]) AND isset($_POST["id_billet"]) AND isset($_POST["commentaire"]) AND isset($_POST["g-recaptcha-response"]))
{
	if ($_POST["g-recaptcha-response"] == true)
		{
			PostComment($_POST["id_billet"], $_POST["auteur"], $_POST["commentaire"]);
			$published = true;
		}
		else
		{
			$published = false;
		}
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

//Inclusion vue index 
include_once("vue/commentaires.php");
?>

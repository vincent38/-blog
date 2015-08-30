<?php
/*
	controleur/index.php par Vincent AUBRIOT
	Availible @ https://github.com/vincent38/-blog/
	Contient : Gestion de la récupération des billets et de la pagination,
	gestion des membres connectés/non connectés.

	Inclus dans : ../index.php
*/

//Inclusion connexionBDD
include_once("modele/connexionsql.php");

//Inclusion fonctions SQL
include_once("modele/fonctionsdb.php");

//GESTION DES BILLETS

$billets = AffichageIndex();

foreach ($billets as $cle => $billet)
{
	$billets["cle"]["titre"] = htmlspecialchars($billet["titre"]);
	$billets["cle"]["auteur"] = htmlspecialchars($billet["auteur"]);
	$billets["cle"]["contenu"] = nl2br(htmlspecialchars($billet["contenu"]));
}

//Inclusion vue index
include_once("vue/index.php");
?>
<!--
	//BBCODE-like
	$billets["cle"]["contenu"] = preg_replace("#\[alert=(success|info|warning|danger)\](.+)\[/alert\]#isU","<div class=\"alert alert-$1\" role=\"alert\">$2</div>",$billet["contenu"]); //bold
	$billets["cle"]["contenu"] = preg_replace("#\[b\](.+)\[/b\]#isU","<strong>$1</strong>",$billet["contenu"]); //bold
	$billets["cle"]["contenu"] = preg_replace("#\[i\](.+)\[/i\]#isU","<em>$1</em>",$billet["contenu"]); //italic
	$billets["cle"]["contenu"] = preg_replace("#\[color=(blue|red|green|\#[a-z0-9]{6})\](.+)\[/color\]#isU","<span style=\"color: $1\">$2</strong>",$billet["contenu"]); //color
	$billets["cle"]["contenu"] = preg_replace("#url!(https?://[a-z0-9._/-]+[a-z0-9A-Z&\?._=-]*)#i", "<a href='$1'>$1</a>", $billet["contenu"]); // url (with url!)
	$billets["cle"]["contenu"] = preg_replace("#\[img=(.+)\](https?://[a-z0-9._/-]+[a-z0-9A-Z&\?._=-]*)\[/img\]#isU", "<img src='$2' alt='$1'/>", $billet["contenu"]); //images
	$billets["cle"]["contenu"] = preg_replace("#(\\\')#i","'", $billet["contenu"]); //'
	//Fin du BBCODE-like
-->
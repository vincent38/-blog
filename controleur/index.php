<?php
/*
	controleur/index.php par Vincent AUBRIOT
	Availible @ https://github.com/vincent38/-blog/
	Contient : Gestion de la récupération des billets et de la pagination,
	gestion des membres connectés/non connectés.

	Inclus dans : ../index.php
*/

session_start();

//pub
$pub = "";

//Inclusion connexionBDD
include_once("modele/connexionsql.php");

//Inclusion fonctions SQL
include_once("modele/fonctionsdb.php");

//Test si maintenance
if(returnValueFromParam("maintenanceMode") == "true"){
	header("Location: maintenance.php");
}

if (isset($_GET["page"]))
{
	$page = (int) $_GET["page"];
	$dernier = 10;
	$premier = ($page * 10) - 10;
	if ($_GET["page"] == 1)
	{
		$dernier = 10;
		$premier = 0;
	}
}
else
{
	$dernier = 10;
	$premier = 0;
}

//GESTION DES BILLETS

$billets = AffichageIndex($premier,$dernier);

if (empty($billets))
{
	header("Location: index.php");
}

foreach ($billets as $cle => $billet)
{
	$billets["cle"]["titre"] = htmlspecialchars($billet["titre"]);
	$billets["cle"]["auteur"] = htmlspecialchars($billet["auteur"]);
	$billets["cle"]["contenu"] = nl2br(htmlspecialchars($billet["contenu"]));
}

//Test si page suivante/précédente possible

//Page précédente
if ($premier == 0)
{
	$precedent = false;
}
else
{
	$precedent = true;
	if (isset($_GET["page"]))
	{
		$pagePrecedent = (int) $_GET["page"];
		$pagePrecedent = $pagePrecedent - 1;
	}
	else
	{
		$pagePrecedent = 0;
	}

}

//Page suivante

if (isset($_GET["page"]))
{
	$page = (int) $_GET["page"];
}
else
{
	$page = 1;
}

$controlDernier = (($page + 1) * 10) - 1;
$controlPremier = $controlDernier - 10;
$next = AffichageIndex($controlPremier,$controlDernier);
if (empty($next))
{
	$suivant = false;
}
else
{
	$suivant = true;
	$pageSuivant = $page + 1;
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

$title = "Bienvenue chez vincent !";

//Gestion carrousel
$carrouselShow = returnValueFromParam("carrousel");
$tagShow = returnValueFromParam("tagcloud");
$img1 = returnValueFromParam("img1");
$img2 = returnValueFromParam("img2");
$img3 = returnValueFromParam("img3");
$link1 = returnValueFromParam("link1");
$link2 = returnValueFromParam("link2");
$link3 = returnValueFromParam("link3");

//Get categories + listing tag cloud
$cats = AffichageNomsCat();

foreach ($cats as $cle => $cat)
{
	$cats["cle"]["id"] = $cat["id"];
	$cats["cle"]["nom"] = htmlspecialchars($cat["nom"]);
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
<?php
/*
	controleur/maintenance.php par Vincent AUBRIOT
	Availible @ https://github.com/vincent38/-blog/
*/

session_start();

//pub
$pub = "";

//Inclusion connexionBDD
include_once("modele/connexionsql.php");

//Inclusion fonctions SQL
include_once("modele/fonctionsdb.php");

//Test si non maintenance
if(returnValueFromParam("maintenanceMode") == "false"){
	header("Location: index.php");
}

//Get maintenance message
$status = returnValueFromParam("maintenanceMessage");

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

$title = "Maintenance en cours !";

//Inclusion vue index
include_once("vue/maintenance.php");
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
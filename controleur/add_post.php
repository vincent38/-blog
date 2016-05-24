<?php

session_start();

//Inclusion connexionBDD
include_once("modele/connexionsql.php");

//Inclusion fonctions SQL
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
	$author = $_SESSION["pseudo"];
}

//Test permissions
$access = RankingComment($_SESSION["pseudo"]);
if ($access["miaounet_mod"] == "0")
{
	header("Location: index.php");
}

//Get images
$listepics = AffichageNomsImages();

//Imageshack
if (!empty($_SESSION["token"]))
{
	$imgshack = true;
} else {
	$imgshack = false;
}

//Tri images
foreach ($listepics as $cle => $pic)
{
	$listepics["cle"]["id"] = $pic["id"];
	$listepics["cle"]["name"] = htmlspecialchars($pic["name"]);
}

$listeCats = AffichageNomsCat();

foreach ($listeCats as $cle => $cat)
{
	$listeCats["cle"]["id"] = $cat["id"];
	$listeCats["cle"]["nom"] = htmlspecialchars($cat["nom"]);
}

//Variables de base
$post = false;

//Détection si billet présent sur POST -> Envoi du billet
if (isset($_POST["auteur"]) AND isset($_POST["titre"]) AND isset($_POST["contenu"]) AND isset($_POST["pic"]) AND isset($_POST["cat"]) AND !empty($_POST["titre"]) AND !empty($_POST["auteur"]) AND !empty($_POST["contenu"]))
		{
			if (!isset($_POST["available"]))
			{
				$available = 1;
			}
			else
			{
				$available = 0;
			}

			if (isset($_POST["pic"]))
			{
				PostBillet($_POST["titre"], $_POST["auteur"], $_POST["contenu"], $_POST["pic"], $available, $_POST["cat"]);
				$post = true;
			}
			else
			{
				PostBillet($_POST["titre"], $_POST["auteur"], $_POST["contenu"], "", $available, $_POST["cat"]);
				$post = true;
			}
			
		}

$title = "Edition en cours d'un nouveau billet ...";

include_once("vue/add_post.php");
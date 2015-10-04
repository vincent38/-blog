<?php

session_start();

//Inclusion connexionBDD
include_once("modele/connexionsql.php");

//Inclusion fonctions SQL
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

//Tri images
foreach ($listepics as $cle => $pic)
{
	$listepics["cle"]["id"] = $pic["id"];
	$listepics["cle"]["name"] = htmlspecialchars($pic["name"]);
}

//Variables de base
$post = false;

//Détection si billet présent sur POST -> Envoi du billet
if (isset($_POST["auteur"]) AND isset($_POST["titre"]) AND isset($_POST["contenu"]) AND isset($_POST["picture"]) AND !empty($_POST["titre"]) AND !empty($_POST["auteur"]) AND !empty($_POST["contenu"]))
		{
			if (isset($_POST["image"]))
			{
				PostBillet($_POST["titre"], $_POST["auteur"], $_POST["contenu"], $_POST["image"]);
				$post = true;
			}
			else
			{
				PostBillet($_POST["titre"], $_POST["auteur"], $_POST["contenu"], "");
				$post = true;
			}
			
		}


include_once("vue/add_post.php");
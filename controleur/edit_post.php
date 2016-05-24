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

//Charger une news dans l'éditeur
if (isset($_GET["id"]))
		{
			$postToEdit = AffichageBillet($_GET["id"]);
			if (!empty($postToEdit))
			{
				$alarmNoPostDetected = false;
				$postToEdit["titre"] = preg_replace("#(\\\')#i","'", $postToEdit["titre"]); //'
				$postToEdit["titre"] = preg_replace('#(\\\")#i','"', $postToEdit["titre"]); //'
				$title = "Edition en cours de : ".$postToEdit["titre"];
			}
			else
			{
				$alarmNoPostDetected = true;
				$title = "Editeur déchargé.";
			}
			
		}
		else
		{
			$alarmNoPostDetected = true;
			$title = "Editeur déchargé.";
		}

//Variables de base
$post = false;

//Détection si billet présent sur POST -> Modification du billet
if (isset($_POST["auteur"]) AND isset($_POST["titre"]) AND isset($_POST["contenu"]) AND !empty($_POST["titre"]) AND !empty($_POST["auteur"]) AND !empty($_POST["contenu"]))
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
				EditBillet($_POST["titre"], $_POST["auteur"], $_POST["contenu"], $_POST["pic"], $_POST["id"], $available);
				$post = true;
				$alarmNoPostDetected = false;
				$title = "Post édité :)";
			}
			else
			{
				EditBillet($_POST["titre"], $_POST["auteur"], $_POST["contenu"], "", $_POST["id"], $available);
				$post = true;
				$alarmNoPostDetected = false;
				$title = "Post édité :)";
			}
			
		}


include_once("vue/edit_post.php");
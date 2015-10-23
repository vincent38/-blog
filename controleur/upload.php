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

//Partie upload images

if (isset($_FILES["pic"]) AND isset($_POST["desc"]) AND !empty($_POST["desc"]) AND $_FILES["pic"]["error"]==0)
{
	if ($_FILES["pic"]["size"] <= 8000000)
	{
		$aboutfile = pathinfo($_FILES["pic"]["name"]);
		$extension = $aboutfile["extension"];
		$allowed = array('jpg','jpeg','gif','png');
		if (in_array($extension,$allowed))
		{			
			$posnumber = checkPosNumberImg();
			$namepic = $posnumber["totalimg"] + 1;
			move_uploaded_file($_FILES["pic"]["tmp_name"],"uploads/".$namepic.".".$extension);
			$finalname = $namepic.".".$extension;
			
			//Fct include DB

			insertImg($finalname, $_POST["desc"]);

			$error = "<div class=\"alert alert-success\" role=\"alert\">La photo a été importée !<br /><br />Nom : ".$finalname."<br /><br /><a href=\"index.php\"><-- Revenir au menu de modération !</a></div>";
		}
		else
		{
			$error = "<div class=\"alert alert-danger\" role=\"alert\">Le fichier ne porte pas une extension autorisée !<br /><br /><a href=\"index.php\"><-- Revenir au menu de modération !</a></div>";
		}
	}
	else
	{
		$error = "<div class=\"alert alert-danger\" role=\"alert\">Le fichier est trop lourd ! (RAPPEL : 8 Mo MAX. !)<br /><br /><a href=\"index.php\"><-- Revenir au menu de modération !</a></div>";
	}
} 
/*
else
{
	$error = "<div class=\"alert alert-danger\" role=\"alert\">Une erreur est survenue à l'upload !<br /><br /><a href=\"index.php\"><-- Revenir au menu de modération !</a></div>";
}
*/

if (isset($_POST["desc"]) AND empty($_POST["desc"]))
{
	$error = "<div class=\"alert alert-danger\" role=\"alert\">Aucune description n'a été entrée !<br /><br /><a href=\"index.php\"><-- Revenir au menu de modération !</a></div>";
}

include_once("vue/upload.php");
?>
<?php
//Inclusion des ID SQL
include_once("modele/connexionsql.php");
//Inclusion des fonctions relatives aux membres
include_once("modele/fonctionsdb.php");

$box = "";
$status = "";

if (isset($_SESSION["pseudo"]))
{
	header("Location: index.php");
}
//Vérification : si les variables POST sont définies, traitement de l'inscription / sinon affichage formulaire
if (isset($_POST["pseudo"]) AND isset($_POST["pass1"]) AND isset($_POST["pass2"]) AND isset($_POST["mail"]))
{
	//Vérification de l'email
	if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,15}$#", $_POST["mail"]))
	{
		//Adresse mail validée
		//Vérification du pseudo
		$pseudoAlreadyExists = pseudoAlreadyExists($_POST["pseudo"]);
		if ($pseudoAlreadyExists == false)
		{
			//Le pseudo est disponible
			//Verification des MdP et cryptage
			if ($_POST["pass1"] == $_POST["pass2"])
			{
				//Les deux MdP sont identiques, cryptage
				$cryptedPasswd = sha1("y01op4s5wd".$_POST["pass1"]);
				//On inscrit le tout dans la DB
				inscriptionMembre($_POST["pseudo"], $cryptedPasswd, $_POST["mail"]);
				$status = "Inscription terminée ! :D";
				$box = "alert alert-success";
				$form = false;
			}
			else
			{
				$status = "Les mots de passe ne correspondent pas.";
				$box = "alert alert-warning";
				$form = true;
			}
		}
		else
		{
			$status = "Le pseudo est déjà utilisé.";
			$box = "alert alert-warning";
			$form = true;
		}
	}
	else
	{
		$status = "L'adresse mail fournie n'est pas conforme.";
		$box = "alert alert-warning";
		$form = true;
	}
}
else
{
	$form = true;
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

include_once("vue/inscription.php");
?>
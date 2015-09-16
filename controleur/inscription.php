<?php
//Inclusion des ID SQL
include_once("modele/connexionsql.php");
//Inclusion des fonctions relatives aux membres
include_once("modele/fonctionsdb.php");

//Vérification : si les variables POST sont définies, traitement de l'inscription / sinon affichage formulaire
if (isset($_POST["pseudo"]) AND isset($_POST["pass1"]) AND isset($_POST["pass2"]) AND isset($_POST["mail"]))
{
	//Vérification de l'email
	if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,10}$#", $_POST["mail"]))
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
				echo "Inscription terminée ! :D";
				$form = false;
			}
			else
			{
				echo "les mdp ne correspondent pas.";
				$form = false;
			}
		}
		else
		{
			echo "Le pseudo n'est pas disponible.";
			$form = false;
		}
	}
	else
	{
		echo "Adresse mail fausse";
		$form = false;
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
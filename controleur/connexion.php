<?php
//Démarrage de la session
session_start();
//Inclusion des ID SQL
include_once("modele/connexionsql.php");
//Inclusion des fonctions relatives aux membres
include_once("modele/fonctionsdb.php");

include_once("apivariables.php");

if (isset($_SESSION["pseudo"]))
{
	header("Location: index.php");
}

$status = "";
$box = "";

//Test : si le visiteur a une connexion automatique ou est déjà connecté, on peut refuser l'accès à des pages
if (isset($_COOKIE["username"]) AND isset($_COOKIE["passwd"]))
{
	$reponse = connexionMembre($_COOKIE["username"], $_COOKIE["passwd"]);
	if ($reponse == true)
	{
		setSessionUser($_COOKIE["username"]);
		$status .= "Connecté !<br />";
		$box = "alert alert-success";
		$form = false;
	}
	else
	{
		$status .= "Vos cookies de connexion sont erronés !";
		$box = "alert alert-warning";
		setcookie("username","",time()-3600,null,null,false,true);
		setcookie("passwd","",time()-3600,null,null,false,true);
		$form = true;
	}
}
else //Aucun cookie défini ou utilisateur non connecté, donc on affiche le formulaire / on effectue le traitement
{
	//Si les variables POST sont définies, connexion, sinon affichage du formulaire de connexion
	if (isset($_POST["pseudo"]) AND isset($_POST["pass"]))
	{
		//Variables définies, on cherche à savoir si le pseudo et le mot de passe existent et si ils sont bien reliés
		$pass = $_POST["pass"];
		$cryptedPass = sha1($password_salt.$pass);
		$reponse = connexionMembre($_POST["pseudo"], $cryptedPass);

		//Si true, alors définir variables de session, et éventuellement les cookies
		if ($reponse == true)
		{
			setSessionUser($_POST["pseudo"]);
			if ($_SESSION["rank"] == 1)
			{
				$status .= "<i class=\"fa fa-times\"></i> Accès interdit, vous avez été banni par un administrateur :/<br />";
				$box = "alert alert-danger";
				$form = true;
				$_SESSION = array();
				session_destroy();
				setcookie("username","",time()-3600,null,null,false,true);
				setcookie("passwd","",time()-3600,null,null,false,true);
			}
			else
			{
				$status .= "<i class=\"fa fa-check\"></i> Connecté !<br />";
				$box = "alert alert-success";
				$form = false;
				if (isset($_POST["autoco"]))
				{
					setcookie("username",$_POST["pseudo"],time()+365*24*3600,null,null,false,true);
					setcookie("passwd",$cryptedPass,time()+365*24*3600,null,null,false,true);
					$status .= "Connexion automatique installée pour 1 an !";
				}
			}
		}
		else
		{
			$status .= "<i class=\"fa fa-times\"></i> Nom d'utilisateur ou MdP faux.";
			$box = "alert alert-warning";
			$form = true;
		}
	}
	else
	{
		$form = true;
	}
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

$title = "Formulaire de connexion";

include_once("vue/connexion.php")
?>
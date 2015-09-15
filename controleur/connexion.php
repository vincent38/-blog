<?php
//Démarrage de la session
session_start();
//Inclusion des ID SQL
include_once("modele/connexionsql.php");
//Inclusion des fonctions relatives aux membres
include_once("modele/fonctionsdb.php");

//Test : si le visiteur a une connexion automatique ou est déjà connectée, on peut refuser l'accès à des pages
if (isset($_COOKIE["username"]) AND isset($_COOKIE["passwd"]))
{
	$reponse = connexionMembre($_COOKIE["username"], $_COOKIE["passwd"]);
	if ($reponse == true)
	{
		setSessionUser($_COOKIE["username"]);
		echo "Connecté !<br />";
		$form = false;
	}
	else
	{
		echo "Vos cookies de connexion sont erronés !";
		setcookie("username",$_POST["pseudo"],time()-3600,null,null,false,true);
		setcookie("passwd",$cryptedPass,time()-3600,null,null,false,true);
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
		$cryptedPass = sha1("y01op4s5wd".$pass);
		$reponse = connexionMembre($_POST["pseudo"], $cryptedPass);

		//Si true, alors définir variables de session, et éventuellement les cookies
		if ($reponse == true)
		{
			setSessionUser($_POST["pseudo"]);
			echo "Connecté !<br />";
			$form = false;
			if (isset($_POST["autoco"]))
			{
				setcookie("username",$_POST["pseudo"],time()+365*24*3600,null,null,false,true);
				setcookie("passwd",$cryptedPass,time()+365*24*3600,null,null,false,true);
				echo "Connexion automatique installée pour 1 an !";
			}
		}
		else
		{
			echo "Nom d'utilisateur ou MdP faux.";
			$form = true;
		}
	}
	else
	{
		$form = true;
	}
}


include_once("vue/connexion.php")
?>
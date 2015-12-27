<?php

//Démarrage de la session
session_start();
//Inclusion des ID SQL
include_once("modele/connexionsql.php");
//Inclusion des fonctions relatives aux membres
include_once("modele/fonctionsdb.php");

include_once("apivariables.php");

//Test if form == true
$contactForm = returnValueFromParam("contact");

if (isset($_POST["mail"]) AND isset($_POST["message"]) AND isset($_POST["g-recaptcha-response"]))
{
	$niveauAlerte = "alert-success";
	$sendingMailStatus = "Statut : ";
	if ($_POST["g-recaptcha-response"] == true)
	{
		if (preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,10}$#", $_POST["mail"]))
		{
			$mail = $_POST['mail'];
			$content = $_POST["message"];
			$from="From: $mail\r\nReturn-path: $mail"; 
			$to = returnValueFromParam("contact");
			mail($to, "Nouveau message envoyé depuis le formulaire", $content, $from);
			$sendingMailStatus = $sendingMailStatus."[OK] - Email envoyé, merci pour votre message :D !";		
		}
		else
		{
			$sendingMailStatus = $sendingMailStatus."[ERREUR] - Adresse mail invalide !";
			$niveauAlerte = "alert-danger";
		}
	}
	else
	{
		$sendingMailStatus = $sendingMailStatus."[ERREUR] - Captcha invalide !";
		$niveauAlerte = "alert-danger";
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

$title = "Contact";

include_once("vue/contact.php");
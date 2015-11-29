<?php
//Inclusion des ID SQL
include_once("modele/connexionsql.php");
//Inclusion des fonctions relatives aux membres
include_once("modele/fonctionsdb.php");

include_once("apivariables.php");

//Test si maintenance
if(returnValueFromParam("maintenanceMode") == "true"){
	header("Location: maintenance.php");
}

$box = "";
$status = "";

if (isset($_SESSION["pseudo"]))
{
	header("Location: index.php");
}
//Vérification : si les variables POST sont définies, traitement de l'inscription / sinon affichage formulaire
if (isset($_POST["pseudo"]) AND isset($_POST["pass1"]) AND isset($_POST["pass2"]) AND isset($_POST["mail"]) AND isset($_POST["g-recaptcha-response"]))
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
				$cryptedPasswd = sha1($password_salt.$_POST["pass1"]);
				if ($_POST["g-recaptcha-response"] == true)
				{
					//On inscrit le tout dans la DB
					inscriptionMembre($_POST["pseudo"], $cryptedPasswd, $_POST["mail"]);
					$status = "<i class=\"fa fa-check\"></i> Inscription terminée ! :D
								<script type=\"text/javascript\">
					        window.onload = Init;
					        var waitTime = 5; // Temps d'attente en seconde
					        var url = 'connexion.php';     // Lien de destination
					        var x;
					        function Init() {
					                window.document.getElementById('compteur').innerHTML = waitTime;
					                x = window.setInterval('Decompte()', 1000);
					        }
					        function Decompte() {
					                ((waitTime > 0)) ? (window.document.getElementById('compteur').innerHTML = --waitTime) : (window.clearInterval(x));
					                if (waitTime == 0) {
					                        window.location = url;
					                }
					                if (waitTime == 1) {
					                        window.document.getElementById('sec').innerHTML = 'seconde';
					                }
					        }
					    </script>
					    <p>Vous allez être redirigé automatiquement vers la page de connexion dans <span id='compteur'>5</span> <span id='sec'>secondes</span> :)</p>";
					$box = "alert alert-success";
					$form = false;
					$title = "Vous êtes inscrit ! Bienvenue :)";
				}
				else
				{
					$status = "<i class=\"fa fa-times\"></i> Vous n'avez pas validé le captcha !";
					$box = "alert alert-warning";
					$form = true;
					$title = "Formulaire d'inscription";
				}
			}
			else
			{
				$status = "<i class=\"fa fa-times\"></i> Les mots de passe ne correspondent pas.";
				$box = "alert alert-warning";
				$form = true;
				$title = "Formulaire d'inscription";
			}
		}
		else
		{
			$status = "<i class=\"fa fa-times\"></i> Le pseudo est déjà utilisé.";
			$box = "alert alert-warning";
			$form = true;
			$title = "Formulaire d'inscription";
		}
	}
	else
	{
		$status = "<i class=\"fa fa-times\"></i> L'adresse mail fournie n'est pas conforme.";
		$box = "alert alert-warning";
		$form = true;
		$title = "Formulaire d'inscription";
	}
}
else
{
	$form = true;
	$title = "Formulaire d'inscription";
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
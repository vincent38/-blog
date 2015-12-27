<?php
//Démarrage de la session
session_start();
//Inclusion des ID SQL
include_once("modele/connexionsql.php");
//Inclusion des fonctions relatives aux membres
include_once("modele/fonctionsdb.php");

include_once("apivariables.php");

//Redirecteur anti double co
if (isset($_SESSION["token"]) AND !empty($_SESSION["token"]))
{
	header("Location: sendimgshack.php");
}

//Test if login
if (isset($_POST["user"]) AND isset($_POST["password"]))
{
	$login = curl_init();

	$url = "http://api.imageshack.com/v2/user/login";

	$parameters = array(
		"user"=>$_POST["user"],
		"password"=>$_POST["password"]);

	curl_setopt($login, CURLOPT_URL, $url);
	curl_setopt($login, CURLOPT_POST, true);
	curl_setopt($login, CURLOPT_POSTFIELDS, $parameters);
	curl_setopt($login, CURLOPT_RETURNTRANSFER, true);

	$out = curl_exec($login);

	$outParsed = json_decode($out, true);

	if (isset($outParsed['result']['auth_token']))
	{
		$_SESSION["token"] = $outParsed['result']['auth_token'];
	}

	curl_close($login);

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

$title = "Connexion à Imageshack";

include_once("vue/loginimgshack.php")
?>
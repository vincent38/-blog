<?php
//Démarrage de la session
session_start();
//Inclusion des ID SQL
include_once("modele/connexionsql.php");
//Inclusion des fonctions relatives aux membres
include_once("modele/fonctionsdb.php");

include_once("apivariables.php");

//Test if file
if (isset($_FILES["file"]))
{
	$file = curl_init();

	$url = "http://api.imageshack.com/v2/images/";

	$fileslt = new CurlFile($_FILES["file"]["tmp_name"]);

	$parameters = array(
		"auth_token"=>$_SESSION["token"],
		"file"=>$fileslt,
		"api_key"=>$imageshack);

	curl_setopt($file, CURLOPT_URL, $url);
	curl_setopt($file, CURLOPT_POST, true);
	curl_setopt($file, CURLOPT_POSTFIELDS, $parameters);
	curl_setopt($file, CURLOPT_RETURNTRANSFER, true);

	$out = curl_exec($file);

	$outParsed = json_decode($out, true);

	curl_close($file);

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

include_once("vue/sendimgshack.php")
?>
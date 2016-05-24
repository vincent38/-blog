<?php
//Démarrage de la session
session_start();
//Inclusion des ID SQL
include_once("modele/connexionsql.php");
//Inclusion des fonctions relatives aux membres
include_once("modele/fonctionsdb.php");

include_once("apivariables.php");

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
		$_SESSION["username_is"] = $outParsed['result']['username'];
		$_SESSION["userid_is"] = $outParsed['result']['userid'];
		$_SESSION["membership_is"] = $outParsed['result']['membership'];
	}

	curl_close($login);

}

if (isset($_SESSION["token"]) AND isset($_SESSION["username_is"]) AND isset($_SESSION["userid_is"]) AND isset($_SESSION["membership_is"]))
{
	$imgshack = true;
}

$title = "Connexion à Imageshack";

include_once("vue/loginimgshack.php")
?>
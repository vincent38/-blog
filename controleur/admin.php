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
if ($access["miaounet_admin"] == "0")
{
	header("Location: index.php");
}

$users = getUsers();

foreach ($users as $cle => $user)
{
	$users["cle"]["pseudo"] = htmlspecialchars($user["pseudo"]);
	$users["cle"]["date_inscription"] = $user["date_inscription"];
	$users["cle"]["id"] = $user["id"];
	$users["cle"]["rank"] = $user["rank"];
}

$title = "MiaouNET - Administration";

//Carrousel POST
if (isset($_POST["img1"]) AND isset($_POST["img2"]) AND isset($_POST["img3"]) AND isset($_POST["link1"]) AND isset($_POST["link2"]) AND isset($_POST["link3"])){
	setParam("img1", $_POST["img1"]);
	setParam("img2", $_POST["img2"]);
	setParam("img3", $_POST["img3"]);
	setParam("link1", $_POST["link1"]);
	setParam("link2", $_POST["link2"]);
	setParam("link3", $_POST["link3"]);
	if (isset($_POST["carrousel"])){
		setParam("carrousel", "true");
	} else {
		setParam("carrousel", "false");
	}
	$outputCarrousel = "Les paramètres du carrousel ont été définis dans la BDD.";
}

//Tag cloud POST
if (isset($_POST["confirmtag"])){
	if (isset($_POST["tagcloud"])){
		setParam("tagcloud", "true");
	} else {
		setParam("tagcloud", "false");
	}
	$outputTagCloud = "Les paramètres du nuage de mots ont été définis dans la BDD.";
}

//Contact POST
if (isset($_POST["confirmcontact"])){
	setParam("emailContact", $_POST["formEmail"]);
	if (isset($_POST["contactForm"])){
		setParam("contact", "true");
	} else {
		setParam("contact", "false");
	}
	$outputContact = "Les paramètres du formulaire de contact ont été définis dans la BDD.";
}

//Maintenance POST
if (isset($_POST["confirmmtce"])){
	setParam("maintenanceMessage", $_POST["mtceTxt"]);
	if (isset($_POST["mtceShow"])){
		setParam("maintenanceMode", "true");
	} else {
		setParam("maintenanceMode", "false");
	}
	$outputMaintenance = "Les paramètres de maintenance ont été définis dans la BDD.";
}

//Gestion carrousel + tag + contact
$carrouselShow = returnValueFromParam("carrousel");
$tagShow = returnValueFromParam("tagcloud");
$contactForm = returnValueFromParam("contact");
$formEmail = returnValueFromParam("emailContact");
$img1 = returnValueFromParam("img1");
$img2 = returnValueFromParam("img2");
$img3 = returnValueFromParam("img3");
$link1 = returnValueFromParam("link1");
$link2 = returnValueFromParam("link2");
$link3 = returnValueFromParam("link3");

//Gestion maintenance
$mtceShow = returnValueFromParam("maintenanceMode");
$mtceTxt = returnValueFromParam("maintenanceMessage");

include_once("vue/admin.php");
?>
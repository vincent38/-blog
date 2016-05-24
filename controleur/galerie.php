<?php
/*
	controleur/charte.php par Vincent AUBRIOT
	Availible @ https://github.com/vincent38/-blog/
	Contient : Charte

	Inclus dans : ../charte.php
*/
session_start();

//Inclusion connexionBDD
include_once("modele/connexionsql.php");

//Inclusion fonctions SQL
include_once("modele/fonctionsdb.php");

//Inclusion api
include_once("apivariables.php");

//Test si maintenance
if(returnValueFromParam("maintenanceMode") == "true"){
	header("Location: maintenance.php");
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

$title = "Galerie";

//Read the files

$nbFiles = 0;
$picsList = "";

if ($dossier = opendir("./pics_galerie"))
{
	while (($fichier = readdir($dossier)) !== false)
	{
		if ($fichier != "." && $fichier != ".." && $fichier != "index.php" && !is_dir($fichier))
		{
			$nbFiles ++;
			$picList[$nbFiles] = $fichier;
		}
	}
	closedir($dossier);
}

$number = 0;
$totalRows = round(($nbFiles / 4) + 1, PHP_ROUND_HALF_EVEN);
$final = "";

for ($i = 1; $i < $totalRows; $i++)
	{
	$final .= '<div class="row">';
	    for ($j=0; $j < 4; $j++) 
	    { 
	        $number++;
	        if (!empty($picList[$number])) {
	        	$final .= '<div class="col-xs-6 col-md-3">';
	        	$final .= '<a onclick="fullPage(\'./pics_galerie/'.$picList[$number].'\')" class="thumbnail">';
			    $final .= '<img src="./pics_galerie/'.$picList[$number].'" alt="Test">';
			   	$final .= '</a></div>';
	        }	
	    }
	    $final .= '</div>';
	}

//Inclusion vue index 
include_once("vue/galerie.php");
?>
